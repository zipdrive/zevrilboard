<div class='sidebar'>
    <img src=<?php echo get_site_icon_url(); ?> alt='Icon goes here' width='60%'>
    
    <?php
    
    function zevrilboard_display_sidebar_menu( $menu, $display_name = 1 ) {
        
        if ( !$menu ) {
            return '';
        }
        
        $items = wp_get_nav_menu_items( $menu->term_id );
        $nav_menu = '';
        
        if ( !empty( $items ) ) {
            
            $nav_menu .= '<hr><div class=\'sidebar-nav\'>';
            
            if ( $display_name ) {
                
                $nav_menu .= '<p>' . $menu->name . '</p><hr>';
                
            }
            
            foreach ( $items as $item ) {
            
                $nav_menu .= '<br /><a href="' . $item->url . '">' . $item->title . '</a>';
                
            }
            
            $nav_menu .= '</div>';
        }
        
        return $nav_menu;
        
    }
    
    $nav_menu = '';
    $locations = get_nav_menu_locations();
    
    $sidebar_menu = null;
    if ( $locations && isset( $locations[ 'sidebar' ] ) ) {
        
        $sidebar_menu = wp_get_nav_menu_object( $locations[ 'sidebar' ] );
        $nav_menu .= zevrilboard_display_sidebar_menu( $sidebar_menu, 0 );
        
    }
    
    $footer_menu = null;
    if ( $locations && isset( $locations[ 'footer' ] ) ) {
        
        $footer_menu = wp_get_nav_menu_object( $locations[ 'footer' ] );
        
    }
    
    $zb_nav_menus = wp_get_nav_menus( array( 
        'hide_empty'    =>      true
    ) );
    
    if ( $zb_nav_menus ) {
        
        foreach ( $zb_nav_menus as $zb_nav_menu ) {
            
            if ( $zb_nav_menu != $sidebar_menu && $zb_nav_menu != $footer_menu ) {
                
                $nav_menu .= zevrilboard_display_sidebar_menu( $zb_nav_menu );
                
            }
            
        }
        
    }
    
    echo $nav_menu
    
    ?>
</div>