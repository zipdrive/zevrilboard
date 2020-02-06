<?php
get_header();

$keywords = '';
if ( isset( $_GET['s'] ) && !empty( $_GET['s'] ) ) {
    $keywords = $_GET['s'];
}

echo '<h1>Search results for: "' . $keywords . '"</h1><hr>';

if ( have_posts() ) {
    
    while ( have_posts() ) {
        
        the_post();
        
        echo '<br /><div class="search-result">';
        echo '<a href="' . get_permalink() . '"><h2>';
        the_title();
        echo '</h2></a>';
        the_excerpt();
        echo '</div>';
        
    }
    
} else {
    
    echo "<p>No results found.</p>";
    
}

get_footer(); 
?>