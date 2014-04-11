<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = 'd5businessline';
	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'd5businessline'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	$options[] = array(
		'name' => 'D5 Business Line Options',
		'type' => 'heading');

	$options[] = array(
		'desc' => '<div class="infohead"><span class="donation">If you like this FREEE Theme You can consider for a small Donation to us. Your Donation will be spent for the Disadvantaged Children and Students. You can visit our <a href="http://d5creation.com/donate/" target="_blank"><strong>DONATION PAGE</strong></a> and Take your decision.</span><br /><br /><span class="donation">Need Moor Features and Options? Try <a href="http://d5creation.com/theme/businessline/" target="_blank"><strong>D5 BUSINESS LINE PRO or EXTEND Version</strong></a>. You can visit the <a href="http://demo.d5creation.com/wp/themes/d5businessline/" target="_blank"><strong>Demo Site</strong></a> to see how the Extend Version is working.</span></div>',
		'type' => 'info');
		
	$options[] = array(
		'name' => 'Front Page Banner Image',
		'desc' => 'Upload an image for the Front Page Banner. 1050px X 400px image is recommended.',
		'id' => 'banner-image',
		'std' => get_template_directory_uri() . '/images/slide-image/slide-image1.jpg',
		'type' => 'upload');	
		
	$options[] = array(
		'name' => 'Front Page Banner Image',
		'desc' => 'Upload an image for the Front Page Banner. 1050px X 400px image is recommended. Leave this box blank if you want one Banner Image without sliding.',
		'id' => 'banner-iimage',
		'std' => get_template_directory_uri() . '/images/slide-image/slide-image2.jpg',
		'type' => 'upload');	
		
	$options[] = array(
		'name' => 'Front Page Heading',
		'desc' => 'Input your heading text here. Plese limit it within 100 Letters.',
		'id' => 'heading_text',
		'std' => 'World class and industry standard IT services are our passion. We build your ideas True',
		'type' => 'text');
	
// Front Page Fearured Box 01	
	$options[] = array(
		'desc' => '<span class="featured-area-title">Featured Box: 01</span>',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Featured Image',
		'desc' => 'Upload an image for the Featured Box. 215px X 100px image is recommended.',
		'id' => 'featured-image1',
		'std' => get_template_directory_uri() . '/images/featured-image1.jpg',
		'type' => 'upload');	
	
		
	$options[] = array(
		'name' => 'Featured Title',
		'desc' => 'Input your Featured Title here. Plese limit it within 30 Letters.',
		'id' => 'featured-title1',
		'std' => 'D5 Business Line Theme for Small Business',
		'type' => 'text');

	
	$options[] = array(
		'name' => 'Featured Description',
		'desc' => 'Input the description of Featured Areas. Please limit the words within 30 so that the layout should be clean and attractive.',
		'id' => 'featured-description1',
		'std' => 'The Customizable Background and other options of D5 Business Line will give the WordPress Driven Site an attractive look.  D5 Business Line is super elegant and Professional Responsive Theme which will create the business widely expressed.',
		'type' => 'textarea');

	$options[] = array(
		'name' => 'Featured Link',
		'desc' => 'Input your Featured Items URL here.',
		'id' => 'featured-link1',
		'std' => '#',
		'type' => 'text');

// Front Page Fearured Box 02	
	$options[] = array(
		'desc' => '<span class="featured-area-title">Featured Box: 02</span>',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Featured Image',
		'desc' => 'Upload an image for the Featured Box. 220px X 100px image is recommended.',
		'id' => 'featured-image2',
		'std' => get_template_directory_uri() . '/images/featured-image2.jpg',
		'type' => 'upload');	
	
		
	$options[] = array(
		'name' => 'Featured Title',
		'desc' => 'Input your Featured Title here. Plese limit it within 30 Letters.',
		'id' => 'featured-title2',
		'std' => 'D5 Business Line Theme for Small Business',
		'type' => 'text');

	
	$options[] = array(
		'name' => 'Featured Description',
		'desc' => 'Input the description of Featured Areas. Please limit the words within 30 so that the layout should be clean and attractive.',
		'id' => 'featured-description2',
		'std' => 'The Customizable Background and other options of D5 Business Line will give the WordPress Driven Site an attractive look.  D5 Business Line is super elegant and Professional Responsive Theme which will create the business widely expressed.',
		'type' => 'textarea');

	$options[] = array(
		'name' => 'Featured Link',
		'desc' => 'Input your Featured Items URL here.',
		'id' => 'featured-link2',
		'std' => '#',
		'type' => 'text');


