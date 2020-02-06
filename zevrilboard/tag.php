<?php get_header(); ?>

<h1><?php single_tag_title(); ?></h1>
<hr>
<p><?php echo tag_description(); ?></p>

<?php
$parent = get_queried_object();

$articles = get_posts( array( 
    'category'      =>      $parent->term_id,
    'orderby'       =>      'name',
    'order'         =>      'ASC',
    'numberposts'   =>      -1
) );

if ( !empty( $articles ) ) {
    
    $article_list = '<h2>Articles</h2><div class="category-list">';
    foreach ( $articles as $article ) {
        $article_list .= sprintf(
            '<p><a href="%1$s">%2$s</a></p>', 
            esc_url( get_permalink( $article->ID ) ),
            esc_html( $article->post_title )
        );
    }
    
    $article_list .= '</div>';
    echo $article_list;
    
}

get_footer();
?>