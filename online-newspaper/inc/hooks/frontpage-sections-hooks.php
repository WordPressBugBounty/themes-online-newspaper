<?php
/**
 * Includes all the frontpage sections html functions
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
use OnlineNewspaper\CustomizerDefault as ONP;

if( ! function_exists( 'online_newspaper_main_banner_part' ) ) :
    /**
     * Main Banner element
     * 
     * @since 1.0.0
     */
    function online_newspaper_main_banner_part() {
        if( is_paged() || online_newspaper_is_paged_filtered() ) return;
        $main_banner_layout = 'five';
        $main_banner_slider_order_by = ONP\online_newspaper_get_customizer_option( 'main_banner_slider_order_by' );
        $main_banner_slider_categories = ONP\online_newspaper_get_customizer_option( 'main_banner_slider_categories' );
        $main_banner_posts = ONP\online_newspaper_get_customizer_option( 'main_banner_posts' );
        $banner_section_three_column_order = json_decode( ONP\online_newspaper_get_customizer_option( 'banner_section_three_column_order' ), true );
        $main_banner_card_enable = ONP\online_newspaper_get_customizer_option( 'main_banner_card_enable' );

        $orderArray = explode( '-', $main_banner_slider_order_by );
        $main_banner_args = array(
            'slider_args'  => array(
                'order' => esc_html( $orderArray[1] ),
                'orderby' => esc_html( $orderArray[0] ),
                'ignore_sticky_posts'   => true,
                'fields'    =>  'ids',
                'no_found_rows' =>  true,
                'update_post_meta_cache'    =>  false,
                'update_post_term_cache'    =>  false,
            )
        );
        $main_banner_args['slider_args']['posts_per_page'] = 4;
        if( $main_banner_slider_categories ) $main_banner_args['slider_args']['cat'] = online_newspaper_get_categories_for_args( $main_banner_slider_categories );
        if( $main_banner_posts ) $main_banner_args['slider_args']['post__in'] = online_newspaper_get_post_id_for_args($main_banner_posts);
        $section_column_sort_class = implode( '--', array_keys( $banner_section_three_column_order ) );
        
        $sectionClass[] = 'online-newspaper-section';
        $sectionClass[] = 'online-newspaper-category-no-bk';
        $sectionClass[] = 'banner-layout--'. $main_banner_layout;
        $sectionClass[] = $section_column_sort_class;
        $sectionClass[] = 'width-' . online_newspaper_get_section_width_layout_val( 'main_banner_width_layout' );
        $sectionClass[] = 'card--' . ( $main_banner_card_enable ? 'on': 'off' );
        ?>
            <section id="main-banner-section" class="<?php echo esc_attr( implode( ' ', $sectionClass    ) ); ?>">
                <div class="online-newspaper-container">
                    <div class="row">
                        <?php get_template_part( 'template-parts/main-banner/template', esc_html( $main_banner_layout ), $main_banner_args ); ?>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'online_newspaper_main_banner_hook', 'online_newspaper_main_banner_part', 10 );
endif;

