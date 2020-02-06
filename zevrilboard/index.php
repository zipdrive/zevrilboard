<?php get_header(); ?>


<?php
if ( have_posts() ) {
    
    while ( have_posts() ) {
        
        the_post();
        
        echo "<h1>";
        the_title();
        echo "</h1><hr>";
        the_content();
        
        if ( !empty( get_the_category() ) ) {
            echo "<div class='category-box'><p>Categories: ";
            the_category( ' | ' );
            echo "</p></div>";
        }
        
    }
    
}
?>
    

<?php get_footer(); ?>