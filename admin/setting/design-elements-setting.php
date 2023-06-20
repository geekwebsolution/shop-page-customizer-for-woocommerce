<?php
if (!class_exists('wspc_design_elements_settings')) {
    $wspc_des_ele_options = get_option('wspc_desgin_elements_options');



   
    class wspc_design_elements_settings{

        public function __construct(){       
            add_action('admin_init', array($this, 'design_elements_register_settings_init'));
        }


        function design_elements_setting_form_option(){ ?>

            <form action="options.php?tab=wspc-design-elements" method="post">

                <?php  settings_fields('wspc-loop-setting-options');   ?>

                <div class="wspc-section">
                    <?php do_settings_sections('wspc_customize_cart_btn_section'); ?>
                </div>

                <div class="wspc-section">
                    <?php do_settings_sections('wspc_customize_shop_now_section'); ?>
                </div>

                <div class="wspc-section">
                    <?php do_settings_sections('wspc_customize_sale_flash_btn_section'); ?>
                </div>

                <div class="wspc-section">
                    <?php do_settings_sections('wspc_customize_product_title_section'); ?>
                </div>

                <div class="wspc-section">
                    <?php do_settings_sections('wspc_customize_product_price_section'); ?>
                </div>
               
                <?php
               
                submit_button('Save Settings');
                ?>

            </form>

            <?php
        }

        /* register setting */
        public function design_elements_register_settings_init()
        {
            register_setting('wspc-loop-setting-options', 'wspc_desgin_elements_options', array($this, 'sanitize_settings'));


            /** Customize Add to Cart Button section start */
            add_settings_section(
                'wspc_shop_page_layout_setting',
                __('Customize Add to Cart Button', 'woocommerce-shop-page-customizer'),
                array(),
                'wspc_customize_cart_btn_section'
            );

            add_settings_field(
                'cart_button_color',
                __('Button Color', 'woocommerce-shop-page-customizer'),
                array($this, 'select_color_html'),
                'wspc_customize_cart_btn_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'cart_btn_color',
                    'description'   => 'Change add to cart button background color.',
                    'class'         => 'wspc_disabled'
                ]
            );

            add_settings_field(
                'cart_button_font_color',
                __('Button Font Color', 'woocommerce-shop-page-customizer'),
                array($this, 'select_color_html'),
                'wspc_customize_cart_btn_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'cart_btn_font_color',
                    'description'   => 'Change add to cart button font color.',
                    'class'         => 'wspc_disabled'
                ]
            );

            add_settings_field(
                'cart_button_hover_color',
                __('Button Hover Color', 'woocommerce-shop-page-customizer'),
                array($this, 'select_color_html'),
                'wspc_customize_cart_btn_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'cart_btn_hover_color',
                    'description'   => 'Change add to cart button hover background color.',
                    'class'         => 'wspc_disabled'
                ]
            );

            add_settings_field(
                'cart_button_font_hover_color',
                __('Button Font Hover Color', 'woocommerce-shop-page-customizer'),
                array($this, 'select_color_html'),
                'wspc_customize_cart_btn_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'cart_btn_font_hover_color',
                    'description'   => 'Change add to cart button font hover color.',
                    'class'         => 'wspc_disabled'
                ]
            );

            add_settings_field(
                'cart_button_font_size',
                __('Font Size', 'woocommerce-shop-page-customizer'),
                array($this, 'layout_html'),
                'wspc_customize_cart_btn_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'cart_btn_font_size',
                    'description'   => 'Change button font size.'
                ]
            );

            add_settings_field(
                'cart_button_border_radius',
                __('Border Radius', 'woocommerce-shop-page-customizer'),
                array($this, 'layout_html'),
                'wspc_customize_cart_btn_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'cart_btn_border_radius',
                    'description'   => 'Change button border radius.'
                ]
            );

            add_settings_field(
                'cart_button_padding',
                __('Padding', 'woocommerce-shop-page-customizer'),
                array($this, 'layout_html'),
                'wspc_customize_cart_btn_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'cart_btn_padding',
                    'description'   => 'Change button padding.'
                ]
            );

            /** Customize Add to Cart Button section end */

             /** Customize Shop Now Button section start */
             add_settings_section(
                'wspc_shop_page_layout_setting',
                __('Customize Shop Now Button', 'woocommerce-shop-page-customizer'),
                array(),
                'wspc_customize_shop_now_section'
            );

            add_settings_field(
                'buy_now_color',
                __('Button Color', 'woocommerce-shop-page-customizer'),
                array($this, 'select_color_html'),
                'wspc_customize_shop_now_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'shop_now_color',
                    'description'   => 'Change add to cart button background color.',
                    'class'         => 'wspc_disabled'
                ]
            );

            add_settings_field(
                'buy_now_font_color',
                __('Button Font Color', 'woocommerce-shop-page-customizer'),
                array($this, 'select_color_html'),
                'wspc_customize_shop_now_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'shop_now_font_color',
                    'description'   => 'Change add to cart button font color.',
                    'class'         => 'wspc_disabled'
                ]
            );

            add_settings_field(
                'buy_now_hover_color',
                __('Button Hover Color', 'woocommerce-shop-page-customizer'),
                array($this, 'select_color_html'),
                'wspc_customize_shop_now_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'shop_now_hover_color',
                    'description'   => 'Change add to cart button hover background color.',
                    'class'         => 'wspc_disabled'
                ]
            );

            add_settings_field(
                'buy_now_font_hover_color',
                __('Button Font Hover Color', 'woocommerce-shop-page-customizer'),
                array($this, 'select_color_html'),
                'wspc_customize_shop_now_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'shop_now_font_hover_color',
                    'description'   => 'Change add to cart button font hover color.',
                    'class'         => 'wspc_disabled'
                ]
            );

            add_settings_field(
                'buy_now_font_size',
                __('Font Size', 'woocommerce-shop-page-customizer'),
                array($this, 'layout_html'),
                'wspc_customize_shop_now_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'shop_now_font_size',
                    'description'   => 'Change button font size.'
                ]
            );

            add_settings_field(
                'buy_now_border_radius',
                __('Border Radius', 'woocommerce-shop-page-customizer'),
                array($this, 'layout_html'),
                'wspc_customize_shop_now_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'shop_now_border_radius',
                    'description'   => 'Change button border radius.'
                ]
            );

            add_settings_field(
                'buy_now_padding',
                __('Padding', 'woocommerce-shop-page-customizer'),
                array($this, 'layout_html'),
                'wspc_customize_shop_now_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'shop_now_padding',
                    'description'   => 'Change button border radius.'
                ]
            );

            /** Customize Shop Now Button section end */

            /** Customize Sale Flash section start */
            add_settings_section(
                'wspc_sale_flash_label_setting',
                __('Customize Sale Flash', 'woocommerce-shop-page-customizer'),
                array(),
                'wspc_customize_sale_flash_btn_section'
            );

            add_settings_field(
                'sale_flash_button_color',
                __('Sale Banner Color', 'woocommerce-shop-page-customizer'),
                array($this, 'select_color_html'),
                'wspc_customize_sale_flash_btn_section',
                'wspc_sale_flash_label_setting',
                [
                    'label_for'     => 'sale_flash_btn_color',
                    'description'   => 'Change sale banner background color.',
                    'class'         => 'wspc_disabled'
                ]
            );

            add_settings_field(
                'sale_flash_button_font_color',
                __('Sale Banner Font Color', 'woocommerce-shop-page-customizer'),
                array($this, 'select_color_html'),
                'wspc_customize_sale_flash_btn_section',
                'wspc_sale_flash_label_setting',
                [
                    'label_for'     => 'sale_flash_btn_font_color',
                    'description'   => 'Change sale banner button font color.',
                    'class'         => 'wspc_disabled'
                ]
            );

            add_settings_field(
                'sale_flash_button_border_radius',
                __('Border Radius', 'woocommerce-shop-page-customizer'),
                array($this, 'layout_html'),
                'wspc_customize_sale_flash_btn_section',
                'wspc_sale_flash_label_setting',
                [
                    'label_for'     => 'sale_flash_btn_border_radius',
                    'description'   => 'Change sale banner border radius.'
                ]
            );

            add_settings_field(
                'sale_flash_button_font_size',
                __('Font Size', 'woocommerce-shop-page-customizer'),
                array($this, 'layout_html'),
                'wspc_customize_sale_flash_btn_section',
                'wspc_sale_flash_label_setting',
                [
                    'label_for'     => 'sale_flash_btn_font_size',
                    'description'   => 'Change sale banner font size.'
                ]
            );

            add_settings_field(
                'sale_flash_button_font_bold',
                __('Font Weight', 'woocommerce-shop-page-customizer'),
                array($this, 'font_weight_html'),
                'wspc_customize_sale_flash_btn_section',
                'wspc_sale_flash_label_setting',
                [
                    'label_for'     => 'sale_flash_btn_font_bold',
                    'description'   => 'Change sale banner font weight.'
                ]
            );

            /** Customize Sale Flash section end */

            /** Customize Product Title section start */
            add_settings_section(
                'wspc_product_title_label_setting',
                __('Customize Product Title', 'woocommerce-shop-page-customizer'),
                array(),
                'wspc_customize_product_title_section'
            );

            add_settings_field(
                'product_title_button_font_color',
                __('Font Color', 'woocommerce-shop-page-customizer'),
                array($this, 'select_color_html'),
                'wspc_customize_product_title_section',
                'wspc_product_title_label_setting',
                [
                    'label_for'     => 'product_title_font_color',
                    'description'   => 'Change product title font color.'
                ]
            );

            add_settings_field(
                'product_title_button_font_size',
                __('Font Size', 'woocommerce-shop-page-customizer'),
                array($this, 'layout_html'),
                'wspc_customize_product_title_section',
                'wspc_product_title_label_setting',
                [
                    'label_for'     => 'product_title_font_size',
                    'description'   => 'Change product title font size.'
                ]
            );

            /** Customize Product Title section end */


            
            /** Customize Product Price section start */
            add_settings_section(
                'wspc_product_price_label_setting',
                __('Customize Product Price', 'woocommerce-shop-page-customizer'),
                array(),
                'wspc_customize_product_price_section'
            );

            add_settings_field(
                'product_price_button_font_color',
                __('Font Color', 'woocommerce-shop-page-customizer'),
                array($this, 'select_color_html'),
                'wspc_customize_product_price_section',
                'wspc_product_price_label_setting',
                [
                    'label_for'     => 'product_price_font_color',
                    'description'   => 'Change product price font color.'
                ]
            );

            add_settings_field(
                'product_price_button_font_size',
                __('Font Size', 'woocommerce-shop-page-customizer'),
                array($this, 'layout_html'),
                'wspc_customize_product_price_section',
                'wspc_product_price_label_setting',
                [
                    'label_for'     => 'product_price_font_size',
                    'description'   => 'Change product price font size.'
                ]
            );

            /** Customize Product Price section end */

        

           
        }

        public function select_color_html($args){
            global $wspc_des_ele_options;
            $value = isset($wspc_des_ele_options[$args['label_for']]) ? $wspc_des_ele_options[$args['label_for']] : '';
            ?>
            <div class="wspc-pro-feature-feild">
            <input type="text" class="wdpgk_colorpicker" name="wspc_desgin_elements_options[<?php esc_attr_e( $args['label_for'] ); ?>]" id="<?php esc_attr_e( $args['label_for'] ); ?>" value="<?php _e($value); ?>" >
            <span class="wspc-pro">pro</span>
            </div>
            <p class="wspc-input-note"><?php esc_attr_e($args['description'],'woocommerce-shop-page-customizer') ?></p>
            <?php
        }

        public function layout_html($args){
            global $wspc_des_ele_options;

            $value = isset($wspc_des_ele_options[$args['label_for']]) ? $wspc_des_ele_options[$args['label_for']] : '';


            ?>
            <input type="number" name="wspc_desgin_elements_options[<?php esc_attr_e( $args['label_for'] ); ?>]" id="<?php esc_attr_e( $args['label_for'] ); ?>" value="<?php _e($value); ?>">
            <p class="wspc-input-note"><?php esc_attr_e($args['description'],'woocommerce-shop-page-customizer') ?></p>
            <?php
        }

        public function font_weight_html($args){
            global $wspc_des_ele_options;

            $value = isset($wspc_des_ele_options[$args['label_for']]) ? $wspc_des_ele_options[$args['label_for']] : '';


            ?>
            <input type="number" name="wspc_desgin_elements_options[<?php esc_attr_e( $args['label_for'] ); ?>]" id="<?php esc_attr_e( $args['label_for'] ); ?>" min="100" max="700" step="100" value="<?php _e($value); ?>">
            <p class="wspc-input-note"><?php esc_attr_e($args['description'],'woocommerce-shop-page-customizer') ?></p>
            <?php
        }




        public function sanitize_settings($input)
        {
            $new_input = array();


            if (isset($input['cart_btn_border_radius']) && !empty($input['cart_btn_border_radius'])) {

                $new_input['cart_btn_border_radius'] = sanitize_text_field($input['cart_btn_border_radius']);
            }

            if (isset($input['cart_btn_padding']) && !empty($input['cart_btn_padding'])) {

                $new_input['cart_btn_padding'] = sanitize_text_field($input['cart_btn_padding']);
            }

            if (isset($input['cart_btn_font_size']) && !empty($input['cart_btn_font_size'])) {

                $new_input['cart_btn_font_size'] = sanitize_text_field($input['cart_btn_font_size']);
            }
            
            if (isset($input['shop_now_font_size']) && !empty($input['shop_now_font_size'])) {

                $new_input['shop_now_font_size'] = sanitize_text_field($input['shop_now_font_size']);
            }

            if (isset($input['shop_now_border_radius']) && !empty($input['shop_now_border_radius'])) {

                $new_input['shop_now_border_radius'] = sanitize_text_field($input['shop_now_border_radius']);
            }

            if (isset($input['shop_now_padding']) && !empty($input['shop_now_padding'])) {

                $new_input['shop_now_padding'] = sanitize_text_field($input['shop_now_padding']);
            }

            if (isset($input['sale_flash_btn_border_radius']) && !empty($input['sale_flash_btn_border_radius'])) {

                $new_input['sale_flash_btn_border_radius'] = sanitize_text_field($input['sale_flash_btn_border_radius']);
            }

            if (isset($input['sale_flash_btn_font_size']) && !empty($input['sale_flash_btn_font_size'])) {

                $new_input['sale_flash_btn_font_size'] = sanitize_text_field($input['sale_flash_btn_font_size']);
            }

            if (isset($input['sale_flash_btn_font_bold']) && !empty($input['sale_flash_btn_font_bold'])) {

                $new_input['sale_flash_btn_font_bold'] = sanitize_text_field($input['sale_flash_btn_font_bold']);
            }

            if (isset($input['product_title_font_color'])) {
                
                $new_input['product_title_font_color'] = sanitize_text_field($input['product_title_font_color']);
            }

            if (isset($input['product_title_font_size']) && !empty($input['product_title_font_size'])) {

                $new_input['product_title_font_size'] = sanitize_text_field($input['product_title_font_size']);
            }

            if (isset($input['product_price_font_color'])) {
                
                $new_input['product_price_font_color'] = sanitize_text_field($input['product_price_font_color']);
            }

            if (isset($input['product_price_font_size']) && !empty($input['product_price_font_size'])) {

                $new_input['product_price_font_size'] = sanitize_text_field($input['product_price_font_size']);
            }
            

            
            return $new_input;
        }
    }

}