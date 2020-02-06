<?php get_header(); ?>

<h1><?php single_cat_title(); ?></h1>
<hr>
<p><?php echo category_description(); ?></p>

<?php
$parent = get_queried_object();

$articles = array();
$suparticles = get_posts( array( 
    'category'      =>      $parent->term_id,
    'orderby'       =>      'name',
    'order'         =>      'ASC',
    'numberposts'   =>      -1
) );

foreach ( $suparticles as $suparticle ) {
    $article_categories = get_the_category( $suparticle->ID );
    if ( in_array( $parent, $article_categories ) ) {
        array_push( $articles, $suparticle );
    }
}

$subcategories = array();
$allcategories = get_categories( array( 'orderby' => 'name' ) );

foreach ( $allcategories as $category ) {
    if ( $category->parent == $parent->term_id ) {
        array_push( $subcategories, $category );
    }
}

if ( !empty( $subcategories ) ) {
    
    $subcategory_list = '<h2>Subcategories</h2><div class="category-list">';
    foreach ( $subcategories as $subcategory ) {
        $subcategory_list .= sprintf(
            '<p><a href="%1$s">%2$s</a> (%3$s)</p>', 
            esc_url( get_category_link( $subcategory->term_id ) ),
            esc_html( $subcategory->name ),
            esc_html( $subcategory->count )
        );
    }
    
    $subcategory_list .= '</div>';
    echo $subcategory_list;
    
}

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