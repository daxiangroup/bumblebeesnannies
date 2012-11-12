<?php

// Get the page number
function get_page_number() {
    if ( get_query_var('paged') ) {
        print ' | ' . __( 'Page ' , 'your-theme') . get_query_var('paged');
    }
} // end get_page_number

/*---------------------------------------------------------
 | register_my_menus()
 |---------------------------------------------------------
 | Registering custom menu locations with the theme
 */
function register_my_menus() {
	register_nav_menus(array(
		'main-navigation' => __('Main Navigation'),
		'footer-services' => __('Footer - Services'),
		'footer-service-areas' => __('Footer - Service Areas'),
		'footer-information' => __('Footer - Information'),
	));
}
add_action('init', 'register_my_menus');

/*---------------------------------------------------------
 | add_markup_pages()
 |---------------------------------------------------------
 | Adding 'first-menu-item' and 'last-menu-item' to any menu
 | rendered by wp_nav_menu()
 */
function add_markup_pages($output) {
    $output = preg_replace('/class="menu-item/', 'class="first-menu-item menu-item', $output, 1);
	$output = substr_replace($output, "last-menu-item menu-item", strripos($output, "menu-item"), strlen("menu-item"));
    return $output;
}
add_filter('wp_nav_menu', 'add_markup_pages');

/*---------------------------------------------------------
 | create_post_type()
 |---------------------------------------------------------
 | Creating custom post types for the Bumble Bees Nannies
 | system.
 */
function create_post_type() {
    register_post_type( 'families', array(
        'labels' => array(
            'name' => __( 'Families' ),
            'singular_name' => __( 'Family' ),
            'all_items' => __( 'All Family Posts' ),
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_nav_menus' => true,
        'rewrite' => array(
            'with_front' => false,
        ),
        'menu_position' => 5,
    ));

    register_post_type( 'caregivers', array(
        'labels' => array(
            'name' => __( 'Care Givers' ),
            'singular_name' => __( 'Care Giver' ),
            'all_items' => __( 'All Care Giver Posts' ),
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_nav_menus' => true,
        'rewrite' => array(
            'with_front' => false,
        ),
        'menu_position' => 5,
    ));

}
//add_action( 'init', 'create_post_type' );

/*---------------------------------------------------------
 | bbn_enqueue_scripts()
 |---------------------------------------------------------
 | Enqueuing WordPress to include scripts for the theme.
 */
function bbn_enqueue_scripts() {
    wp_enqueue_script('bbnmain', get_bloginfo('template_url').'/bbnmain.js', 'jquery', false, true);
    wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
}
add_action('wp_enqueue_scripts', 'bbn_enqueue_scripts');


function bbn_get_post($id, $item=null) {
    $post = get_post($id);

    if (!is_null($item)) {
        $content = $post->$item;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        return $content;
    }

    return $post;
}




