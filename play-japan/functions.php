<?php

    // MY CUSTOM TITLE
    function my_title () {

        if ( is_front_page() || is_singular() ) {
            the_title(); 
        } else {
            wp_title('');
        }

    }



    // REGISTER MENUS
    function my_register_custom_menus () {

        register_nav_menus( 
            array(
                'main-navigation'   => 'Main Navigation',
                'footer-navigation' => 'Footer Navigation'
            )
        );

    }
    add_action( 'init', 'my_register_custom_menus' );



    // REGISTER SIDEBARS
    function my_register_sidebars () {

        register_sidebar(array(
            'name' => 'Sidebar 1',
            'id'   => 'sidebar-1'
        ));

        register_sidebar(array(
            'name' => 'Sidebar 2',
            'id'   => 'sidebar-2'
        ));

    }
    add_action( 'init', 'my_register_sidebars' );



    // ADD CSS STYLES
    function my_add_theme_style_css() {

        wp_enqueue_style( 'main',      get_stylesheet_directory_uri() . '/style.css' );
        wp_enqueue_style( 'normalize', get_stylesheet_directory_uri() . '/css/normalize.css' );
        wp_enqueue_style( 'structure', get_stylesheet_directory_uri() . '/css/structure.css' );
        wp_enqueue_style( 'header',    get_stylesheet_directory_uri() . '/css/header.css' );
        wp_enqueue_style( 'content',   get_stylesheet_directory_uri() . '/css/content.css' );
        wp_enqueue_style( 'sidebar',   get_stylesheet_directory_uri() . '/css/sidebar.css' );
        wp_enqueue_style( 'footer',    get_stylesheet_directory_uri() . '/css/footer.css' );

    }
    add_action( 'wp_enqueue_scripts', 'my_add_theme_style_css' );




    // ADD THUMBNAILS FOR CUSTOM POSTS

    function codex_custom_init() {
        $labels = array(
          'name' => _x('Games', 'post type general name'),
          'singular_name' => _x('Game', 'post type singular name'),
          'add_new' => _x('Add New', 'game'),
          'add_new_item' => __('Add New Game'),
          'edit_item' => __('Edit Game'),
          'new_item' => __('New Game'),
          'all_items' => __('All Games'),
          'view_item' => __('View Game'),
          'search_items' => __('Search Games'),
          'not_found' =>  __('No games found'),
          'not_found_in_trash' => __('No games found in Trash'), 
          'parent_item_colon' => '',
          'menu_name' => __('Games')
      
        );
        $args = array(
          'labels' => $labels,
          'public' => true,
          'publicly_queryable' => true,
          'show_ui' => true, 
          'show_in_menu' => true, 
          'query_var' => true,
          'rewrite' => true,
          'capability_type' => 'post',
          'has_archive' => true, 
          'hierarchical' => false,
          'menu_position' => null,
          'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
        ); 
        register_post_type('game',$args);
      }
      add_action( 'init', 'codex_custom_init' );

      add_theme_support( 'post-thumbnails' );



    // Search Filters

    function search_filter($query) {
        if($query->is_search()){
            $query->set('post_type', array('post','game'));
        }
    }

    add_filter('pre_get_posts', 'search_filter');


    // Displaying Multiple Post Types on Category Pages

    add_filter('pre_get_posts', 'query_post_type');
    function query_post_type($query) {
        if( is_category() ) {
            $post_type = get_query_var('post_type');
            if($post_type)
                $post_type = $post_type;
            else
                $post_type = array('nav_menu_item', 'post', 'game');
            $query->set('post_type',$post_type);
            return $query;
            }
    }



    // Include CSS Styles

    add_action('wp_enqueue_scripts', 'cssmenumaker_scripts_styles' );

    function cssmenumaker_scripts_styles() {  
    wp_enqueue_style( 'cssmenu-styles', get_template_directory_uri() . '/cssmenu/styles.css');
    }


    // Custom Walker Class


    class CSS_Menu_Walker extends Walker {

        var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');
        
        function start_lvl(&$output, $depth = 0, $args = array()) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul>\n";
        }
        
        function end_lvl(&$output, $depth = 0, $args = array()) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }
        
        function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        
            global $wp_query;
            $indent = ($depth) ? str_repeat("\t", $depth) : '';
            $class_names = $value = '';
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            
            /* Add active class */
            if (in_array('current-menu-item', $classes)) {
                $classes[] = 'active';
                unset($classes['current-menu-item']);
            }
            
            /* Check for children */
            $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
            if (!empty($children)) {
                $classes[] = 'has-sub';
            }
            
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
            
            $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';
            
            $output .= $indent . '<li' . $id . $value . $class_names .'>';
            
            $attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
            $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target    ) .'"' : '';
            $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn       ) .'"' : '';
            $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url       ) .'"' : '';
            
            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'><span>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</span></a>';
            $item_output .= $args->after;
            
            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }
        
        function end_el(&$output, $item, $depth = 0, $args = array()) {
            $output .= "</li>\n";
        }
    }
?>





