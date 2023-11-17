<?php
if (!class_exists('wspc_shop_page_customizer_settings')) {
    $wspc_list_page_options = get_option('wspc_shop_page_options');
   
    class wspc_shop_page_customizer_settings{

        public function __construct(){       
            add_action('admin_init', array($this, 'shop_page_register_settings_init'));
        }

        function shop_page_setting_form_option(){ ?>
            <form action="options.php?tab=wspc-shop-customizer" method="post">

                <?php  settings_fields('wspc-loop-setting-options');   ?>

                <div class="wspc-section">
                    <?php do_settings_sections('wspc_product_page_layout_section'); ?>
                </div>

                <div class="wspc-section">
                    <?php do_settings_sections('wspc_hide_shop_page_option_section'); ?>
                </div>
                <?php
                submit_button('Save Settings');
                ?>
            </form>

            <?php
        }

        /* register setting */
        public function shop_page_register_settings_init()
        {
            register_setting('wspc-loop-setting-options', 'wspc_shop_page_options', array($this, 'sanitize_settings'));


            /** Shop Page Layout section start */
            add_settings_section(
                'wspc_shop_page_layout_setting',
                __('Shop Page Layout', 'woocommerce-shop-page-customizer'),
                array(),
                'wspc_product_page_layout_section'
            );

            add_settings_field(
                'product_per_page',
                __('Products Per Page', 'woocommerce-shop-page-customizer'),
                array($this, 'layout_html'),
                'wspc_product_page_layout_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'product_per_page',
                    'description'   => 'Changes the number of products displayed per page.'
                ]
            );

            add_settings_field(
                'product_par_row',
                __('Product Per Row', 'woocommerce-shop-page-customizer'),
                array($this, 'layout_html'),
                'wspc_product_page_layout_section',
                'wspc_shop_page_layout_setting',
                [
                    'label_for'     => 'product_par_row',
                    'description'   => 'Changes the number of columns displayed per page.'
                ]
            );

            /** Shop Page Layout section end */

            /** Hide Shop Page Option section start */

            add_settings_section(
                'wspc_hide_shop_option_setting',
                __('Hide Shop Page Option', 'woocommerce-shop-page-customizer'),
                array(),
                'wspc_hide_shop_page_option_section'
            );

            add_settings_field(
                'hide_shop_breadcrumbs',
                __('Remove Shop Page Breadcrumbs', 'woocommerce-shop-page-customizer'),
                array($this, 'hide_shop_page_option_html'),
                'wspc_hide_shop_page_option_section',
                'wspc_hide_shop_option_setting',
                [
                    'label_for'     => 'hide_breadcrumbs',
                ]
            );

            add_settings_field(
                'hide_shop_page_title',
                __('Remove Shop Title', 'woocommerce-shop-page-customizer'),
                array($this, 'hide_shop_page_option_html'),
                'wspc_hide_shop_page_option_section',
                'wspc_hide_shop_option_setting',
                [
                    'label_for'     => 'hide_shop_title',
                ]
            );

            add_settings_field(
                'hide_shop_sorting_dropdown',
                __('Remove Shop Sorting Dropdown', 'woocommerce-shop-page-customizer'),
                array($this, 'hide_shop_page_option_html'),
                'wspc_hide_shop_page_option_section',
                'wspc_hide_shop_option_setting',
                [
                    'label_for'     => 'hide_sorting_dropdown',
                ]
            );

            add_settings_field(
                'hide_shop_sorting_results',
                __('Remove Shop Sorting Results', 'woocommerce-shop-page-customizer'),
                array($this, 'hide_shop_page_option_html'),
                'wspc_hide_shop_page_option_section',
                'wspc_hide_shop_option_setting',
                [
                    'label_for'     => 'hide_sorting_results',
                ]
            );
            /** Hide Shop Page Option section end */
        }

        public function layout_html($args){
            global $wspc_list_page_options;
            $value = isset($wspc_list_page_options[$args['label_for']]) ? $wspc_list_page_options[$args['label_for']] : '';
            ?>
            <input type="number" name="wspc_shop_page_options[<?php esc_attr_e( $args['label_for'] ); ?>]" id="<?php esc_attr_e( $args['label_for'] ); ?>" value="<?php _e($value); ?>">
            <p class="wspc-input-note"><?php esc_attr_e($args['description'],'woocommerce-shop-page-customizer') ?></p>
            <?php
        }

        public function hide_shop_page_option_html($args){
            global $wspc_list_page_options;
            $value = isset($wspc_list_page_options[$args['label_for']]) ? $wspc_list_page_options[$args['label_for']] : '';
            ?>  
            <label class="wspc-switch">
				<input type="checkbox" class="wspc-checkbox" name="wspc_shop_page_options[<?php esc_attr_e( $args['label_for'] ); ?>]" id="<?php esc_attr_e( $args['label_for'] ); ?>" value="on" <?php if($value == "on"){ _e('checked'); } ?> >
				<span class="wspc-slider wspc-round"></span>
			</label>
            <?php
        }


        public function sanitize_settings($input)
        {
            $new_input = array();

            if (isset($input['product_per_page']) && !empty($input['product_per_page'])) {

                $new_input['product_per_page'] = sanitize_text_field($input['product_per_page']);
            }

            if (isset($input['product_par_row']) && !empty($input['product_par_row'])) {

                $new_input['product_par_row'] = sanitize_text_field($input['product_par_row']);
            }

            if (isset($input['hide_breadcrumbs'])) {

                $new_input['hide_breadcrumbs'] = sanitize_text_field($input['hide_breadcrumbs']);
            }

            if (isset($input['hide_shop_title'])) {

                $new_input['hide_shop_title'] = sanitize_text_field($input['hide_shop_title']);
            }

            if (isset($input['hide_sorting_dropdown'])) {

                $new_input['hide_sorting_dropdown'] = sanitize_text_field($input['hide_sorting_dropdown']);
            }

            if (isset($input['hide_sorting_results'])) {

                $new_input['hide_sorting_results'] = sanitize_text_field($input['hide_sorting_results']);
            }
            
            return $new_input;
        }
    }
}