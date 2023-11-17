<?php
if (!class_exists('wspc_get_pro_version')) {   
    class wspc_get_pro_version {
 
        function get_pro_version_list(){ ?>

            <form>
                <div class="wspc-prop-details">
                    <div class="wspc-section">
                        <h2><?php _e('Shop Page Customizer for WooCommerce Pro Version Features','woocommerce-shop-page-customizer') ?></h2>
                        <ul>
                            <li> <?php _e('Can display shop now button in product loop.','woocommerce-shop-page-customizer') ?></li>
                            <li> <?php _e('Customize Add to Cart Button style like Button Color, Button Font Color, Button Hover Color, Button Font Hover Color, etc.','woocommerce-shop-page-customizer') ?></li>
                            <li> <?php _e('Option to change Shop Now Button style like Button Color, Button Font Color, Button Hover Color, Button Font Hover Color, etc.','woocommerce-shop-page-customizer') ?></li>
                            <li> <?php _e('Also you can change Sale Flash style like Sale Banner Color, Sale Banner font Color, etc.','woocommerce-shop-page-customizer') ?></li>

                            <li> <?php _e('Manually enable disable option to Display product description in product loop.','woocommerce-shop-page-customizer') ?></li>
                            <li> <?php _e('Option to change product description position in product loop. Position can be "Before product title", "After product title", "Before rating", "After rating", "Before price", "After price", "Before add to cart button", "After add to cart button".','woocommerce-shop-page-customizer') ?></li>
                            <li> <?php _e('Select content of product description. Content can be "Product Detail Description", "Product short Description", "Custom Loop Description".','woocommerce-shop-page-customizer') ?></li>
                            <li> <?php _e('Option to set a limit of alphabets in product description.','woocommerce-shop-page-customizer') ?></li>
                            <li> <?php _e('Also you can change product description alignment.Text Alignment can be "Right", "Letf", "Center".','woocommerce-shop-page-customizer') ?></li>
                            <li> <?php _e('Users can customize product description font color and font size.','woocommerce-shop-page-customizer') ?></li>

                            <li> <?php _e('Timely <a href="https://geekcodelab.com/contact/" target="_blank">support</a> 24/7.','woocommerce-shop-page-customizer') ?></li>
                            <li> <?php _e('Regular updates.','woocommerce-shop-page-customizer') ?></li>
                            <li> <?php _e('Well documented.','woocommerce-shop-page-customizer') ?></li>
                        </ul>
                        <a href="https://geekcodelab.com/wordpress-plugins/shop-page-customizer-for-woocommerce-pro" title="Upgrade to Premium" class="wspc-premium-btn" target="_blank"><?php _e('Upgrade to Premium','woocommerce-shop-page-customizer'); ?></a>
                    </div>
                </div>
            </form>
            <?php
        }
    }

}