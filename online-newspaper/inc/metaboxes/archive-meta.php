<?php
/**
 * Adds archive meta fields in the archive
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
define('ONLINE_NEWSPAPER_IMAGE_URL', get_template_directory_uri() . '/assets/images/customizer/' );

 if( ! function_exists( 'online_newspaper_metabox_loop_part' ) ) :
    /**
     * adds radio images in metabox
     * 
     * @since 1.0.0
     * @param array key( id of radio image ), value( path of radio image )
     * @return html
     */
    function online_newspaper_metabox_loop_part( $layout_args, $meta_key, $meta_value ) {
        if( is_array( $layout_args ) && ! empty( $layout_args ) ) :
            $count = 0;
            foreach( $layout_args as $layout_key => $layout_value ) :
                $checked = ( $meta_value == $layout_key ) ? 'checked' : '';
                $isactive = ( $meta_value == $layout_key ) ? ' isactive' : '';
                ?>
                    <p class="layout-item<?php echo $isactive; ?>">
                        <input type="radio" name="<?php echo esc_attr( $meta_key ); ?>" id="<?php echo esc_attr( $layout_key ); ?>" value="<?php echo esc_attr( $layout_key ); ?>" <?php echo esc_attr( $checked ); ?>>
                        <label for="<?php echo esc_attr( $layout_key ); ?>">
                            <img src="<?php echo esc_attr( $layout_value ); ?>" loading="lazy">
                            <span class="title"><?php echo esc_html( ucfirst( $layout_key ) ); ?></span>
                        </label>
                    </p>
                <?php
                $count++;
            endforeach;
        endif;
    }
 endif;

