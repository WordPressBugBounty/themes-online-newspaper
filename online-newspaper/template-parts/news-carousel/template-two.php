<?php
/**
 * News Carousel template two
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
use OnlineNewspaper\CustomizerDefault as ONP;
extract( $args );
$block_id_attribute = ( $options[ 'blockId' ] ) ? ( ' ' . $options[ 'blockId' ] ) : '';
?>
<div id="<?php echo esc_attr( $uniqueID . $block_id_attribute ); ?>" class="news-carousel <?php echo esc_attr( 'layout--' . $options[ 'layout' ] ); ?>">
    <div class="section-head">
        <?php
            if( $options[ 'title' ] ) echo '<h2 class="online-newspaper-block-title"><span>', esc_html( $options[ 'title' ] ), '</span></h2>';
            
            do_action( 'online_newspaper_section_block_view_all_hook', array(
                'option'=> isset( $options[ 'viewallLabelOption' ] ) ? $options[ 'viewallLabelOption' ] : false,
                'classes' => 'view-all-button',
                'link'  => isset( $options[ 'viewallUrl' ] ) ? $options[ 'viewallUrl' ] : '',
                'text_option'  => isset( $options[ 'viewallLabelOption' ] ) ? $options[ 'viewallLabelOption' ] : false,
                'text'  => isset( $options[ 'viewallLabel' ] ) ? $options[ 'viewallLabel' ] : esc_html__( 'View all', 'online-newspaper' )
            ));

            $view_allclass = 'viewall_disabled';
            if( $options[ 'viewallLabelOption' ] ) $view_allclass = 'viewall_enabled';

        ?>
    </div>
    <div class="news-carousel-post-wrap <?php echo esc_attr($view_allclass); ?>" data-dots="<?php echo esc_attr( online_newspaper_bool_to_string( $options[ 'dots' ] ) ); ?>" data-loop="<?php echo esc_attr( online_newspaper_bool_to_string( $options[ 'loop' ] ) ); ?>" data-arrows="<?php echo esc_attr( online_newspaper_bool_to_string( $options[ 'arrows' ] ) ); ?>" data-auto="<?php echo esc_attr( online_newspaper_bool_to_string( $options[ 'auto' ] ) ); ?>" data-columns="<?php if( isset($options[ 'columns' ]) ) { echo absint( $options[ 'columns' ] ); } else { echo absint(1); }; ?>">
        <?php
            $post_query = new WP_Query( $post_args );
            if( $post_query -> have_posts() ) :
                while( $post_query -> have_posts() ) : $post_query -> the_post();
                ?>
                    <article class="carousel-item <?php if(!has_post_thumbnail()){ echo esc_attr('no-feat-img');} ?>">
                        <div class="blaze_box_wrap online-newspaper-card">
                            <figure class="post-thumb-wrap">
                                
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php
                                        if( has_post_thumbnail() ) : 
                                            the_post_thumbnail((array_key_exists( 'imageSize', $options ) ? $options[ 'imageSize' ] : 'online-newspaper-list'), array(
                                                'title' => the_title_attribute(array(
                                                    'echo'  => false
                                                )),
                                                'loading'   =>  'lazy'
                                            ));
                                        endif;
                                    ?>
                                    <div class="thumb-overlay"></div>
                                </a>
                                <div class="post-element">
                                    <?php if( $options[ 'categoryOption' ] ) online_newspaper_get_post_categories( get_the_ID(), 2 ); ?>
                                    <div class="post-element-inner">
                                        <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                                        <div class="post-meta">
                                            <?php if( $options[ 'authorOption' ] ) online_newspaper_posted_by(); ?>
                                            <?php if( $options[ 'dateOption' ] ) online_newspaper_posted_on(); ?>
                                            <?php if( $options[ 'commentOption' ] ) online_newspaper_comments_number(); ?>
                                        </div>
                                    </div>
                                </div>
                            </figure>
                        </div>
                    </article>
                <?php
                endwhile;
            endif;
        ?>
    </div>
</div>