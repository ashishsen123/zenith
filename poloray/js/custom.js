//Menu Init
ddsmoothmenu.init({
	mainmenuid: "menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
});

//Flexslider
//<![CDATA[
 var $j = jQuery.noConflict();
    $j("document").ready(function(){
    $j('.flexslider').flexslider();
});
//]]>  

//Fade lense
jQuery(document).ready(function(){
    jQuery(".fade").hover(function() {
        jQuery(this).stop().animate({
            opacity: "1"
        }, '500');
    },
    function() {
        jQuery(this).stop().animate({
            opacity: "0"
        }, '500');
    });
});

//Cufon replacement
Cufon.replace('h1',{hover: true})('h2',{hover: true})('h3',{hover: true})('h4',{hover: true})('h5',{hover: true})('h6',{hover: true})('.contentbtn')('.content_info')('.readmore',{hover: true})('.submit',{hover: true});