if( ! function_exists( 'online_newspaper_full_width_blocks_part' ) ) :
    /**
     * Full Width Blocks element
     * 
     * @since 1.0.0
     */
     function online_newspaper_full_width_blocks_part() {
        $full_width_blocks = ONP\online_newspaper_get_customizer_option( 'full_width_blocks' );
        if( empty( $full_width_blocks ) || is_paged() || online_newspaper_is_paged_filtered() ) return;
        if( ! in_array( true, array_column( $full_width_blocks, 'option' ) ) ) {
            return;
        }
        $full_width_blocks_width_layout = online_newspaper_get_section_width_layout_val('full_width_blocks_width_layout');
        $full_width_card_enable = ONP\online_newspaper_get_customizer_option( 'full_width_card_enable' );
        $sectionClass[] = 'online-newspaper-section';
        $sectionClass[] = 'full-width-section';
        $sectionClass[] = 'width-' . $full_width_blocks_width_layout;
        $sectionClass[] = 'card--' . ( $full_width_card_enable ? 'on': 'off' );
        ?>
            <section id="full-width-section" class="<?php echo esc_attr( implode( ' ', $sectionClass ) ); ?>">
                <div class="online-newspaper-container">
                    <div class="row">
                        <?php
                            foreach( $full_width_blocks as $block ) :
                                if( $block[ 'option' ] ) :
                                    $type = $block[ 'type' ];
                                    switch($type) {
                                        case 'shortcode-block' : online_newspaper_shortcode_block_html( $block, true );
                                                        break;
                                        case 'ad-block' : online_newspaper_advertisement_block_html( $block, true );
                                                        break;
                                        default: $layout = $block[ 'layout' ];
                                                $block_query = $block[ 'query' ];
                                                $order = $block_query[ 'order' ];
                                                $postCategories = $block_query[ 'categories' ];
                                                $customexclude_ids = $block_query[ 'ids' ];
                                                $orderArray = explode( '-', $order );
                                                $block_args = array(
                                                    'post_args' => array(
                                                        'post_type' => 'post',
                                                        'order' => esc_html( $orderArray[1] ),
                                                        'orderby' => esc_html( $orderArray[0] ),
                                                        'ignore_sticky_posts'   => true,
                                                        'fields'    =>  'ids',
                                                        'no_found_rows' =>  true,
                                                        'update_post_meta_cache'    =>  false,
                                                        'update_post_term_cache'    =>  false,
                                                    ),
                                                    'options'    => $block
                                                );
                                                $offset = isset( $block_query[ 'offset' ] ) ? $block_query[ 'offset' ]: 0;
                                                if( $offset > 0 ) $block_args['post_args']['offset'] = absint($offset);
                                                $block_args['post_args']['posts_per_page'] = absint( $block_query[ 'count' ] );
                                                if( $customexclude_ids ) $block_args['post_args']['post__not_in'] = online_newspaper_get_post_id_for_args( $customexclude_ids );
                                                if( $postCategories ) $block_args['post_args']['cat'] = online_newspaper_get_categories_for_args($postCategories);
                                                if( $block_query[ 'dateFilter' ] != 'all' ) $block_args['post_args']['date_query'] = online_newspaper_get_date_format_array_args($block_query[ 'dateFilter' ]);
                                                if( $block_query[ 'posts' ] ) $block_args['post_args']['post__in'] = online_newspaper_get_post_id_for_args($block_query[ 'posts' ]);
                                                // get template file w.r.t par
                                                $block_args['uniqueID'] = wp_unique_id('online-newspaper-block--');
                                                $style_variables = [
                                                    'unique_id' =>  $block_args['uniqueID'],
                                                    'layout'    =>  $block_args['options'][ 'layout' ],
                                                    'image_ratio' => $block[ 'imageRatio' ]
                                                ];
                                                ( in_array( $block_args['options'][ 'type' ], [ 'news-grid', 'news-carousel', 'news-list' ] ) ) ? online_newspaper_get_style_tag( $style_variables ) : online_newspaper_get_style_tag_fb( $style_variables );
                                                get_template_part( 'template-parts/' .esc_html( $type ). '/template', esc_html( $layout ), $block_args );
                                    }
                                endif;
                            endforeach;
                        ?>
                    </div>
                </div>
            </section>
        <?php
     }
     add_action( 'online_newspaper_full_width_blocks_hook', 'online_newspaper_full_width_blocks_part' );
endif;

