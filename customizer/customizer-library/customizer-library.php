<?php
/**
 * Customizer Library
 *
 * @package        woo_shop_customizer_style_library
 * @author         Devin Price, The Theme Foundry
 * @license        GPL-2.0+
 * @version        1.3.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Continue if the woo_shop_customizer_style_library isn't already in use.
if ( ! class_exists( 'woo_shop_customizer_style_library' ) ) : // Helper functions to output the customizer controls.


	// Helper functions to build the inline CSS.
	require_once 'style-builder.php';


	/**
	 * Class wrapper with useful methods for interacting with the theme customizer.
	 */
	class woo_shop_customizer_style_library {

		/**
		 * The one instance of woo_shop_customizer_style_library.
		 *
		 * @since 1.0.0.
		 *
		 * @var   woo_shop_customizer_style_library_Styles    The one instance for the singleton.
		 */
		private static $instance;

		/**
		 * The array for storing $options.
		 *
		 * @since 1.0.0.
		 *
		 * @var   array    Holds the options array.
		 */

		public $options = array();

		/**
		 * Instantiate or return the one woo_shop_customizer_style_library instance.
		 *
		 * @since  1.0.0.
		 *
		 * @return woo_shop_customizer_style_library
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function add_options( $options = array() ) {
			$this->options = array_merge( $options, $this->options );
		}

		public function get_options() {
			return $this->options;
		}

}

endif;
?>