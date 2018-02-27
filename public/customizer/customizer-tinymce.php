<?php
/*
  Allow visual editor on Customizer panel
*/
if( class_exists( 'WP_Customize_Control' ) ):

  /*
	  TinyMCE Custom Control

		@link https://github.com/maddisondesigns/customizer-custom-controls
	*/
	class H_Customize_TinyMCE_Control extends WP_Customize_Control {
		/*
			Enqueue JS and CSS
		*/
		public function enqueue() {
		  wp_enqueue_script( 'h_customizer_js', H_URL . '/assets/js/h-customizer.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'h_customizer_css',  H_URL . '/assets/css/h-customizer.css', array(), '1.0', 'all' );
			wp_enqueue_editor();
		}

		/*
		  Pass our TinyMCE toolbar string to JavaScript
		*/
		public function to_json() {
			parent::to_json();

			$this->json['toolbar1'] = isset( $this->input_attrs['toolbar1'] ) ? esc_attr( $this->input_attrs['toolbar1'] ) : 'bold italic bullist numlist link';
			$this->json['toolbar2'] = isset( $this->input_attrs['toolbar2'] ) ? esc_attr( $this->input_attrs['toolbar2'] ) : '';
		}

		/*
		  Render the control in the customizer
		*/
		public function render_content() {
			$id = _H::to_param( $this->id );
		?>
			<div class="tinymce-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<textarea id="<?php echo esc_attr( $id ); ?>" class="customize-control-tinymce-editor" rows="8" <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></textarea>
			</div>
		<?php
		}
	}

endif;
