<?php
/**
 * Adds custom meta boxes
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */

 if( ! function_exists( 'online_newspaper_add_author_social_meta_fields' ) ) :
    /**
     * Add new fields above 'Update' button user page.
     *
     * @param WP_User $user User object.
     */
    function online_newspaper_add_author_social_meta_fields( $user ) {
        $facebook_url = ( get_the_author_meta( 'facebook_url', $user->ID ) ) ? esc_url( get_the_author_meta( 'facebook_url', $user->ID ) ) : '';
        $twitter_url = ( get_the_author_meta( 'twitter_url', $user->ID ) ) ? esc_url( get_the_author_meta( 'twitter_url', $user->ID ) ) : '';
        $linkedin_url = ( get_the_author_meta( 'linkedin_url', $user->ID ) ) ? esc_url( get_the_author_meta( 'linkedin_url', $user->ID ) ) : '';
        $instagram_url = ( get_the_author_meta( 'instagram_url', $user->ID ) ) ? esc_url( get_the_author_meta( 'instagram_url', $user->ID ) ) : '';
        ?>
        <h2><?php esc_html_e( 'Social Networks', 'online-newspaper' ); ?></h2>
        <table class="form-table">
            <tr>
                <th><label for="facebook_url"><?php esc_html_e( 'Facebook Url', 'online-newspaper' ); ?></label></th>
                <td>
                    <input type="url" name="facebook_url" id="facebook_url" value="<?php echo esc_url( $facebook_url ); ?>" class="regular-text code">
                </td>
            </tr>
            <tr>
                <th><label for="twitter_url"><?php esc_html_e( 'Twitter Url', 'online-newspaper' ); ?></label></th>
                <td>
                    <input type="url" name="twitter_url" id="twitter_url" value="<?php echo esc_url( $twitter_url ); ?>" class="regular-text code">
                </td>
            </tr>
            <tr>
                <th><label for="linkedin_url"><?php esc_html_e( 'Linkedin Url', 'online-newspaper' ); ?></label></th>
                <td>
                    <input type="url" name="linkedin_url" id="linkedin_url" value="<?php echo esc_url( $linkedin_url ); ?>" class="regular-text code">
                </td>
            </tr>
            <tr>
                <th><label for="instagram_url"><?php esc_html_e( 'Instagram Url', 'online-newspaper' ); ?></label></th>
                <td>
                    <input type="url" name="instagram_url" id="instagram_url" value="<?php echo esc_url( $instagram_url ); ?>" class="regular-text code">
                </td>
            </tr>
        </table>
        <?php
    }
    add_action( 'show_user_profile', 'online_newspaper_add_author_social_meta_fields' );
    add_action( 'edit_user_profile', 'online_newspaper_add_author_social_meta_fields' );
endif;

if( ! function_exists( 'online_newspaper_save_author_social_meta_fields' ) ) :
    /**
     * Save additional profile fields.
     *
     * @param  int $user_id Current user ID.
     */
    function online_newspaper_save_author_social_meta_fields( $user_id ) {
        if ( ! current_user_can( 'edit_user', $user_id ) ) {
        return false;
        }
        $facebook_url = isset( $_POST['facebook_url'] ) ? esc_url( $_POST['facebook_url'] ) : '';
        update_user_meta( $user_id, 'facebook_url', esc_url( $facebook_url ) );

        $twitter_url = isset( $_POST['twitter_url'] ) ? esc_url( $_POST['twitter_url'] ) : '';
        update_user_meta( $user_id, 'twitter_url', esc_url( $twitter_url ) );

        $linkedin_url = isset( $_POST['linkedin_url'] ) ? esc_url( $_POST['linkedin_url'] ) : '';
        update_user_meta( $user_id, 'linkedin_url', esc_url( $linkedin_url ) );

        $instagram_url = isset( $_POST['instagram_url'] ) ? esc_url( $_POST['instagram_url'] ) : '';
        update_user_meta( $user_id, 'instagram_url', esc_url( $instagram_url ) );
    }

    add_action( 'personal_options_update', 'online_newspaper_save_author_social_meta_fields' );
    add_action( 'edit_user_profile_update', 'online_newspaper_save_author_social_meta_fields' );
endif;

function online_newspaper_post_meta_scripts($hook) {
    if( ! in_array( $hook, [ 'post.php', 'edit-tags.php', 'term.php', 'post-new.php' ] ) ) {
        return;
    }
    wp_enqueue_style( 'online-newspaper-metaboxes', get_template_directory_uri() . '/inc/metaboxes/assets/metabox.css', array(), ONLINE_NEWSPAPER_VERSION );
	wp_enqueue_script( 'online-newspaper-metaboxes', get_template_directory_uri() . '/inc/metaboxes/assets/metabox.js', array( 'jquery' ), ONLINE_NEWSPAPER_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'online_newspaper_post_meta_scripts' );

require get_template_directory() . '/inc/metaboxes/post-meta.php'; // post meta handlers
require get_template_directory() . '/inc/metaboxes/archive-meta.php'; // archive meta handlers