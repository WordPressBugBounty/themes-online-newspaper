<?php
/**
 * News List 2 template one
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
extract( $args );
?>
<div id="<?php echo esc_attr( $uniqueID ); ?>" class="news-list-2<?php if( isset($options[ 'thumbOption' ]) && ! $options[ 'thumbOption' ] ) echo ' section-no-thumbnail'; ?> <?php echo esc_attr( 'layout--' . $options[ 'layout' ] );?>">
    <?php
        do_action( 'online_newspaper_section_block_view_all_hook', array(
            'option'=> isset( $options[ 'viewallLabelOption' ] ) ? $options[ 'viewallLabelOption' ] : false,
            'classes' => 'view-all-button',
            'link'  => isset( $options[ 'viewallUrl' ] ) ? $options[ 'viewallUrl' ] : '',
            'text_option'  => isset( $options[ 'viewallLabelOption' ] ) ? $options[ 'viewallLabelOption' ] : false,
            'text'  => isset( $options[ 'viewallLabel' ] ) ? $options[ 'viewallLabel' ] : esc_html__( 'View all', 'online-newspaper' )
        ));
        
        if( $options[ 'title' ] ) :
            ?>
                <h2 class="online-newspaper-block-title">
                    <span><?php echo esc_html( $options[ 'title' ] ); ?></span>
                </h2>
            <?php
        endif;

        $elementClass = 'news-list-post-wrap';
        $elementClass .= isset( $options[ 'column' ] ) ? ( ' column--' . $options[ 'column' ] ) : ( ' column--one' );
        $elementClass .= ( $options[ 'viewallLabelOption' ] ) ? ' viewall_enabled' : ' viewall_disabled';
    ?>
    <div class="<?php echo esc_attr( $elementClass ); ?>">
        <?php
        $post_query = new WP_Query( $post_args );
        if( $post_query -> have_posts() ) :
            $delay = 0;
            while( $post_query -> have_posts() ) : $post_query -> the_post();
            ?>
                <article class="list-item online-newspaper-category-no-bk <?php if(!has_post_thumbnail()){ echo esc_attr('no-feat-img');} ?>">
                   <div class="blaze_box_wrap online-newspaper-card">
                        <figure class="post-thumb-wrap">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php
                                    if( has_post_thumbnail() ) : 
                                        the_post_thumbnail($options[ 'imageSize' ], array(
                                            'title' => the_title_attribute(array(
                                                'echo'  => false
                                            ))
                                        ));
                                    endif;
                                ?>
                            </a>
                        </figure>
                        <div class="post-element">
                            <?php if( $options[ 'categoryOption' ] ) online_newspaper_get_post_categories( get_the_ID(), 2 ); ?>
                            <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                        </div>
                    </div>
                </article>
            <?php
            $delay += 50;
            endwhile;
        endif;
        ?>
    </div>
</div>