<?php
class wspc_admin_product_page_meta_box
{
    /**
     * Constructor.
     */
    public function __construct(){
        if (is_admin()) {
            add_action('add_meta_boxes', array($this, 'add_loop_metabox'));
            add_action('save_post',      array($this, 'save_metabox'), 10, 2);
        }
    }

    /**
     * Adds the meta box.
     */
    public function add_loop_metabox(){
        add_meta_box(
            'loop-meta-box',
            __('Shop Page Customizer for WooCommerce Pro', 'woocommerce-shop-page-customizer'),
            array($this, 'render_loop_metabox'),
            'product',
            'advanced',
            'default'
        );
    }

    /**
     * Renders the meta box.
     */
    public function render_loop_metabox($post){

        wp_nonce_field('custom_nonce_action', 'custom_nonce');
        $popupcontent = "";
        $popupcontent = get_post_meta($post->ID, 'wspc_loop_description', true);

        ?>
        <div class="wrap wspc-main-box">
            <div class="wdpgk-popup-content">
                <h4><b><?php _e('Loop Description','woocommerce-shop-page-customizer') ?></b></h4>
                <?php
                
                $editor_id = 'wspc_loop_content';

                $settings = array(
                    'textarea_name' => 'wspc_loop_content',
                    'tinymce'       => array(
                        'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
                        'theme_advanced_buttons2' => '',
                    ),
                    'editor_css'    => '<style>#wp-wspc_loop_content-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
                );

                wp_editor(htmlspecialchars_decode($popupcontent), $editor_id, $settings);
                ?>
            </div>
        </div>
        <?php
    }

    /**
     * Handles saving the meta box.
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post    Post object.
     * @return null
     */
    public function save_metabox($post_id, $post){

        $nonce_name   = isset($_POST['custom_nonce']) ? $_POST['custom_nonce'] : '';
        $nonce_action = 'custom_nonce_action';

        if (!wp_verify_nonce($nonce_name, $nonce_action)) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (wp_is_post_autosave($post_id)) {
            return;
        }

        if (wp_is_post_revision($post_id)) {
            return;
        }

        $content = wp_kses_allowed_html(htmlentities($_POST['wspc_loop_content']));
    }
}
new wspc_admin_product_page_meta_box();
?>