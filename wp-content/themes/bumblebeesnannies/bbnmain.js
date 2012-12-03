jQuery(document).ready(function() {
    jQuery('#frm-caregivers-registration').submit(function() {
        return caregiver_validation();
    });

    jQuery('#frm-family-registration').submit(function() { return family_validation(); });
    jQuery('#frm-ns-contact').submit(function() { return ns_contact_validation(); });
    jQuery('#frm-job-contact').submit(function() { return job_contact_validation(); });
    jQuery('#frm-contact').submit(function() { return contact_validation(); });

    if (jQuery('#cntr-map').length) {
        init_contact_map();
    }

    init_share_buttons();
    init_job_buttons();
    init_contact_toggles();
    reset_submenus();
});

function init_contact_map() {
    jQuery('#cntr-map').gmap3({
        map:{
            options:{
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: true,
                mapTypeControlOptions:{
                    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                },
                center:[43.663576,-79.340934],
                zoom:15,
                navigationControl: true,
                scrollwheel: false,
                streetViewControl: true
            }
        },        
        marker:{
            latLng:[43.663576,-79.340934]
        },
    });
}

function reset_submenus() {
    var i = 1;
    jQuery('#menu-main-navigation > li').each(function() {
        jQuery(this).addClass('menu-item-position-' + i);
        i += 1;
    });

    jQuery('#menu-main-navigation ul.sub-menu').each(function() {
        jQuery(this).find('li').first().addClass('first-menu-item');
    });
}

function contact_validation() {
    var retval = true;
    var messages = [];

    jQuery('#cntr-contact-form .required').each(function() {
        if (jQuery(this).val() == '') {
            messages.push('The <a href="#section-' + jQuery(this).data('section') + '">' + jQuery(this).data('label') + '</a> field is required');
            retval = false;
        }
    });

    if (!retval) {
        error_messages(messages);
    }

    return retval;
}

function ns_contact_validation() {
    var retval = true;
    var messages = [];

    jQuery('#cntr-ns-contact-form .required').each(function() {
        if (jQuery(this).val() == '') {
            messages.push('The <a href="#section-' + jQuery(this).data('section') + '">' + jQuery(this).data('label') + '</a> field is required');
            retval = false;
        }
    });

    if (jQuery('#ns-start-month').val() == '' || jQuery('#ns-start-day').val() == '' || jQuery('#ns-start-year').val() == '') {
        messages.push('The <a href="#section-contact">Start Date</a> must be selected in full');
        retval = false;
    }

    if (!jQuery('#days-1').prop('checked') && !jQuery('#days-2').prop('checked') && !jQuery('#days-3').prop('checked') &&
        !jQuery('#days-4').prop('checked') && !jQuery('#days-5').prop('checked') && !jQuery('#days-6').prop('checked') &&
        !jQuery('#days-7').prop('checked')
    ) {
        messages.push('One of the <a href="#section-contact">Days</a> are required');
        retval = false;
    }

    if ((jQuery('#days-1').prop('checked') && jQuery('#ns-hours-1').val() == '') ||
        (jQuery('#days-2').prop('checked') && jQuery('#ns-hours-2').val() == '') ||
        (jQuery('#days-3').prop('checked') && jQuery('#ns-hours-3').val() == '') ||
        (jQuery('#days-4').prop('checked') && jQuery('#ns-hours-4').val() == '') ||
        (jQuery('#days-5').prop('checked') && jQuery('#ns-hours-5').val() == '') ||
        (jQuery('#days-6').prop('checked') && jQuery('#ns-hours-6').val() == '') ||
        (jQuery('#days-7').prop('checked') && jQuery('#ns-hours-7').val() == '')
    ) {
        messages.push('<a href="#section-contact">Hours</a> must be supplied for selected Days');
        retval = false;
    }


    if (!retval) {
        error_messages(messages);
    }

    return retval;        
}

function job_contact_validation() {
    var retval = true;
    var messages = [];

    jQuery('#cntr-job-contact-form .required').each(function() {
        if (jQuery(this).val() == '') {
            messages.push('The <a href="#section-' + jQuery(this).data('section') + '">' + jQuery(this).data('label') + '</a> field is required');
            retval = false;
        }
    });

    if (jQuery('#job-start-month').val() == '' || jQuery('#job-start-day').val() == '' || jQuery('#job-start-year').val() == '') {
        messages.push('The <a href="#section-contact">Start Date</a> must be selected in full');
        retval = false;
    }

    if (!jQuery('#days-1').prop('checked') && !jQuery('#days-2').prop('checked') && !jQuery('#days-3').prop('checked') &&
        !jQuery('#days-4').prop('checked') && !jQuery('#days-5').prop('checked') && !jQuery('#days-6').prop('checked') &&
        !jQuery('#days-7').prop('checked')
    ) {
        messages.push('One of the <a href="#section-contact">Days</a> are required');
        retval = false;
    }

    if ((jQuery('#days-1').prop('checked') && jQuery('#ns-hours-1').val() == '') ||
        (jQuery('#days-2').prop('checked') && jQuery('#ns-hours-2').val() == '') ||
        (jQuery('#days-3').prop('checked') && jQuery('#ns-hours-3').val() == '') ||
        (jQuery('#days-4').prop('checked') && jQuery('#ns-hours-4').val() == '') ||
        (jQuery('#days-5').prop('checked') && jQuery('#ns-hours-5').val() == '') ||
        (jQuery('#days-6').prop('checked') && jQuery('#ns-hours-6').val() == '') ||
        (jQuery('#days-7').prop('checked') && jQuery('#ns-hours-7').val() == '')
    ) {
        messages.push('<a href="#section-contact">Hours</a> must be supplied for selected Days');
        retval = false;
    }


    if (!retval) {
        error_messages(messages);
    }

    return retval;        
}

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
        error_messages(messages);
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

/*------------------------------------------------------------------------------
 | error_messages
 |------------------------------------------------------------------------------
 | Parses through error message generated by the variuos validation functions
 | and displays them in a nice box at the top of the page. It will scroll the page
 | up to the box after it's done prepending it do the DOM.
 |
 | @param messages - An array of messages that need to be displayed
 | @return null
 */
function error_messages(messages) {
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

function init_share_buttons() {
    jQuery('.nanny-share-families-looking .interested-family, .nanny-share-families-sharing .interested-family').each(function() {
        jQuery(this).click(function() {
            var current_location = String(document.location).split('/');
            current_location[(current_location.length-2)] = 'contact-family';
            current_location = current_location.join('/');
            document.location.href = current_location + '?fid=' + jQuery(this).data('family-id');
        });
    });
}

function init_job_buttons() {
    jQuery('.job-vacancies .interested-job').each(function() {
        jQuery(this).click(function() {
            var current_location = String(document.location).split('/');
            current_location[(current_location.length-2)] = 'contact-job';
            current_location = current_location.join('/');
            document.location.href = current_location + '?jid=' + jQuery(this).data('job-id');
        });
    });
}

function init_contact_toggles() {
    jQuery('div.field.days input[type="checkbox"]').each(function() {
        var src = jQuery(this);
        var dst = jQuery('#' + src.data('input'));

        src.click(function() {
            dst.toggle();
            if (!dst.is(':visible')) {
                dst.find('input[type="text"]').val('');
            }
        });
        if (src.is(':checked')) {
            dst.toggle();            
        }
    });

}







