<?php
/*
Template Name: Archive
*/
?>
<?php get_header(); ?>
        <div id="container" class="<?php echo bbn_slug_classes(); ?> archive">
            <div id="content">
                <div id="body">

                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $blogs = new WP_query(array(
                        'post_type' => 'post',
                        'orderby' => 'date',
                        'order' => 'desc',
                        'paged' => $paged,
                    ));
//die('<pre>'.print_r($blogs,true));
                    bbn_blogs($blogs);

	                ?>
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