<?php
/*
Plugin Name: Shop Page Customizer for WooCommerce
Description: Woocommerce shop page customizer is an excellent plugin to customize the WooCommerce shop page. It allows you to edit your product title, price add to cart button, sale flash in a few clicks.
Author: Geek Code Lab
Version: 1.7
WC tested up to: 8.6.0
Author URI: https://geekcodelab.com/
Text Domain : woocommerce-shop-page-customizer

*/

if (!defined('ABSPATH')) exit;

if (!defined("WSPC_PLUGIN_DIR_PATH"))

	define("WSPC_PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));

if (!defined("WSPC_PLUGIN_URL"))
    
    define("WSPC_PLUGIN_URL", plugins_url() . '/' . basename(dirname(__FILE__)));

if (!defined("WSPC_PLUGIN_DIR")) define("WSPC_PLUGIN_DIR", plugin_basename(__DIR__));
if (!defined("WSPC_PLUGIN_BASENAME")) define("WSPC_PLUGIN_BASENAME", plugin_basename(__FILE__));
    
define("wspc_BUILD", '1.7');

require(SMMGK_PATH . 'updater/updater.php');

register_activation_hook( __FILE__, 'wspc_plugin_active_woocommerce_shop_page_customizer' );
function wspc_plugin_active_woocommerce_shop_page_customizer(){
	wspc_updater_activate();
	if (is_plugin_active( 'shop-page-customizer-for-woo-pro/shop-page-customizer-for-woo-pro.php' ) ) {		
		deactivate_plugins('shop-page-customizer-for-woo-pro/shop-page-customizer-for-woo-pro.php');
   	}
}

add_action('upgrader_process_complete', 'wspc_updater_activate'); // remove  transient  on plugin  update

/** Trigger an admin notice if WooCommerce is not installed.*/
if ( ! function_exists( 'wspc_install_woocommerce_admin_notice' ) ) {
	function wspc_install_woocommerce_admin_notice() { ?>
		<div class="error">
			<p>
				<?php
				// translators: %s is the plugin name.
				echo esc_html__( sprintf( '%s is enabled but not effective. It requires WooCommerce in order to work.', 'Shop Page Customizer for WooCommerce' ), 'woocommerce-shop-page-customizer' );
				?>
			</p>
		</div>
		<?php
	}
}
function wspc_woocommerce_constructor() {
    // Check WooCommerce installation
	if ( ! function_exists( 'WC' ) ) {
		add_action( 'admin_notices', 'wspc_install_woocommerce_admin_notice' );
		return;
	}

}
add_action( 'plugins_loaded', 'wspc_woocommerce_constructor' );

require_once( WSPC_PLUGIN_DIR_PATH .'admin/options.php');
require_once( WSPC_PLUGIN_DIR_PATH . 'admin/product-loop-description-meta.php' );
require_once( WSPC_PLUGIN_DIR_PATH .'front/index.php');
require_once( WSPC_PLUGIN_DIR_PATH .'/customizer/customizer-library/customizer-library.php');
require_once( WSPC_PLUGIN_DIR_PATH .'/customizer/styles.php');


add_action('admin_enqueue_scripts', 'wspc_admin_enqueue_scripts');

function wspc_admin_enqueue_scripts($hook){
	if ($hook == 'woocommerce_page_wspc-option-page') {
		$js		=	WSPC_PLUGIN_URL.'/assets/js/admin_script.js';
		wp_enqueue_style('wspc_admin_style', WSPC_PLUGIN_URL . '/assets/css/admin-style.css' , '',wspc_BUILD);
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('wspc_admin_js',$js,array('jquery'),wspc_BUILD);
	}
}

add_action('wp_enqueue_scripts', 'wspc_include_front_script');
function wspc_include_front_script()
{
    wp_enqueue_style("wspc_front_style", WSPC_PLUGIN_URL . "/assets/css/front-style.css", '',wspc_BUILD);
    // wp_enqueue_script('wspc_donation_script', WSPC_PLUGIN_URL.'/assets/js/wspc_front_script.js', array('jquery'), wspc_BUILD);
}

function wspc_plugin_add_settings_link($links)
{
	$support_link = '<a href="https://geekcodelab.com/contact/"  target="_blank" >' . __('Support') . '</a>';
	array_unshift($links, $support_link);

	$pro_link = '<a href="https://geekcodelab.com/wordpress-plugins/shop-page-customizer-for-woocommerce-pro"  target="_blank" style="color:#46b450;font-weight: 600;">' . __('Premium Upgrade') . '</a>';
	array_unshift($links, $pro_link);

	$settings_link = '<a href="admin.php?page=wspc-option-page">' . __('Settings') . '</a>';
	array_unshift($links, $settings_link);
	return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'wspc_plugin_add_settings_link');

/**
 * Added HPOS support for woocommerce
 */
add_action( 'before_woocommerce_init', 'wspc_before_woocommerce_init' );
function wspc_before_woocommerce_init() {
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
		\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
	}
}