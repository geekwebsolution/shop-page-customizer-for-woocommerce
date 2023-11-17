<?php
if (!class_exists('wspc_product_loop_settings')) {
    $wspc_product_loop_options = get_option('wspc_product_loop_options');
   
    class wspc_product_loop_settings{

        public function __construct(){       
            add_action('admin_init', array($this, 'loop_register_settings_init'));
        }

        function loop_shop_page_customize_callback(){ ?>
            <form action="options.php" method="post">

                <?php  settings_fields('wspc-loop-setting-options');   ?>

                <div class="wspc-section">
                    <?php do_settings_sections('wspc_loop_cart_btn_section'); ?>
                </div>

                <div class="wspc-section">
                    <?php do_settings_sections('wspc_loop_sale_flash_section'); ?>
                </div>

                <div class="wspc-section">
                    <?php do_settings_sections('wspc_loop_hide_meta_section'); ?>
                </div>

                <div class="wspc-section">
                    <?php do_settings_sections('wspc_add_shop_now_section'); ?>
                </div>

                <div class="wspc-section">
                    <?php do_settings_sections('wspc_stock_quantity_manage_section'); ?>
                </div>
                <?php
                submit_button('Save Settings');
                ?>
            </form>
            <?php
        }

        /* register setting */
        public function loop_register_settings_init()
        {
            register_setting('wspc-loop-setting-options', 'wspc_product_loop_options', array($this, 'sanitize_settings'));


            /** Add to cart button section start */
            add_settings_section(
                'wspc_add_to_cart_setting',
                __('Add to cart button text', 'woocommerce-shop-page-customizer'),
                array(),
                'wspc_loop_cart_btn_section'
            );

            add_settings_field(
                'simplae_product_cart',
                __('Simple Product', 'woocommerce-shop-page-customizer'),
                array($this, 'cart_btn_text_change'),
                'wspc_loop_cart_btn_section',
                'wspc_add_to_cart_setting',
                [
                    'label_for'     => 'add_to_cart_text',
                    'description'   => 'Changes the add to cart button text for simple products on all loop pages.'
                ]
            );

            add_settings_field(
                'variable_cart_btn',
                __('Variable Product', 'woocommerce-shop-page-customizer'),
                array($this, 'cart_btn_text_change'),
                'wspc_loop_cart_btn_section',
                'wspc_add_to_cart_setting',
                [
                    'label_for'     => 'variable_add_to_cart_text',
                    'description'   => 'Changes the add to cart button text for variable products on all loop pages.'
                ]
            );

            add_settings_field(
                'grouped_product_cart',
                __('Grouped Product', 'woocommerce-shop-page-customizer'),
                array($this, 'cart_btn_text_change'),
                'wspc_loop_cart_btn_section',
                'wspc_add_to_cart_setting',
                [
                    'label_for'     => 'grouped_add_to_cart_text',
                    'description'   => 'Changes the add to cart button text for grouped products on all loop pages.'
                ]
            );

            add_settings_field(
                'stock_out_product_cart',
                __('Out of Stock Product', 'woocommerce-shop-page-customizer'),
                array($this, 'cart_btn_text_change'),
                'wspc_loop_cart_btn_section',
                'wspc_add_to_cart_setting',
                [
                    'label_for'     => 'out_of_stock_add_to_cart_text',
                    'description'   => 'Changes the add to cart button text for out of stock products on all loop pages.'
                ]
            );
            /** Add to cart button section end */


            /** Sale Flash Section start */

            add_settings_section(
                'wspc_sale_flash_setting',
                __('Sale Flash', 'woocommerce-shop-page-customizer'),
                array(),
                'wspc_loop_sale_flash_section'
            );

            add_settings_field(
                'sale_flash_label',
                __('Sale Badge Text', 'woocommerce-shop-page-customizer'),
                array($this, 'sale_flash_btn_html'),
                'wspc_loop_sale_flash_section',
                'wspc_sale_flash_setting',
                [
                    'label_for' => 'sale_flash_label',
                ]
            );

            /**Sale Flash Section end */

            /** Hide Product Meta section start */

            add_settings_section(
                'wspc_hide_meta_setting',
                __('Hide Product Meta', 'woocommerce-shop-page-customizer'),
                array(),
                'wspc_loop_hide_meta_section'
            );

            add_settings_field(
                'hide_sale_flash_label',
                __('Hide Sale Flash', 'woocommerce-shop-page-customizer'),
                array($this, 'hide_product_meta_html'),
                'wspc_loop_hide_meta_section',
                'wspc_hide_meta_setting',
                [
                    'label_for'     => 'hide_sale_flash',
                ]
            );

            add_settings_field(
                'hide_add_to_cart_label',
                __('Hide Add to cart', 'woocommerce-shop-page-customizer'),
                array($this, 'hide_product_meta_html'),
                'wspc_loop_hide_meta_section',
                'wspc_hide_meta_setting',
                [
                    'label_for'     => 'hide_add_to_cart',
                ]
            );

            add_settings_field(
                'hide_loop_price_label',
                __('Hide Price', 'woocommerce-shop-page-customizer'),
                array($this, 'hide_product_meta_html'),
                'wspc_loop_hide_meta_section',
                'wspc_hide_meta_setting',
                [
                    'label_for'     => 'hide_loop_price',
                ]
            );

            add_settings_field(
                'hide_loop_sale_price_label',
                __('Hide Sale Price', 'woocommerce-shop-page-customizer'),
                array($this, 'hide_product_meta_html'),
                'wspc_loop_hide_meta_section',
                'wspc_hide_meta_setting',
                [
                    'label_for'     => 'hide_loop_sale_price',
                ]
            );
            
            add_settings_field(
                'hide_loop_variable_price_label',
                __('Hide Variable Price', 'woocommerce-shop-page-customizer'),
                array($this, 'hide_product_meta_html'),
                'wspc_loop_hide_meta_section',
                'wspc_hide_meta_setting',
                [
                    'label_for'     => 'hide_loop_variable_price',
                ]
            );

            add_settings_field(
                'hide_loop_rating_label',
                __('Hide Rating', 'woocommerce-shop-page-customizer'),
                array($this, 'hide_product_meta_html'),
                'wspc_loop_hide_meta_section',
                'wspc_hide_meta_setting',
                [
                    'label_for'     => 'hide_loop_rating',
                ]
            );

            add_settings_field(
                'hide_loop_image_label',
                __('Hide Image', 'woocommerce-shop-page-customizer'),
                array($this, 'hide_product_meta_html'),
                'wspc_loop_hide_meta_section',
                'wspc_hide_meta_setting',
                [
                    'label_for'     => 'hide_loop_image',
                ]
            );

            /** Hide Product Meta section end */

            /** Shop Now Button Section start */

            add_settings_section(
                'wspc_shop_now_btn_setting',
                __('Shop Now', 'woocommerce-shop-page-customizer'),
                array(),
                'wspc_add_shop_now_section'
            );

            add_settings_field(
                'display_shop_now',
                __('Enable to Display Shop Now Button in Product Loop. ', 'woocommerce-shop-page-customizer'),
                array($this, 'hide_product_meta_html'),
                'wspc_add_shop_now_section',
                'wspc_shop_now_btn_setting',
                [
                    'label_for' => 'shop_now_btn',
                ]
            );

            add_settings_field(
                'shop_now_btn_text',
                __('Shop Now Button Text ', 'woocommerce-shop-page-customizer'),
                array($this, 'shop_now_btn_text_change'),
                'wspc_add_shop_now_section',
                'wspc_shop_now_btn_setting',
                [
                    'label_for'     => 'shop_now_btn_text',
                    'description'   => 'Add Shop Now Button text.',
                    'class'         => 'wspc_disabled'
                ]
            );

            /** Shop Now Button Section end */

            /** Stock Quantity section start */

            add_settings_section(
                'wspc_stock_quantity_setting',
                __('Stock Quantity', 'woocommerce-shop-page-customizer'),
                array(),
                'wspc_stock_quantity_manage_section'
            );

            add_settings_field(
                'display_stock_quantity',
                __('Enable to Display Stock Quantity.', 'woocommerce-shop-page-customizer'),
                array($this, 'hide_product_meta_html'),
                'wspc_stock_quantity_manage_section',
                'wspc_stock_quantity_setting',
                [
                    'label_for' => 'display_stock_quantity',
                ]
            );

            add_settings_field(
                'display_low_stock_label',
                __('Low Stock Amount Text', 'woocommerce-shop-page-customizer'),
                array($this, 'stock_text_change'),
                'wspc_stock_quantity_manage_section',
                'wspc_stock_quantity_setting',
                [
                    'label_for'     => 'display_low_stock_quantity',
                    'description'   => 'If the product stock is 3 or less.',
                    'placeholder'   => 'Only [no] left in stock!'
                ]
            );

            add_settings_field(
                'display_totle_stock_label',
                __('Stock Amount Text', 'woocommerce-shop-page-customizer'),
                array($this, 'stock_text_change'),
                'wspc_stock_quantity_manage_section',
                'wspc_stock_quantity_setting',
                [
                    'label_for'     => 'display_totle_stock_quantity',
                    'description'   => 'Use "[no]" in the text to display the stock amount.',
                    'placeholder'   => '[no] left in stock!'
                ]
            );

            /** Stock Quantity section end */
        }

        public function cart_btn_text_change($args){
            global $wspc_product_loop_options;
            $value = isset($wspc_product_loop_options[$args['label_for']]) ? $wspc_product_loop_options[$args['label_for']] : '';
            ?>
            <input type="text" name="wspc_product_loop_options[<?php esc_attr_e( $args['label_for'] ); ?>]" id="<?php esc_attr_e( $args['label_for'] ); ?>" value="<?php _e($value); ?>">
            <p class="wspc-input-note"><?php esc_attr_e($args['description'],'woocommerce-shop-page-customizer') ?></p>
            <?php
        }

        public function shop_now_btn_text_change($args){
            global $wspc_product_loop_options;
            ?>
            <div class="wspc-pro-feature-feild">
                <input type="text"  id="<?php esc_attr_e( $args['label_for'] ); ?>" value="Shop Now" disabled>
                <span class="wspc-pro"><?php _e('pro','woocommerce-shop-page-customizer'); ?></span>
            </div>            
            <p class="wspc-input-note"><?php esc_attr_e($args['description'],'woocommerce-shop-page-customizer') ?></p>
            <?php
        }

        public function sale_flash_btn_html(){
            global $wspc_product_loop_options;
            $value = isset($wspc_product_loop_options['sale_flashs_btn']) ? $wspc_product_loop_options['sale_flashs_btn'] : '';
            ?>
            <input type="text" name="wspc_product_loop_options[sale_flashs_btn]" id="sale_flashs_btn" value="<?php _e($value); ?>">
            <p class="wspc-input-note"><?php _e('Use {percent} to insert percent off, e.g., "{percent} off!"','woocommerce-shop-page-customizer') ?></p>
            <p class="wspc-input-note"><?php _e('Shows "up to n%" for grouped or variable products if multiple percentages are possible.','woocommerce-shop-page-customizer') ?></p>
            <?php
        }

        public function hide_product_meta_html($args){
            global $wspc_product_loop_options;
            $value = isset($wspc_product_loop_options[$args['label_for']]) ? $wspc_product_loop_options[$args['label_for']] : '';
            ?>
            <label class="wspc-switch">
				<input type="checkbox" class="wspc-checkbox" name="wspc_product_loop_options[<?php esc_attr_e( $args['label_for'] ); ?>]" id="<?php esc_attr_e( $args['label_for'] ); ?>" value="on" <?php if($value == "on"){ _e('checked'); } ?>>
				<span class="wspc-slider wspc-round"></span>
			</label>
            <?php
        }

        public function stock_text_change($args){
            global $wspc_product_loop_options;
            $value = isset($wspc_product_loop_options[$args['label_for']]) ? $wspc_product_loop_options[$args['label_for']] : '';
            ?>
            <input type="text" name="wspc_product_loop_options[<?php esc_attr_e( $args['label_for'] ); ?>]" placeholder="<?php esc_attr_e( $args['placeholder'] ); ?>" id="<?php esc_attr_e( $args['label_for'] ); ?>" value="<?php _e($value); ?>">
            <p class="wspc-input-note"><?php esc_attr_e($args['description'],'woocommerce-shop-page-customizer') ?></p>
            <?php
        }


        public function sanitize_settings($input)
        {
            $new_input = array();


            if (isset($input['add_to_cart_text']) && !empty($input['add_to_cart_text'])) {

                $new_input['add_to_cart_text'] = sanitize_text_field($input['add_to_cart_text']);
            }

            if (isset($input['variable_add_to_cart_text']) && !empty($input['variable_add_to_cart_text'])) {

                $new_input['variable_add_to_cart_text'] = sanitize_text_field($input['variable_add_to_cart_text']);
            }

            if (isset($input['grouped_add_to_cart_text']) && !empty($input['grouped_add_to_cart_text'])) {

                $new_input['grouped_add_to_cart_text'] = sanitize_text_field($input['grouped_add_to_cart_text']);
            }

            if (isset($input['out_of_stock_add_to_cart_text']) && !empty($input['out_of_stock_add_to_cart_text'])) {

                $new_input['out_of_stock_add_to_cart_text'] = sanitize_text_field($input['out_of_stock_add_to_cart_text']);
            }

            if (isset($input['sale_flashs_btn']) && !empty($input['sale_flashs_btn'])) {

                $new_input['sale_flashs_btn'] = sanitize_text_field($input['sale_flashs_btn']);
            }

            if (isset($input['hide_sale_flash'])) {

                $new_input['hide_sale_flash'] = sanitize_text_field($input['hide_sale_flash']);
            }

            if (isset($input['hide_add_to_cart'])) {

                $new_input['hide_add_to_cart'] = sanitize_text_field($input['hide_add_to_cart']);
            }

            if (isset($input['hide_loop_price'])) {

                $new_input['hide_loop_price'] = sanitize_text_field($input['hide_loop_price']);
            }

            if (isset($input['hide_loop_sale_price'])) {

                $new_input['hide_loop_sale_price'] = sanitize_text_field($input['hide_loop_sale_price']);
            }

            if (isset($input['hide_loop_variable_price'])) {

                $new_input['hide_loop_variable_price'] = sanitize_text_field($input['hide_loop_variable_price']);
            }

            if (isset($input['hide_loop_rating'])) {

                $new_input['hide_loop_rating'] = sanitize_text_field($input['hide_loop_rating']);
            }

            if (isset($input['hide_loop_categorie'])) {

                $new_input['hide_loop_categorie'] = sanitize_text_field($input['hide_loop_categorie']);
            }

            if (isset($input['hide_loop_image'])) {

                $new_input['hide_loop_image'] = sanitize_text_field($input['hide_loop_image']);
            }

            if (isset($input['shop_now_btn'])) {

                $new_input['shop_now_btn'] = sanitize_text_field($input['shop_now_btn']);
            }

            if (isset($input['display_stock_quantity'])) {

                $new_input['display_stock_quantity'] = sanitize_text_field($input['display_stock_quantity']);
            }

            if (isset($input['display_low_stock_quantity']) && !empty($input['display_low_stock_quantity'])) {

                $new_input['display_low_stock_quantity'] = sanitize_text_field($input['display_low_stock_quantity']);
            }

            if (isset($input['display_totle_stock_quantity']) && !empty($input['display_totle_stock_quantity'])) {

                $new_input['display_totle_stock_quantity'] = sanitize_text_field($input['display_totle_stock_quantity']);
            }

            return $new_input;
        }
    }

}