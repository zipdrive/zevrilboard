<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    
    <title><?php wp_title(); ?></title>
    
    <link rel='stylesheet' type='text/css' href='<?php echo get_stylesheet_uri(); ?>'>
    
    <?php wp_head(); ?>
</head>

<body>
<?php get_sidebar(); ?>

<form class='search-bar' role='search' method='get' action='<?php echo esc_url( home_url( '/' ) ); ?>'>
    <input id='s' name='s' type='text' name='keywords' placeholder='Search Ellundara'>
</form>

<div class='content'>

<div class='content-page'>