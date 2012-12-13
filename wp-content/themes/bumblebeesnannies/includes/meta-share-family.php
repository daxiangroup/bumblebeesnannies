<?php
    $type  = esc_attr(get_post_meta($object->ID, 'ns-family-type', true));
    $month = esc_attr(get_post_meta($object->ID, 'ns-family-start-month', true));
    $day   = esc_attr(get_post_meta($object->ID, 'ns-family-start-day', true));
    $year  = esc_attr(get_post_meta($object->ID, 'ns-family-start-year', true));
    $days  = unserialize(get_post_meta($object->ID, 'ns-family-days', true));
    $hours = unserialize(get_post_meta($object->ID, 'ns-family-hours', true));
?>
<?php wp_nonce_field( basename( __FILE__ ), 'share-family-nonce' ); ?>
<div>
    <label><?php echo _e("We Are A Family Who"); ?></label><br />
    <input type="radio" id="ns-family-type-1" name="ns-family-type" value="1"<?php echo ($type == '1' || empty($type) ? ' checked' : ''); ?> />
    <label class="radio" for="ns-family-type-1">Has A Nanny To Share</label>
    <input type="radio" id="ns-family-type-2" name="ns-family-type" value="2"<?php echo ($type == '2' ? ' checked' : ''); ?> />
    <label class="radio" for="ns-family-type-2">Looking For A Shared Nanny</label>
</div>

<div>
    <label for="ns-family-intersection"><?php echo _e("Closest Intersection"); ?></label><br />
    <input type="text" id="ns-family-intersection" name="ns-family-intersection" value="<?php echo esc_attr(get_post_meta($object->ID, 'ns-family-intersection', true)); ?>" size="25" />
</div>

<div>
    <label for="ns-family-start-month"><?php echo _e("Start Date"); ?></label><br />
    <select id="ns-family-start-month" name="ns-family-start-month">
        <option value="">--</option>
        <?php for ($i=1; $i<=12; $i++) {
            echo '<option value="'.($i<10 ? '0'.$i : $i).'"'.($month == $i ? ' selected' : '').'>'.date("F", strtotime('2000-'.$i.'-01')).'</option>';
        } ?>
    </select>
    <select id="ns-family-start-day" name="ns-family-start-day">
        <option value="">--</option>
        <?php for ($i=1; $i<=31; $i++) {
            echo '<option value="'.($i<10 ? '0'.$i : $i).'"'.($day == $i ? ' selected' : '').'>'.($i<10 ? '0'.$i : $i).'</option>';
        } ?>
    </select>
    <select id="ns-family-start-year" name="ns-family-start-year">
        <option value="">--</option>
        <?php for ($i=date("Y"); $i<=date("Y")+1; $i++) {
            echo '<option vlaue="'.$i.'"'.($year == $i ? ' selected' : '').'>'.$i.'</option>';
        } ?>
    </select>
</div>

<div>
    <label for="ns-family-age"><?php echo _e('Age of your Child/ren'); ?></label><br />
    <input type="text" id="ns-family-age" name="ns-family-age" value="<?php echo esc_attr(get_post_meta($object->ID, 'ns-family-age', true)); ?>" />
</div>

<div class="day-select">
    <label><?php echo _e('Days'); ?></label><br />
    <!--<input type="checkbox" name="ns-family-days[1]" id="days-1" data-input="day-input-1" value="1"<?php echo ($days[1] ? ' checked' : ''); ?>><label class="checkbox" for="days-1">Sunday</label>-->
    <input type="checkbox" name="ns-family-days[2]" id="days-2" data-input="day-input-2" value="1"<?php echo ($days[2] ? ' checked' : ''); ?>><label class="checkbox" for="days-2">Monday</label>
    <input type="checkbox" name="ns-family-days[3]" id="days-3" data-input="day-input-3" value="1"<?php echo ($days[3] ? ' checked' : ''); ?>><label class="checkbox" for="days-3">Tuesday</label>
    <input type="checkbox" name="ns-family-days[4]" id="days-4" data-input="day-input-4" value="1"<?php echo ($days[4] ? ' checked' : ''); ?>><label class="checkbox" for="days-4">Wednesday</label>
    <input type="checkbox" name="ns-family-days[5]" id="days-5" data-input="day-input-5" value="1"<?php echo ($days[5] ? ' checked' : ''); ?>><label class="checkbox" for="days-5">Thursday</label>
    <input type="checkbox" name="ns-family-days[6]" id="days-6" data-input="day-input-6" value="1"<?php echo ($days[6] ? ' checked' : ''); ?>><label class="checkbox" for="days-6">Friday</label>
    <!--<input type="checkbox" name="ns-family-days[7]" id="days-7" data-input="day-input-7" value="1"<?php echo ($days[7] ? ' checked' : ''); ?>><label class="checkbox" for="days-7">Saturday</label>-->
</div>

<div class="day-input">
    <label><?php echo _e('Hours'); ?></label><br />
    <!--
    <div id="day-input-1">
        <label for="">Sunday</label>
        <input type="text" id="ns-family-hours-1" name="ns-family-hours[1]" value="<?php echo $hours[1]; ?>" />
    </div>
    -->
    <div id="day-input-2">
        <label for="">Monday</label>
        <input type="text" id="ns-family-hours-2" name="ns-family-hours[2]" value="<?php echo $hours[2]; ?>" />
    </div>
    <div id="day-input-3">
        <label for="">Tuesday</label>
        <input type="text" id="ns-family-hours-3" name="ns-family-hours[3]" value="<?php echo $hours[3]; ?>" />
    </div>
    <div id="day-input-4">
        <label for="">Wednesday</label>
        <input type="text" id="ns-family-hours-4" name="ns-family-hours[4]" value="<?php echo $hours[4]; ?>" />
    </div>
    <div id="day-input-5">
        <label for="">Thursday</label>
        <input type="text" id="ns-family-hours-5" name="ns-family-hours[5]" value="<?php echo $hours[5]; ?>" />
    </div>
    <div id="day-input-6">
        <label for="">Friday</label>
        <input type="text" id="ns-family-hours-6" name="ns-family-hours[6]" value="<?php echo $hours[6]; ?>" />
    </div>
    <!--
    <div id="day-input-7">
        <label for="">Saturday</label>
        <input type="text" id="ns-family-hours-7" name="ns-family-hours[7]" value="<?php echo $hours[7]; ?>" />
    </div>
    -->
</div>










