N<?php
    /**
     * Template Name: Web Stories
     */
    use OnlineNewspaper\CustomizerDefault as ONP;
    get_header();

        $image_hover = ONP\online_newspaper_get_customizer_option( 'site_image_hover_effects' );
        $image_size = ONP\online_newspaper_get_customizer_option( 'web_stories_image_sizes' );

        $sectionClass[] = 'online-newspaper-web-stories';
        $sectionClass[] = 'hover--' . $image_hover;
        $categories = get_categories([
            'hide_empty'    =>  true
        ]);

        ?>
            <section class="<?php echo esc_attr( implode( ' ', $sectionClass ) ); ?>">
                <div class="online-newspaper-container">
                    <div class="row">
                        <h2 class="section-title"><span class="title"><?php esc_html_e( 'Top Stories', 'online-newspaper' ); ?></span></h2>
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
                                                    <?php
                                                        echo '<figure class="preview-thumb">';
                                                            if( $thumbnail_id ) echo wp_kses_post( get_the_post_thumbnail( $thumbnail_id, $image_size, [ 'loading'   => 'lazy' ] ) );
                                                        echo '</figure>';

                                                        echo '<a href="', esc_url( get_category_link( $cat_value->term_id ) ) ,'" class="item"><span class="label">', esc_html( $cat_value->name ), '</span></a>';

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

    get_footer();