<?php
/**
 * Integrate ACF Blocks with Timber.
 * See _render() function in "/module/gutenberg/acf-blocks.php" for its implementation.
 */
namespace Timber;

use Timber\Core;
use Timber\CoreInterface;

class Block extends Core implements CoreInterface {
	public $PostClass = 'Timber\Block';
	public $TermClass = 'Block';
  public $block;

	public function __construct( $block ) {
    if( $block ) {
      $this->block = $block;
    }
	}

	public function __toString() {
		return $this->block_data['name'];
  }

  public function get_field( $key = '' ) {
    return self::meta( $key );
  }

	public function meta( $key ) {
    if( $key != '' && isset( $this->block['id'] ) && $this->block['id'] != '' ) {
      return get_field( $key, $this->block['id'] );
    }
  }
}
