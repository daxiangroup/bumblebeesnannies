jQuery(document).ready(function() {
    jQuery('div.day-select input[type="checkbox"]').each(function() {
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
});