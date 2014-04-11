jQuery(document).ready(function() {
	jQuery('.sidebar-nav>li:last-child').addClass('bot');
	jQuery('.sidebar-nav>li:first-child').addClass('top');
	jQuery('.hot-news ul li:last-child').css("border","none");
	jQuery('.slider').slidesjs({
		fade: {
			speed: 500,
			crossfade: true
		  },
		navigation: {
      		active: false,
			effect: "fade"
		},
		pagination: {
		  active: true,
		  effect: "fade"
		},
		play: {
		  active: false,
		  effect: "fade",
		  interval: 7000,
		  auto: true,
		  swap: false,
		  pauseOnHover: true,
		  restartDelay: 6000
		},
	});
});