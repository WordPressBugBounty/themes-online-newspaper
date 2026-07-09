<?php
/**
 * Ticker news template two
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
use OnlineNewspaper\CustomizerDefault as ONP;
$ticker_query = new WP_Query( $args );
if( $ticker_query->have_posts() ) :
    $ticker_news_thumbnail_option = ONP\online_newspaper_get_customizer_option( 'ticker_news_thumbnail_option' );
    while( $ticker_query->have_posts() ) : $ticker_query->the_post();
    ?>
        <div class="ticker-item online-newspaper-card">
            <figure class="feature_image">
                <?php if( has_post_thumbnail() && $ticker_news_thumbnail_option ) : ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php
                            the_post_thumbnail('online-newspaper-thumb', array(
                                'title' => the_title_attribute(array(
                                    'echo'  => false
                                ))
                            ));
                        ?>
                    </a>
                <?php endif; ?>
            </figure>
            <div class="title-wrap">
                <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <?php online_newspaper_posted_on(); ?>
            </div>
        </div>
    <?php
    endwhile;
    wp_reset_postdata();
endif;