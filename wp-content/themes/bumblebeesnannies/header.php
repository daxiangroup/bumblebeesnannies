<?php
    $page_type = false;
    if (empty($page_type) && is_front_page()) { $page_type = 'front'; }
    if (empty($page_type) && is_404()) { $page_type = 'four-oh-four'; }
    if (empty($page_type) && is_archive()) { $page_type = 'blog'; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php
        if ( is_single() ) { single_post_title(); }       
        elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); get_page_number(); }
        elseif ( is_page() ) { single_post_title(''); }
        elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); get_page_number(); }
        elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
        else { bloginfo('name'); wp_title('|'); get_page_number(); }
    ?></title>
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <link href="<?php echo home_url('/css/bootstrap.min.css'); ?>" rel="stylesheet" media="screen">
    <link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
    
    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
     
    <?php wp_head(); ?>

    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'your-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'your-theme' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />    
</head>
 
<body>
<div id="wrapper" class="hfeed">
    <div id="header">
        <div id="masthead">
         
            <div id="branding">
                <a id="blog-title-link" href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home">
                    <div id="blog-title"></div>
                </a>

                <div id="contact">
                    <li><a href="<?php bloginfo( 'url' ) ?>/contact" title="Contact Us">Contact Us</a></li>
                    <div>647.505.2904</div>
                </div>
            </div><!-- #branding -->
             
            <div id="access" class="<?php echo $page_type ?>">
                <?php wp_nav_menu( array( 'theme_location' => 'main-navigation') ); ?>
            </div><!-- #access -->
             
        </div><!-- #masthead -->   
    </div><!-- #header -->
     
    <div id="main">