<?php
/**
 * Main Banner template five
 * 
 * @package Online Newspaper Pro
 * @since 1.0.0
 */
use OnlineNewspaper\CustomizerDefault as ONP;
$banner_section_three_column_order = json_decode( ONP\online_newspaper_get_customizer_option( 'banner_section_three_column_order' ), true );
extract( $banner_section_three_column_order );
if( $list_posts ) :
    ?>
    <div class="main-banner-list-posts">
        <h2 class="section-title"><?php echo esc_html( ONP\online_newspaper_get_customizer_option( 'main_banner_list_posts_title' ) ); ?></h2>
        <div class="list-posts-wrap">
            <?php
                $main_banner_list_posts_categories = ONP\online_newspaper_get_customizer_option( 'main_banner_list_posts_categories' );
                $list_posts_args = array(
                    'numberposts' => 4,
                    'cat' => online_newspaper_get_categories_for_args($main_banner_list_posts_categories)
                );
                $list_posts = get_posts( $list_posts_args );
                if( $list_posts ) :
                    $main_banner_list_posts_categories_option = ONP\online_newspaper_get_customizer_option( 'main_banner_list_posts_categories_option' );
                    $main_banner_list_posts_author_option = ONP\online_newspaper_get_customizer_option( 'main_banner_list_posts_author_option' );
                    $main_banner_list_posts_date_option = ONP\online_newspaper_get_customizer_option( 'main_banner_list_posts_date_option' );
                    $total_posts = sizeof($list_posts);
                    foreach( $list_posts as $list_post_key => $list_post ) :
                        $list_post_id  = $list_post->ID;
                        $title = get_the_title( $list_post_id );
                    ?>
                            <article class="post-item online-newspaper-card <?php if(!has_post_thumbnail($list_post_id)){ echo esc_attr(' no-feat-img');} ?>">
                                <figure class="post-thumb">
                                    <?php if( has_post_thumbnail($list_post_id) ): ?> 
                                        <a href="<?php echo esc_url(get_the_permalink($list_post_id)); ?>" title="<?php echo esc_attr( $title ); ?>">
                                            <?php 
                                                echo get_the_post_thumbnail( $list_post_id, 'online-newspaper-list', [ 'alt' => esc_attr( $title ) ] );
                                            ?>
                                        </a>
                                    <?php endif; ?>
                                </figure>
                                <div class="post-element">
                                    <?php if( $main_banner_list_posts_categories_option ) online_newspaper_get_post_categories( $list_post_id, 2 ); ?>
                                    <h2 class="post-title"><a href="<?php the_permalink($list_post_id); ?>"><?php echo wp_kses_post( get_the_title($list_post_id) ); ?></a></h2>
                                    <div class="post-meta">
                                        <?php if( $main_banner_list_posts_author_option ) online_newspaper_posted_by( $list_post_id ); ?>
                                        <?php if( $main_banner_list_posts_date_option ) online_newspaper_posted_on( $list_post_id ); ?>
                                    </div>
                                </div>
                            </article>
                    <?php
                    endforeach;
                endif;
                wp_reset_postdata();
            ?>
        </div>
    </div>
    <?php
endif;

if( $banner_slider ) :
    $slider_args = $args['slider_args'];
    ?>
    <div class="main-banner-wrap">
        <div class="main-banner-slider online-newspaper-card">
            <?php
                $slider_query = new WP_Query( $slider_args );
                if( $slider_query -> have_posts() ) :
                    $main_banner_slider_categories_option = ONP\online_newspaper_get_customizer_option( 'main_banner_slider_categories_option' );
                    $main_banner_slider_date_option = ONP\online_newspaper_get_customizer_option( 'main_banner_slider_date_option' );
                    while( $slider_query -> have_posts() ) : $slider_query -> the_post();
                    ?>
                        <article class="slide-item<?php if(!has_post_thumbnail()){ echo esc_attr(' no-feat-img');} ?>">
                            <figure class="post-thumb">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php 
                                        if( has_post_thumbnail()) { 
                                            the_post_thumbnail('online-newspaper-featured', array(
                                                'title' => the_title_attribute(array(
                                                    'echo'  => false
                                                ))
                                            ));
                                        }
                                    ?>
                                </a>
                            </figure>
                            <div class="post-element">
                                <div class="post-meta">
                                    <?php
                                        if( $main_banner_slider_categories_option ) online_newspaper_get_post_categories( get_the_ID(), 2 );
                                        if( $main_banner_slider_date_option ) online_newspaper_posted_on();    
                                    ?>
                                </div>
                                <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                                <?php
                                    /**
                                     * hook - online_newspaper_main_banner_post_append_hook
                                     * 
                                     */
                                    do_action('online_newspaper_main_banner_post_append_hook', get_the_ID());
                                ?>
                            </div>
                        </article>
                    <?php
                    endwhile;
                endif;
            ?>
        </div>
    </div>
    <?php
endif;

if( $grid_slider ) :
    // Slider direction
    $main_banner_grid_posts_order_by = ONP\online_newspaper_get_customizer_option( 'main_banner_grid_posts_order_by' );
    $main_banner_grid_posts_categories = ONP\online_newspaper_get_customizer_option( 'main_banner_grid_posts_categories' );
    $online_newspaper_slider = 'online_newspaper_vertical_slider';
    ?>
        <div class="main-banner-grid-posts <?php echo esc_attr($online_newspaper_slider); ?>">
            <h2 class="section-title"><?php echo esc_html( ONP\online_newspaper_get_customizer_option( 'main_banner_grid_posts_title' ) ); ?></h2>
            <div class="grid-posts-wrap">
                <?php
                    $gridPostsOrderArray = explode( '-', $main_banner_grid_posts_order_by );
                    $grid_posts_args = [
                        'post_status'   =>  'publish',
                        'orderby'   =>  esc_html( $gridPostsOrderArray[0] ),
                        'order' =>  esc_html( $gridPostsOrderArray[1] ),
                        'cat'   =>  online_newspaper_get_categories_for_args( $main_banner_grid_posts_categories ),
                        'numberposts'   =>  8
                    ];
                    $grid_posts = get_posts( $grid_posts_args );
                    if( $grid_posts ) :
                        $total_posts = sizeof($grid_posts);
                        foreach( $grid_posts as $grid_post_key => $grid_post ) :
                            $grid_post_id  = $grid_post->ID;
                        ?>
                            <article class="post-item online-newspaper-card online-newspaper-category-no-bk <?php if(!has_post_thumbnail($grid_post_id)){ echo esc_attr(' no-feat-img');} ?>">
                                <figure class="post-thumb">
                                    <?php if( has_post_thumbnail($grid_post_id) ): ?> 
                                        <a href="<?php echo esc_url(get_the_permalink($grid_post_id)); ?>" title="<?php the_title_attribute(['post' => $grid_post_id]); ?>">
                                            <img src="<?php echo esc_url( get_the_post_thumbnail_url($grid_post_id, 'online-newspaper-list') ); ?>" alt="<?php echo esc_attr( get_post_meta( get_post_thumbnail_id($grid_post_id), '_wp_attachment_image_alt', true ) ); ?>"/>
                                        </a>
                                    <?php endif; ?>
                                </figure>
                                <div class="post-element">
                                    <h2 class="post-title"><a href="<?php the_permalink($grid_post_id); ?>"><?php echo wp_kses_post( get_the_title($grid_post_id) ); ?></a></h2>
                                </div>
                            </article>
                        <?php
                        endforeach;
                    endif;
                ?>
            </div>
        </div>
    <?php
endif;