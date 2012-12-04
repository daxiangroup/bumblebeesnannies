<?php get_header(); ?>
        <div id="container">
            <div id="content">
                <div id="body">

                    <h2 class="entry-title"><?php echo bbn_get_post($post->id, 'post_title'); ?></h2>

<?php if (bbn_check_active_state('job', $_GET['jid'])) { ?>
                    <?php echo bbn_get_post($post->id, 'post_content'); ?>

                    <form id="frm-job-contact" action="<?php echo get_bloginfo('url'); ?>/submit/contact-job.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="jid" value="<?php echo $_GET['jid']; ?>" />

                    <div id="cntr-job-contact-form">
                        <h4 id="section-contact">Contact &amp; Details</h4>
                        <div class="contact left">
                            <div class="field">
                                <label for="job-fullname">Full Name<span class="req">*</span></label>
                                <input name="job-fullname" id="job-fullname" type="text" class="required" data-label="Full Name" data-section="contact" />
                            </div>
                            <div class="field">
                                <label for="job-email">Email Address<span class="req">*</span></label>
                                <input name="job-email" id="job-email" type="text" class="required" data-label="Email Address" data-section="contact" />
                            </div>
                        </div>
                        <div class="contact right">
                            <div class="field">
                                <label for="job-intersection">Closest Intersection<span class="req">*</span></label>
                                <input name="job-intersection" id="job-intersection" type="text" class="required" data-label="Closest Intersection" data-section="contact" />
                            </div>
                            <div class="field">
                                <label for="job-age">Age of Your Child/ren<span class="req">*</span></label>
                                <input name="job-age" id="job-age" type="text" class="required" data-label="Age of Your Child/ren" data-section="contact" />
                            </div>
                        </div>
                        <div class="field start-date">
                            <label>Start Date<span class="req">*</span></label>
                            <select id="job-start-month" name="job-start-month">
                                <option value="">--</option>
                                <?php for ($i=1; $i<=12; $i++) {
                                    echo '<option value="'.($i<10 ? '0'.$i : $i).'"'.($month == $i ? ' selected' : '').'>'.date("F", strtotime('2000-'.$i.'-01')).'</option>';
                                } ?>
                            </select>
                            <select id="job-start-day" name="job-start-day">
                                <option value="">--</option>
                                <?php for ($i=1; $i<=31; $i++) {
                                    echo '<option value="'.($i<10 ? '0'.$i : $i).'"'.($day == $i ? ' selected' : '').'>'.($i<10 ? '0'.$i : $i).'</option>';
                                } ?>
                            </select>
                            <select id="job-start-year" name="job-start-year">
                                <option value="">--</option>
                                <?php for ($i=date("Y"); $i<=date("Y")+1; $i++) {
                                    echo '<option vlaue="'.$i.'"'.($year == $i ? ' selected' : '').'>'.$i.'</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="field days">
                            <?php echo _e('Days'); ?><span class="req">*</span><br />
                            <input type="checkbox" name="job-days[1]" id="days-1" data-input="day-input-1" value="1"><label class="checkbox" for="days-1">Sunday</label>
                            <input type="checkbox" name="job-days[2]" id="days-2" data-input="day-input-2" value="1"><label class="checkbox" for="days-2">Monday</label>
                            <input type="checkbox" name="job-days[3]" id="days-3" data-input="day-input-3" value="1"><label class="checkbox" for="days-3">Tuesday</label>
                            <input type="checkbox" name="job-days[4]" id="days-4" data-input="day-input-4" value="1"><label class="checkbox" for="days-4">Wednesday</label>
                            <input type="checkbox" name="job-days[5]" id="days-5" data-input="day-input-5" value="1"><label class="checkbox" for="days-5">Thursday</label>
                            <input type="checkbox" name="job-days[6]" id="days-6" data-input="day-input-6" value="1"><label class="checkbox" for="days-6">Friday</label>
                            <input type="checkbox" name="job-days[7]" id="days-7" data-input="day-input-7" value="1"><label class="checkbox" for="days-7">Saturday</label>
                        </div>
                        <div class="field hours">
                            <?php echo _e('Hours'); ?><span class="req">*</span><br />
                            <div id="day-input-1">
                                <label for="">Sunday</label>
                                <input type="text" id="job-hours-1" name="job-hours[1]" />
                            </div>
                            <div id="day-input-2">
                                <label for="">Monday</label>
                                <input type="text" id="job-hours-2" name="job-hours[2]" />
                            </div>
                            <div id="day-input-3">
                                <label for="">Tuesday</label>
                                <input type="text" id="job-hours-3" name="job-hours[3]" />
                            </div>
                            <div id="day-input-4">
                                <label for="">Wednesday</label>
                                <input type="text" id="job-hours-4" name="job-hours[4]" />
                            </div>
                            <div id="day-input-5">
                                <label for="">Thursday</label>
                                <input type="text" id="job-hours-5" name="job-hours[5]" />
                            </div>
                            <div id="day-input-6">
                                <label for="">Friday</label>
                                <input type="text" id="job-hours-6" name="job-hours[6]" />
                            </div>
                            <div id="day-input-7">
                                <label for="">Saturday</label>
                                <input type="text" id="job-hours-7" name="job-hours[7]" />
                            </div>
                        </div>                        

                        <div class="controls">
                            <button class="btn btn-primary">Contact Family</button>
                        </div>
                    </div>
                    </form>
<?php } else { ?>
                    <div class="centered">The Job you are trying to contact about is not availble</div>
<?php } ?>
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