if( ! function_exists( 'online_newspaper_leftc_rights_blocks_part' ) ) :
    /**
     * Left Content Right Sidebar Blocks element
     * 
     * @since 1.0.0
     */
     function online_newspaper_leftc_rights_blocks_part() {
        $leftc_rights_blocks = ONP\online_newspaper_get_customizer_option( 'leftc_rights_blocks' );
        if( empty( $leftc_rights_blocks ) || is_paged() || online_newspaper_is_paged_filtered() ) return;
        if( ! in_array( true, array_column( $leftc_rights_blocks, 'option' ) ) ) {
            return;
        }
        $leftc_rights_blocks_width_layout = online_newspaper_get_section_width_layout_val('leftc_rights_blocks_width_layout');
        $leftc_rights_card_enable = ONP\online_newspaper_get_customizer_option( 'leftc_rights_card_enable' );
        $sectionClass[] = 'online-newspaper-section';
        $sectionClass[] = 'leftc-rights-section';
        $sectionClass[] = 'width-' . $leftc_rights_blocks_width_layout;
        $sectionClass[] = 'card--' . ( $leftc_rights_card_enable ? 'on': 'off' );
        ?>
            <section id="leftc-rights-section" class="<?php echo esc_attr( implode( ' ', $sectionClass ) ); ?>">
                <div class="online-newspaper-container">
                    <div class="row">
                        <div class="primary-content">
                            <?php
                                foreach( $leftc_rights_blocks as $block ) :
                                    if( $block[ 'option' ] ) :
                                        $type = $block[ 'type' ];
                                        switch($type) {
                                            case 'shortcode-block' : online_newspaper_shortcode_block_html( $block, true );
                                                        break;
                                            case 'ad-block' : online_newspaper_advertisement_block_html( $block, true );
                                                            break;
                                            default: $layout = $block[ 'layout' ];
                                                    $block_query = $block[ 'query' ];
                                                    $order = $block_query[ 'order' ];
                                                    $postCategories = $block_query[ 'categories' ];
                                                    $customexclude_ids = $block_query[ 'ids' ];
                                                    $orderArray = explode( '-', $order );
                                                    $block_args = array(
                                                        'post_args' => array(
                                                            'post_type' => 'post',
                                                            'order' => esc_html( $orderArray[1] ),
                                                            'orderby' => esc_html( $orderArray[0] ),
                                                            'ignore_sticky_posts'   => true,
                                                            'fields'    =>  'ids',
                                                            'no_found_rows' =>  true,
                                                            'update_post_meta_cache'    =>  false,
                                                            'update_post_term_cache'    =>  false,
                                                        ),
                                                        'options'    => $block
                                                    );
                                                    $offset = isset( $block_query[ 'offset' ] ) ? $block_query[ 'offset' ]: 0;
                                                    if( $offset > 0 ) $block_args['post_args']['offset'] = absint($offset);
                                                    $block_args['post_args']['posts_per_page'] = absint( $block_query[ 'count' ] );
                                                    if( $customexclude_ids ) $block_args['post_args']['post__not_in'] = online_newspaper_get_post_id_for_args( $customexclude_ids );
                                                    if( $postCategories ) $block_args['post_args']['cat'] = online_newspaper_get_categories_for_args($postCategories);
                                                    if( $block_query[ 'dateFilter' ] != 'all' ) $block_args['post_args']['date_query'] = online_newspaper_get_date_format_array_args($block_query[ 'dateFilter' ]);
                                                    if( $block_query[ 'posts' ] ) $block_args['post_args']['post__in'] = online_newspaper_get_post_id_for_args($block_query[ 'posts' ]);
                                                    // get template file w.r.t par
                                                    $block_args['uniqueID'] = wp_unique_id('online-newspaper-block--');
                                                    $style_variables = [
                                                        'unique_id' =>  $block_args['uniqueID'],
                                                        'layout'    =>  $block_args['options'][ 'layout' ],
                                                        'image_ratio' => $block[ 'imageRatio' ]
                                                    ];
                                                    ( in_array( $block_args['options'][ 'type' ], [ 'news-grid', 'news-carousel', 'news-list' ] ) ) ? online_newspaper_get_style_tag( $style_variables ) : online_newspaper_get_style_tag_fb( $style_variables );
                                                    get_template_part( 'template-parts/' .esc_html( $type ). '/template', esc_html( $layout ), $block_args );
                                        }
                                    endif;
                                endforeach;
                            ?>
                        </div>
                        <div class="secondary-sidebar">
                            <?php dynamic_sidebar( 'front-right-sidebar' ); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
     }
     add_action( 'online_newspaper_leftc_rights_blocks_hook', 'online_newspaper_leftc_rights_blocks_part', 10 );
endif;

