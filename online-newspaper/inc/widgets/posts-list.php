<?php
/**
 * Adds Online_Newspaper_Posts_List_Widget widget.
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
class Online_Newspaper_Posts_List_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'online_newspaper_posts_list_widget',
            esc_html__( 'Online Newspaper : Posts List', 'online-newspaper' ),
            array( 'description' => __( 'A collection of posts from specific category displayed in list layout.', 'online-newspaper' ) )
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        $args[ 'before_widget' ] = str_replace(
            'class="',
            'class="online-newspaper-widget ',
            $args[ 'before_widget' ]
        );
        extract( $args );
        $widget_title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';
        $posts_category = isset( $instance['posts_category'] ) ? $instance['posts_category'] : '';
        $widget_layout = isset( $instance['widget_layout'] ) ? $instance['widget_layout'] : 'layout-one';
        echo wp_kses_post($before_widget);
            if ( ! empty( $widget_title ) ) {
                echo $before_title . $widget_title . $after_title;
            }
    ?>
            <div class="posts-wrap posts-list-wrap feature-post-block <?php echo esc_attr( $widget_layout ); ?>">
                <?php
                    $post = new WP_Query( 
                        array( 
                            'cat'    => absint( $posts_category ),
                            'posts_per_page' => 3,
                            'ignore_sticky_posts'    => true,
                            'fields'    =>  'ids',
                            'no_found_rows' =>  true,
                            'update_post_meta_cache'    =>  false,
                            'update_post_term_cache'    =>  false,
                        )
                    );
                    if( $post->have_posts() ) :
                        $delay = 0;
                        if( $widget_layout == 'layout-three' ) $numbering = 1;
                        while( $post->have_posts() ) : $post->the_post();
                            $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'online-newspaper-list' );
                            $categories = get_the_category();
                    ?>
                            <div class="post-item format-standard online-newspaper-category-no-bk online-newspaper-card">
                                <div class="post_thumb_image post-thumb <?php if( !$thumbnail_url ) echo esc_attr('no-feat-img'); ?>">
                                    <?php if( $widget_layout != 'layout-three' ) { ?>
                                        <figure class="post-thumb">
                                            <?php if( $thumbnail_url ) : ?>
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                    <?php
                                                        the_post_thumbnail(
                                                            'online-newspaper-list',
                                                            array(
                                                                'alt' => the_title_attribute(
                                                                    array(
                                                                        'echo' => false
                                                                    )
                                                                ),
                                                                'loading'   =>  'lazy'
                                                            )
                                                        );
                                                    ?>
                                                </a>
                                            <?php endif; ?>
                                        </figure>
                                    <?php
                                    } else {
                                        if( isset( $numbering ) && $numbering == 1 ) {
                                            ?>
                                                <figure class="post-thumb">
                                                    <?php if( $thumbnail_url ) : ?>
                                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                            <?php
                                                                the_post_thumbnail(
                                                                    'online-newspaper-list',
                                                                    array(
                                                                        'alt' => the_title_attribute(
                                                                            array(
                                                                                'echo' => false
                                                                            )
                                                                        ),
                                                                        'loading'   =>  'lazy'
                                                                    )
                                                                );
                                                            ?>
                                                        </a>
                                                    <?php endif; ?>
                                                </figure>
                                            <?php
                                        }
                                    }
                                        if( $widget_layout == 'layout-three' && $numbering > 1 ) echo '<span class="post-numbering">' . online_newspaper_numbering_with_pad_format($numbering). '</span>';
                                    ?>
                                </div>
                                <div class="post-content-wrap card__content">
                                        <div class="online-newspaper-post-title card__content-title post-title">
                                            <div class="permalink-wrapper"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                            <?php if( $widget_layout == 'layout-three' && $numbering == 1 ) echo '<span class="post-numbering">' . online_newspaper_numbering_with_pad_format($numbering). '</span>'; ?>
                                        </div>
                                    <?php
                                        echo '<div class="bmm-post-cats-wrap bmm-post-meta-item post-categories">';
                                            $count = 0;
                                            foreach( $categories as $cat ) {
                                                echo '<h3 class="card__content-category cat-item cat-' .esc_attr( $cat->cat_ID ). '"><a href="' .esc_url(get_term_link( $cat->cat_ID )). '">' .esc_html( $cat->name ). '</a></h3>';
                                                if( $count > 0 ) break;
                                                $count++;
                                            }
                                        echo '</div>';
                                    ?>
                                </div>
                            </div>
                    <?php
                        $delay += 100;
                        if( $widget_layout == 'layout-three' ) $numbering++;
                        endwhile;
                        wp_reset_postdata();
                    endif;
                ?>
            </div>
        <?php
        echo wp_kses_post($after_widget);
    }

    /**
     * Widgets fields
     * 
     */
    function widget_fields() {
        $categories = get_categories();
        $categories_options[''] = esc_html__( 'Select category', 'online-newspaper' );
        foreach( $categories as $category ) :
            $categories_options[$category->term_id] = $category->name. ' (' .$category->count. ') ';
        endforeach;
        return array(
                array(
                    'name'      => 'widget_title',
                    'type'      => 'text',
                    'title'     => esc_html__( 'Widget Title', 'online-newspaper' ),
                    'description'=> esc_html__( 'Add the widget title here', 'online-newspaper' ),
                    'default'   => esc_html__( 'Trending News', 'online-newspaper' )
                ),
                array(
                    'name'      => 'posts_category',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Categories', 'online-newspaper' ),
                    'description'=> esc_html__( 'Choose the category to display list of posts', 'online-newspaper' ),
                    'options'   => $categories_options
                ),
                array(
                    'name'      => 'widget_layout',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Layouts', 'online-newspaper' ),
                    'options'   => array(
                        'layout-one'    => esc_html__( 'Layout One', 'online-newspaper' ),
                        'layout-two'    => esc_html__( 'Layout Two', 'online-newspaper' ),
                        'layout-three'  => esc_html__( 'Layout Three', 'online-newspaper' )
                    ),
                    'default'   =>  'layout-three'
                )
            );
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();
        foreach( $widget_fields as $widget_field ) :
            if ( isset( $instance[ $widget_field['name'] ] ) ) {
                $field_value = $instance[ $widget_field['name'] ];
            } else if( isset( $widget_field['default'] ) ) {
                $field_value = $widget_field['default'];
            } else {
                $field_value = '';
            }
            online_newspaper_widget_fields( $this, $widget_field, $field_value );
        endforeach;
    }
 
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $widget_fields = $this->widget_fields();
        if( ! is_array( $widget_fields ) ) {
            return $instance;
        }
        foreach( $widget_fields as $widget_field ) :
            $instance[$widget_field['name']] = online_newspaper_sanitize_widget_fields( $widget_field, $new_instance );
        endforeach;

        return $instance;
    }
 
} // class Online_Newspaper_Posts_List_Widget