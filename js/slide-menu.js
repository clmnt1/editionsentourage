jQuery.fn.slideMenu = function(direction) {

	var control = jQuery(this).find('.slidemenu-control');
	var menu = jQuery(this).find('.slidemenu-menu');
	
	jQuery(this).addClass('slidemenu-'+direction);

	menu.append('<div class="slidemenu-close"></div>');
	
	var closeBtn = menu.find('.slidemenu-close');

	control.click(function() {
		jQuery('.slidemenu-menu').each(function() {
			if(jQuery(this).hasClass('active')) {
				jQuery(this).removeClass('active');
			}
		});
		
		if(!menu.hasClass('active')){
			menu.addClass('active');
		}else {
			menu.removeClass('active');
		}
		
		return false;
	});
	
	jQuery(document).click(function(event){
		if(jQuery(event.target).closest('.slidemenu-menu').length < 1) {
			menu.removeClass('active');
		}
	});

	closeBtn.click(function() {
		menu.removeClass('active');
	});

    return this;
}
 