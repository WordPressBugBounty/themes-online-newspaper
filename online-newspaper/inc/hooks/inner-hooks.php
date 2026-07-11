<?php
/**
 * Inner sections hooks and functions
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
use OnlineNewspaper\CustomizerDefault as ONP;
if( ! function_exists( 'online_newspaper_single_related_posts' ) ) :
    /**
     * Single related posts
     * 
     * @package Online Newspaper
     */
    function online_newspaper_single_related_posts() {
        if( get_post_type() != 'post' ) return;
        $single_post_related_posts_option = ONP\online_newspaper_get_customizer_option( 'single_post_related_posts_option' );
        if( ! $single_post_related_posts_option ) return;
        $related_posts_title = ONP\online_newspaper_get_customizer_option( 'single_post_related_posts_title' );

        $related_posts_args = array(
            'posts_per_page'   => 4,
            'post__not_in'  => array( get_the_ID() ),
            'ignore_sticky_posts'    => true,
            'fields'    =>  'ids',
            'no_found_rows' =>  true,
            'update_post_meta_cache'    =>  false,
            'update_post_term_cache'    =>  false,
        );
        $current_post_categories = get_the_category(get_the_ID());
        if( $current_post_categories ) :
            foreach( $current_post_categories as $current_post_cat ) :
                $query_cats[] =  $current_post_cat->term_id;
            endforeach;
            $related_posts_args['category__in'] = $query_cats;
        endif;
        $related_posts = new WP_Query( $related_posts_args );
        if( ! $related_posts->have_posts() ) return;
            $relatedPostsClass = 'single-related-posts-section-wrap layout--list';
  ?>
            <div class="<?php echo esc_attr( $relatedPostsClass ); ?>">
                <div class="single-related-posts-section">
                    <button type="button" class="related_post_close" aria-label="<?php echo esc_attr__( 'Close related posts', 'online-newspaper' ); ?>">
                        <i class="fas fa-times-circle"></i>
                    </button>
                    <?php
                        if( $related_posts_title ) echo '<h2 class="online-newspaper-block-title"><span>' .esc_html( $related_posts_title ). '</span></h2>';
                        echo '<div class="single-related-posts-wrap">';
                            while( $related_posts->have_posts() ) : $related_posts->the_post();
                                ?>
                                    <article post-id="post-<?php the_ID(); ?>" <?php post_class('online-newspaper-card'); ?>>
                                        <?php if( has_post_thumbnail() ) : ?>
                                            <figure class="post-thumb-wrap <?php if(!has_post_thumbnail()){ echo esc_attr('no-feat-img');} ?>">
                                                <?php online_newspaper_post_thumbnail(); ?>
                                            </figure>
                                        <?php endif; ?>
                                        <div class="post-element">
                                            <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            <div class="post-meta">
                                                <?php
                                                    online_newspaper_posted_on();
                                                ?>
                                            </div>
                                        </div>
                                    </article>
                                <?php
                            endwhile;
                        echo '</div>';
                    ?>
                </div>
            </div>
    <?php
    }
endif;
add_action( 'online_newspaper_single_post_append_hook', 'online_newspaper_single_related_posts' );

if( ! function_exists( 'online_newspaper_before_content_advertisement_part' ) ) :
    /**
     * Online Newspaper before content advertisement part for single
     * 
     * @since 1.0.0
     */
    function online_newspaper_before_content_advertisement_part() {
        $advertisement_repeater = ONP\online_newspaper_get_customizer_option( 'advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $before_content_advertisement = array_values(array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_before_post_content' ) ) return ( $element->item_checkbox_before_post_content == true && $element->item_option == 'show' ) ? $element : ''; 
        }));
        if( empty( $before_content_advertisement ) ) return;
        $image_option = array_column( $before_content_advertisement, 'item_image_option' );
        $alignment = array_column( $before_content_advertisement, 'item_alignment' );
        $elementClass = 'alignment--' . $alignment[0];
        $elementClass .= ' image-option--' . ( ( $image_option[0] == 'full_width' ) ? 'full-width' : 'original' );
        ?>
            <section class="online-newspaper-advertisement-section-before-content online-newspaper-advertisement <?php echo esc_html( $elementClass ); ?>">
                <div class="online-newspaper-container">
                    <div class="row">
                        <div class="advertisement-wrap">
                            <?php
                                if( ! empty( $advertisement_repeater_decoded ) ) :
                                    foreach( $before_content_advertisement as $field ) :
                                        ?>
                                        <div class="advertisement">
                                            <a href="<?php echo esc_url( $field->item_url ); ?>" target="<?php echo esc_attr( $field->item_target ); ?>" rel="<?php echo esc_attr( $field->item_rel_attribute ); ?>" title="<?php echo esc_attr( get_the_title( $field->item_image ) ); ?>">
                                                <?php echo wp_kses_post( wp_get_attachment_image( $field->item_image, 'large', false, [ 'alt' => esc_attr( get_the_title( $field->item_image ) ), 'loading' => 'lazy' ] ) ); ?>
                                            </a>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'online_newspaper_before_single_content_hook', 'online_newspaper_before_content_advertisement_part' );
 endif;

 if( ! function_exists( 'online_newspaper_after_content_advertisement_part' ) ) :
    /**
     * Online Newspaper after content advertisement part for single
     * 
     * @since 1.0.0
     */
    function online_newspaper_after_content_advertisement_part() {
        $advertisement_repeater = ONP\online_newspaper_get_customizer_option( 'advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $after_content_advertisement = array_values(array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_after_post_content' ) ) return ( $element->item_checkbox_after_post_content == true && $element->item_option == 'show' ) ? $element : ''; 
        }));
        if( empty( $after_content_advertisement ) ) return;
        $image_option = array_column( $after_content_advertisement, 'item_image_option' );
        $alignment = array_column( $after_content_advertisement, 'item_alignment' );
        $elementClass = 'alignment--' . $alignment[0];
        $elementClass .= ' image-option--' . ( ( $image_option[0] == 'full_width' ) ? 'full-width' : 'original' );
        ?>
            <section class="online-newspaper-advertisement-section-after-content online-newspaper-advertisement <?php echo esc_html( $elementClass ); ?>">
                <div class="online-newspaper-container">
                    <div class="row">
                        <div class="advertisement-wrap">
                            <?php
                                if( ! empty( $advertisement_repeater_decoded ) ) :
                                    foreach( $after_content_advertisement as $field ) :
                                        ?>
                                        <div class="advertisement">
                                            <a href="<?php echo esc_url( $field->item_url ); ?>" target="<?php echo esc_attr( $field->item_target ); ?>" rel="<?php echo esc_attr( $field->item_rel_attribute ); ?>" title="<?php echo esc_attr( get_the_title( $field->item_image ) ); ?>">
                                                <?php echo wp_kses_post( wp_get_attachment_image( $field->item_image, 'large', false, [ 'alt' => esc_attr( get_the_title( $field->item_image ) ), 'loading' => 'lazy' ] ) ); ?>
                                            </a>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'online_newspaper_after_single_content_hook', 'online_newspaper_after_content_advertisement_part' );
 endif;