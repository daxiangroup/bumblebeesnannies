<?php
    $type  = esc_attr(get_post_meta($object->ID, 'jv-type', true));
    $month = esc_attr(get_post_meta($object->ID, 'jv-start-month', true));
    $day   = esc_attr(get_post_meta($object->ID, 'jv-start-day', true));
    $year  = esc_attr(get_post_meta($object->ID, 'jv-start-year', true));
?>
<?php wp_nonce_field( basename( __FILE__ ), 'job-vacancy-nonce' ); ?>
<div class="top">
    <div>
        <label><?php echo _e("Type"); ?></label><br />
        <input type="radio" id="jv-type-1" name="jv-type" value="1"<?php echo ($type == '1' || empty($type) ? ' checked' : ''); ?> />
        <label class="radio" for="jv-type-1">Full Time</label>
        <input type="radio" id="jv-type-2" name="jv-type" value="2"<?php echo ($type == '2' ? ' checked' : ''); ?> />
        <label class="radio" for="jv-type-2">Part Time</label>
        <input type="radio" id="jv-type-3" name="jv-type" value="3"<?php echo ($type == '3' ? ' checked' : ''); ?> />
        <label class="radio" for="jv-type-3">After School Care</label>
        <!--
        <input type="radio" id="jv-type-4" name="jv-type" value="4"<?php echo ($type == '4' ? ' checked' : ''); ?> />
        <label class="radio" for="jv-type-4">Mother's Help</label>
        -->
    </div>

    <div class="left">
        <div>
            <label for="jv-position"><?php echo _e("Position"); ?></label><br />
            <input type="text" id="jv-position" name="jv-position" value="<?php echo esc_attr(get_post_meta($object->ID, 'jv-position', true)); ?>" size="25" />
        </div>

        <div>
            <label for="jv-start-month"><?php echo _e("Start Date"); ?></label><br />
            <select id="jv-start-month" name="jv-start-month">
                <option value="">--</option>
                <?php for ($i=1; $i<=12; $i++) {
                    echo '<option value="'.($i<10 ? '0'.$i : $i).'"'.($month == $i ? ' selected' : '').'>'.date("F", strtotime('2000-'.$i.'-01')).'</option>';
                } ?>
            </select>
            <select id="jv-start-day" name="jv-start-day">
                <option value="">--</option>
                <?php for ($i=1; $i<=31; $i++) {
                    echo '<option value="'.($i<10 ? '0'.$i : $i).'"'.($day == $i ? ' selected' : '').'>'.($i<10 ? '0'.$i : $i).'</option>';
                } ?>
            </select>
            <select id="jv-start-year" name="jv-start-year">
                <option value="">--</option>
                <?php for ($i=date("Y"); $i<=date("Y")+1; $i++) {
                    echo '<option vlaue="'.$i.'"'.($year == $i ? ' selected' : '').'>'.$i.'</option>';
                } ?>
            </select>
        </div>

        <div>
            <label for="jv-location"><?php echo _e("Location"); ?></label><br />
            <input type="text" id="jv-location" name="jv-location" value="<?php echo esc_attr(get_post_meta($object->ID, 'jv-location', true)); ?>" size="25" />
        </div>
    </div>

    <div class="right">
        <div>
            <label for="jv-hours"><?php echo _e("Hours"); ?></label><br />
            <input type="text" id="jv-hours" name="jv-hours" value="<?php echo esc_attr(get_post_meta($object->ID, 'jv-hours', true)); ?>" size="25" />
        </div>

        <div>
            <label for="jv-salary"><?php echo _e("Salary/Wages"); ?></label><br />
            <input type="text" id="jv-salary" name="jv-salary" value="<?php echo esc_attr(get_post_meta($object->ID, 'jv-salary', true)); ?>" size="25" />
        </div>

        <div>
            <label for="jv-num-children"><?php echo _e("Number Of Children"); ?></label><br />
            <input type="text" id="jv-num-children" name="jv-num-children" value="<?php echo esc_attr(get_post_meta($object->ID, 'jv-num-children', true)); ?>" size="25" />
        </div>
    </div>
</div>

<div class="bottom">
    <div>
        <label for="jv-qualifications"><?php echo _e("Qualifications Needed"); ?></label><br />
        <textarea id="jv-qualifications" name="jv-qualifications"><?php echo esc_attr(get_post_meta($object->ID, 'jv-qualifications', true)); ?></textarea>
    </div>

    <div>
        <label for="jv-responsibilities"><?php echo _e("Responsibilities"); ?></label><br />
        <textarea id="jv-responsibilities" name="jv-responsibilities"><?php echo esc_attr(get_post_meta($object->ID, 'jv-responsibilities', true)); ?></textarea>
    </div>

    <div>
        <label for="jv-expectations"><?php echo _e("Expectations"); ?></label><br />
        <textarea id="jv-expectations" name="jv-expectations"><?php echo esc_attr(get_post_meta($object->ID, 'jv-expectations', true)); ?></textarea>
    </div>
</div>