if( ! function_exists( 'online_newspaper_lefts_rightc_blocks_part' ) ) :
    /**
     * Left Sidebar Right Content Blocks element
     * 
     * @since 1.0.0
     */
     function online_newspaper_lefts_rightc_blocks_part() {
        $lefts_rightc_blocks = ONP\online_newspaper_get_customizer_option( 'lefts_rightc_blocks' );
        if( empty( $lefts_rightc_blocks )|| is_paged() || online_newspaper_is_paged_filtered() ) return;
        if( ! in_array( true, array_column( $lefts_rightc_blocks, 'option' ) ) ) {
            return;
        }
        $lefts_rightc_blocks_width_layout = online_newspaper_get_section_width_layout_val('lefts_rightc_blocks_width_layout');
        $lefts_rightc_card_enable = ONP\online_newspaper_get_customizer_option( 'lefts_rightc_card_enable' );
        $sectionClass[] = 'online-newspaper-section';
        $sectionClass[] = 'lefts-rightc-section';
        $sectionClass[] = 'width-' . $lefts_rightc_blocks_width_layout;
        $sectionClass[] = 'card--' . ( $lefts_rightc_card_enable ? 'on': 'off' );
        ?>
            <section id="lefts-rightc-section" class="<?php echo esc_attr( implode( ' ', $sectionClass ) ); ?>">
                <div class="online-newspaper-container">
                    <div class="row">
                        <div class="secondary-sidebar">
                            <?php dynamic_sidebar( 'front-left-sidebar' ); ?>
                        </div>
                        <div class="primary-content">
                            <?php
                                foreach( $lefts_rightc_blocks as $block ) :
                                    if( $block[ 'option' ] ) :
                                        $type = $block[ 'type' ];
                                        switch($type) {
                                            case 'shortcode-block' : online_newspaper_shortcode_block_html( $block, true );
                                                        break;
                                            case 'ad-block' : online_newspaper_advertisement_block_html( $block, true );
                                                            break;
                                            default: $layout = $block[ 'layout' ];
                                                    $block_query = $block[ 'query' ];
                                                    $order = $block_query[ 'order' ];
                                                    $postCategories = $block_query[ 'categories' ];
                                                    $customexclude_ids = $block_query[ 'ids' ];
                                                    $orderArray = explode( '-', $order );
                                                    $block_args = array(
                                                        'post_args' => array(
                                                            'post_type' => 'post',
                                                            'order' => esc_html( $orderArray[1] ),
                                                            'orderby' => esc_html( $orderArray[0] ),
                                                            'ignore_sticky_posts'   => true,
                                                            'fields'    =>  'ids',
                                                            'no_found_rows' =>  true,
                                                            'update_post_meta_cache'    =>  false,
                                                            'update_post_term_cache'    =>  false,
                                                        ),
                                                        'options'    => $block
                                                    );
                                                    $offset = isset( $block_query[ 'offset' ] ) ? $block_query[ 'offset' ]: 0;
                                                    if( $offset > 0 ) $block_args['post_args']['offset'] = absint($offset);
                                                    $block_args['post_args']['posts_per_page'] = absint( $block_query[ 'count' ] );
                                                    if( $customexclude_ids ) $block_args['post_args']['post__not_in'] = online_newspaper_get_post_id_for_args( $customexclude_ids );
                                                    if( $postCategories ) $block_args['post_args']['cat'] = online_newspaper_get_categories_for_args($postCategories);
                                                    if( $block_query[ 'dateFilter' ] != 'all' ) $block_args['post_args']['date_query'] = online_newspaper_get_date_format_array_args($block_query[ 'dateFilter' ]);
                                                    if( $block_query[ 'posts' ] ) $block_args['post_args']['post__in'] = online_newspaper_get_post_id_for_args($block_query[ 'posts' ]);
                                                    // get template file w.r.t par
                                                    $block_args['uniqueID'] = wp_unique_id('online-newspaper-block--');
                                                    $style_variables = [
                                                        'unique_id' =>  $block_args['uniqueID'],
                                                        'layout'    =>  $block_args['options'][ 'layout' ],
                                                        'image_ratio' => $block[ 'imageRatio' ]
                                                    ];
                                                    ( in_array( $block_args['options'][ 'type' ], [ 'news-grid', 'news-carousel', 'news-list' ] ) ) ? online_newspaper_get_style_tag( $style_variables ) : online_newspaper_get_style_tag_fb( $style_variables );
                                                    get_template_part( 'template-parts/' .esc_html( $type ). '/template', esc_html( $layout ), $block_args );
                                        }
                                    endif;
                                endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
     }
     add_action( 'online_newspaper_lefts_rightc_blocks_hook', 'online_newspaper_lefts_rightc_blocks_part', 10 );
endif;