// Front Page Fearured Box 03	
	$options[] = array(
		'desc' => '<span class="featured-area-title">Featured Box: 03</span>',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Featured Image',
		'desc' => 'Upload an image for the Featured Box. 220px X 100px image is recommended.',
		'id' => 'featured-image3',
		'std' => get_template_directory_uri() . '/images/featured-image3.jpg',
		'type' => 'upload');	
	
		
	$options[] = array(
		'name' => 'Featured Title',
		'desc' => 'Input your Featured Title here. Plese limit it within 30 Letters.',
		'id' => 'featured-title3',
		'std' => 'D5 Business Line Theme for Small Business',
		'type' => 'text');

	
	$options[] = array(
		'name' => 'Featured Description',
		'desc' => 'Input the description of Featured Areas. Please limit the words within 30 so that the layout should be clean and attractive.',
		'id' => 'featured-description3',
		'std' => 'The Customizable Background and other options of D5 Business Line will give the WordPress Driven Site an attractive look.  D5 Business Line is super elegant and Professional Responsive Theme which will create the business widely expressed.',
		'type' => 'textarea');

	$options[] = array(
		'name' => 'Featured Link',
		'desc' => 'Input your Featured Items URL here.',
		'id' => 'featured-link3',
		'std' => '#',
		'type' => 'text');

// Front Page Fearured Box 04	
	$options[] = array(
		'desc' => '<span class="featured-area-title">Featured Box: 04</span>',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Featured Image',
		'desc' => 'Upload an image for the Featured Box. 220px X 100px image is recommended.',
		'id' => 'featured-image4',
		'std' => get_template_directory_uri() . '/images/featured-image4.jpg',
		'type' => 'upload');	
	
		
	$options[] = array(
		'name' => 'Featured Title',
		'desc' => 'Input your Featured Title here. Plese limit it within 30 Letters.',
		'id' => 'featured-title4',
		'std' => 'D5 Business Line Theme for Small Business',
		'type' => 'text');

	
	$options[] = array(
		'name' => 'Featured Description',
		'desc' => 'Input the description of Featured Areas. Please limit the words within 30 so that the layout should be clean and attractive.',
		'id' => 'featured-description4',
		'std' => 'The Customizable Background and other options of D5 Business Line will give the WordPress Driven Site an attractive look.  D5 Business Line is super elegant and Professional Responsive Theme which will create the business widely expressed.',
		'type' => 'textarea');

	$options[] = array(
		'name' => 'Featured Link',
		'desc' => 'Input your Featured Items URL here.',
		'id' => 'featured-link4',
		'std' => '#',
		'type' => 'text');

// Quotation	
	$options[] = array(
		'desc' => '<span class="featured-area-title">Bottom Quotation</span>',
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Quote Text',
		'desc' => 'Input your Quotation here. Plese limit it within 150 Letters.',
		'id' => 'bottom-quotation',
		'std' => 'All the developers of D5 Creation have come from the disadvantaged part or group of the society. All have established themselves after a long and hard struggle in their life ----- D5 Creation Team',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => 'Display the Latest Posts',
		'desc' => 'Check here if you want to display the latest Posts in Front Page.',
		'id' => 'lpost',
		'std' => '0',
		'type' => 'checkbox' );	


// Social Contacts	
	$options[] = array(
		'desc' => '<span class="featured-area-title">Social Links</span>',
		'type' => 'info');
	
	
		
	$options[] = array(
		'name' => 'Facebook Link',
		'desc' => 'Input your Facebook URL here.',
		'id' => 'facebook-link',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => 'Twitter Link',
		'desc' => 'Input your Twitter URL here.',
		'id' => 'twitter-link',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'You Tube Channel Link',
		'desc' => 'Input your You Tube Channel URL here.',
		'id' => 'youtube-link',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => 'Linked In Link',
		'desc' => 'Input your Linked In URL here.',
		'id' => 'li-link',
		'std' => '',
		'type' => 'text');

$options[] = array(
		'name' => 'Blog Link', 
		'desc' => 'Input your Blog URL here.',
		'id' => 'blog-link',
		'std' => '',
		'type' => 'text');

	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});

	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}

});
</script>

<?php
}