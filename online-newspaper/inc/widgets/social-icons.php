<?php
 
/**
 * Adds Online_Newspaper_Social_Icons_Widget widget.
 * 
 * @package Online Newspaper
 * @since 1.0.0
 */
class Online_Newspaper_Social_Icons_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'online_newspaper_social_icons_widget',
            esc_html__( 'Online Newspaper : Social Icons', 'online-newspaper' ),
            array( 'description' => __( 'The list of social icons.', 'online-newspaper' ) )
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
        $columns = isset( $instance['columns'] ) ? $instance['columns'] : 2;
        $display_label = isset( $instance['display_label'] ) ? $instance['display_label'] : false;

        echo wp_kses_post($before_widget);
            if ($widget_title ): ?>
                <h2 class="widget-title online-newspaper-block-title">
                    <span><?php echo esc_html($widget_title); ?></span>
                </h2>
            <?php endif; ?>
            <div class="social-block-widget online-newspaper-card global-color-icon">
                <?php 
                    $widget_args = [
                        'columns' => $columns,
                        'display_count' => false,
                        'display_label' => $display_label,
                        'widget'    =>  true
                    ];
                    online_newspaper_customizer_social_icons( 'footer', 4, true, $widget_args ); 
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
        return [
            [
                'name'      => 'widget_title',
                'type'      => 'text',
                'title'     => esc_html__( 'Widget Title', 'online-newspaper' ),
                'description'=> esc_html__( 'Add the widget title here', 'online-newspaper' ),
                'default'   => esc_html__( 'Find Me On', 'online-newspaper' )
            ],
            [
                'name'      => 'columns',
                'type'      => 'number',
                'title'     => esc_html__( 'Columns', 'online-newspaper' ),
                'default'   => 2,
                'max'       => 3,
            ],
            [
                'name'      => 'display_label',
                'type'      => 'checkbox',
                'title'     => esc_html__( 'Display Label', 'online-newspaper' ),
                'default'   => false
            ]
        ];
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
    ?>
            <div class="refer-note">
                <p>
                    <?php esc_html_e( 'Manage social icons and other options from customizer ', 'online-newspaper' ); ?>
                    <a href="<?php echo esc_url(admin_url( 'customize.php?autofocus[control]=social_icons' )); ?>" target="_blank"><?php esc_html_e( 'go to manage social icons', 'online-newspaper' ); ?></a>
                </p>
            </div>
    <?php
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
} // class Online_Newspaper_Social_Icons_Widget