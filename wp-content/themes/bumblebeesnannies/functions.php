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