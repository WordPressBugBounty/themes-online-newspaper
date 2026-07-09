<?php
/**
 * News Filter template four
 * 
 * @package Online Newspaper Pro
 * @since 1.0.0
 */
extract( $args );
$filter_query = $options[ 'query' ];
$postCategories = ( isset( $filter_query[ 'categories' ] ) && ! empty( $filter_query[ 'categories' ] ) ) ? online_newspaper_get_categories_for_args( $filter_query[ 'categories' ] ) : '';
$postCategories = explode( ",", $postCategories );
array_unshift( $postCategories, 'All' );

$view_allclass = 'viewall_disabled';
if( $options[ 'viewallLabelOption' ] ){
    $view_allclass = 'viewall_enabled';
}
$block_id_attribute = ( $options[ 'blockId' ] ) ? ( ' ' . $options[ 'blockId' ] ) : '';
?>
<div id="<?php echo esc_attr( $uniqueID . $block_id_attribute ); ?>" class="news-alter online-newspaper-block <?php echo esc_attr( 'layout--' . $options[ 'layout' ] );?>" data-args="<?php echo esc_attr( json_encode( $options ) ); ?>">
    <div class="news-alter-post-wrap <?php echo esc_attr($view_allclass); ?>">
        <div class="section-head">
            <?php 
                if( $options[ 'title' ] ) echo '<h2 class="online-newspaper-block-title"><span>', esc_html( $options[ 'title' ] ), '</span></h2>';

                do_action( 'online_newspaper_section_block_view_all_hook', array(
                    'option'=> isset( $options[ 'viewallLabelOption' ] ) ? ( $options[ 'viewallLabelOption' ] ) : false,
                    'classes' => 'view-all-button',
                    'link'  => isset( $options[ 'viewallUrl' ] ) ? $options[ 'viewallUrl' ] : '',
                    'text_option'  => isset( $options[ 'viewallLabelOption' ] ) ? $options[ 'viewallLabelOption' ] : false,
                    'text'  => isset( $options[ 'viewallLabel' ] ) ? $options[ 'viewallLabel' ] : esc_html__( 'View all', 'online-newspaper' )
                ));
            ?>
        </div>
        <?php if( $postCategories ) : ?>
            <div class="news-alter-content-wrapper">
                <div class="row-wrap">
                    <?php
                        if( array_key_exists( 'category_name', $post_args ) ) $post_args['cat'] = $post_args['category_name'];
                        unset( $post_args['category_name'] );
                        $post_query = new WP_Query( $post_args );
                        $total_posts = $post_query->post_count;
                        if( $post_query->have_posts() ) :
                            $delay =0;
                            while( $post_query->have_posts() ) : $post_query->the_post();
                            $current_post = $post_query->current_post;
                                $options[ 'featuredPosts' ] = false;
                                if( $current_post === 0 || $current_post === 1 ) $options[ 'featuredPosts' ] = true;
                                    if( $current_post === 0 ) echo '<div class="featured-post">';
                                        if( $current_post === 2 ) {
                                            ?>
                                            <div class="trailing-post">
                                            <?php
                                        }
                                            $options[ 'delay' ] = $delay;
                                            // get template file w.r.t par
                                            get_template_part( 'template-parts/news-alter/content', 'one', $options );
                                        if( $current_post != 1 && $total_posts === $current_post + 1 ) echo '</div><!-- .trailing-post/total-posts-wrap/featured-post -->';
                                    if( $current_post === 1 ) echo '</div><!-- .featured-post-->';
                                $delay += 50;
                            endwhile;
                        endif;
                    ?>
                </div><!-- .row-wrap -->
            </div>
            <?php
        endif;
        ?>
    </div>
</div>