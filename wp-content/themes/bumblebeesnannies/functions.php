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

function bbn_callouts($which=null) {
	if (is_null($which) || $which == 'parents') {
	?>
	<a href="<?php bloginfo('url'); ?>/family-registration" class="callout-link">
		<div id="callout-parents" class="callout">
			<div>Parents</div>
			Register Here
		</div>
	</a>
	<?php
	}
	if (is_null($which) || $which == 'caregivers') {
	?>
	<a href="<?php bloginfo('url'); ?>/caregiver-registration" class="callout-link">
		<div id="callout-caregivers" class="callout">
			<div>Caregivers</div>
			Register Here
		</div>
	</a>
	<?php
	}
	if ($which == 'nanny-payroll') {
	?>
	<a href="<?php bloginfo('url'); ?>/caregiver-registration" class="callout-link">
		<div id="callout-payroll" class="callout">
			<div>Nanny Payroll</div>
			More Information
		</div>
	</a>
	<?php
	}
}

function bbn_tweets($num_to_get=5) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://api.twitter.com/1/statuses/user_timeline.json?include_entities=true&include_rts=true&screen_name=BumbleBeesNanny&count='.$num_to_get);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	$response = json_decode($response);

	foreach ($response AS $i => $tweet) {
		$text = $tweet->text;
		preg_match_all('/@([A-Za-z0-9_]+)/', $text, $usernames);
		foreach ($usernames[0] AS $j => $username) {
			$find[] = $username;
			$replace[] = '<a href="http://www.twitter.com/'.$usernames[1][$j].'" target="_blank">'.$username.'</a>';
			//$text = str_replace($username, $replace, $text);
		}
		preg_match_all('/#([A-Za-z0-9_]+)/', $text, $hashes);
		foreach ($hashes[0] AS $j => $hash) {
			$find[] = $hash;
			$replace[] = '<a href="http://search.twitter.com/search?q='.urlencode($hashes[1][$j]).'" target="_blank">'.$hash.'</a>';
			//$text = str_replace($hash, $replace, $text);
		}
		preg_match_all('/http([s]?):\/\/([^\ \)$]*)/', $text, $links);
		//echo '<pre>'.print_r($links,true).'</pre>';
		foreach ($links[0] AS $j => $link) {
			$find[]    = $link;
			$replace[] = '<a href="'.$link.'" target="_blank">'.$link.'</a>';
		}
		$text = str_replace($find, $replace, $text);

		echo '<div class="tweet">';
		echo $text;
		echo '	<div class="date">'.bbn_twitter_time(strtotime($tweet->created_at)).'</div>';
		echo '</div>';
	}
}

function bbn_twitter_time($original) {
	if ($original < strtotime('-1 day')) {
		return date('j M', $original);
	}

    // array of time period chunks
    $chunks = array(
    array(60 * 60 * 24 * 365 , 'year'),
    array(60 * 60 * 24 * 30 , 'month'),
    array(60 * 60 * 24 * 7, 'week'),
    array(60 * 60 * 24 , 'day'),
    array(60 * 60 , 'hour'),
    array(60 , 'min'),
    array(1 , 'sec'),
    );
 
    $today = time(); /* Current unix time  */
    $since = $today - $original;
 
    // $j saves performing the count function each time around the loop
    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
 
    $seconds = $chunks[$i][0];
    $name = $chunks[$i][1];
 
    // finding the biggest chunk (if the chunk fits, break)
    if (($count = floor($since / $seconds)) != 0) {
        break;
    }
    }
 
    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
 
    if ($i + 1 < $j) {
    // now getting the second item
    $seconds2 = $chunks[$i + 1][0];
    $name2 = $chunks[$i + 1][1];
 
    // add second item if its greater than 0
    if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
        $print .= ($count2 == 1) ? ', 1 '.$name2 : " $count2 {$name2}s";
    }
    }
    return $print;
}