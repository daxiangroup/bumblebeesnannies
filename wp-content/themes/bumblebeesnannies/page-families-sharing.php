<?php get_header(); ?>        
        <div id="container">
            <div id="content">
                <div id="body">

                    <h2 class="entry-title"><?php echo bbn_get_post($post->id, 'post_title'); ?></h2>
                    <?php echo bbn_get_post($post->id, 'post_content'); ?>

                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $nanny_shares = new WP_query(array(
                        'post_type' => 'share_family',
                        'meta_key' => 'ns-family-type',
                        'meta_value' => '1',
                        'orderby' => 'id',
                        'order' => 'DESC',
                        'posts_per_page' => POSTS_PER_PAGE,
                        'paged' => $paged,
                    ));

                    bbn_nanny_shares($nanny_shares);

                    ?>
                </div>

                <div id="sidebar">
                    <?php
                    bbn_callouts();
                    bbn_callouts('sidebar-tagline');
                    bbn_callouts('filler-image');
                    bbn_labels('Recent Blogs');
                    bbn_callouts('recent-blogs');
                    ?>
                </div>
            </div>
        </div>
<?php get_footer(); ?>