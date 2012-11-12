jQuery(document).ready(function() {
    jQuery('#frm-caregivers-registration').submit(function() {
        return caregiver_validation();
    });

    jQuery('#frm-family-registration').submit(function() {
        return family_validation();
    });
});

function caregiver_validation() {
    var retval = true;
    var messages = [];

    jQuery('#cntr-caregivers-registration-form .required').each(function() {
        if (jQuery(this).val() == '') {
            messages.push('The <a href="#section-' + jQuery(this).data('section') + '">' + jQuery(this).data('label') + '</a> field is required');
            retval = false;
        }
    });

    // Positions
    if (!jQuery('#crf-cbx-nanny').prop('checked') && !jQuery('#crf-cbx-nanny-share').prop('checked') &&
        !jQuery('#crf-cbx-after-school').prop('checked') && !jQuery('#crf-cbx-emergency-babysitting').prop('checked') &&
        !jQuery('#crf-cbx-live-out').prop('checked') && !jQuery('#crf-cbx-permanent').prop('checked') &&
        !jQuery('#crf-cbx-temporary').prop('checked') && !jQuery('#crf-cbx-full-time').prop('checked') &&
        !jQuery('#crf-cbx-part-time').prop('checked')
    ) {
        messages.push('One of the <a href="#section-position">Position</a> options are required');
        retval = false;
    }

    // Qualifications
    if (!jQuery('#crf-rdo-first-aid-yes').prop('checked') && !jQuery('#crf-rdo-first-aid-no').prop('checked')) {
        messages.push('The <a href="#section-qualifications">Valid First Aid</a> field is requried');
        retval = false;
    }
    if (!jQuery('#crf-rdo-police-check-yes').prop('checked') && !jQuery('#crf-rdo-police-check-no').prop('checked')) {
        messages.push('The <a href="#section-qualifications">Valid Police Check</a> field is requried');
        retval = false;
    }
    if (!jQuery('#crf-rdo-drivers-license-yes').prop('checked') && !jQuery('#crf-rdo-drivers-license-no').prop('checked')) {
        messages.push('The <a href="#section-qualifications">Drivers License</a> field is requried');
        retval = false;
    }

    // Where Heard
    if (!jQuery('#crf-cbx-todays-parent').prop('checked') && !jQuery('#crf-cbx-little-paper').prop('checked') &&
        !jQuery('#crf-cbx-help-kids').prop('checked') && !jQuery('#crf-cbx-kijiji').prop('checked') &&
        !jQuery('#crf-cbx-yelp').prop('checked') && jQuery('#crf-google-search').val() == '' &&
        jQuery('#crf-recommendation').val() == '' && jQuery('#crf-other').val() == ''
    ) {
        messages.push('One of the <a href="#section-where-heard">Where Did You Find Out About Bumble Bees Nannies</a> options are required');
        retval = false;
    }

    var resume = jQuery('#crf-resume').prop('files')[0];
    if (!resume) {
        messages.push('You must provide us with your current <a href="#section-resume">resume</a>');
        retval = false;
    }


    if (!retval) {
        // Initialize grammar to have one error.
        var grammar = 'an error';
        // If there is more than one error, change the grammar to fit multiple
        // errors.
        if (messages.length > 1) {
            grammar = 'some errors';
        }

        // Create the output that will be prepended to the #body div
        var output = '<div id="form-error-messages" class="alert alert-error"> \
            <strong>Warning!</strong> There seems to be ' + grammar + ' with your submission:<br /><br /> \
            <ul>';
        jQuery.each(messages, function(index, value) {
            output += '<li>' + value + '</li>';
        });
        output += '<ul></div>';

        // Output the actual error messages
        jQuery('#form-error-messages').remove();
        jQuery('#body').prepend(output);
        jQuery('html, body').animate({ scrollTop: 0 });
    }

    return retval;    
}

function family_validation() {
    var retval = true;
    var messages = [];

    jQuery('#cntr-family-registration-form .required').each(function() {
        if (jQuery(this).val() == '') {
            messages.push('The <a href="#section-' + jQuery(this).data('section') + '">' + jQuery(this).data('label') + '</a> field is required');
            retval = false;
        }
    });

    // Positions
    if (!jQuery('#frf-cbx-nanny').prop('checked') && !jQuery('#frf-cbx-nanny-share').prop('checked') &&
        !jQuery('#frf-cbx-after-school').prop('checked') && !jQuery('#frf-cbx-emergency-babysitting').prop('checked') &&
        !jQuery('#frf-cbx-live-out').prop('checked') && !jQuery('#frf-cbx-permanent').prop('checked') &&
        !jQuery('#frf-cbx-temporary').prop('checked') && !jQuery('#frf-cbx-full-time').prop('checked') &&
        !jQuery('#frf-cbx-part-time').prop('checked')
    ) {
        messages.push('One of the <a href="#section-requirements">Requirements</a> options are required');
        retval = false;
    }

    // Where Heard
    if (!jQuery('#frf-cbx-todays-parent').prop('checked') && !jQuery('#frf-cbx-little-paper').prop('checked') &&
        !jQuery('#frf-cbx-help-kids').prop('checked') && !jQuery('#frf-cbx-yelp').prop('checked') &&
        jQuery('#frf-google-search').val() == '' && jQuery('#frf-recommendation').val() == '' &&
        jQuery('#frf-other').val() == ''
    ) {
        messages.push('One of the <a href="#section-where-heard">Where Did You Find Out About Bumble Bees Nannies</a> options are required');
        retval = false;
    }

    if (!retval) {
        // Initialize grammar to have one error.
        var grammar = 'an error';
        // If there is more than one error, change the grammar to fit multiple
        // errors.
        if (messages.length > 1) {
            grammar = 'some errors';
        }

        // Create the output that will be prepended to the #body div
        var output = '<div id="form-error-messages" class="alert alert-error"> \
            <strong>Warning!</strong> There seems to be ' + grammar + ' with your submission:<br /><br /> \
            <ul>';
        jQuery.each(messages, function(index, value) {
            output += '<li>' + value + '</li>';
        });
        output += '<ul></div>';

        // Output the actual error messages
        jQuery('#form-error-messages').remove();
        jQuery('#body').prepend(output);
        jQuery('html, body').animate({ scrollTop: 0 });
    }

    return retval;    
}