if( ! function_exists( 'online_newspaper_bottom_full_width_blocks_part' ) ) :
    /**
     * Bottom Full Width Blocks element
     * 
     * @since 1.0.0
     */
     function online_newspaper_bottom_full_width_blocks_part() {
        $bottom_full_width_blocks = ONP\online_newspaper_get_customizer_option( 'bottom_full_width_blocks' );
        if( empty( $bottom_full_width_blocks )|| is_paged() || online_newspaper_is_paged_filtered() ) return;
        if( ! in_array( true, array_column( $bottom_full_width_blocks, 'option' ) ) ) {
            return;
        }
        $bottom_full_width_blocks_width_layout = online_newspaper_get_section_width_layout_val('bottom_full_width_blocks_width_layout');
        $bottom_full_width_card_enable = ONP\online_newspaper_get_customizer_option( 'bottom_full_width_card_enable' );
        $sectionClass[] = 'online-newspaper-section';
        $sectionClass[] = 'bottom-full-width-section';
        $sectionClass[] = 'width-' . $bottom_full_width_blocks_width_layout;
        $sectionClass[] = 'card--' . ( $bottom_full_width_card_enable ? 'on': 'off' );
        ?>
            <section id="bottom-full-width-section" class="<?php echo esc_attr( implode( ' ', $sectionClass ) ); ?>">
                <div class="online-newspaper-container">
                    <div class="row">
                        <?php
                            foreach( $bottom_full_width_blocks as $block ) :
                                if( $block[ 'option' ] ) :
                                    $type = $block[ 'type' ];
                                    switch($type) {
                                        case 'shortcode-block' : online_newspaper_shortcode_block_html( $block, true );
                                                        break;
                                        case 'ad-block' : online_newspaper_advertisement_block_html( $block, true );
                                                        break;
                                        default: $layout = $block[ 'layout' ];
                                                $block_query = $block[ 'query' ];
                                                $order = $block_query[ 'order' ];
                                                $postCategories = $block_query[ 'categories' ];
                                                $customexclude_ids = $block_query[ 'ids' ];
                                                $orderArray = explode( '-', $order );
                                                $block_args = array(
                                                    'post_args' => array(
                                                        'post_type' => 'post',
                                                        'order' => esc_html( $orderArray[1] ),
                                                        'orderby' => esc_html( $orderArray[0] ),
                                                        'ignore_sticky_posts'   => true,
                                                        'fields'    =>  'ids',
                                                        'no_found_rows' =>  true,
                                                        'update_post_meta_cache'    =>  false,
                                                        'update_post_term_cache'    =>  false,
                                                    ),
                                                    'options'    => $block
                                                );
                                                $offset = isset( $block_query[ 'offset' ] ) ? $block_query[ 'offset' ]: 0;
                                                if( $offset > 0 ) $block_args['post_args']['offset'] = absint($offset);
                                                $block_args['post_args']['posts_per_page'] = absint( $block_query[ 'count' ] );
                                                if( $customexclude_ids ) $block_args['post_args']['post__not_in'] = online_newspaper_get_post_id_for_args( $customexclude_ids );
                                                if( $postCategories ) $block_args['post_args']['cat'] = online_newspaper_get_categories_for_args($postCategories);
                                                if( $block_query[ 'dateFilter' ] != 'all' ) $block_args['post_args']['date_query'] = online_newspaper_get_date_format_array_args($block_query[ 'dateFilter' ]);
                                                if( $block_query[ 'posts' ] ) $block_args['post_args']['post__in'] = online_newspaper_get_post_id_for_args($block_query[ 'posts' ]);
                                                // get template file w.r.t par
                                                $block_args['uniqueID'] = wp_unique_id('online-newspaper-block--');
                                                $style_variables = [
                                                    'unique_id' =>  $block_args['uniqueID'],
                                                    'layout'    =>  $block_args['options'][ 'layout' ],
                                                    'image_ratio' => $block[ 'imageRatio' ]
                                                ];
                                                ( in_array( $block_args['options'][ 'type' ], [ 'news-grid', 'news-carousel', 'news-list' ] ) ) ? online_newspaper_get_style_tag( $style_variables ) : online_newspaper_get_style_tag_fb( $style_variables );
                                                get_template_part( 'template-parts/' .esc_html( $type ). '/template', esc_html( $layout ), $block_args );
                                    }
                                endif;
                            endforeach;
                        ?>
                    </div>
                </div>
            </section>
        <?php
     }
     add_action( 'online_newspaper_bottom_full_width_blocks_hook', 'online_newspaper_bottom_full_width_blocks_part', 10 );
endif;

