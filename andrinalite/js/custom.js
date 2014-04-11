//Menu
ddsmoothmenu.init({
    mainmenuid: "menu", //menu DIV id
    orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
    classname: 'ddsmoothmenu', //class added to menu's outer DIV
    //customtheme: ["#1c5a80", "#18374a"],
    contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
});
//cufone
Cufon.replace({
    hover: true
})('#colRight h2')('.reply',{
    hover:true
})('h1')('h2')('h3')('h4')('h5')('h6');
//Fade images
jQuery(document).ready(function(){
    jQuery(".feature-item img, .post img, .sidebar img .recent_post li img").hover(function() {
        jQuery(this).stop().animate({
            opacity: "0.6"
        }, '5000');
    },
    function() {
        jQuery(this).stop().animate({
            opacity: "1.0"
        }, '100');
    });
});
//Fade images
jQuery(document).ready(function(){
    jQuery(".thumbnail li a img").hover(function() {
        jQuery(this).stop().animate({
            opacity: "1.0"
        }, '5000');
    },
    function() {
        jQuery(this).stop().animate({
            opacity: "0.6"
        }, '100');
    });
});
//Gallery Thumbnail Zoombox
jQuery(function(){
    jQuery('a.zoombox').zoombox();
});
//Slider
jQuery(function(){
    jQuery('#slides').slides({
        preload: true,
        preloadImage: 'images/loading.gif',
        autoHeight: false,
        effect: 'fade',
        container: 'slides_container',
        play: 6000,
        slideSpeed: 700,
        fadeSpeed: 650,		
        crossfade: true,
        hoverPause: true,
        "pause":3500,
        animationStart: function(current){
            jQuery('.caption').animate({
                bottom:-150
            },300);
            if (window.console && console.log) {
                // example return of current slide number
                console.log('animationStart on slide: ', current);
            };
        },
        animationComplete: function(current){
            jQuery('.caption').animate({
                bottom:30
            },300);
            if (window.console && console.log) {
                // example return of current slide number
                console.log('animationComplete on slide: ', current);
            };
        },
        slidesLoaded: function() {
            jQuery('.caption').animate({
                bottom:30
            },300);
        }
    });
});
//Contact validate
jQuery(document).ready(function(){
	jQuery("#contactForm").validate();
});