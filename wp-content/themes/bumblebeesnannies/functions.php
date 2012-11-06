<?php

// Get the page number
function get_page_number() {
    if ( get_query_var('paged') ) {
        print ' | ' . __( 'Page ' , 'your-theme') . get_query_var('paged');
    }
} // end get_page_number

function register_my_menus() {
	register_nav_menus(array(
		'footer-services' => __('Footer - Services'),
		'footer-service-areas' => __('Footer - Service Areas'),
		'footer-information' => __('Footer - Information'),
	));
}
add_action('init', 'register_my_menus');