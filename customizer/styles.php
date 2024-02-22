<?php

/**
 * Implements styles set in the theme customizer
 *
 * @package Customizer Library WooCommerce Designer
 */
if ( !function_exists( 'woo_shop_page_customizer_style_build' ) && class_exists( 'woo_shop_customizer_style_library_Styles' ) ) {
    /**
     * Process user options to generate CSS needed to implement the choices.
     *
     * @since  1.0.0.
     *
     * @return void
     */
    function woo_shop_page_customizer_style_build()
    {


        /** Customize Add to Cart Button CSS Start */
        // Button - Font Size
        $wspc_product_loop_options = get_option('wspc_desgin_elements_options');
        $wspc_loop_description_options = get_option('wspc_product_loop_description_options');
        $wspc_shop_page_option = get_option('wspc_shop_page_options');

        $setting = 'cart_btn_font_size';
        
        if ( isset($wspc_product_loop_options[$setting]) && !empty($wspc_product_loop_options[$setting]) ) {
            $mod = $wspc_product_loop_options[$setting];
            $wspc_btn_fsize = esc_attr( $mod );
            woo_shop_customizer_style_library_Styles()->add( array(
                'selectors'    => array( 'body ul.products li.product .button.add_to_cart_button, body ul.products li.product .button.product_type_grouped, body ul.products li.product .button.product_type_simple, body ul.products li.product .button.product_type_external' ),
                'declarations' => array(
                'font-size' => $wspc_btn_fsize . 'px',
            ),
            ) );
        }

        
        // Button - Border Radius
        $setting = 'cart_btn_border_radius';
        
        if ( isset($wspc_product_loop_options[$setting]) && !empty($wspc_product_loop_options[$setting]) ) {
            $mod = $wspc_product_loop_options[$setting];
            $wspc_btn_br = esc_attr( $mod );
            woo_shop_customizer_style_library_Styles()->add( array(
                'selectors'    => array( 'body ul.products li.product .button.add_to_cart_button, body ul.products li.product .button.product_type_grouped, body ul.products li.product .button.product_type_simple, body ul.products li.product .button.product_type_external' ),
                'declarations' => array(
                'border-radius' => $wspc_btn_br . 'px !important',
            ),
            ) );
        }

                
        // Button - Padding
        $setting = 'cart_btn_padding';
       
        
        if ( isset($wspc_product_loop_options[$setting]) && !empty($wspc_product_loop_options[$setting]) ) {

            $mod = $wspc_product_loop_options[$setting];
            $wspc_btn_pad = esc_attr( $mod );
            woo_shop_customizer_style_library_Styles()->add( array(
                'selectors'    => array( 'body ul.products li.product .button.add_to_cart_button, body ul.products li.product .button.product_type_grouped, body ul.products li.product .button.product_type_simple, body ul.products li.product .button.product_type_external' ),
                'declarations' => array(
                'padding' => $wspc_btn_pad . 'px ' . $wspc_btn_pad * 2 . 'px ' . ($wspc_btn_pad + 1) . 'px !important',
            ),
            ) );
        }

        /** Customize Add to Cart Button CSS End */

        /** Customize Shop Now CSS Start */
        // Button - Font Size
        $wspc_product_loop_options = get_option('wspc_desgin_elements_options');
        $setting = 'shop_now_font_size';
        
        if ( isset($wspc_product_loop_options[$setting]) && !empty($wspc_product_loop_options[$setting]) ) {
            $mod = $wspc_product_loop_options[$setting];
            $wspc_btn_fsize = esc_attr( $mod );
            woo_shop_customizer_style_library_Styles()->add( array(
                'selectors'    => array( 'body ul.products li.product .button.shop-now-btn' ),
                'declarations' => array(
                'font-size' => $wspc_btn_fsize . 'px',
            ),
            ) );
        }

        
        // Button - Border Radius
        $setting = 'shop_now_border_radius';
        
        if ( isset($wspc_product_loop_options[$setting]) && !empty($wspc_product_loop_options[$setting]) ) {
            $mod = $wspc_product_loop_options[$setting];
            $wspc_btn_br = esc_attr( $mod );
            woo_shop_customizer_style_library_Styles()->add( array(
                'selectors'    => array( 'body ul.products li.product .button.shop-now-btn' ),
                'declarations' => array(
                'border-radius' => $wspc_btn_br . 'px !important',
            ),
            ) );
        }

                
        // Button - Padding
        $setting = 'shop_now_padding';
        
        if ( isset($wspc_product_loop_options[$setting]) && !empty($wspc_product_loop_options[$setting]) ) {
            $mod = $wspc_product_loop_options[$setting];
            $wspc_btn_pad = esc_attr( $mod );
            woo_shop_customizer_style_library_Styles()->add( array(
                'selectors'    => array( 'body ul.products li.product .button.shop-now-btn' ),
                'declarations' => array(
                'padding' => $wspc_btn_pad . 'px ' . $wspc_btn_pad * 2 . 'px ' . ($wspc_btn_pad + 1) . 'px !important',
            ),
            ) );
        }

        /** Customize Shop Now CSS End */

        /** Customize Sale Flash CSS Start */

        // Sale Banner - Font Size
        $setting = 'sale_flash_btn_font_size';

        if (isset($wspc_product_loop_options[$setting]) && !empty($wspc_product_loop_options[$setting])) {
            $mod = $wspc_product_loop_options[$setting];
            $wspc_sale_fsize = esc_attr($mod);
            woo_shop_customizer_style_library_Styles()->add(array(
                'selectors'    => array('body.woocommerce ul.products li.product span.onsale'),
                'declarations' => array(
                    'font-size' => $wspc_sale_fsize . 'px !important',
                ),
            ));
        }

        // // Sale Banner - Font Weight
        $setting = 'sale_flash_btn_font_bold';

        if ( isset($wspc_product_loop_options[$setting]) && !empty($wspc_product_loop_options[$setting] )) {
          $mod = $wspc_product_loop_options[$setting];
            $wspc_sale_fweight = esc_attr( $mod );
            woo_shop_customizer_style_library_Styles()->add( array(
                'selectors'    => array( 'body.woocommerce ul.products li.product span.onsale' ),
                'declarations' => array(
                'font-weight' => $wspc_sale_fweight.' !important',
            ),
            ) );
        }

        // Sale Banner - Border Radius

        $setting = 'sale_flash_btn_border_radius';

        if (isset($wspc_product_loop_options[$setting]) && !empty($wspc_product_loop_options[$setting])) {
            $mod = $wspc_product_loop_options[$setting];
            $wspc_btn_br = esc_attr($mod);
            woo_shop_customizer_style_library_Styles()->add(array(
                'selectors'    => array('body.woocommerce ul.products li.product span.onsale'),
                'declarations' => array(
                    'border-radius' => $wspc_btn_br . '% !important',
                ),
            ));
        }


        /** Customize Sale Flash CSS end */

        /** Customize Product Title CSS Strat */

        // Product Title - Font Size
        $setting = 'product_title_font_size';
        
        if ( isset($wspc_product_loop_options[$setting]) && !empty($wspc_product_loop_options[$setting]) ) {

            $mod = $wspc_product_loop_options[$setting];
            $wspc_shop_prodtitlefs = esc_attr( $mod );

            woo_shop_customizer_style_library_Styles()->add( array(
                'selectors'    => array( 'body.woocommerce ul.products li.product .woocommerce-loop-product__title' ),
                'declarations' => array(
                'font-size' => $wspc_shop_prodtitlefs . 'px !important',
            ),
            ) );
        }

        // Product Title - Color
        $setting = 'product_title_font_color';
        
        if ( isset($wspc_product_loop_options[$setting]) && !empty($wspc_product_loop_options[$setting]) ) {

            $mod = $wspc_product_loop_options[$setting];
            $wspc_shop_prodtitlefc = wspc_sanitize_hex_color( $mod );

            woo_shop_customizer_style_library_Styles()->add( array(
                'selectors'    => array( 'body.woocommerce ul.products li.product .woocommerce-loop-product__title' ),
                'declarations' => array(
                'color' => $wspc_shop_prodtitlefc . ' !important',
            ),
            ) );
        }        

        /** Customize Product Title CSS End */

        /** Customize Product Price CSS Strat */

        $setting = 'product_price_font_size';
        
        if ( isset($wspc_product_loop_options[$setting]) && !empty($wspc_product_loop_options[$setting]) ) {
            $mod = $wspc_product_loop_options[$setting];
            $wspc_shop_prodpricefs = esc_attr($mod);
            woo_shop_customizer_style_library_Styles()->add(array(
                'selectors'    => array('body.woocommerce ul.products li.product .price'),
                'declarations' => array(
                    'font-size' => $wspc_shop_prodpricefs . 'px !important',
                ),
            ));
        }

        // Product Price - Color
        $setting = 'product_price_font_color';
        
        if ( isset($wspc_product_loop_options[$setting]) && !empty($wspc_product_loop_options[$setting]) ) {
            $mod = $wspc_product_loop_options[$setting];
            $wspc_shop_prodpricefc = wspc_sanitize_hex_color($mod);

            woo_shop_customizer_style_library_Styles()->add(array(
                'selectors'    => array('body.woocommerce ul.products li.product .price'),
                'declarations' => array(
                    'color' => $wspc_shop_prodpricefc . ' !important',
                ),
            ));
        }

        /** Customize Product Price CSS End */



        /** Shop page Strat  */
        $setting = 'hide_breadcrumbs';
        
        if ( isset($wspc_shop_page_option[$setting]) && !empty($wspc_shop_page_option[$setting]) ) {
            $mod = $wspc_shop_page_option[$setting];

            woo_shop_customizer_style_library_Styles()->add( array(
                'selectors'    => array( 'body.woocommerce-shop .woocommerce-breadcrumb, body.woocommerce.archive .woocommerce-breadcrumb' ),
                'declarations' => array(
                'display' => 'none',
            ),
            ) );
        }
        /** Shop page End  */
    
    
    }

}
add_action( 'customizer_library_styles', 'woo_shop_page_customizer_style_build' );
if ( !function_exists( 'woocustomizer_customizer_library_styles' ) ) {
    /**
     * Generates the style tag and CSS needed for the theme options.
     *
     * By using the "woo_shop_customizer_style_library_Styles" filter, different components can print CSS in the header.
     * It is organized this way to ensure there is only one "style" tag.
     *
     * @since  1.0.0.
     *
     * @return void
     */
    function woocustomizer_customizer_library_styles()
    {
        do_action( 'customizer_library_styles' );
        // Echo the rules
        $css = woo_shop_customizer_style_library_Styles()->build();
        
        if ( !empty($css) ) {
            wp_register_style( 'wspc-customizer-custom-css', false );
            wp_enqueue_style( 'wspc-customizer-custom-css' );
            wp_add_inline_style( 'wspc-customizer-custom-css', $css );
        }
    
    }

}
add_action( 'wp_enqueue_scripts', 'woocustomizer_customizer_library_styles', 11 );

