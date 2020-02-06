</div>

<?php

$locations = get_nav_menu_locations();
$footer_menu = null;
if ( $locations && isset( $locations[ 'footer' ] ) ) {
    
    $footer_menu = wp_get_nav_menu_object( $locations[ 'footer' ] );
    
}

$footer_text = get_theme_mod( 'footertext_setting', '' );

if ( $footer_text != '' || $footer_menu != null ) {
    
    echo '<div class="footer">';
    
    if ( $footer_text != '' ) {
        echo '<p>' . $footer_text . '</p>';
    }
    
    if ( $footer_menu != null ) {
        
        echo '<span>';
        
        $items = wp_get_nav_menu_items( $footer_menu->term_id );
        foreach ( $items as $item ) {
            echo '<a href="' . $item->url . '">' . $item->title . '</a>' . str_repeat( '&nbsp;', 5 );
        }
        
        echo '</span>';
        
    }
    
    echo '</div>';
    
}

?>

</div>
</body>
</html>