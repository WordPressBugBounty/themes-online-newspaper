<?php
/**
 * Adds Online_Newspaper_Carousel_Widget widget.
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
class Online_Newspaper_Carousel_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'online_newspaper_carousel_widget',
            esc_html__( 'Online Newspaper : Carousel Posts', 'online-newspaper' ),
            array( 'description' => __( 'A collection of posts from specific category for carousel slide.', 'online-newspaper' ) )
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
        $slide_direction = isset( $instance['slide_direction'] ) ? $instance['slide_direction'] : 'vertical';
        $widget_layout = isset( $instance['widget_layout'] ) ? $instance['widget_layout'] : 'one';
        
        echo wp_kses_post($before_widget);
            // Slider direction
            $online_newspaper_widget_attr = '';
            if( $slide_direction == 'horizontal' ) {
                $online_newspaper_widget_attr .= ' online_newspaper_horizontal_slider';
            } else {
                $online_newspaper_widget_attr .= ' online_newspaper_vertical_slider';
            }
            if( empty( $widget_title ) ) $online_newspaper_widget_attr .= ' no_heading_widget';
            $online_newspaper_widget_attr .= ' layout--'. $widget_layout;
            ?>
            <div class="online-newspaper-widget-carousel-posts<?php echo esc_attr($online_newspaper_widget_attr); ?>">
                <?php if ($widget_title ): ?>
                    <h2 class="widget-title">
                        <span><?php echo esc_html($widget_title); ?></span>
                    </h2>
                <?php endif; ?>
                <div class="carousel-posts-wrap online-newspaper-card" data-vertical="<?php echo esc_attr( $slide_direction ); ?>">
                    <?php
                        $carousel_posts_args = array( 
                                    'numberposts' => -1,
                                    'cat' => absint( $posts_category )
                                );
                        if( empty( $posts_category ) ) $carousel_posts_args['numberposts'] = 4;
                        $carousel_posts = get_posts( $carousel_posts_args );
                        if( $carousel_posts ) :
                            $total_posts = sizeof($carousel_posts);
                            foreach( $carousel_posts as $carousel_post_key => $carousel_post ) :
                                $carousel_post_id  = $carousel_post->ID;
                            ?>
                                    <article class="post-item <?php if(!has_post_thumbnail($carousel_post_id)){ echo esc_attr('no-feat-img');} ?>">
                                        <figure class="post-thumb-wrap">
                                            <?php if( has_post_thumbnail($carousel_post_id) ): ?> 
                                                <a href="<?php echo esc_url(get_the_permalink($carousel_post_id)); ?>">
                                                    <?php echo wp_kses_post( get_the_post_thumbnail( $carousel_post_id, 'online-newspaper-list', [ 'loading' => 'lazy', 'alt' => esc_attr( get_the_title( $carousel_post_id ) ) ] ) ); ?>
                                                    <div class="thumb-overlay"></div>
                                                </a>
                                            <?php endif; ?>
                                            <?php online_newspaper_get_post_categories($carousel_post_id,2); ?>
                                        </figure>
                                        <div class="post-element">
                                            <?php online_newspaper_get_post_categories($carousel_post_id,2); ?>
                                            <h2 class="post-title"><a href="<?php the_permalink($carousel_post_id); ?>"><?php echo wp_kses_post( get_the_title($carousel_post_id) ); ?></a></h2>
                                            <div class="post-meta">
                                                <?php online_newspaper_posted_on(); ?>
                                            </div>
                                        </div>
                                    </article>
                            <?php
                            endforeach;
                        endif;
                    ?>
                </div>
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
                    'default'   => esc_html__( 'Highlights', 'online-newspaper' )
                ),
                array(
                    'name'      => 'posts_category',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Categories', 'online-newspaper' ),
                    'description'=> esc_html__( 'Choose the category to display for carousel posts', 'online-newspaper' ),
                    'options'   => $categories_options
                ),
                array(
                    'name'      => 'slide_direction',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Slide Direction', 'online-newspaper' ),
                    'options'   => array(
                        'vertical'    => esc_html__( 'Vertical', 'online-newspaper' ),
                        'horizontal'    => esc_html__( 'Horizontal', 'online-newspaper' )
                    )
                    ),
                array(
                    'name'      => 'widget_layout',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Carousel Layout', 'online-newspaper' ),
                    'description'=> esc_html__( 'Change the layout of the widget.', 'online-newspaper' ),
                    'options'   => array(
                        'one'  => esc_html__( 'Layout One', 'online-newspaper' ),
                        'two'=> esc_html__( 'Layout Two', 'online-newspaper' )
                    )
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
 
} // class Online_Newspaper_Carousel_Widget