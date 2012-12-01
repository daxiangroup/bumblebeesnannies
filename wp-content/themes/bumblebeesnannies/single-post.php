<?php get_header(); ?>
        <div id="container" class="<?php echo bbn_slug_classes(); ?>">
            <div id="content">
                <div id="body">

					<?php the_post(); ?>
						<nav id="nav-single">
							<div class="nav-previous"><?php previous_post_link('%link', __( '<span class="meta-nav">&larr;</span> %title')); ?></div>
							<div class="nav-next"><?php next_post_link('%link', __( '%title <span class="meta-nav">&rarr;</span>')); ?></div>
						</nav>
    	                <h2 class="entry-title"><?php echo bbn_get_post($post->id, 'post_title'); ?></h2>
    	                <div class="blog-post-info">Posted by <?php the_author(); ?> on <?php echo the_date(); ?></div>

                    	<?php echo bbn_get_post($post->id, 'post_content'); ?>

                </div>

                <div id="sidebar">
                    <?php
                    bbn_callouts();
                    bbn_callouts('sidebar-tagline');
                    bbn_callouts('filler-image');
                    bbn_callouts('recent-blogs');
                    ?>
                </div>
            </div>
        </div>
<?php get_footer(); ?>