if( ! function_exists( 'online_newspaper_two_column_section_columns_part' ) ) :
    /**
     * Three Column Blocks element
     * 
     * @since 1.0.0
     */
     function online_newspaper_two_column_section_columns_part() {
        $two_column_first_column_blocks = ONP\online_newspaper_get_customizer_option( 'two_column_first_column_blocks' );
        $two_column_second_column_blocks = ONP\online_newspaper_get_customizer_option( 'two_column_second_column_blocks' );
        if( ( empty( $two_column_first_column_blocks ) && empty( $two_column_second_column_blocks ) ) || is_paged() || online_newspaper_is_paged_filtered() ) return;
        if( ! in_array( true, array_column( $two_column_first_column_blocks, 'option' ) ) && ! in_array( true, array_column( $two_column_second_column_blocks, 'option' ) ) ) {
            return;
        }
        $two_column_section_layout = online_newspaper_get_section_width_layout_val('two_column_section_layout');
        $two_column_card_enable = ONP\online_newspaper_get_customizer_option( 'two_column_card_enable' );
        $sectionClass[] = 'online-newspaper-section';
        $sectionClass[] = 'online-newspaper-multi-column-section';
        $sectionClass[] = 'two-column-section';
        $sectionClass[] = 'width-' . $two_column_section_layout;
        $sectionClass[] = 'card--' . ( $two_column_card_enable ? 'on': 'off' );
        ?>
            <section id="two-column-section" class="<?php echo esc_attr( implode( ' ', $sectionClass ) ); ?>">
                <div class="online-newspaper-container">
                    <div class="row">
                        <div class="section-column-wrap">
                            <?php
                                if( in_array( true, array_column( $two_column_first_column_blocks, 'option' ) ) ) :
                                    echo '<div class="section-column column-first">';
                                        foreach( $two_column_first_column_blocks as $block ) :
                                            if( $block[ 'option' ] ) :
                                                $type = $block[ 'type' ];
                                                switch($type) {
                                                    case 'shortcode-block' : online_newspaper_shortcode_block_html( $block, true );
                                                                    break;
                                                    case 'ad-block' : online_newspaper_advertisement_block_html( $block, true );
                                                                    break;
                                                    default: $layout = $block[ 'layout' ];
                                                            $block_query = $block[ 'query' ];
                                                            $block[ 'column' ] = 'one';
                                                            $order = $block_query[ 'order' ];
                                                            $postCategories = $block_query[ 'categories' ];
                                                            $customexclude_ids = $block_query[ 'ids' ];
                                                            $orderArray = explode( '-', $order );
                                                            $block_args = array(
                                                                'post_args' => array(
                                                                    'post_type' => 'post',
                                                                    'order' => esc_html( $orderArray[1] ),
                                                                    'orderby' => esc_html( $orderArray[0] ),
                                                                    'ignore_sticky_posts'   => true,
                                                                    'fields'    =>  'ids',
                                                                    'no_found_rows' =>  true,
                                                                    'update_post_meta_cache'    =>  false,
                                                                    'update_post_term_cache'    =>  false,
                                                                ),
                                                                'options'    => $block
                                                            );
                                                            $block_args['post_args']['posts_per_page'] = absint( $block_query[ 'count' ] );
                                                            $offset = isset( $block_query[ 'offset' ] ) ? $block_query[ 'offset' ]: 0;
                                                            if( $offset > 0 ) $block_args['post_args']['offset'] = absint($offset);
                                                            if( $customexclude_ids ) $block_args['post_args']['post__not_in'] = online_newspaper_get_post_id_for_args( $customexclude_ids );
                                                            if( $postCategories ) $block_args['post_args']['cat'] = online_newspaper_get_categories_for_args($postCategories);
                                                            if( $block_query[ 'dateFilter' ] != 'all' ) $block_args['post_args']['date_query'] = online_newspaper_get_date_format_array_args($block_query[ 'dateFilter' ]);
                                                            if( $block_query[ 'posts' ] ) $block_args['post_args']['post__in'] = online_newspaper_get_post_id_for_args($block_query[ 'posts' ]);
                                                            // get template file w.r.t par
                                                            $block_args['uniqueID'] = wp_unique_id('online-newspaper-block--');
                                                            $style_variables = [
                                                                'unique_id' =>  $block_args['uniqueID'],
                                                                'layout'    =>  $block_args['options'][ 'layout' ],
                                                                'image_ratio' => $block[ 'imageRatio' ]
                                                            ];
                                                            ( in_array( $block_args['options'][ 'type' ], [ 'news-grid', 'news-carousel', 'news-list' ] ) ) ? online_newspaper_get_style_tag( $style_variables ) : online_newspaper_get_style_tag_fb( $style_variables );
                                                            get_template_part( 'template-parts/' .esc_html( $type ). '/template', esc_html( $layout ), $block_args );
                                                }
                                            endif;
                                        endforeach;
                                    echo '</div><!-- .section-column.column-first -->';
                                endif;

                                if( in_array( true, array_column( $two_column_second_column_blocks, 'option' ) ) ) :
                                    echo '<div class="section-column column-second">';
                                        foreach( $two_column_second_column_blocks as $block ) :
                                            if( $block[ 'option' ] ) :
                                                $type = $block[ 'type' ];
                                                switch($type) {
                                                    case 'shortcode-block' : online_newspaper_shortcode_block_html( $block, true );
                                                                    break;
                                                    case 'ad-block' : online_newspaper_advertisement_block_html( $block, true );
                                                                    break;
                                                    default: $layout = $block[ 'layout' ];
                                                            $block_query = $block[ 'query' ];
                                                            $block[ 'column' ] = 'one';
                                                            $order = $block_query[ 'order' ];
                                                            $postCategories = $block_query[ 'categories' ];
                                                            $customexclude_ids = $block_query[ 'ids' ];
                                                            $orderArray = explode( '-', $order );
                                                            $block_args = array(
                                                                'post_args' => array(
                                                                    'post_type' => 'post',
                                                                    'order' => esc_html( $orderArray[1] ),
                                                                    'orderby' => esc_html( $orderArray[0] ),
                                                                    'ignore_sticky_posts'   => true,
                                                                    'fields'    =>  'ids',
                                                                    'no_found_rows' =>  true,
                                                                    'update_post_meta_cache'    =>  false,
                                                                    'update_post_term_cache'    =>  false,
                                                                ),
                                                                'options'    => $block
                                                            );
                                                            $offset = isset( $block_query[ 'offset' ] ) ? $block_query[ 'offset' ]: 0;
                                                            if( $offset > 0 ) $block_args['post_args']['offset'] = absint($offset);
                                                            $block_args['post_args']['posts_per_page'] = absint( $block_query[ 'count' ] );
                                                            if( $customexclude_ids ) $block_args['post_args']['post__not_in'] = online_newspaper_get_post_id_for_args( $customexclude_ids );
                                                            if( $postCategories ) $block_args['post_args']['cat'] = online_newspaper_get_categories_for_args($postCategories);
                                                            if( $block_query[ 'dateFilter' ] != 'all' ) $block_args['post_args']['date_query'] = online_newspaper_get_date_format_array_args($block_query[ 'dateFilter' ]);
                                                            if( $block_query[ 'posts' ] ) $block_args['post_args']['post__in'] = online_newspaper_get_post_id_for_args($block_query[ 'posts' ]);
                                                            // get template file w.r.t par
                                                            $block_args['uniqueID'] = wp_unique_id('online-newspaper-block--');
                                                            $style_variables = [
                                                                'unique_id' =>  $block_args['uniqueID'],
                                                                'layout'    =>  $block_args['options'][ 'layout' ],
                                                                'image_ratio' => $block[ 'imageRatio' ]
                                                            ];
                                                            ( in_array( $block_args['options'][ 'type' ], [ 'news-grid', 'news-carousel', 'news-list' ] ) ) ? online_newspaper_get_style_tag( $style_variables ) : online_newspaper_get_style_tag_fb( $style_variables );
                                                            get_template_part( 'template-parts/' .esc_html( $type ). '/template', esc_html( $layout ), $block_args );
                                                }
                                            endif;
                                        endforeach;
                                    echo '</div><!-- .section-column.column-second -->';
                                endif;
                            ?>
                        </div><!-- .section-column-wrap -->
                    </div>
                </div>
            </section>
        <?php
     }
     add_action( 'online_newspaper_two_column_section_hook', 'online_newspaper_two_column_section_columns_part', 10 );