if( ! function_exists( 'online_newspaper_categories_custom_meta_fields' ) ) :
	/**
	 * Adds custom meta fields in categories dashboard
	 * 
	 * @since 1.0.0
	 */
	function online_newspaper_categories_custom_meta_fields( $term ) {
        $sidebar_meta = metadata_exists( 'term', $term->term_id, "_online_newspaper_{$term->taxonomy}_sidebar_custom_meta_field" ) ? get_term_meta( $term->term_id, "_online_newspaper_{$term->taxonomy}_sidebar_custom_meta_field", true ) : 'customizer-setting';
        $archive_meta = metadata_exists( 'term', $term->term_id, "_online_newspaper_{$term->taxonomy}_archive_custom_meta_field" ) ? get_term_meta( $term->term_id, "_online_newspaper_{$term->taxonomy}_archive_custom_meta_field", true ) : 'customizer-layout';
		$sidebar_layout_args = [ 
            'customizer-setting'    =>  ONLINE_NEWSPAPER_IMAGE_URL . 'customizer-setting.jpg',
            'right-sidebar' =>  ONLINE_NEWSPAPER_IMAGE_URL . 'right_sidebar.jpg',
            'left-sidebar'  =>  ONLINE_NEWSPAPER_IMAGE_URL . 'left_sidebar.jpg',
            'both-sidebar'  =>  ONLINE_NEWSPAPER_IMAGE_URL . 'both_sidebar.jpg',
            'no-sidebar'    =>  ONLINE_NEWSPAPER_IMAGE_URL . 'no_sidebar.jpg'
        ];
		$archive_layout_args = [ 
            'customizer-layout' =>  ONLINE_NEWSPAPER_IMAGE_URL . 'customizer-setting.jpg',
            'one' =>  ONLINE_NEWSPAPER_IMAGE_URL . 'archive_one.jpg',
            'two' =>  ONLINE_NEWSPAPER_IMAGE_URL . 'archive_two.jpg',
            'five'   =>  ONLINE_NEWSPAPER_IMAGE_URL . 'archive_five.jpg',
        ];
        ?>
            <tr class="form-field">
                <th><?php echo esc_html__( 'Sidebar Layouts', 'online-newspaper' ); ?></th>
                <td>
                    <div class="taxonomy-sidebar-layouts-wrap">
                        <?php online_newspaper_metabox_loop_part( $sidebar_layout_args, "_online_newspaper_{$term->taxonomy}_sidebar_custom_meta_field", $sidebar_meta ); ?>
                    </div>
                </td>
            </tr>
            <tr class="form-field">
                <th><?php echo esc_html__( 'Archive Layouts', 'online-newspaper' ); ?></th>
                <td>
                    <div class="taxonomy-archive-layouts-wrap">
                        <?php online_newspaper_metabox_loop_part( $archive_layout_args, "_online_newspaper_{$term->taxonomy}_archive_custom_meta_field", $archive_meta ); ?>
                    </div>
                </td>
            </tr>
        <?php
	}
	add_action( 'category_edit_form_fields', 'online_newspaper_categories_custom_meta_fields' );
	add_action( 'post_tag_edit_form_fields', 'online_newspaper_categories_custom_meta_fields' );
 endif;
 
 if( ! function_exists( 'online_newspaper_category_custom_meta_field_save' ) ) :
	/**
	 * Save category custom meta fields
	 * 
	 * @since 1.0.0
	 */
	function online_newspaper_category_custom_meta_field_save( $term_id ) {
        if( array_key_exists( '_online_newspaper_category_sidebar_custom_meta_field', $_POST ) ) update_term_meta( $term_id, '_online_newspaper_category_sidebar_custom_meta_field', sanitize_text_field( $_POST['_online_newspaper_category_sidebar_custom_meta_field'] ) );
        if( array_key_exists( '_online_newspaper_category_archive_custom_meta_field', $_POST ) ) update_term_meta( $term_id, '_online_newspaper_category_archive_custom_meta_field', sanitize_text_field( $_POST['_online_newspaper_category_archive_custom_meta_field'] ) );
	}
	add_action( 'edited_category', 'online_newspaper_category_custom_meta_field_save' );
	add_action( 'create_category', 'online_newspaper_category_custom_meta_field_save' );
 endif;

 if( ! function_exists( 'online_newspaper_post_tag_custom_meta_field_save' ) ) :
    /**
     * Save tag custom meta fields
     * 
     * @since 1.0.0
     */
    function online_newspaper_post_tag_custom_meta_field_save( $term_id ) {
        if( array_key_exists( '_online_newspaper_post_tag_sidebar_custom_meta_field', $_POST ) ) update_term_meta( $term_id, '_online_newspaper_post_tag_sidebar_custom_meta_field', sanitize_text_field( $_POST['_online_newspaper_post_tag_sidebar_custom_meta_field'] ) );
        if( array_key_exists( '_online_newspaper_post_tag_archive_custom_meta_field', $_POST ) ) update_term_meta( $term_id, '_online_newspaper_post_tag_archive_custom_meta_field', sanitize_text_field( $_POST['_online_newspaper_post_tag_archive_custom_meta_field'] ) );
    }
    add_action( 'edited_post_tag', 'online_newspaper_post_tag_custom_meta_field_save' );
	add_action( 'create_post_tag', 'online_newspaper_post_tag_custom_meta_field_save' );
 endif;

 if( ! function_exists( 'online_newspaper_taxonomy_custom_meta_part' ) ) :
    /**
     * Adds custom meta fields in add new category page and add new tags page
     * 
     * @since 1.0.0
     */
    function online_newspaper_taxonomy_custom_meta_part( $this_taxonomy ) {
        $sidebar_layout_args = [ 
            'customizer-setting'    =>  ONLINE_NEWSPAPER_IMAGE_URL . 'customizer-setting.jpg',
            'right-sidebar' =>  ONLINE_NEWSPAPER_IMAGE_URL . 'right_sidebar.jpg',
            'left-sidebar'  =>  ONLINE_NEWSPAPER_IMAGE_URL . 'left_sidebar.jpg',
            'both-sidebar'  =>  ONLINE_NEWSPAPER_IMAGE_URL . 'both_sidebar.jpg',
            'no-sidebar'    =>  ONLINE_NEWSPAPER_IMAGE_URL . 'no_sidebar.jpg'
        ];
		$archive_layout_args = [ 
            'customizer-layout' =>  ONLINE_NEWSPAPER_IMAGE_URL . 'customizer-setting.jpg',
            'one' =>  ONLINE_NEWSPAPER_IMAGE_URL . 'archive_one.jpg',
            'two' =>  ONLINE_NEWSPAPER_IMAGE_URL . 'archive_two.jpg',
            'five'   =>  ONLINE_NEWSPAPER_IMAGE_URL . 'archive_five.jpg',
        ];
        ?>
            <div class="form-field term-sidebar-layouts-wrap">
                <h2><?php echo esc_html__( 'Sidebar Layouts', 'online-newspaper' ); ?></h2>
                <td>
                    <div class="taxonomy-sidebar-layouts-wrap">
                        <?php
                            if( is_array( $sidebar_layout_args ) && ! empty( $sidebar_layout_args ) ) :
                                $count = 0;
                                foreach( $sidebar_layout_args as $sidebar_key => $sidebar_value ) :
                                    ?>
                                        <p class="layout-item<?php echo esc_attr( ( $count == 0 ) ? ' isactive' : '' ); ?>">
                                            <input type="radio" name="<?php echo esc_attr( "_online_newspaper_{$this_taxonomy}_sidebar_custom_meta_field" ); ?>" id="<?php echo esc_attr( $sidebar_key ); ?>" value="<?php echo esc_attr( $sidebar_key ); ?>" <?php echo esc_attr( ( $count == 0 ) ? 'checked' : '' ); ?>>
                                            <label for="<?php echo esc_attr( $sidebar_key ); ?>">
                                                <img src="<?php echo esc_attr( $sidebar_value ); ?>" loading="lazy">
                                                <span class="title"><?php echo esc_html( ucfirst( $sidebar_key ) ); ?></span>
                                            </label>
                                        </p>
                                    <?php
                                    $count++;
                                endforeach;
                            endif;
                        ?>
                    </div>
                </td>
            </div>
            <div class="form-field term-archive-layouts-wrap">
                <h2><?php echo esc_html__( 'Archive Layouts', 'online-newspaper' ); ?></h2>
                <td>
                    <div class="taxonomy-archive-layouts-wrap">
                        <?php
                            if( is_array( $archive_layout_args ) && ! empty( $archive_layout_args ) ) :
                                $count = 0;
                                foreach( $archive_layout_args as $archive_key => $archive_value ) :
                                    ?>
                                        <p class="layout-item<?php echo esc_attr( ( $count == 0 ) ? ' isactive' : '' ); ?>">
                                            <input type="radio" name="<?php echo esc_attr( "_online_newspaper_{$this_taxonomy}_archive_custom_meta_field" ); ?>" id="<?php echo esc_attr( $archive_key ); ?>" value="<?php echo esc_attr( $archive_key ); ?>" <?php echo esc_attr( ( $count == 0 ) ? 'checked' : '' ); ?>>
                                            <label for="<?php echo esc_attr( $archive_key ); ?>">
                                                <img src="<?php echo esc_attr( $archive_value ); ?>" loading="lazy">
                                                <span class="title"><?php echo esc_html( ucfirst( $archive_key ) ); ?></span>
                                            </label>
                                        </p>
                                    <?php
                                    $count++;
                                endforeach;
                            endif;
                        ?>
                    </div>
                </td>
            </div>
        <?php
    }
endif;

if( ! function_exists( 'online_newspaper_categories_custom_meta' ) ) :
    /**
     * Adds custom meta in categories
     * 
     * @since 1.0.0
     */
    function online_newspaper_categories_custom_meta() {
        online_newspaper_taxonomy_custom_meta_part( 'category' );
    }
endif;

add_action( 'category_add_form_fields', 'online_newspaper_categories_custom_meta' );


if( ! function_exists( 'online_newspaper_tags_custom_meta' ) ) :
    /**
     * Adds custom meta in categories
     * 
     * @since 1.0.0
     */
    function online_newspaper_tags_custom_meta() {
        online_newspaper_taxonomy_custom_meta_part( 'post_tag' );
    }
endif;
add_action( 'post_tag_add_form_fields', 'online_newspaper_tags_custom_meta' );