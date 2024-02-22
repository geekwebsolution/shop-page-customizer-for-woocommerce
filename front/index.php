<?php
add_action('init', 'wspc_shop_page_customizer_option_class', 2  );

require_once( WSPC_PLUGIN_DIR_PATH .'front/product-loop-setting.php');
require_once( WSPC_PLUGIN_DIR_PATH .'front/shop-page-setting.php');

function wspc_shop_page_customizer_option_class(){
    if( !is_admin() ) {
        $product_loop_obj  = new wspc_front_product_loop_settings();
        $product_loop_obj->wspc_customizations_loop();
    

        $shop_page_obj  = new wspc_front_shop_page_settings();
        $shop_page_obj->wspc_customizations_shop_page();
    }
    
}
?>