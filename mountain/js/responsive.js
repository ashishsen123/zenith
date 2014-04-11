var ww = document.body.clientWidth;

jQuery(document).ready(function() {
	jQuery(".sidebar-nav li a").each(function() {
		if (jQuery(this).next().length > 0) {
			jQuery(this).addClass("parent");
		};
	})
	
	jQuery("#pull").click(function(e) {
		e.preventDefault();
		jQuery(this).toggleClass("active");
		jQuery(".sidebar-nav").toggle();
	});
	adjustMenu();
})

jQuery(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});

var adjustMenu = function() {
	if (ww < 768) {
		jQuery("#pull").css("display", "block");
		if (!jQuery("#pull").hasClass("active")) {
			jQuery(".sidebar-nav").hide();
		} else {
			jQuery(".sidebar-nav").show();
		}
		jQuery(".sidebar-nav li").unbind('mouseenter mouseleave hover');
		jQuery(".sidebar-nav li a.parent").unbind('click').bind('click', function(e) {
			// must be attached to anchor element to prevent bubbling
			e.preventDefault();
			jQuery(this).parent("li").toggleClass("hover");
		});
	} 
	else if (ww >= 768) { //480
		jQuery("#pull").css("display", "none");
		jQuery(".sidebar-nav").show();
		jQuery(".sidebar-nav li").removeClass("hover");
		jQuery(".sidebar-nav li a").unbind('click');
		jQuery(".sidebar-nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
			// must be attached to li so that mouseleave is not triggered when hover over submenu
			jQuery(this).toggleClass('hover');
		});
	}
}