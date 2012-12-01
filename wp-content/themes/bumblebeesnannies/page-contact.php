<?php
    wp_enqueue_script('googlemaps', 'http://maps.google.com/maps/api/js?sensor=false&amp;language=en', 'jquery', false, true);
    wp_enqueue_script('gmap3', get_bloginfo('template_url').'/gmap3.min.js', 'googlemaps', false, true);

    wp_enqueue_script('gmap3', 'http://maps.google.com/maps/api/js?sensor=false&amp;language=en', 'jquery', false, true);
?>
<?php get_header(); ?>
        <div id="container" class="<?php echo bbn_slug_classes(); ?>">
            <div id="content">
                <div id="body">

                    <h2 class="entry-title"><?php echo bbn_get_post($post->id, 'post_title'); ?></h2>
                    <?php echo bbn_get_post($post->id, 'post_content'); ?>                    

                    <form id="frm-contact" action="<?php echo get_bloginfo('url'); ?>/submit/contact.php" method="post">
                    <div id="cntr-contact-form">
                        <div class="field">
                            <label for="con-fullname">Full Name<span class="req">*</span></label>
                            <input name="con-fullname" id="con-fullname" type="text" class="required" data-label="Full Name" data-section="contact" />
                        </div>
                        <div class="field">
                            <label for="con-email">Email Address<span class="req">*</span></label>
                            <input name="con-email" id="con-email" type="text" class="required" data-label="Email Address" data-section="contact" />
                        </div>
                        <div class="field">
                            <label for="con-subject">Subject<span class="req">*</span></label>
                            <input name="con-subject" id="con-subject" type="text" class="required" data-label="Subject" data-section="contact" />
                        </div>
                        <div class="field">
                            <label for="con-message">Message<span class="req">*</span></label>
                            <textarea name="con-message" id="con-message" class="required" data-label="Message" data-section="contact"></textarea>
                        </div>
                        <div class="field">
                            <label></label>
                            <button class="btn btn-primary">Send</button>
                        </div>
                    </div>
                    </form>
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