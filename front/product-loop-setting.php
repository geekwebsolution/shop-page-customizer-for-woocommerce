<?php 


if (!class_exists('wspc_front_product_loop_settings')) {
    $wspc_product_loop_options = get_option('wspc_product_loop_options');

   
    class wspc_front_product_loop_settings{


        public function __construct() {

            add_action( 'woocommerce_init', array( $this, 'wspc_customizations_loop' ) );
        }
        
        public function wspc_customizations_loop() {

            $this->filters = get_option( 'wspc_product_loop_options' );
    
            if ( ! empty( $this->filters ) ) {
 
                foreach ( $this->filters as $filter_name => $filter_value ) {
             

                    if ( 'sale_flashs_btn' === $filter_name) {
          
                        add_filter( 'woocommerce_sale_flash', array( $this, 'customize_woocommerce_sale_flash' ), 50, 3 );
    
                    }elseif($filter_name  == "hide_sale_flash"){
                  
                        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' ,10);
                        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' ,6);
                    
                    }elseif($filter_name  == "hide_add_to_cart"){
                  
                        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' , 10);
                    
                    }elseif($filter_name  == "hide_loop_price"){
                   
                        add_filter( 'woocommerce_get_price_html', 'wspc_remove_prices', 10, 2 );
                         
                        function wspc_remove_prices( $price, $product ) {
                            if(is_shop() || is_product_category())
                            {
                                $price = '';
                            }
                            return $price;
                        
                        }

                    }elseif($filter_name  == "hide_loop_sale_price"){
                      
                        function wspc_change_sale_price( $price_html, $product ) {
                            global $product;
                            if( $product->is_on_sale() ) {
                                $price_html = '';
                                return $price_html;
                            }
                            return $price_html;
                          
                        }
                        add_filter( 'woocommerce_get_price_html', 'wspc_change_sale_price', 10, 2 );
                        
                    }elseif($filter_name  == "hide_loop_variable_price"){
                      
                        // remove variable price
                        add_filter( 'woocommerce_variable_price_html', 'wspc_remove_variable_prices', 10, 2 );
                        function wspc_remove_variable_prices( $price, $product ) {
                            $price = '';
                            return $price;
                        }
                    }elseif($filter_name  == "hide_loop_rating"){
                        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

                    }elseif($filter_name  == "hide_loop_image"){
                        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

                    }elseif($filter_name == "shop_now_btn" || $filter_name == "shop_now_btn_text" ){
                                         
             

                        if(isset($this->filters['shop_now_btn'])){
                            add_action( 'woocommerce_after_shop_loop_item', array( $this, 'wspc_add_shop_button_text_html' ), 10 );
                        }

                    }elseif($filter_name == "display_stock_quantity"){
                                        
                        if(isset( $this->filters['display_stock_quantity'])){

                            add_action( 'woocommerce_after_shop_loop_item', function(){
                                     $product = wc_get_product( get_the_ID() );
                                
                                if ( $product->get_stock_quantity() ) {
                                    // if manage stock is enabled
                                    $wspc_pro_stock = number_format(
                                        $product->get_stock_quantity(),
                                        0,
                                        '',
                                        ''
                                    );
                                    
                                    if ( $wspc_pro_stock <= 3 ) {
                                        // if stock is low
                                        if(isset($this->filters['display_low_stock_quantity'])){
                                            $wspc_low_stocktxt  = $this->filters['display_low_stock_quantity'];
                                        }else{
                                            $wspc_low_stocktxt  = "Only [no] left in stock!";
                                        }
                                        $wspc_low_stock_text = str_ireplace( '[no]', $wspc_pro_stock, $wspc_low_stocktxt );
                   

                                        $stock_html = sprintf('<div class="wspc-stock-remaining">%s</div>', $wspc_low_stock_text, 'woocommerce-shop-page-customizer' );
                                        _e($stock_html,'woocommerce-shop-page-customizer');
                                    } else {
                                        if(isset($this->filters['display_totle_stock_quantity'])){
                                            $wspc_stocktxt  = $this->filters['display_totle_stock_quantity'];
                                        }else{
                                            $wspc_stocktxt  = "[no] left in stock!";
                                        }
                                        $wspc_stock_text = str_ireplace( '[no]', $wspc_pro_stock, $wspc_stocktxt ) ;
                                

                                        $stock_html = sprintf('<div class="wspc-stock-remaining">%s</div>', $wspc_stock_text, 'woocommerce-shop-page-customizer' );
                                        _e($stock_html,'woocommerce-shop-page-customizer');
                                    }
                                
                                }
                            },30);
                        }
                    
                    }else{
                      
                        add_filter( 'woocommerce_product_add_to_cart_text', array( $this, 'customize_add_to_cart_text' ), 50, 2 );
                    }
             
                }

                
      
            }
        }

        public function wspc_add_shop_button_text_html() {
            global $product;
            $link = $product->get_permalink();
            $shop_btn_text = "Shop Now";

            $stock_html = sprintf('<a href="%s" class="btn button shop-now-btn addtocartbutton">%s</a>', $link , $shop_btn_text, 'woocommerce-shop-page-customizer' );
            _e($stock_html,'woocommerce-shop-page-customizer');

                
        }

        public function customize_add_to_cart_text( $text, $product ) {

            // out of stock add to cart text
            if ( isset( $this->filters['out_of_stock_add_to_cart_text'] ) && ! $product->is_in_stock() ) {

                return $this->filters['out_of_stock_add_to_cart_text'];
            }

            if ( isset( $this->filters['add_to_cart_text'] ) && $product->is_type( 'simple' ) ) {

                // simple add to cart text
                return $this->filters['add_to_cart_text'];

            } elseif ( isset( $this->filters['variable_add_to_cart_text'] ) && $product->is_type( 'variable') )  {

                // variable add to cart text
                return $this->filters['variable_add_to_cart_text'];

            } elseif ( isset( $this->filters['grouped_add_to_cart_text'] ) && $product->is_type( 'grouped' ) ) {

                // grouped add to cart text
                return $this->filters['grouped_add_to_cart_text'];

            }

            return $text;
        }

        public function customize_woocommerce_sale_flash( $html, $_, $product ) {

            $text = '';   
 
    
            $text = $this->filters['sale_flashs_btn'];
              

            if ( false !== strpos( $text, '{percent}' ) ) {
    
                $percent = $this->get_sale_percentage( $product );
                $text    = str_replace( '{percent}', "{$percent}%", $text );
            }
 
            return ! empty( $text ) ? "<span class='onsale'>{$text}</span>" : $html;
        }

        private function get_sale_percentage( $product ) {

            $child_sale_percents = array();
            $percentage          = '0';
    
            if ( $product->is_type( 'grouped' ) || $product->is_type( 'variable' ) ) {
    
                foreach ( $product->get_children() as $child_id ) {
    
                    $child = wc_get_product( $child_id );
    
                    if ( $child->is_on_sale() ) {
    
                        $regular_price         = $child->get_regular_price();
                        $sale_price            = $child->get_sale_price();
                        $child_sale_percents[] = $this->calculate_sale_percentage( $regular_price, $sale_price );
                    }
                }
    
                // filter out duplicate values
                $child_sale_percents = array_unique( $child_sale_percents );
    
                // only add "up to" if there's > 1 percentage possible
                if ( ! empty ( $child_sale_percents ) ) {
    
                    /* translators: Placeholder: %s - sale percentage */
                    $percentage = count( $child_sale_percents ) > 1 ? sprintf( esc_html__( 'up to %s', 'woocommerce-customizer' ), max( $child_sale_percents ) ) : current( $child_sale_percents );
                }
    
            } else {
    
                $percentage = $this->calculate_sale_percentage( $product->get_regular_price(), $product->get_sale_price() );
            }
    
            return $percentage;
        }
        
        private function calculate_sale_percentage( $regular_price, $sale_price ) {

            $percent = 0;
            $regular = (float) $regular_price;
            $sale    = (float) $sale_price;
    
            // in case of free products so we don't divide by 0
            if ( $regular ) {
                $percent = round( ( ( $regular - $sale ) / $regular ) * 100 );
            }
    
            return $percent;
        }
    
    }

}
?>