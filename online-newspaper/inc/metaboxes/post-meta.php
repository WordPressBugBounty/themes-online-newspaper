<?php
/**
 * Adds post meta fields in the post, page and custom post types
 * 
 * @package Online Newspaper
 * @since 1.0.0
 * 
 */
if ( ! function_exists( 'online_newspaper_post_metaboxes' ) ) :
    /**
     * Add post metabox
     *
     * @since 1.0.0
     */
    function online_newspaper_post_metaboxes() {
        add_meta_box(
            'online_newspaper_post_meta',
            esc_html__( 'Meta Settings', 'online-newspaper' ),
            'online_newspaper_post_meta_callback',
            array( 'page', 'post' ),
            'normal',
            'default'
        );
    }
    add_action( 'add_meta_boxes', 'online_newspaper_post_metaboxes', 10, 2 );
endif;

function online_newspaper_post_meta_callback( $post ) {
    // sidebar option
    $meta_sidebar_options = [
        'customizer-setting'    => array(
            'label' => esc_html__( 'Customizer Setting', 'online-newspaper' ),
            'url'   => get_template_directory_uri() . '/assets/images/customizer/customizer-setting.jpg'
        ),
        'no-sidebar' => array(
            'label' => esc_html__( 'No Sidebar', 'online-newspaper' ),
            'url'   => get_template_directory_uri() . '/assets/images/customizer/no_sidebar.jpg'
        ),
        'left-sidebar' => array(
            'label' => esc_html__( 'Left Sidebar', 'online-newspaper' ),
            'url'   => get_template_directory_uri() . '/assets/images/customizer/left_sidebar.jpg'
        ),
        'right-sidebar' => array(
            'label' => esc_html__( 'Right Sidebar', 'online-newspaper' ),
            'url'   => get_template_directory_uri() . '/assets/images/customizer/right_sidebar.jpg'
        ),
        'both-sidebar' => array(
            'label' => esc_html__( 'Both Sidebar', 'online-newspaper' ),
            'url'   => get_template_directory_uri() . '/assets/images/customizer/both_sidebar.jpg'
        ),
        'left-both-sidebar' => array(
            'label' => esc_html__( 'Both Sidebar', 'online-newspaper' ),
            'url'   => get_template_directory_uri() . '/assets/images/customizer/left_both_sidebar.jpg'
        ),
        'right-both-sidebar' => array(
            'label' => esc_html__( 'Both Sidebar', 'online-newspaper' ),
            'url'   => get_template_directory_uri() . '/assets/images/customizer/right_both_sidebar.jpg'
        )
    ];

    // width layouts option
    $meta_width_layouts_options = [
        'customizer-setting'    => array(
            'label' => esc_html__( 'Customizer Setting', 'online-newspaper' ),
            'url'   => get_template_directory_uri() . '/assets/images/customizer/customizer-setting.jpg'
        ),
        'boxed--layout' => array(
            'label' => esc_html__( 'Boxed', 'online-newspaper' ),
            'url'   => get_template_directory_uri() . '/assets/images/customizer/boxed_content.jpg'
        ),
        'full-width--layout' => array(
            'label' => esc_html__( 'Full Width', 'online-newspaper' ),
            'url'   => get_template_directory_uri() . '/assets/images/customizer/full_content.jpg'
        )
    ];

    // Single layouts option
    $single_layout_options = array(
        'customizer-layout' => array(
            'label' => esc_html__( 'customizer Layout', 'online-newspaper' ),
            'url'   => get_template_directory_uri() .  '/assets/images/customizer/customizer-setting.jpg'
        ),
        'three' => array(
            'label' => esc_html__( 'Layout One', 'online-newspaper' ),
            'url'   => get_template_directory_uri() .  '/assets/images/customizer/single_three.jpg'
        ),
        'five' => array(
            'label' => esc_html__( 'Layout Two', 'online-newspaper' ),
            'url'   => get_template_directory_uri() .  '/assets/images/customizer/single_five.jpg'
        )
    );

    // default value set for post sidebar layout.
    if( !metadata_exists( 'post', $post->ID, 'post_sidebar_layout' ) ) {
        // add post sidebar layout value "custmomizer-setting".
        update_post_meta( $post->ID, 'post_sidebar_layout', 'customizer-setting' );
    }
    $post_sidebar_layout = get_post_meta( $post->ID, 'post_sidebar_layout', true );
    $post_sidebar_layout = ( $post_sidebar_layout ) ? $post_sidebar_layout : 'customizer-setting';

    // default value set for post width layout.
    if( !metadata_exists( 'post', $post->ID, 'post_width_layout' ) ) {
        // add post width layout value "custmomizer-setting".
        update_post_meta( $post->ID, 'post_width_layout', 'customizer-setting' );
    }
    $post_width_layout = get_post_meta( $post->ID, 'post_width_layout', true );
    $post_width_layout = ( $post_width_layout ) ? $post_width_layout : 'customizer-setting';

    // default value set for post width layout.
    if( !metadata_exists( 'post', $post->ID, 'single_layout' ) ) {
        // add post width layout value "custmomizer-setting".
        update_post_meta( $post->ID, 'single_layout', 'customizer-layout' );
    }
    $single_layout = get_post_meta( $post->ID, 'single_layout', true );
    $single_layout = ( $single_layout ) ? $single_layout : 'customizer-layout';
    
    // Create our nonce field.
    wp_nonce_field( basename( __FILE__ ) , 'online_newspaper_post_meta_nonce' );
    ?>
        <div id="online-newspaper-post-metabox">
            <div class="single-meta-field radio-image-field">
                <label for="post_sidebar_layout"><?php esc_html_e( 'Sidebar Layout Settings', 'online-newspaper' ); ?></label>
                <p class="meta-description"><?php esc_html_e( 'Choose sidebar layout for this post', 'online-newspaper' ); ?></p>
                <div class="radio-image-fields-wrap">
                    <?php
                        foreach( $meta_sidebar_options as $key => $value ) :
                        ?>
                            <div class="radio-field <?php if( $post_sidebar_layout === $key ) echo 'selected'; ?>" data-value="<?php echo esc_attr( $key ); ?>"><img src="<?php echo esc_url( $value['url'] ); ?>" alt="<?php echo esc_attr( $value['label'] ); ?>"></div>
                    <?php
                        endforeach;
                    ?>
                </div>
                <input type="hidden" name="post_sidebar_layout" value="<?php echo esc_attr($post_sidebar_layout); ?>">
            </div><!-- .single-meta-field -->
            <div class="single-meta-field radio-image-field">
                <label for="post_width_layout"><?php esc_html_e( 'Width Layout Settings', 'online-newspaper' ); ?></label>
                <p class="meta-description"><?php esc_html_e( 'Choose width layout for this post', 'online-newspaper' ); ?></p>
                <div class="radio-image-fields-wrap">
                    <?php
                        foreach( $meta_width_layouts_options as $key => $value ) :
                    ?>
                            <div class="radio-field <?php if( $post_width_layout === $key ) echo 'selected'; ?>" data-value="<?php echo esc_attr( $key ); ?>"><img src="<?php echo esc_url( $value['url'] ); ?>" alt="<?php echo esc_attr( $value['label'] ); ?>"></div>
                    <?php
                        endforeach;
                    ?>
                </div>
                <input type="hidden" name="post_width_layout" value="<?php echo esc_attr($post_width_layout); ?>">
            </div><!-- .single-meta-field -->
            <?php
                $screen = get_current_screen();

                if ( $screen && $screen->base === 'post' && $screen->post_type === 'post' ) :
                    ?>
                        <div class="single-meta-field radio-image-field">
                            <label for="single_layout"><?php esc_html_e( 'Single Layout Settings', 'online-newspaper' ); ?></label>
                            <p class="meta-description"><?php esc_html_e( 'Choose single layout for this post', 'online-newspaper' ); ?></p>
                            <div class="radio-image-fields-wrap">
                                <?php
                                    foreach( $single_layout_options as $key => $value ) :
                                ?>
                                        <div class="radio-field <?php if( $single_layout === $key ) echo 'selected'; ?>" data-value="<?php echo esc_attr( $key ); ?>"><img src="<?php echo esc_url( $value['url'] ); ?>" alt="<?php echo esc_attr( $value['label'] ); ?>"></div>
                                <?php
                                    endforeach;
                                ?>
                            </div>
                            <input type="hidden" name="single_layout" value="<?php echo esc_attr($single_layout); ?>">
                        </div><!-- .single-meta-field -->
                    <?php
                endif;
            ?>
        </div>
    <?php
}

