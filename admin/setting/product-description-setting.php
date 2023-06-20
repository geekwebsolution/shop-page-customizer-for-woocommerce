<?php
if (!class_exists('wspc_product_description_settings')) {
    $wspc_loop_description_options = get_option('wspc_product_loop_description_options');

   
    class wspc_product_description_settings{

        public function __construct(){       
            add_action('admin_init', array($this, 'product_description_register_settings_init'));
        }


        function product_description_setting_form_option(){ ?>

            <form action="options.php?tab=wspc-product-description" method="post">

                <?php  settings_fields('wspc-loop-setting-options');   ?>

                <div class="wspc-section">
                    <?php do_settings_sections('wspc_loop_product_description_section'); ?>
                </div>

                <div class="wspc-section">
                    <?php do_settings_sections('wspc_loop_product_description_style_section'); ?>
                </div>
               
                <input type="button" name="submit" class="button button-primary" value="Save Settings" disabled>
                <?php
               
                // submit_button('Save Settings');
                ?>

            </form>

            <?php
        }

        /* register setting */
        public function product_description_register_settings_init()
        {
            register_setting('wspc-loop-setting-options', 'wspc_product_loop_description_options', array($this, 'sanitize_settings'));


            /** Product Description on loop section start */
            add_settings_section(
                'wspc_product_description_setting',
                __('Product Description on loop', 'woocommerce-shop-page-customizer'),
                array(),
                'wspc_loop_product_description_section'
            );

            add_settings_field(
                'enable_description_for_loop',
                __('Select Pages to Enable Description', 'woocommerce-shop-page-customizer'),
                array($this, 'hide_product_meta_html'),
                'wspc_loop_product_description_section',
                'wspc_product_description_setting',
                [
                    'label_for'     => 'enable_product_description',
                    'class'         => 'wspc_disabled'
                ]
            );

            add_settings_field(
                'position_for_description',
                __('Select the Position of Description', 'woocommerce-shop-page-customizer'),
                array($this, 'select_position_description_html'),
                'wspc_loop_product_description_section',
                'wspc_product_description_setting',
                [
                    'label_for'     => 'product_description_position',
                    'description'   => 'Select the position of description.',
                    'class'         => 'wspc_disabled'
                ]
            );

            add_settings_field(
                'specify_product_description',
                __('Select the Content of Description', 'woocommerce-shop-page-customizer'),
                array($this, 'select_box_html'),
                'wspc_loop_product_description_section',
                'wspc_product_description_setting',
                [
                    'label_for'     => 'specify_product_description',
                    'description'   => 'Specify which description to show.',
                    'class'         => 'wspc_disabled'
                ]
            );

            add_settings_field(
                'product_par_row',
                __('Limit of Alphabets in Description ', 'woocommerce-shop-page-customizer'),
                array($this, 'alphabets_limit_html'),
                'wspc_loop_product_description_section',
                'wspc_product_description_setting',
                [
                    'label_for'     => 'alphabets_limit',
                    'class'         => 'wspc_disabled'
                ]
            );

            /** Product Description on loop section end */


            /** Product Description Style Settings section start */
            add_settings_section(
                'wspc_product_description_style_setting',
                __('Product Description Style Settings', 'woocommerce-shop-page-customizer'),
                array(),
                'wspc_loop_product_description_style_section'
            );


            add_settings_field(
                'specify_product_description',
                __('Text Alignment', 'woocommerce-shop-page-customizer'),
                array($this, 'text_alignment_html'),
                'wspc_loop_product_description_style_section',
                'wspc_product_description_style_setting',
                [
                    'label_for'     => 'description_text_alignment',
                    'description'   => 'Specify which description to show.',
                    'class'         => 'wspc_disabled'
                ]
            );

            add_settings_field(
                'des_font_color',
                __('Font Color', 'woocommerce-shop-page-customizer'),
                array($this, 'select_color_html'),
                'wspc_loop_product_description_style_section',
                'wspc_product_description_style_setting',
                [
                    'label_for'     => 'description_font_color',
                    'description'   => 'Change description font color.',
                    'class'         => 'wspc_disabled'
                ]
            );

            add_settings_field(
                'font_size',
                __('Font Size', 'woocommerce-shop-page-customizer'),
                array($this, 'font_size_html'),
                'wspc_loop_product_description_style_section',
                'wspc_product_description_style_setting',
                [
                    'label_for'     => 'description_font_size',
                    'description'   => 'Change Description font size.',
                    'class'         => 'wspc_disabled'
                ]
            );

            /** Product Description Style Settings section end */

            

           
        }

        public function alphabets_limit_html($args){
            
            global $wspc_loop_description_options;
            $value = isset($wspc_loop_description_options[$args['label_for']]) ? $wspc_loop_description_options[$args['label_for']] : '';
            ?>
            <div class="wspc-pro-feature-feild">
                <input type="number" name="wspc_product_loop_description_options[<?php esc_attr_e( $args['label_for'] ); ?>]" id="<?php esc_attr_e( $args['label_for'] ); ?>" value="<?php _e($value); ?>">
                <span class="wspc-pro"><?php _e('pro','woocommerce-shop-page-customizer'); ?></span>
            </div>
            <p  class="wspc-input-note"><?php esc_html('Set the characters limit. Set "0" to show all.(Works for product short & detail description).','woocommerce-shop-page-customizer') ?></p>
            <p  class="wspc-input-note"><?php esc_html('The limit is not applicable to the Loop description (Custom description)','woocommerce-shop-page-customizer') ?></p>
            <?php
        }

        public function font_size_html($args){

            global $wspc_loop_description_options;
            $value = isset($wspc_loop_description_options[$args['label_for']]) ? $wspc_loop_description_options[$args['label_for']] : '';
            ?>
            <div class="wspc-pro-feature-feild">
            <input type="number" name="wspc_product_loop_description_options[<?php esc_attr_e( $args['label_for'] ); ?>]" id="<?php esc_attr_e( $args['label_for'] ); ?>" value="<?php _e($value); ?>">
            <span class="wspc-pro"><?php _e('pro','woocommerce-shop-page-customizer'); ?></span>
            </div>            
            <p class="wspc-input-note"><?php esc_attr_e($args['description'],'woocommerce-shop-page-customizer') ?></p>
            <?php
        }

        
        public function hide_product_meta_html($args){

            global $wspc_loop_description_options;
            $value = isset($wspc_loop_description_options[$args['label_for']]) ? $wspc_loop_description_options[$args['label_for']] : '';
            ?>
            <div class="wspc-pro-feature-feild">
                <label class="wspc-switch">
                    <input type="checkbox" class="wspc-checkbox" name="wspc_product_loop_description_options[<?php esc_attr_e( $args['label_for'] ); ?>]" id="<?php esc_attr_e( $args['label_for'] ); ?>" value="on" <?php if($value == "on"){ _e('checked'); } ?> >
                    <span class="wspc-slider wspc-round"></span>
                </label>
                <span class="wspc-pro"><?php _e('pro','woocommerce-shop-page-customizer'); ?></span>
            </div>              
            <?php
        }


        public function select_position_description_html($args){

            global $wspc_loop_description_options;
            $position_description = array(
                "Before Product Title",
                "After Product Title",
                "Before Rating",
                "After Rating",
                "Before Price",
                "After Price",
                "Before Add to Cart Button",
                "After Add to Cart Button",
            );
            $select_value = "";
            $select_value = isset($wspc_loop_description_options[$args['label_for']]) ? $wspc_loop_description_options[$args['label_for']] : '';
            ?>
            <div class="wspc-pro-feature-feild">
                <select name="wspc_product_loop_description_options[<?php esc_attr_e( $args['label_for'] ); ?>]" id="<?php esc_attr_e( $args['label_for'] ); ?>">
                    <?php 
                    foreach ($position_description as $key => $value) {
    
                        $key = strtolower(str_replace(" ","-",$value));
                        ?>
                        <option value="<?php esc_attr_e($key); ?>" <?php  if($select_value == $key){ _e('selected'); } ?>><?php esc_attr_e($value); ?></option>
                        <?php
                    }
                    ?>
                </select>
                <span class="wspc-pro"><?php _e('pro','woocommerce-shop-page-customizer'); ?></span>
            </div>
            <p class="wspc-input-note"><?php esc_attr_e($args['description'],'woocommerce-shop-page-customizer') ?></p>
            <?php
        }

        public function select_box_html($args){

            global $wspc_loop_description_options;
            $description_type = array(
                "Product Detail Description",
                "Product Short Description",
                "Custom Loop Description"
            );
            $select_value = "";
            $select_value = isset($wspc_loop_description_options[$args['label_for']]) ? $wspc_loop_description_options[$args['label_for']] : '';
            ?>
            <div class="wspc-pro-feature-feild">
                <select name="wspc_product_loop_description_options[<?php esc_attr_e( $args['label_for'] ); ?>]" id="<?php esc_attr_e( $args['label_for'] ); ?>">
                <?php 
                    foreach ($description_type as $key => $value) {
    
                        $key = strtolower(str_replace(" ","-",$value));
                       
                        ?>
                        <option value="<?php esc_attr_e($key); ?>" <?php  if($select_value == $key){ _e('selected'); } ?>><?php esc_attr_e($value); ?></option>
                        <?php
                    }
                    ?>
                </select>
                <span class="wspc-pro"><?php _e('pro','woocommerce-shop-page-customizer'); ?></span>
            </div>
            <p class="wspc-input-note"><?php esc_attr_e($args['description'],'woocommerce-shop-page-customizer') ?></p>
            <?php
        }

        public function text_alignment_html($args){
            global $wspc_loop_description_options;
            $value = isset($wspc_loop_description_options[$args['label_for']]) ? $wspc_loop_description_options[$args['label_for']] : '';
            ?>
            <div class="wspc-pro-feature-feild">
                <select name="wspc_product_loop_description_options[<?php esc_attr_e( $args['label_for'] ); ?>]" id="<?php esc_attr_e( $args['label_for'] ); ?>">
                    <option value="right" <?php if($value == "right"){ _e('selected'); } ?>>Right</option>
                    <option value="center" <?php if($value == "center"){ _e('selected'); } ?>>Center</option>
                    <option value="left" <?php if($value == "left"){ _e('selected'); } ?>>Left</option>
                </select>
                <span class="wspc-pro"><?php _e('pro','woocommerce-shop-page-customizer'); ?></span>
            </div>

            <?php
        }


        public function select_color_html($args){
            global $wspc_loop_description_options;
            $value = isset($wspc_loop_description_options[$args['label_for']]) ? $wspc_loop_description_options[$args['label_for']] : '';
            ?>
            <div class="wspc-pro-feature-feild">
                <input type="text" class="wdpgk_colorpicker" name="wspc_product_loop_description_options[<?php esc_attr_e( $args['label_for'] ); ?>]" id="<?php esc_attr_e( $args['label_for'] ); ?>" value="<?php _e($value); ?>" >
                <span class="wspc-pro"><?php _e('pro','woocommerce-shop-page-customizer'); ?></span>
            </div>
            <p  class="wspc-input-note"><?php esc_attr_e($args['description'],'woocommerce-shop-page-customizer') ?></p>
            <?php
        }



        public function sanitize_settings($input){
            $new_input = array();

            return $new_input;
        }
    }

}