endif;

if( ! function_exists( 'online_newspaper_web_stories_html' ) ) :
    /**
     * MARK: Web stories hook
     * 
     * @since 1.0.0
     * @package Online Newspaper
     */
    function online_newspaper_web_stories_html() {
        if( is_paged() ) :
            return;
        elseif( ! is_front_page() ) :
            return;
        endif;
        $categories_to_include = ONP\online_newspaper_get_customizer_option( 'web_stories_categories_to_include' );
        $orderby = ONP\online_newspaper_get_customizer_option( 'web_stories_orderby' );
        $exploded_orderby = explode( '-', $orderby );
        $no_of_cats_to_show = ONP\online_newspaper_get_customizer_option( 'web_stories_no_of_cats_to_show' );
        $max_no_of_inner_stories = ONP\online_newspaper_get_customizer_option( 'web_stories_max_no_of_inner_stories' );
        $image_size = ONP\online_newspaper_get_customizer_option( 'web_stories_image_sizes' );
        $image_hover = ONP\online_newspaper_get_customizer_option( 'site_image_hover_effects' );
        $web_stories_card_enable = ONP\online_newspaper_get_customizer_option( 'web_stories_card_enable' );
        $web_stories_full_width_blocks_width_layout = online_newspaper_get_section_width_layout_val( 'web_stories_full_width_blocks_width_layout' );
        $categories = get_categories([
            'number'    =>  absint( $no_of_cats_to_show ),
            'include'   =>  ( ! empty( $categories_to_include ) ) ? array_column( $categories_to_include, 'value' ) : [],
            'orderby'   =>  $exploded_orderby[1],
            'order' =>  $exploded_orderby[0]
        ]);
        $sectionClass[] = 'online-newspaper-web-stories';
        if( $no_of_cats_to_show ) $sectionClass[] = 'column--' . online_newspaper_convert_number_to_numeric_string( $no_of_cats_to_show );
        $sectionClass[] = 'hover--' . $image_hover;
        $sectionClass[] = 'width-' . $web_stories_full_width_blocks_width_layout;
        $sectionClass[] = 'card--' . ( $web_stories_card_enable ? 'on': 'off' );

        $page = get_pages([
            'meta_key'  =>  '_wp_page_template',
            'meta_value'    =>  'web-stories.php',
            'number'    =>  1
        ]);
        $archive_link = '#';
        if( ! empty( $page ) ) $archive_link = get_permalink( $page[ 0 ]->ID );
        ?>
            <section class="<?php echo esc_attr( implode( ' ', $sectionClass ) ); ?>" id="online-newspaper-web-stories">
                <div class="online-newspaper-container">
                    <div class="row">
                        <div class="section-head">
                            <h2 class="section-title"><span class="title"><?php esc_html_e( 'Top Stories', 'online-newspaper' ); ?></span></h2>
                            <a href="<?php echo esc_url( $archive_link ); ?>" class="web-stories-view-all">
                                <span class="label"><?php esc_html_e( 'View all', 'online-newspaper' ); ?></span>
                                <span class="icon"><i class="fa-solid fa-chevron-right"></i></span>
                            </a>
                        </div>
                        <div class="full-stories-wrapper">
                            <div class="stories-wrap">
                                <?php
                                    if( ! is_null( $categories ) && is_array( $categories ) ) :
                                        foreach( $categories as $cat_key => $cat_value ) :
                                            $category_query_args = [
                                                'category'   =>  absint( $cat_value->term_id ),
                                                'ignore_stick_posts'    =>  true,
                                                'fields'    =>  'ids',
                                                'no_found_rows' =>  true
                                            ];
                                            $category_query = get_posts( apply_filters( 'online_newspaper_query_args_filter', $category_query_args ) );
                                            $preview_title = '';
                                            if( $category_query ) :
                                                $first_post = $category_query[0];
                                                $thumbnail_id = ( $first_post != null ) ? $first_post : '';
                                                $preview_title = get_the_title( $first_post );
                                            else:
                                                $thumbnail_id = '';
                                            endif;
                                            $category_count = $cat_value->count;
    
                                            ?>
                                                <div class="story" data-id="<?php echo esc_attr( $cat_value->term_id ); ?>" data-count="<?php echo esc_attr( $category_count ); ?>">
                                                    <div class="preview">
                                                        <figure class="preview-thumb">
                                                            <?php if( $thumbnail_id ) echo wp_kses_post( get_the_post_thumbnail( $thumbnail_id, $image_size, [ 'loading'   => 'lazy' ] ) ); ?>
                                                        </figure>
                                                        <?php
                                                            $category_html = $title_html = '';
                                                            $category_html = '<a href="' . esc_url( get_category_link( $cat_value->term_id ) ) . '" class="story-count"><span class="label">' . esc_html( $category_count ) . '</span><span class="text">' . esc_html__( ' Stories', 'online-newspaper' ) . '</span></a>';

                                                            if( $preview_title ) :
                                                                $title_html = '<h2 class="story-title"><span class="title-text">' . esc_html( $preview_title ) . '</span></h2>';
                                                            endif;
                                                            printf( '<div class="story-title-wrap">%s%s</div>', wp_kses_post( $category_html ), wp_kses_post( $title_html ) );
                                                            
                                                            if( $category_count ) :
                                                                echo '<div class="indicators">';
                                                                    for( $i = 0; $i < $category_count; $i++ ) :
                                                                        echo '<span class="indicator"></span>';
                                                                    endfor;
                                                                echo '</div>';
                                                            endif;
                                                        ?>
                                                    </div>
                                                </div>
                                            <?php
                                        endforeach;
                                    endif;
                                ?>
                            </div>
                        </div>
                        <div class="inner-stories-wrap">
                            <div class="inner-stories"></div>
                            <div class="action-buttons">
                                <button class="action-btn close"><i class="fa-solid fa-xmark"></i></button>
                                <button class="action-btn pause"><i class="fa-solid fa-pause"></i></button>
                            </div>
                            <div class="story-arrows"></div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'online_newspaper_web_stories_hook', 'online_newspaper_web_stories_html' );
