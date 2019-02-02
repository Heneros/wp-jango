<?php
require_once __DIR__ . '/Test_Menu.php';


function test_scripts(){
    wp_enqueue_style('test-bootstrapcss', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css');
    wp_enqueue_style('test-style', get_stylesheet_uri());

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), false, true);

    wp_enqueue_script('test-popper', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array('jquery'), false, true);
    wp_enqueue_script('test-bootstrapjs', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'test_scripts');


function test_setup(){
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo', array(
        'width' => '150',
        'height' => '40',
    ));
    add_theme_support('custom-header', array(
        'default-image' => get_template_directory_uri() . '/assets/images/header.jpg',
        'width' => '1200',
        'height' => '900'
    ));
    add_theme_support('custom-background', array(
        'default-image' => get_template_directory_uri() . '/assets/images/123.jpg'
    ));

    add_image_size('my-thumb', 600, 400 );
    register_nav_menus( array(
      'header_menu1' => 'Menu in navbar 1',
      'footer_menu2' => 'Menu in footer 2',
    ));
}
add_action( 'after_setup_theme', 'test_setup' );


add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){


    return '
	<nav class="navigation" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}


the_posts_pagination( array(
    'end_size' => 2,
) );

function test_widgets_init(){
    register_sidebar(array(
        'name' => 'Sidebar right',
        'id' => 'right-sidebar',
        'description' => 'Area for widgets in sidebar the right',

    ));
}

add_action('widgets_init', 'test_widgets_init');