<?php
use OnlineNewspaper\CustomizerDefault as ONP;
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
add_action( 'customize_preview_init', function() {
    $enqueue_script_args = [ 'strategy' => 'defer', 'in_footer' => true ];
    wp_enqueue_script( 
        'online-newspaper-customizer-preview',
        get_template_directory_uri() . '/inc/customizer/assets/customizer-preview.js',
        [ 'customize-preview' ],
        ONLINE_NEWSPAPER_VERSION,
        $enqueue_script_args
    );
});

add_action( 'customize_controls_enqueue_scripts', function() {
    $enqueue_script_args = [ 'strategy' => 'defer', 'in_footer' => true ];
    $buildControlsDeps = apply_filters(  'online_newspaper_customizer_build_controls_dependencies', [
        'wp-element',
        'react',
        'wp-blocks',
        'wp-editor',
        'wp-i18n',
        'wp-polyfill',
        'jquery',
        'wp-components'
    ]);
	wp_enqueue_style( 
        'online-newspaper-builder-style',
        get_template_directory_uri() . '/inc/customizer/assets/builder.min.css', 
        [ 'wp-components' ],
        ONLINE_NEWSPAPER_VERSION,
        'all'
    );
	wp_enqueue_style( 
        'online-newspaper-customizer-control',
        get_template_directory_uri() . '/inc/customizer/assets/customizer-controls.min.css', 
        [ 'wp-components' ],
        ONLINE_NEWSPAPER_VERSION,
        'all'
    );
    wp_enqueue_script( 
        'online-newspaper-customizer-control',
        get_template_directory_uri() . '/inc/customizer/assets/customizer-extends.min.js',
        $buildControlsDeps,
        ONLINE_NEWSPAPER_VERSION,
        $enqueue_script_args
    );

    wp_enqueue_script( 
        'online-newspaper-customizer-extras',
        get_template_directory_uri() . '/inc/customizer/assets/extras.min.js',
        [ 'jquery', 'customize-controls' ],
        ONLINE_NEWSPAPER_VERSION,
        $enqueue_script_args
    );
    // localize scripts
    wp_localize_script( 
        'online-newspaper-customizer-control', 
        'customizerControlsObject', [
            'imageSizes'    => online_newspaper_get_image_sizes_option_array(),
            'templateDirectoryUri'  =>  get_template_directory_uri(),
            'homeUrl'   =>  home_url()
        ]
    );
    // localize scripts
    wp_localize_script( 
        'online-newspaper-customizer-extras', 
        'customizerExtrasObject', array(
            '_wpnonce'	=> wp_create_nonce( 'online-newspaper-customizer-controls-nonce' ),
            'ajaxUrl' => esc_url( admin_url( 'admin-ajax.php' ) ),
            'custom_callback'   =>  [
                'preloader_option'  =>  [
                    'true'  =>  [ 'preloader_type' ]
                ],
                'website_layout'    =>  [
                    'boxed--layout'  =>  [ 'website_box_shadow', 'website_layout_horizontal_gap', 'website_layout_vertical_gap', 'website_layout_container_setting_heading', 'website_layout_background_color' ]
                ],
                'bottom_footer_header_or_custom' =>  [
                    'custom' =>  [ 'bottom_footer_logo_option', 'bottom_footer_logo_width' ]
                ],
                'archive_pagination_type'   =>  [
                    'number'    =>  [ 'pagination_button_background_color' ]
                ],
                /* Header Builder custom callbacks */
                'header_first_row_column'   =>  [
                    '1' =>  [ 'header_first_row_column_one' ],
                    '2' =>  [ 'header_first_row_column_one', 'header_first_row_column_two' ],
                    '3' =>  [ 'header_first_row_column_one', 'header_first_row_column_two', 'header_first_row_column_three' ]
                ],
                'header_second_row_column'  =>  [
                    '1' =>  [ 'header_second_row_column_one' ],
                    '2' =>  [ 'header_second_row_column_one', 'header_second_row_column_two' ],
                    '3' =>  [ 'header_second_row_column_one', 'header_second_row_column_two', 'header_second_row_column_three' ]
                ],
                'header_third_row_column'   =>  [
                    '1' =>  [ 'header_third_row_column_one' ],
                    '2' =>  [ 'header_third_row_column_one', 'header_third_row_column_two' ],
                    '3' =>  [ 'header_third_row_column_one', 'header_third_row_column_two', 'header_third_row_column_three' ]
                ],
                /* Footer Builder custom callbacks */
                'footer_first_row_column'   =>  [
                    '1' =>  [ 'footer_first_row_column_one' ],
                    '2' =>  [ 'footer_first_row_column_one', 'footer_first_row_column_two' ],
                    '3' =>  [ 'footer_first_row_column_one', 'footer_first_row_column_two', 'footer_first_row_column_three' ],
                    '4' =>  [ 'footer_first_row_column_one', 'footer_first_row_column_two', 'footer_first_row_column_three', 'footer_first_row_column_four' ],
                ],
                'footer_second_row_column'  =>  [
                    '1' =>  [ 'footer_second_row_column_one' ],
                    '2' =>  [ 'footer_second_row_column_one', 'footer_second_row_column_two' ],
                    '3' =>  [ 'footer_second_row_column_one', 'footer_second_row_column_two', 'footer_second_row_column_three' ],
                    '4' =>  [ 'footer_second_row_column_one', 'footer_second_row_column_two', 'footer_second_row_column_three', 'footer_second_row_column_four' ],
                ],
                'footer_third_row_column'   =>  [
                    '1' =>  [ 'footer_third_row_column_one' ],
                    '2' =>  [ 'footer_third_row_column_one', 'footer_third_row_column_two' ],
                    '3' =>  [ 'footer_third_row_column_one', 'footer_third_row_column_two', 'footer_third_row_column_three' ],
                    '4' =>  [ 'footer_third_row_column_one', 'footer_third_row_column_two', 'footer_third_row_column_three', 'footer_third_row_column_four' ],
                ],
                'header_buiilder_header_sticky' =>  [
                    'true'  =>  [ 'header_first_row_header_sticky', 'header_second_row_header_sticky', 'header_third_row_header_sticky' ]
                ],
            ],
            'custom'    =>  [
                'single_section_panel'   =>  online_newspaper_wp_query( 'post' ),
                'page_settings_section'   =>  online_newspaper_wp_query( 'page' ),
                'archive_panel'   =>  home_url() . '/',
                '404_section'   =>  home_url() . '/~~~hfieojfw',
                'search_page_settings'  =>  home_url() . '?s=a',
            ],
        )
    );
});

