<?php
    $page_type = false;
    if (empty($page_type) && is_front_page()) { $page_type = 'front'; }
    if (empty($page_type) && is_404()) { $page_type = 'four-oh-four'; }
    if (empty($page_type) && preg_match('/blog\//', get_permalink($post->ID))) { $page_type = 'blog'; }
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
    <link rel='shortcut icon' href='<?php echo home_url('/favicon.gif'); ?>' type="image/ico">

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
            </div><!-- #branding -->

        </div><!-- #masthead -->
    </div><!-- #header -->

    <div id="main">
        <div id="#container">
            <div id="content">
                <div id="impact" class="impact-<?php echo rand(1,3); ?>">
                    <div id="tagline"><?php bloginfo( 'description' ) ?></div>
                </div>

                <div id="body">
                    <h2 class="entry-title">Bumble Bees Nannies is closed from Sept 5th onwards.</h2>
                    <p>Bumble Bees Nannies has been in operation for over two years now and over the last few weeks I have come to the decision to close Bumble Bees Nannies.  It has been an exciting adventure that I have been so passionate about.  I have meet the most amazing people over the last few years and thank you for making this experience so enjoyable</p>

                    <p>To all the families that I have had the pleasure of helping and meeting, Thank-you for being such great people to work with and being fantastic employers. I have really enjoyed helping your families and I wish you good luck in the future.</p>

                    <p>To all my nannies that I have interviewed, laughed with, had coffee with; I wish you all the best in your current jobs and good luck for the future. I really hope you find jobs with families that you love and treat you well.</p>

                    <p>Thank you everyone - Richelle</p>
                </div>
            </div>
        </div>

    </div><!-- #main -->
</div><!-- #wrapper -->

<div id="footer">
    <div class="wrapper">
    </div>
</div><!-- #footer -->

<?php wp_footer(); ?>
</body>
</html>