endif;

if( ! function_exists( 'online_newspaper_sticky_posts' ) ) :
    /**
     * MARK: Sticky Posts
     * 
     * @since 1.0.0
     * @package Online Newspaper
     */
    function online_newspaper_sticky_posts(){
        if( ! ONP\online_newspaper_get_customizer_option( 'sticky_posts_option' ) || is_paged() ) return;
        $sticky_posts_position = ONP\online_newspaper_get_customizer_option( 'sticky_posts_position' );
        $posts_to_append = ONP\online_newspaper_get_customizer_option( 'sticky_posts_posts_to_append' );
        $posts_to_show = ONP\online_newspaper_get_customizer_option( 'sticky_posts_to_show' );
        $sectionClass = 'online-newspaper-sticky-posts position-' . esc_html( $sticky_posts_position );
        $posts_args = online_newspaper_get_query_args( 'sticky' );
        $posts_args[ 'posts_per_page' ] = absint( $posts_to_append - $posts_to_show );
        ?>
            <div class="<?php echo esc_attr( $sectionClass ); ?>">
				<div class="label-wrapper"><h2 class="label"><?php esc_html_e( 'Popular Posts', 'online-newspaper' ); ?></h2><span class="icon"></span></div>
				<div class="post-list">
					<?php
						$query_instance = new \WP_Query( $posts_args );
						if( $query_instance->have_posts() ) :
							$count = 0;
							while( ( $query_instance->have_posts() ) ) : $query_instance->the_post();
                                $count++;
                                $args[ 'count' ] = $count;
								get_template_part( 'template-parts/content', 'sticky-posts', $args );
							endwhile;
                            wp_reset_postdata();
						endif;
					?>
					<div class="more-less-indicator">
                        <span class="indicator more active"></span>
                        <span class="indicator less"></span>
					</div>
				</div>
			</div><!-- .nekit-sticky-posts -->
        <?php
    }
    add_action( 'online_newspaper_sticky_posts_hook', 'online_newspaper_sticky_posts', 10 );
endif;