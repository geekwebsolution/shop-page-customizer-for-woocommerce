<?php 
    include( WSPC_PLUGIN_DIR_PATH .'admin/setting/product-loop-setting.php'); 
    include( WSPC_PLUGIN_DIR_PATH .'admin/setting/shop-page-setting.php'); 
    include( WSPC_PLUGIN_DIR_PATH .'admin/setting/design-elements-setting.php'); 
    include( WSPC_PLUGIN_DIR_PATH .'admin/setting/product-description-setting.php'); 
    include( WSPC_PLUGIN_DIR_PATH .'admin/setting/get-pro-version.php'); 

$default_tab = null;
$tab = "";
$tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : $default_tab;


if (!class_exists('wspc_shop_page_settings')) {


    if ($tab == null) { 
        $loop  = new wspc_product_loop_settings();
        add_action('admin_init', array($loop, 'loop_register_settings_init'));
    }

    if ($tab == "wspc-shop-customizer") {
        $shop_page_class  = new wspc_shop_page_customizer_settings();
        add_action('admin_init', array($shop_page_class, 'shop_page_register_settings_init'));

    }

    if ($tab == "wspc-design-elements") {
        $design_class  = new wspc_design_elements_settings();
        add_action('admin_init', array($design_class, 'design_elements_register_settings_init'));
    }

    if ($tab == "wspc-product-description") {
        $pro_des_class  = new wspc_product_description_settings();
        add_action('admin_init', array($pro_des_class, 'product_description_register_settings_init'));
    }

    class wspc_shop_page_settings
    {
        public function __construct(){
            add_action('admin_menu',  array($this, 'wspc_admin_menu_donation_setting_page'));            
        }
        
        

    function wspc_admin_menu_donation_setting_page(){
        
        add_submenu_page('woocommerce', 'Shop Page Customizer for WooCommerce', 'Shop Page Customizer for WooCommerce', 'manage_options', 'wspc-option-page', array($this, 'shop_page_customize_callback'));
    }
        
        function shop_page_customize_callback()
        {
            $default_tab = null;
            $tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : $default_tab;
            ?>
            <div class="wspc-main-box">
                <div class="wspc-container">
                    <div class="wspc-header">
                        <h1 class="wspcp-h1"> <?php _e('Shop Page Customizer for WooCommerce', 'woocommerce-shop-page-customizer'); ?></h1>
                    </div>
                    <div class="wspc-option-section">

                        <div class="wspc-tabbing-box">
                            <ul class="wspc-tab-list">

                                <li><a href="?page=wspc-option-page" class="nav-tab <?php if ($tab === null) : ?>nav-tab-active<?php endif; ?>"><?php _e('Product Loop Setting', 'woocommerce-shop-page-customizer'); ?></a></li>
                                <li><a href="?page=wspc-option-page&tab=wspc-shop-customizer" class="nav-tab <?php if ($tab === 'wspc-shop-customizer') : ?>nav-tab-active<?php endif; ?>"><?php _e('Shop Page Setting', 'woocommerce-shop-page-customizer'); ?></a></li>
                                <li><a href="?page=wspc-option-page&tab=wspc-design-elements" class="nav-tab <?php if ($tab === 'wspc-design-elements') : ?>nav-tab-active<?php endif; ?>"><?php _e('Design Elements', 'woocommerce-shop-page-customizer'); ?></a></li>
                                <li><a href="?page=wspc-option-page&tab=wspc-product-description" class="nav-tab <?php if ($tab === 'wspc-product-description') : ?>nav-tab-active<?php endif; ?>"><?php _e('Product Description', 'woocommerce-shop-page-customizer'); ?></a></li>
                                <li><a href="?page=wspc-option-page&tab=wspc-pro-version" class="nav-tab <?php if ($tab === 'wspc-pro-version') : ?>nav-tab-active pro-active-tab<?php endif; ?>"><?php _e('Get Pro Version', 'woocommerce-shop-page-customizer'); ?><svg width="18" height="18" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="crown" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-crown fa-w-20 fa-2x"><path fill="#F5BC3E" d="M528 448H112c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm64-320c-26.5 0-48 21.5-48 48 0 7.1 1.6 13.7 4.4 19.8L476 239.2c-15.4 9.2-35.3 4-44.2-11.6L350.3 85C361 76.2 368 63 368 48c0-26.5-21.5-48-48-48s-48 21.5-48 48c0 15 7 28.2 17.7 37l-81.5 142.6c-8.9 15.6-28.9 20.8-44.2 11.6l-72.3-43.4c2.7-6 4.4-12.7 4.4-19.8 0-26.5-21.5-48-48-48S0 149.5 0 176s21.5 48 48 48c2.6 0 5.2-.4 7.7-.8L128 416h384l72.3-192.8c2.5.4 5.1.8 7.7.8 26.5 0 48-21.5 48-48s-21.5-48-48-48z" class=""></path></svg></a></li>
   
                            </ul>
                        </div>

                        <div class="wspc-tabing-option">
                           
                            <?php if ($tab == null) { 

                                $loop  = new wspc_product_loop_settings();    
                                $loop->loop_shop_page_customize_callback();

                            }
                            
                            if ($tab == "wspc-shop-customizer") {
                                
                                $shop_page_class  = new wspc_shop_page_customizer_settings();                                
                                $shop_page_class->shop_page_setting_form_option();

                            }
                            
                            if ($tab == "wspc-design-elements") {
                            
                                $design_class  = new wspc_design_elements_settings();
                                $design_class->design_elements_setting_form_option();

                            }
                            
                            
                            if ($tab == "wspc-product-description") {
                            
                                $pro_des_class  = new wspc_product_description_settings();
                                $pro_des_class->product_description_setting_form_option();

                            }


                            if ($tab == "wspc-pro-version") {
                            
                                $pro_version  = new wspc_get_pro_version();
                                $pro_version->get_pro_version_list();
                                

                            }
                            ?>

                        
                        </div>

                    </div>
                </div>
            </div>

        <?php

        }

        
    }

    new wspc_shop_page_settings();

}