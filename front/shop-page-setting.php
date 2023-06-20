<?php 
if (!class_exists('wspc_front_shop_page_settings') ) {
    
    $filters_list = get_option('wspc_shop_page_options');
   
    class wspc_front_shop_page_settings{


        public function __construct() {

            add_action( 'woocommerce_init', array( $this, 'wspc_customizations_loop' ) );
        }

        public function wspc_customizations_shop_page()
        {

            $this->filters = get_option('wspc_shop_page_options');

            if(isset($this->filters['product_per_page'])){
                add_filter( 'loop_shop_per_page',array( $this, 'wspc_woocommerce_products_per_page'), 9999 );
            }

            if(isset($this->filters['product_par_row'])){
                add_filter( 'loop_shop_columns',array( $this, 'wspc_woocommerce_loop_columns'), 99999);                
            }

            if(isset($this->filters['hide_breadcrumbs']) && $this->filters['hide_breadcrumbs'] == "on"){
                // add_filter( 'woocommerce_show_page_title', 'wspc_remove_shop_title' );
            }

            if(isset($this->filters['hide_shop_title']) && $this->filters['hide_shop_title'] == "on"){
                add_filter( 'woocommerce_show_page_title', array( $this,'wspc_remove_shop_title') );
            }

            if(isset($this->filters['hide_sorting_dropdown']) && $this->filters['hide_sorting_dropdown'] == "on"){
                remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
                remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
                remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 20 );
                remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 20 );
                remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 30 );
                remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
            }

            if(isset($this->filters['hide_sorting_results']) && $this->filters['hide_sorting_results'] == "on"){
                remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 10 );
                remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 10 );
                remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
                remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
                remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 30 );
                remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 30 );
            }
        
        }
        
        /** totla per page */
        function wspc_woocommerce_products_per_page( $cols ){

            if(isset($this->filters['product_per_page'])){
                return $this->filters['product_per_page'];
            }else{
                return $cols;
            }
        }


        /** row per */
        function wspc_woocommerce_loop_columns(){
             
            if(isset($this->filters['product_par_row'])){
                return $this->filters['product_par_row'];
            }
        }

        /** remove title */
        function wspc_remove_shop_title( $title ){
            
            if ( is_shop() ) {
                $title = false;
            }
            return esc_html( $title );
        }
    }
}
?>