function online_newspaper_save_post_meta( $post_id ) {
    // Verify the nonce before proceeding.
    $online_newspaper_post_meta_nonce   = isset( $_POST['online_newspaper_post_meta_nonce'] ) ? $_POST['online_newspaper_post_meta_nonce'] : '';
    $online_newspaper_post_meta_nonce_action = basename( __FILE__ );

    //* Check if nonce is set...
    if ( ! isset( $online_newspaper_post_meta_nonce ) ) {
        return;
    }

    //* Check if nonce is valid...
    if ( ! wp_verify_nonce( $online_newspaper_post_meta_nonce, $online_newspaper_post_meta_nonce_action ) ) {
        return;
    }

    //* Check if user has permissions to save data...
    if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return;
    }

    // Check auto save
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    //* Check if not a revision...
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }

    if( isset( $_POST['post_sidebar_layout'] ) ) {
        update_post_meta( $post_id, 'post_sidebar_layout', sanitize_text_field( $_POST['post_sidebar_layout'] ) );
    }

    if( isset( $_POST['post_width_layout'] ) ) {
        update_post_meta( $post_id, 'post_width_layout', sanitize_text_field( $_POST['post_width_layout'] ) );
    }

    if( isset( $_POST['single_layout'] ) ) {
        update_post_meta( $post_id, 'single_layout', sanitize_text_field( $_POST['single_layout'] ) );
    }
}
add_action( 'save_post', 'online_newspaper_save_post_meta' );

function online_newspaper_save_attchment_meta( $post_id ) {
    // Verify the nonce before proceeding.
    $online_newspaper_post_meta_nonce   = isset( $_POST['online_newspaper_post_meta_nonce'] ) ? $_POST['online_newspaper_post_meta_nonce'] : '';
    $online_newspaper_post_meta_nonce_action = basename( __FILE__ );

    //* Check if nonce is set...
    if ( ! isset( $online_newspaper_post_meta_nonce ) ) {
        return;
    }

    //* Check if nonce is valid...
    if ( ! wp_verify_nonce( $online_newspaper_post_meta_nonce, $online_newspaper_post_meta_nonce_action ) ) {
        return;
    }

    //* Check if user has permissions to save data...
    if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return;
    }

    // Check auto save
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    //* Check if not a revision...
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }
}
add_action( 'edit_attachment', 'online_newspaper_save_attchment_meta' );