if( ! function_exists( 'online_newspaper_wp_query' ) ) :
    /**
     * Returns permalink
     * 
     * @param post_type
     * @since 1.0.0
     * @package Blogzee Pro
     */
    function online_newspaper_wp_query( $type ) {
        $permalink = home_url();
        switch( $type ) :
            case ( in_array( $type, [ 'page', 'post' ] ) ):
                    $type_args = [
                        'post_type'	=>	$type,
                        'posts_per_page'	=>	1,
                        'orderby'	=>	'rand',
                        'fields'    =>  'ids',
                        'no_found_rows' =>  true,
                        'update_post_meta_cache'    =>  false,
                        'update_post_term_cache'    =>  false,
                    ];
                    if( $type == 'search' ) $type_args['s'] = 'a';
                    $type_query = new \WP_Query( apply_filters( 'blogzee_query_args_filter', $type_args ) );
                    if( $type_query->have_posts() ) :
                        while( $type_query->have_posts() ):
                            $type_query->the_post();
                            $permalink = get_the_permalink();
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    return $permalink;
                break;
            case ( in_array( $type, [ 'tag', 'category' ] ) ):
                    $nexus_collective = function( $args ){
                        return get_terms( $args );
                    };
                    $taxonomy = ( $type == 'category' ) ? 'category' : 'post_tag';
                    $total = count( $nexus_collective([ 'taxonomy'  =>  $taxonomy, 'number' => 0, 'fields'    =>  'ids' ]) );
                    $random_number = rand( 0, ( $total - 1 ) );
                    $taxonomy_args = [
                        'orderby'   =>  'rand',
                        'number'    =>  1,
                        'taxonomy'  =>  $taxonomy,
                        'offset'	=>	$random_number,
                        'fields'    =>  'ids'
                    ];
                    $get_taxonomies = $nexus_collective( $taxonomy_args );
                    if( ! empty( $get_taxonomies ) && is_array( $get_taxonomies ) ) :
                        foreach( $get_taxonomies as $taxonomy ) :
                            $permalink = get_term_link( $taxonomy );
                        endforeach;
                    endif;
                    return $permalink;
                break;
            case 'author':
                    $nexus_collective = function( $args ) {
                        return new \WP_User_Query( $args );
                    };
                    $total = $nexus_collective( [ 'number' => 0, 'fields'    =>  'ids' ] )->get_total();
                    $random_number = rand( 0, ( $total - 1 ) );
                    $author_args = [
                        'number'    =>  1,
                        'offset'    =>  $random_number
                    ];
                    $user_query = $nexus_collective( $author_args );
                    if ( ! empty( $user_query->get_results() ) ) :
                        foreach ( $user_query->get_results() as $user ) :
                            $permalink = get_author_posts_url( $user->data->ID );
                        endforeach;
                    endif;
                    wp_reset_postdata();
                    return $permalink;
                break;
        endswitch;
    }
endif;