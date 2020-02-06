<?php


add_action( 'init', 'zevrilboard_menu_register' );
function zevrilboard_menu_register() {
    
    // This function deprecated until further notice.
    register_nav_menus( array(
        'sidebar'     =>     __( 'Sidebar' ),
        'footer'     =>     __( 'Footer' )
    ) );
    
}

add_action( 'customize_register', 'zevrilboard_customize_register' );
function zevrilboard_customize_register( $wp_customize ) {
    
    $wp_customize->add_setting( 'bgcolor_setting', array(
        'default'       =>      '#f7eeff',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bgcolor_control', array(
        'label'         =>      __( 'Background Color', 'zevrilboard'),
        'section'       =>      'colors',
        'settings'      =>      'bgcolor_setting',
    ) ) );
    
    $wp_customize->add_setting( 'bordercolor_setting', array(
        'default'       =>      '#dbb3ff',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bordercolor_control', array(
        'label'         =>      __( 'Border Color', 'zevrilboard'),
        'section'       =>      'colors',
        'settings'      =>      'bordercolor_setting',
    ) ) );
    
    $wp_customize->add_setting( 'linkcolor_setting', array(
        'default'       =>      '#6606c6',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'linkcolor_control', array(
        'label'         =>      __( 'Link Color', 'zevrilboard'),
        'section'       =>      'colors',
        'settings'      =>      'linkcolor_setting',
    ) ) );
    
    $wp_customize->add_setting( 'linkhover_setting', array(
        'default'       =>      '#a34bfa',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'linkhover_control', array(
        'label'         =>      __( 'Link Hover Color', 'zevrilboard'),
        'section'       =>      'colors',
        'settings'      =>      'linkhover_setting',
    ) ) );
    
    
    $wp_customize->add_setting( 'footertext_setting', array(
        'capability'    =>      'edit_theme_options',
        'default'       =>      ''
    ) );
    
    $wp_customize->add_control( 'footertext_setting', array( 
        'type'          =>      'text',
        'section'       =>      'title_tagline',
        'label'         =>      __( 'Footer Text' ),
        'description'   =>      __( 'This text will display at the bottom of every page, before any footer links.' )
    ) );
    
}

add_action( 'wp_head', 'zevrilboard_get_customizer_css' );
function zevrilboard_get_customizer_css() {
    
    ?>
    <style type='text/css'>
        body {
            background-color: <?php echo get_theme_mod( 'bgcolor_setting', '#f7eeff' ); ?>;
        }
        
        .category-box {
            background-color: <?php echo get_theme_mod( 'bgcolor_setting', '#f7eeff' ); ?>;
            border-color: <?php echo get_theme_mod( 'bordercolor_setting', '#dbb3ff' ); ?>;
        }
        
        .content-page {
            border-color: <?php echo get_theme_mod( 'bordercolor_setting', '#dbb3ff' ); ?>;
        }
        
        .content-page > hr {
            background-color: <?php echo get_theme_mod( 'bordercolor_setting', '#dbb3ff' ); ?>;
        }
        
        .sidebar-nav > hr {
            background-color: <?php echo get_theme_mod( 'bordercolor_setting', '#dbb3ff' ); ?>;
        }
        
        .search-bar > input {
            border-color: <?php echo get_theme_mod( 'bordercolor_setting', '#dbb3ff' ); ?>;
        }
        
        .search-result {
            background-color: <?php echo get_theme_mod( 'bgcolor_setting', '#f7eeff' ); ?>;
            border-color: <?php echo get_theme_mod( 'bordercolor_setting', '#dbb3ff' ); ?>;
        }
        
        a, .sidebar-nav > a {
            color: <?php echo get_theme_mod( 'linkcolor_setting', '#6606c6' ); ?>;
        }
        
        a:hover, .sidebar-nav > a:hover {
            color: <?php echo get_theme_mod( 'linkhover_setting', '#a34bfa' ); ?>;
        }
    </style>
    <?php
    
}

add_action( 'wp_enqueue_styles', 'zevrilboard_enqueue_styles' );
function zevrilboard_enqueue_styles() {
    
    $theme_version = wp_get_theme()->get( 'Version' );
    
    // Load style.css
    wp_enqueue_style( 'zevrilboard-style', get_stylesheet_uri(), array(), $theme_version );
    
    // Load customized styles as inline css
    // *Deprecated
    //wp_add_inline_style( 'zevrilboard-style', zevrilboard_get_customizer_css() );
    
}


add_action( 'init', 'zevrilboard_redirect_register' );
function zevrilboard_redirect_register() {
    
    global $wp;
    
    $wp->add_query_var( 'random' );
    $wp->add_query_var( 'featured' );
    
}

add_action( 'template_redirect', 'zevrilboard_template_random_redirect' );
function zevrilboard_template_random_redirect() {
    
    if ( get_query_var( 'random' ) == 1 ) {
        
        $posts = get_posts( array( 
            'orderby'       =>      'rand',
            'numberposts'   =>      1
        ) );
        
        foreach ( $posts as $post ) {
            $link = get_permalink( $post );
        }
        
        wp_redirect( $link );
        exit;
        
    } else if ( get_query_var( 'featured' ) != 0 ) {
        
        $posts = get_posts( array( 
            'orderby'       =>      'date',
            'numberposts'   =>      get_query_var( 'featured' )
        ) );
        
        foreach ( $posts as $post ) {
            $link = get_permalink( $post );
        }
        
        wp_redirect( $link );
        exit;
        
    }
    
}



?>