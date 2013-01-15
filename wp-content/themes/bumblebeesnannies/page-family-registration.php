<?php get_header(); ?>        
        <div id="container" class="<?php echo bbn_slug_classes(); ?>">
            <div id="content">
                <div id="body">

                    <?php if (isset($_GET['se']) && $_GET['se'] == '1') { ?>
                    <div class="alert alert-error">
                        <h4>Submission Error</h4>
                        We're sorry, there was an error submitting your registration. Please try again, or get in <a href="<?php echo site_url('/contact'); ?>">contact</a> with us.
                    </div>
                    <?php } ?>

                    <h2 class="entry-title">Family Registration Form</h2>
                    <?php echo bbn_get_post($post->id, 'post_content'); ?>

                    <form id="frm-family-registration" action="<?php echo get_bloginfo('url'); ?>/submit/family-registration.php" method="post" enctype="multipart/form-data">
                    <?php wp_nonce_field('family-registration'); ?>
                    <div id="cntr-family-registration-form">
                        <h4 id="section-contact">Contact Details</h4>
                        <div class="contact left">
                            <div class="field">
                                <label for="frf-fullname">Full Name<span class="req">*</span></label>
                                <input name="frf-fullname" id="frf-fullname" type="text" class="required" data-label="Full Name" data-section="contact" />
                            </div>
                            <div class="field">
                                <label for="frf-email">Email Address<span class="req">*</span></label>
                                <input name="frf-email" id="frf-email" type="text" class="required" data-label="Email Address" data-section="contact" />
                            </div>
                        </div>
                        <div class="contact right">
                            <div class="field">
                                <label for="frf-postal-code">Postal Code<span class="req">*</span></label>
                                <input name="frf-postal-code" id="frf-postal-code" type="text" class="required" data-label="Postal Code" data-section="contact" />
                            </div>
                            <div class="field">
                                <label for="frf-contact-number">Contact Number<span class="req">*</span></label>
                                <input name="frf-contact-number" id="frf-contact-number" type="text" class="required" data-label="Contact Number" data-section="contact" />
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <h4 id="section-requirements">Requirements</h4>
                        Please select all options that apply. At least one selection is required:
                        <div class="clearfix"></div>
                        <div class="requirements left">
                            <label for="frf-cbx-nanny">Nanny</label>
                            <input name="frf-cbx-position[nanny]" id="frf-cbx-nanny" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="frf-cbx-nanny-share">Nanny Share</label>
                            <input name="frf-cbx-position[nanny-share]" id="frf-cbx-nanny-share" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="frf-cbx-after-school">After School Care</label>
                            <input name="frf-cbx-position[after-school]" id="frf-cbx-after-school" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="frf-cbx-emergency-babysitting">Emergency Babysitting</label>
                            <input name="frf-cbx-position[emergency-babysitting]" id="frf-cbx-emergency-babysitting" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="frf-cbx-live-out">Live Out</label>
                            <input name="frf-cbx-position[live-out]" id="frf-cbx-live-out" value="1" type="checkbox" />
                        </div>
                        <div class="requirements right">
                            <label for="frf-cbx-permanent">Permanent</label>
                            <input name="frf-cbx-position[permanent]" id="frf-cbx-permanent" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="frf-cbx-temporary">Temporary</label>
                            <input name="frf-cbx-position[temporary]" id="frf-cbx-temporary" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="frf-cbx-full-time">Full-Time</label>
                            <input name="frf-cbx-position[full-time]" id="frf-cbx-full-time" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="frf-cbx-part-time">Part-Time</label>
                            <input name="frf-cbx-position[part-time]" id="frf-cbx-part-time" value="1" type="checkbox" />
                        </div>

                        <div class="clearfix"></div>
                        <h4 id="section-details">Details</h4>
                        <div class="details">
                            <label for="">Ages of Children</label>
                            <input name="frf-age-of-children" id="frf-age-of-children" type="text" class="required" data-label="Age of Children" data-section="details" />
                            <div class="clearfix"></div>

                            <label for="">Start Date</label>
                            <input name="frf-start-date" id="frf-start-date" type="text" class="required" data-label="Start Date" data-section="details" />
                            <div class="clearfix"></div>

                            <label>Minimum Nanny Experience</label>
                            <select name="frf-years-experience" id="frf-years-experience" class="required" data-label="Years of Experience" data-section="details">
                                <option value="">--</option>
                                <option value="1 Year">1 Year</option>
                                <option value="2 Years">2 Years</option>
                                <option value="3 Years">3 Years</option>
                                <option value="4 Years">4 Years</option>
                                <option value="5 Years">5 Years</option>
                                <option value="6-10 Years">6 to 10 Years</option>
                                <option value="11-15 Years">11 to 15 Years</option>
                                <option value="16-20 Years">16 to 20 Years</option>
                                <option value="20+">More Than 20 Years</option>
                            </select>
                        </div>

                        <h4 id="section-where-heard">Where Did You Find Out About Bumble Bees Nannies?</h4>
                        Please select at least one option:<br />
                        <div class="where-heard left">
                            <label for="frf-cbx-todays-parent">Today's Parent</label>
                            <input name="frf-cbx-heard[todays-parent]" id="frf-cbx-todays-parent" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="frf-cbx-little-paper">The Little Paper</label>
                            <input name="frf-cbx-heard[little-paper]" id="frf-cbx-little-paper" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="frf-cbx-help-kids">Help We've Got Kids</label>
                            <input name="frf-cbx-heard[help-kids]" id="frf-cbx-help-kids" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="frf-cbx-yelp">Yelp</label>
                            <input name="frf-cbx-heard[yelp]" id="frf-cbx-yelp" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                        </div>
                        <div class="where-heard right">
                            <label for="frf-google-search">Google Search</label>
                            <input name="frf-google-search" id="frf-google-search" type="text" />
                            <div class="clearfix"></div>
                            <label for="frf-recommendation">Recommendation</label>
                            <input name="frf-recommendation" id="frf-recommendation" type="text" />
                            <div class="clearfix"></div>
                            <label for="frf-other">Other</label>
                            <input name="frf-other" id="frf-other" type="text" />
                            <div class="clearfix"></div>
                        </div>

                        <div class="clearfix"></div>
                        <br />
                        <input type="submit" value="Submit Registration" class="btn btn-primary" />
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