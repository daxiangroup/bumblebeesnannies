<?php get_header(); ?>        
        <div id="container">
            <div id="content">
                <div id="body" class="job-vacancies">

                    <h2 class="entry-title"><?php echo bbn_get_post($post->id, 'post_title'); ?></h2>
                    <?php echo bbn_get_post($post->id, 'post_content'); ?>

                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $job_vacancies = new WP_query(array(
                        'post_type' => 'job_vacancy',
                        'meta_key' => 'jv-type',
                        'meta_value' => '4',                        
                        'orderby' => 'ID',
                        'order' => 'ASC',
                        'posts_per_page' => JOB_POSTS_PER_PAGE,
                        'paged' => $paged,
                    ));

                    bbn_job_vacancies($job_vacancies);

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