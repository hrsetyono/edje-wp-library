<?php
/*
  Integrate ACF Gutenberg Block with Timber

  HOW TO:

  1. Create a block by following https://www.advancedcustomfields.com/blog/acf-5-8-introducing-acf-blocks-for-gutenberg/

  2. Render the block like this:

      function my_acf_block_render( $block ) {
        $slug = str_replace( 'acf/', '', $block['name'] );
        $context = array(
          'block' => new Timber\Block( $block )
        );

        Timber::render( "blocks/_{$slug}-block.twig", $context );
      }
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
