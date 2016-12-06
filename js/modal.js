jQuery.fn.modal = function() {

   jQuery('[data-toggle="modal"]').click(function() {
       var target = jQuery(jQuery(this).attr('data-target'));

       if (!target.hasClass('open')) {
           target.fadeIn('fast');
           target.addClass('open');
       }
    });

    jQuery('.modal').find('[data-dismiss="modal"]').click(function() {
        var target = jQuery("#"+jQuery(this).closest('.modal').attr('id'));

        if (target.hasClass('open')) {
            target.fadeOut('fast');
            target.removeClass('open');
        }
    });

    jQuery('.attribute-item').click(function() {
        if(!jQuery(this).hasClass('out-of-stock')) {
            var target = jQuery("#"+jQuery(this).closest('.modal').attr('id'));
            var variationValue = jQuery(this).html();
            var variationSelect = jQuery('.variations').find('select');

            jQuery('.attribute-item').removeClass('current-variation');
            jQuery(this).addClass('current-variation');

            if (target.hasClass('open')) {
                target.fadeOut('fast');
                target.removeClass('open');
            }

            variationSelect.find('[value = '+variationValue+']').prop('selected', true).trigger('change');
        }
    });

    return this;
}
