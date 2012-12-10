<?php
define('POSTS_PER_PAGE', 2);
define('JOB_POSTS_PER_PAGE', 5);
define('BLOG_EXCERPT_LENGTH', 400);
define('BLOGS_PER_PAGE', 4);


// Get the page number
function get_page_number() {
    if ( get_query_var('paged') ) {
        print ' | ' . __( 'Page ' , 'your-theme') . get_query_var('paged');
    }
} // end get_page_number

/*---------------------------------------------------------
 | bbn_register_menus()
 |---------------------------------------------------------
 | Registering custom menu locations with the theme
 */
function bbn_register_menus() {
	register_nav_menus(array(
		'main-navigation' => __('Main Navigation'),
		'footer-services' => __('Footer - Services'),
		'footer-service-areas' => __('Footer - Service Areas'),
		'footer-information' => __('Footer - Information'),
	));
}

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

/*---------------------------------------------------------
 | bbn_post_types()
 |---------------------------------------------------------
 | Creating custom post types for the Bumble Bees Nannies
 | system.
 */
function bbn_post_types() {
    // Nanny Share
    register_post_type('share_family', array(
        'labels' => array(
            'name' => __('Nanny Share - Families'),
            'singular_name' => __('Nanny Share - Family'),
            'all_items' => __('All Family Posts'),
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_nav_menus' => true,
        'capability_type' => 'post',
        'rewrite' => array(
            'slug' => 'nanny-share/families',
            'with_front' => false,
        ),
        'supports' => array(
            'title',
            'mt'
        ),
        'menu_position' => 5,
    ));

    // Job Vacancies
    register_post_type('job_vacancy', array(
        'labels' => array(
            'name' => __('Job Vacancies'),
            'singular_name' => __('Job Vacancy'),
            'all_items' => __('All Job Vacancies'),
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_nav_menus' => true,
        'capability_type' => 'post',
        'rewrite' => array(
            'with_front' => false,
        ),
        'supports' => array(
            'title',
            'mt',
        ),
        'menu_position' => 6,
    ));
}

function bbn_add_meta_boxes() {
    // If the user is not logged in as an admin, end the function call.
    if (!is_admin())
        return false;

    // Nanny Share
    add_meta_box('nanny-share-family-section', 'Nanny Share - Family Details', 'bbn_meta_share_family', 'share_family', 'normal');
    add_action('save_post', 'bbn_save_share_family', 10, 2);

    // Job Vacancies
    add_meta_box('job-vacancy-section', 'Job Vacancy', 'bbn_meta_job_vacancy', 'job_vacancy', 'normal');
    add_action('save_post', 'bbn_save_job_vacancy', 10, 2);
}
    function bbn_meta_share_family($object, $box) {
        require_once('includes/meta-share-family.php');
    }

    function bbn_save_share_family($post_id, $post) {
        // Verify the nonce before proceeding.
        if (!isset( $_POST['share-family-nonce']) || !wp_verify_nonce($_POST['share-family-nonce'], 'meta-share-family.php'))
            return $post_id;

        // Get the post type object.
        $post_type = get_post_type_object($post->post_type);

        // Check if the current user has permission to edit the post.
        if (!current_user_can($post_type->cap->edit_post, $post_id))
            return $post_id;

        $meta_boxes = array(
            'ns-family-type',
            'ns-family-intersection',
            'ns-family-start-month',
            'ns-family-start-day',
            'ns-family-start-year',
            'ns-family-age',
            'ns-family-days',
            'ns-family-hours',
        );

        foreach ($meta_boxes AS $field) {
            switch ($field) {
                case 'ns-family-days':
                    for ($i=1; $i<=7; $i++) {
                        $parse[$i] = (isset($_POST[$field][$i]) ? $_POST[$field][$i] : '0');
                    }
                    $new_values[$field] = serialize($parse);
                    break;
                case 'ns-family-hours':
                    $new_values[$field] = serialize(isset($_POST[$field]) ? $_POST[$field] : array());
                    break;
                default:
                    $new_values[$field] = isset($_POST[$field]) ? sanitize_text_field($_POST[$field]) : '';
                    break;
            }
            $old_values[$field] = get_post_meta($post_id, $field, true);

            /* If a new meta value was added and there was no previous value, add it. */
            if ($new_values[$field] && '' == $old_values[$field])
                add_post_meta($post_id, $field, $new_values[$field], true);
    
            /* If the new meta value does not match the old value, update it. */
            elseif ($new_values[$field] && $new_values[$field] != $old_values[$field] )
                update_post_meta($post_id, $field, $new_values[$field]);

            /* If there is no new meta value but an old value exists, delete it. */
            elseif ('' == $new_values[$field] && $old_values[$field])
                delete_post_meta($post_id, $field, $old_values[$field]);
        }
    }

    function bbn_meta_job_vacancy($object, $box) {
        require_once('includes/meta-job-vacancy.php');
    }

    function bbn_save_job_vacancy($post_id, $post) {
        // Verify the nonce before proceeding.
        if (!isset( $_POST['job-vacancy-nonce']) || !wp_verify_nonce($_POST['job-vacancy-nonce'], 'meta-job-vacancy.php'))
            return $post_id;

        // Get the post type object.
        $post_type = get_post_type_object($post->post_type);

        // Check if the current user has permission to edit the post.
        if (!current_user_can($post_type->cap->edit_post, $post_id))
            return $post_id;

        $meta_boxes = array(
            'jv-type',
            'jv-position',
            'jv-start-month',
            'jv-start-day',
            'jv-start-year',
            'jv-location',
            'jv-hours',
            'jv-salary',
            'jv-num-children',
            'jv-qualifications',
            'jv-responsibilities',
            'jv-expectations',
        );

        foreach ($meta_boxes AS $field) {
            switch ($field) {
                case 'ns-family-days':
                    for ($i=1; $i<=7; $i++) {
                        $parse[$i] = (isset($_POST[$field][$i]) ? $_POST[$field][$i] : '0');
                    }
                    $new_values[$field] = serialize($parse);
                    break;
                case 'ns-family-hours':
                    $new_values[$field] = serialize(isset($_POST[$field]) ? $_POST[$field] : array());
                    break;
                default:
                    $new_values[$field] = isset($_POST[$field]) ? sanitize_text_field($_POST[$field]) : '';
                    break;
            }
            $old_values[$field] = get_post_meta($post_id, $field, true);

            /* If a new meta value was added and there was no previous value, add it. */
            if ($new_values[$field] && '' == $old_values[$field])
                add_post_meta($post_id, $field, $new_values[$field], true);
    
            /* If the new meta value does not match the old value, update it. */
            elseif ($new_values[$field] && $new_values[$field] != $old_values[$field] )
                update_post_meta($post_id, $field, $new_values[$field]);

            /* If there is no new meta value but an old value exists, delete it. */
            elseif ('' == $new_values[$field] && $old_values[$field])
                delete_post_meta($post_id, $field, $old_values[$field]);
        }
    }

/*---------------------------------------------------------
 | bbn_enqueue_scripts()
 |---------------------------------------------------------
 | Enqueuing WordPress to include scripts for the theme.
 */
function bbn_enqueue_scripts() {
    wp_enqueue_script('bbnmain', get_bloginfo('template_url').'/bbnmain.js', 'jquery', false, true);
    wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
    wp_enqueue_script('bootstrap', '/js/bootstrap.min.js', 'jquery', false, true);

    if (is_admin()) {
        wp_enqueue_script('bbnadmin', get_bloginfo('template_url').'/bbnadmin.js', 'jquery', false, true);
    }
}

function bbn_enqueue_styles() {
    wp_enqueue_style('bbnadmin', get_bloginfo('template_url').'/bbnadmin.css');
}

function bbn_slug_classes() {
	$classes = str_replace('/', ' ', substr($_SERVER['REQUEST_URI'], 1));
	return trim($classes);
}

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
	if (is_null($which) || $which == 'families') {
	?>
	<a href="<?php bloginfo('url'); ?>/family-registration" class="callout-link">
		<div id="callout-families" class="callout">
			<div>Families</div>
			Register Here
		</div>
	</a>
	<?php
	}
	if (is_null($which) || $which == 'nannies') {
	?>
	<a href="<?php bloginfo('url'); ?>/nanny-registration" class="callout-link">
		<div id="callout-nannies" class="callout">
			<div>Nannies</div>
			Register Here
		</div>
	</a>
	<?php
	}
	if ($which == 'nanny-payroll') {
	?>
	<a href="<?php bloginfo('url'); ?>/families/tax-information-and-nanny-pay-scale/" class="callout-link">
		<div id="callout-payroll" class="callout">
			<div>Nanny Payroll</div>
			More Information
		</div>
	</a>
	<?php
	}
    if ($which == 'sidebar-tagline') {
    ?>
    <div class="tagline">
        <?php bloginfo('description'); ?>
    </div>
    <?php
    }
    if ($which == 'recent-blogs') {
	    $recent_blogs = new WP_query();
	    $recent_blogs->query('showposts=5');

	    if ($recent_blogs->have_posts()) {
            bbn_labels('Recent Blogs');
		    echo '<ul class="recent-blogs">';
		    while ($recent_blogs->have_posts()) : $recent_blogs->the_post();
		    	?><li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li><?php
		    endwhile;
		    echo '</ul>';
		}
    }
    if ($which == 'filler-image') {
		echo '<div class="filler-image"></div>';
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

		echo '<div class="tweet'.($i == ($num_to_get-1) ? ' last' : '').'">';
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

function bbn_labels($which) {
	echo '<div class="sidebar-label">'.$which.'</div>';
}

function bbn_nanny_shares($nanny_shares) {
    $i = 0;
    while ($nanny_shares->have_posts()) {
        $post = $nanny_shares->next_post();

        $month = esc_attr(get_post_meta($post->ID, 'ns-family-start-month', true));
        $day   = esc_attr(get_post_meta($post->ID, 'ns-family-start-day', true));
        $year  = esc_attr(get_post_meta($post->ID, 'ns-family-start-year', true));
        $date  = date("F d, Y", strtotime($year.'-'.$month.'-'.$day));
        $days  = unserialize(get_post_meta($post->ID, 'ns-family-days', true));
        $hours = unserialize(get_post_meta($post->ID, 'ns-family-hours', true));

        $class = ($i%2 ? ' last' : '');
        $i++;
    ?>

    <div id="nanny-share-family-<?php echo $post->ID; ?>" class="nanny-share-family">
        <div class="sides clearfix">
            <div class="left">
                <div class="share-row">
                    <div class="lbl">Family Number</div>
                    <div class="fld"><?php echo $post->ID; ?></div>
                </div>

                <div class="share-row">
                    <div class="lbl">Closest Intersection</div>
                    <div class="fld"><?php echo esc_attr(get_post_meta($post->ID, 'ns-family-intersection', true)); ?></div>
                </div>
            </div>
            <div class="right">
                <div class="share-row">
                    <div class="lbl">Age of Child/ren</div>
                    <div class="fld"><?php echo esc_attr(get_post_meta($post->ID, 'ns-family-age', true)); ?></div>
                </div>

                <div class="share-row">
                    <div class="lbl">Start Date</div>
                    <div class="fld"><?php echo $date; ?></div>
                </div>
            </div>

            <div class="share-row full-row days-hours">
                <div class="top">
                    <div class="w33">
                        <div class="day">Monday</div>
                        <div class="hours"><?php echo !empty($hours[2]) ? $hours[2] : '--'; ?></div>
                    </div>
                    <div class="w34">
                        <div class="day">Tuesday</div>
                        <div class="hours"><?php echo !empty($hours[3]) ? $hours[3] : '--'; ?></div>
                    </div>
                    <div class="w33">
                        <div class="day">Wednesday</div>
                        <div class="hours"><?php echo !empty($hours[4]) ? $hours[4] : '--'; ?></div>
                    </div>
                </div>

                <div class="bottom">
                    <div class="w33 ml17">
                        <div class="day">Thursday</div>
                        <div class="hours"><?php echo !empty($hours[5]) ? $hours[5] : '--'; ?></div>
                    </div>
                    <div class="w33">
                        <div class="day">Friday</div>
                        <div class="hours"><?php echo !empty($hours[6]) ? $hours[6] : '--'; ?></div>
                    </div>
                </div>

                <?php /*
                <div class="day">Mon</div> <input type="checkbox"<?php echo ($days[2] ? ' checked' : ''); ?> onclick="this.checked=!this.checked;">
                <div class="day">Tue</div> <input type="checkbox"<?php echo ($days[3] ? ' checked' : ''); ?> onclick="this.checked=!this.checked;">
                <div class="day">Wed</div> <input type="checkbox"<?php echo ($days[4] ? ' checked' : ''); ?> onclick="this.checked=!this.checked;"><br />
                <div class="day">Thu</div> <input type="checkbox"<?php echo ($days[5] ? ' checked' : ''); ?> onclick="this.checked=!this.checked;">
                <div class="day">Fri</div> <input type="checkbox"<?php echo ($days[6] ? ' checked' : ''); ?> onclick="this.checked=!this.checked;">
                */ ?>
            </div>

        </div>

        <div class="controls">
            <button class="btn interested-family" data-family-id="<?php echo $post->ID; ?>">I'm Interested In This Family</button>
        </div>
    </div>

    <?php }

    $big = 9999999999999;
    
    echo '<div class="controls">';
    echo paginate_links(array(
        'base' => str_replace( $big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'total' => $nanny_shares->max_num_pages,
        'current' => max(1, get_query_var('paged')),
    ));
    echo '</div>';
}

/*---------------------------------------------------------
 | bbn_check_active_state($type, $id)
 |---------------------------------------------------------
 | Simply queries the post/page for the requested "job" to 
 | ensure that it is active before trying to submit a contact
 | request.
 |
 | @param $type     string - Type of post to check the status of
 | @param $id       int - ID of the post to check the status of
 */
function bbn_check_active_state($type, $id) {
    switch ($type) {
        case 'family': $post_type = 'share_family'; break;
        case 'job': $post_type = 'job_vacancy'; break;
    }

    $query = new WP_query(array(
        'p' => $id,                                 
        'post_type' => $post_type,
        'post_status' => 'publish',
    ));

    if (!$query->have_posts()) {
        return false;
    }

    return $query;
}

function bbn_job_vacancies($job_vacancies) {
    if (!$job_vacancies->post_count) {
        switch ($job_vacancies->query_vars['meta_value']) {
            case 1: $type = 'Full Time'; break;
            case 2: $type = 'Part Time'; break;
            case 3: $type = 'After School Care'; break;
            case 4: $type = 'Mother\'s Help'; break;
        }

        echo '<div class="centered">There are currently no <strong>'.$type.'</strong> Job Vacancies</div>';
        return;
    }
    while ($job_vacancies->have_posts()) {
        $post = $job_vacancies->next_post();

        $month = esc_attr(get_post_meta($post->ID, 'jv-start-month', true));
        $day   = esc_attr(get_post_meta($post->ID, 'jv-start-day', true));
        $year  = esc_attr(get_post_meta($post->ID, 'jv-start-year', true));
        $date  = date("F d, Y", strtotime($year.'-'.$month.'-'.$day));
    ?>

    <div id="job-vacancy-<?php echo $post->ID; ?>" class="job-vacancy">
        <div class="sides clearfix">
            <div class="left">
                <div class="job-row">
                    <div class="lbl">Job Number</div>
                    <div class="fld"><?php echo $post->ID; ?></div>
                </div>

                <div class="job-row">
                    <div class="lbl">Position</div>
                    <div class="fld"><?php echo esc_attr(get_post_meta($post->ID, 'jv-position', true)); ?></div>
                </div>

                <div class="job-row">
                    <div class="lbl">Start Date</div>
                    <div class="fld"><?php echo $date; ?></div>
                </div>

                <div class="job-row">
                    <div class="lbl">Location</div>
                    <div class="fld"><?php echo esc_attr(get_post_meta($post->ID, 'jv-location', true)); ?></div>
                </div>
            </div>
            <div class="right">
                <div class="job-row">
                    <div class="lbl"></div>
                    <div class="fld">&nbsp;</div>
                </div>

                <div class="job-row">
                    <div class="lbl">Hours</div>
                    <div class="fld"><?php echo esc_attr(get_post_meta($post->ID, 'jv-hours', true)); ?></div>
                </div>

                <div class="job-row">
                    <div class="lbl">Salary/Wages</div>
                    <div class="fld"><?php echo esc_attr(get_post_meta($post->ID, 'jv-salary', true)); ?> gross</div>
                </div>

                <div class="job-row">
                    <div class="lbl">Children</div>
                    <div class="fld"><?php echo esc_attr(get_post_meta($post->ID, 'jv-num-children', true)); ?></div>
                </div>
            </div>
	    </div>

        <div class="job-row full-row first-row">
            <div class="lbl">Qualifications Needed</div>
            <div class="fld"><?php echo esc_attr(get_post_meta($post->ID, 'jv-qualifications', true)); ?></div>
        </div>

        <div class="job-row full-row">
            <div class="lbl">Responsibilities</div>
            <div class="fld"><?php echo esc_attr(get_post_meta($post->ID, 'jv-responsibilities', true)); ?></div>
        </div>

        <div class="job-row full-row">
            <div class="lbl">Expectations</div>
            <div class="fld"><?php echo esc_attr(get_post_meta($post->ID, 'jv-expectations', true)); ?></div>
        </div>

        <?php /*
        <div class="controls">
            <button class="btn interested-job" data-job-id="<?php echo $post->ID; ?>">I'm Interested In This Job</button>
        </div>
        */ ?>
    </div>

    <?php }

    $big = 9999999999999;
    
    echo '<div class="controls">';
    echo paginate_links(array(
        'base' => str_replace( $big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'total' => $job_vacancies->max_num_pages,
        'current' => max(1, get_query_var('paged')),
    ));
    echo '</div>';
}

function bbn_blogs($blogs) {
    while ($blogs->have_posts()) {
    	$blog = $blogs->next_post();
    	$user = get_userdata($blog->post_author);
        //die('<pre>'.print_r($user,true));
        //die('<pre>'.print_r($blog,true));

        echo '<h2 class="entry-title"><a href="'.get_permalink($blog->ID).'">'.$blog->post_title.'</a></h2>';
        echo '<div class="blog-post-info">Posted by '.$user->data->display_name.' on '.date("F j, Y", strtotime($blog->post_date)).'</div>';

        if (!empty($blog->post_excerpt)) {
        	echo $blog->post_excerpt;
        	echo '<div class="blog-read-more"><a href="'.get_permalink($blog->ID).'">...More</a></div>';
        	echo '<hr>';
        	continue;
        }

        if (strlen($blog->post_content) > BLOG_EXCERPT_LENGTH) {
        	echo substr($blog->post_content, 0, BLOG_EXCERPT_LENGTH).'...';
        	echo '<div class="blog-read-more"><a href="'.get_permalink($blog->ID).'">...More</a></div>';
        	echo '<hr>';
        	continue;
        }

        echo $blog->post_content;
        echo '<hr>';
    ?>

    <?php }

    $big = 9999999999999;
    
    echo '<div class="controls">';
    echo paginate_links(array(
        'base' => str_replace( $big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'total' => $blogs->max_num_pages,
        'current' => max(1, get_query_var('paged')),
    ));
    echo '</div>';
}


/*---------------------------------------------------------
 | Hook Section
 |---------------------------------------------------------
 | Bottom of the theme functions.php, here is where we register all
 | the hooks for the theme.
 */
add_action('init',               'bbn_register_menus');
add_action('init',               'bbn_post_types');
add_action('wp_enqueue_scripts', 'bbn_enqueue_scripts');
add_filter('wp_nav_menu',        'add_markup_pages');
add_action('admin_menu',         'bbn_add_meta_boxes');
add_action('admin_menu',         'bbn_enqueue_styles');
add_action('admin_menu',         'bbn_enqueue_scripts');
