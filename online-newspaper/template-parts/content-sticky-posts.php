<?php
    /**
     * Template part for displaying posts
     *
     * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
     *
     * @package Online Newspaper
     */
    use OnlineNewspaper\CustomizerDefault as ONP;
    $sticky_posts_show_author = $sticky_posts_show_date = true;
    $count = $args[ 'count' ];
    $articlePost[] = 'post';
    if( isset( $args[ 'classes' ] ) ) $articlePost[] = $args[ 'classes' ];
?>

<article class="<?php echo esc_attr( implode( ' ', $articlePost ) ); ?>">
    <?php
        /* Image */
        $has_post_thumb = has_post_thumbnail();
        $figureClass = 'post-thumb';
        if( ! $has_post_thumb ) $figureClass .= ' no-post-thumb';
        echo '<figure class="', esc_attr( $figureClass ), '">';
            if( $has_post_thumb ) the_post_thumbnail( 'large' );
            echo '<span class="post-number">', esc_html( $count ), '</span>';
        echo '</figure>';

        echo '<div class="post-content">';

            /* Title */
            the_title( '<h2 class="post-title"><a href="'. get_the_permalink() .'">', '</a></h2>' );

            echo '<div class="post-meta">';
                /* Author */
                if( $sticky_posts_show_author ) online_newspaper_posted_by();
                /* Date */
                if( $sticky_posts_show_date ) online_newspaper_posted_on();
            echo '</div>';
        echo '</div>';
    ?>
</article>