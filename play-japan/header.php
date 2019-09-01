<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>

        <title><?php my_title(); ?> &mdash; <?php bloginfo( 'name' ) ?></title>
        <meta charset="UTF-8">

        <?php wp_head(); ?>

    </head>
    <body <?php body_class( 'myclass' ); ?>>

        <header>
            <div class="header-container">
                <h1 class="logo"><a href="<?php echo site_url() ?>"><?php bloginfo( 'name' ); ?> &mdash; <?php bloginfo( 'description' );?></a></h1>

                <?php wp_nav_menu(array(
	                'menu' => 'Main Menu', 
	                'container_id' => 'cssmenu', 
                    'walker' => new CSS_Menu_Walker())); 
                ?>
            </div>
        </header>

        <div class="main-container">
            <main>