function wspc_getContrastColor( $hexColor )
{
    // hexColor RGB
    $R1 = hexdec( substr( $hexColor, 1, 2 ) );
    $G1 = hexdec( substr( $hexColor, 3, 2 ) );
    $B1 = hexdec( substr( $hexColor, 5, 2 ) );
    // Black RGB
    $blackColor = "#000000";
    $R2BlackColor = hexdec( substr( $blackColor, 1, 2 ) );
    $G2BlackColor = hexdec( substr( $blackColor, 3, 2 ) );
    $B2BlackColor = hexdec( substr( $blackColor, 5, 2 ) );
    // Calc contrast ratio
    $L1 = 0.2126 * pow( $R1 / 255, 2.2 ) + 0.7151999999999999 * pow( $G1 / 255, 2.2 ) + 0.0722 * pow( $B1 / 255, 2.2 );
    $L2 = 0.2126 * pow( $R2BlackColor / 255, 2.2 ) + 0.7151999999999999 * pow( $G2BlackColor / 255, 2.2 ) + 0.0722 * pow( $B2BlackColor / 255, 2.2 );
    $contrastRatio = 0;
    
    if ( $L1 > $L2 ) {
        $contrastRatio = (int) (($L1 + 0.05) / ($L2 + 0.05));
    } else {
        $contrastRatio = (int) (($L2 + 0.05) / ($L1 + 0.05));
    }
    
    // If contrast is more than 5, return black color
    
    if ( $contrastRatio > 5 ) {
        return '#000000';
    } else {
        // if not, return white color.
        return '#FFFFFF';
    }

}

function wspc_sanitize_hex_color( $color ) {
	if ( '' === $color ) {
		return '';
	}

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}

	return null;
}

// function woocustomizer_library_hex_to_rgb( $hex ) {

// 	// Remove "#" if it was added
// 	$color = trim( $hex, '#' );

// 	// Return empty array if invalid value was sent
// 	if ( ! ( 3 === strlen( $color ) ) && ! ( 6 === strlen( $color ) ) ) {
// 		return array();
// 	}

// 	// If the color is three characters, convert it to six.
// 	if ( 3 === strlen( $color ) ) {
// 		$color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
// 	}

// 	// Get the red, green, and blue values
// 	$red   = hexdec( $color[0] . $color[1] );
// 	$green = hexdec( $color[2] . $color[3] );
// 	$blue  = hexdec( $color[4] . $color[5] );

// 	// Return the RGB colors as an array
// 	return array( 'r' => $red, 'g' => $green, 'b' => $blue );
// }

?>