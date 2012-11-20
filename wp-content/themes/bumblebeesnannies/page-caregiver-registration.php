<?php get_header(); ?>        
        <div id="container">
            <div id="content">
                <div id="body">

                    <h2 class="entry-title">Caregiver Registration Form</h2>
                    <?php echo bbn_get_post($post->id, 'post_content'); ?>

                    <form id="frm-caregivers-registration" action="<?php echo get_bloginfo('url'); ?>/submit/caregiver-registration.php" method="post" enctype="multipart/form-data">
                    <div id="cntr-caregivers-registration-form">
                        <h4 id="section-contact">Contact Details</h4>
                        <div class="contact left">
                            <div class="field">
                                <label for="crf-fullname">Full Name<span class="req">*</span></label>
                                <input name="crf-fullname" id="crf-fullname" type="text" class="required" data-label="Full Name" data-section="contact" />
                            </div>
                            <div class="field">
                                <label for="crf-email">Email Address<span class="req">*</span></label>
                                <input name="crf-email" id="crf-email" type="text" class="required" data-label="Email Address" data-section="contact" />
                            </div>
                        </div>
                        <div class="contact right">
                            <div class="field">
                                <label for="crf-postal-code">Postal Code<span class="req">*</span></label>
                                <input name="crf-postal-code" id="crf-postal-code" type="text" class="required" data-label="Postal Code" data-section="contact" />
                            </div>
                            <div class="field">
                                <label for="crf-contact-number">Contact Number<span class="req">*</span></label>
                                <input name="crf-contact-number" id="crf-contact-number" type="text" class="required" data-label="Contact Number" data-section="contact" />
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <h4 id="section-position">Position</h4>
                        Please select all options that apply. At least one selection is required:
                        <div class="clearfix"></div>
                        <div class="position left">
                            <label for="crf-cbx-nanny">Nanny</label>
                            <input name="crf-cbx-position[nanny]" id="crf-cbx-nanny" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="crf-cbx-nanny-share">Nanny Share</label>
                            <input name="crf-cbx-position[nanny-share]" id="crf-cbx-nanny-share" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="crf-cbx-after-school">After School Care</label>
                            <input name="crf-cbx-position[after-school]" id="crf-cbx-after-school" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="crf-cbx-emergency-babysitting">Emergency Babysitting</label>
                            <input name="crf-cbx-position[emergency-babysitting]" id="crf-cbx-emergency-babysitting" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="crf-cbx-live-out">Live Out</label>
                            <input name="crf-cbx-position[live-out]" id="crf-cbx-live-out" value="1" type="checkbox" />
                        </div>
                        <div class="position right">
                            <label for="crf-cbx-permanent">Permanent</label>
                            <input name="crf-cbx-position[permanent]" id="crf-cbx-permanent" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="crf-cbx-temporary">Temporary</label>
                            <input name="crf-cbx-position[temporary]" id="crf-cbx-temporary" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="crf-cbx-full-time">Full-Time</label>
                            <input name="crf-cbx-position[full-time]" id="crf-cbx-full-time" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="crf-cbx-part-time">Part-Time</label>
                            <input name="crf-cbx-position[part-time]" id="crf-cbx-part-time" value="1" type="checkbox" />
                        </div>

                        <div class="clearfix"></div>
                        <h4 id="section-qualifications">Qualifications</h4>
                        <div class="qualifications">
                            <textarea name="crf-qualifications" id="crf-qualifications" rows="3" cols="40" class="required" data-label="Qualifications" data-section="qualifications"></textarea>
                            <div class="clearfix"></div>
                            <label>Valid First Aid</label>
                            <div class="radio-label">Yes <input name="crf-rdo-first-aid" id="crf-rdo-first-aid-yes" value="1" type="radio" /></div>
                            <div class="radio-label">No <input name="crf-rdo-first-aid" id="crf-rdo-first-aid-no" value="0" type="radio" /></div>
                            <div class="clearfix"></div>
                            <label>Valid Police Check</label>
                            <div class="radio-label">Yes <input name="crf-rdo-police-check" id="crf-rdo-police-check-yes" value="1" type="radio" /></div>
                            <div class="radio-label">No <input name="crf-rdo-police-check" id="crf-rdo-police-check-no" value="0" type="radio" /></div>
                            <div class="clearfix"></div>
                            <label>Drivers License</label>
                            <div class="radio-label">Yes <input name="crf-rdo-drivers-license" id="crf-rdo-drivers-license-yes" value="1" type="radio" /></div>
                            <div class="radio-label">No <input name="crf-rdo-drivers-license" id="crf-rdo-drivers-license-no" value="0" type="radio" /></div>
                            <div class="clearfix"></div>
                            <label>Years of Experience Working With Children</label>
                            <select name="crf-years-experience" id="crf-years-experience" class="required" data-label="Years of Experience" data-section="qualifications">
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
                            <label for="crf-cbx-todays-parent">Today's Parent</label>
                            <input name="crf-cbx-heard[todays-parent]" id="crf-cbx-todays-parent" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="crf-cbx-little-paper">The Little Paper</label>
                            <input name="crf-cbx-heard[little-paper]" id="crf-cbx-little-paper" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="crf-cbx-help-kids">Help We've Got Kids</label>
                            <input name="crf-cbx-heard[help-kids]" id="crf-cbx-help-kids" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="crf-cbx-kijiji">Kijiji</label>
                            <input name="crf-cbx-heard[kijiji]" id="crf-cbx-kijiji" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                            <label for="crf-cbx-yelp">Yelp</label>
                            <input name="crf-cbx-heard[yelp]" id="crf-cbx-yelp" value="1" type="checkbox" />
                            <div class="clearfix"></div>
                        </div>
                        <div class="where-heard right">
                            <label for="crf-google-search">Google Search</label>
                            <input name="crf-google-search" id="crf-google-search" type="text" />
                            <div class="clearfix"></div>
                            <label for="crf-recommendation">Recommendation</label>
                            <input name="crf-recommendation" id="crf-recommendation" type="text" />
                            <div class="clearfix"></div>
                            <label for="crf-other">Other</label>
                            <input name="crf-other" id="crf-other" type="text" />
                            <div class="clearfix"></div>
                        </div>

                        <div class="clearfix"></div>
                        <h4 id="section-resume">Resume</h4>
                        Please provide us with your current resume<span class="req">*</span><br />
                        <input name="crf-resume" id="crf-resume" type="file" />

                        <div class="clearfix"></div>
                        <br />
                        <input type="submit" value="Submit Registration" class="btn btn-primary" />
                    </div>
                    </form>
                </div>
                
                <div id="sidebar">
                    <?php bbn_callouts(); ?>
                    <?php bbn_callouts('sidebar-tagline'); ?>
                </div>
            </div>
        </div>
<?php get_footer(); ?>