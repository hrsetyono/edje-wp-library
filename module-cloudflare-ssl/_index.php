<?php
/**
 * Plugin Name: Edje Cloudflare Flexible SSL
 * 
 * Reference: https://wordpress.org/plugins/cloudflare-flexible-ssl/
 */
class H_CloudflareSSL {

	public function __construct() {
		if ( !$this->isSsl() && $this->isSslToNonSslProxy() ) {
			$_SERVER[ 'HTTPS' ] = 'on';
			add_action( 'shutdown', [ $this, 'maintainPluginLoadPosition' ] );
		}
	}

	/**
	 * @return bool
	 */
	private function isSsl() {
		return function_exists( 'is_ssl' ) && is_ssl();
	}

	/**
	 * @return bool
	 */
	private function isSslToNonSslProxy() {
		$bIsProxy = false;

		$aServerKeys = array( 'HTTP_CF_VISITOR', 'HTTP_X_FORWARDED_PROTO' );
		foreach ( $aServerKeys as $sKey ) {
			if ( isset( $_SERVER[ $sKey ] ) && ( strpos( $_SERVER[ $sKey ], 'https' ) !== false ) ) {
				$bIsProxy = true;
				break;
			}
		}

		return $bIsProxy;
	}

	/**
	 * Sets this plugin to be the first loaded of all the plugins.
	 */
	public function maintainPluginLoadPosition() {
		$sBaseFile = plugin_basename( __FILE__ );
		$nLoadPosition = $this->getActivePluginLoadPosition( $sBaseFile );
		if ( $nLoadPosition > 1 ) {
			$this->setActivePluginLoadPosition( $sBaseFile, 0 );
		}
	}

	/**
	 * @param string $sPluginFile
	 * @return int
	 */
	private function getActivePluginLoadPosition( $sPluginFile ) {
		$sOptionKey = is_multisite() ? 'active_sitewide_plugins' : 'active_plugins';
		$aActive = get_option( $sOptionKey );
		$nPosition = -1;
		if ( is_array( $aActive ) ) {
			$nPosition = array_search( $sPluginFile, $aActive );
			if ( $nPosition === false ) {
				$nPosition = -1;
			}
		}
		return $nPosition;
	}

	/**
	 * @param string $sPluginFile
	 * @param int    $nDesiredPosition
	 */
	private function setActivePluginLoadPosition( $sPluginFile, $nDesiredPosition = 0 ) {

		$aActive = $this->setArrayValueToPosition( get_option( 'active_plugins' ), $sPluginFile, $nDesiredPosition );
		update_option( 'active_plugins', $aActive );

		if ( is_multisite() ) {
			$aActive = $this->setArrayValueToPosition( get_option( 'active_sitewide_plugins' ), $sPluginFile, $nDesiredPosition );
			update_option( 'active_sitewide_plugins', $aActive );
		}
	}

	/**
	 * @param array $aSubjectArray
	 * @param mixed $mValue
	 * @param int   $nDesiredPosition
	 * @return array
	 */
	private function setArrayValueToPosition( $aSubjectArray, $mValue, $nDesiredPosition ) {

		if ( $nDesiredPosition < 0 || !is_array( $aSubjectArray ) ) {
			return $aSubjectArray;
		}

		$nMaxPossiblePosition = count( $aSubjectArray ) - 1;
		if ( $nDesiredPosition > $nMaxPossiblePosition ) {
			$nDesiredPosition = $nMaxPossiblePosition;
		}

		$nPosition = array_search( $mValue, $aSubjectArray );
		if ( $nPosition !== false && $nPosition != $nDesiredPosition ) {

			// remove existing and reset index
			unset( $aSubjectArray[ $nPosition ] );
			$aSubjectArray = array_values( $aSubjectArray );

			// insert and update
			// http://stackoverflow.com/questions/3797239/insert-new-item-in-array-on-any-position-in-php
			array_splice( $aSubjectArray, $nDesiredPosition, 0, $mValue );
		}

		return $aSubjectArray;
	}
}

new H_CloudflareSSL();