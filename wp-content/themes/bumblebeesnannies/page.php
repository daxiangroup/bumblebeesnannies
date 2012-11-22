<?php get_header(); ?>
        <div id="container">
            <div id="content">
                <div id="body">

                    <h2 class="entry-title"><?php echo bbn_get_post($post->id, 'post_title'); ?></h2>
                    <?php echo bbn_get_post($post->id, 'post_content'); ?>

                </div>

                <div id="sidebar">
                    <?php bbn_callouts(); ?>
                    <?php bbn_callouts('sidebar-tagline'); ?>
                </div>
            </div>
        </div>
<?php get_footer(); ?>