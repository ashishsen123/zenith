<?php return array(

/* Theme Admin Menu */
"menu" => array(
	array("id"   => "1",
				"name" => "General"),

	array("id"   => "2",
				"name" => "Homepage"),

	array("id"   => "7",
				"name" => "Banners")
),

/* Theme Admin Options */
"id1" => array(
	array("type" => "preheader",
				"name" => "Theme Settings"),

		array("name" => "Logo Image",
					"desc" => "Upload a custom logo image for your site, or you can specify an image URL directly.",
					"id"   => "misc_logo_path",
					"std"  => "",
					"type" => "upload"),

		array("name" => "Favicon URL",
					"desc" => "Upload a favicon image (16&times;16px).",
					"id"   => "misc_favicon",
					"std"  => "",
					"type" => "upload"),

		array("name" => "Custom Feed URL",
					"desc" => "Example: <strong>http://feeds.feedburner.com/wpzoom</strong>",
					"id"   => "misc_feedburner",
					"std"  => "",
					"type" => "text"),
 

 		array("type"  => "preheader",
         			"name"  => "Global Posts Options"),
 
		array("name"  => "Excerpt length",
					"desc"  => "Default: <strong>50</strong> (words)",
					"id"    => "excerpt_length",
					"std"   => "50",
					"type"  => "text"),


	array("type" => "preheader",
				"name" => "Single Post Options"),

		array("name" => "Display Category",
					"id"   => "post_category",
					"std"  => "on",
					"type" => "checkbox"),

		array("name" => "Display Date/Time",
					"desc" => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
					"id"   => "post_date",
					"std"  => "on",
					"type" => "checkbox"),

		array("name" => "Display Author",
					"id"   => "post_author",
					"std"  => "on",
					"type" => "checkbox"),

		array("name" => "Display Tags",
					"id"   => "post_tags",
					"std"  => "on",
					"type" => "checkbox")
),

"id2" => array(
	array("type" => "preheader",
				"name" => "Homepage Settings"),

		array("name" => "Display Recent Posts on Homepage",
					"desc" => "Do you want to show the most recent posts on the homepage? They will appear at the bottom of the page, after all featured posts / categories.",
					"id"   => "recent_posts_show",
					"std"  => "on",
					"type" => "checkbox"),
		

	array("type" => "preheader",
				"name" => "Slider Settings"),

		array("name" => "Enable the Featured Slider",
					"desc" => "The featured slider will display featured posts. Edit posts which you want to feature, and check the box from editing page: <strong>Feature in Homepage Slider</strong>",
					"id"   => "featured_enable",
					"std"  => "on",
					"type" => "checkbox"),

		array("name" => "Number of Featured Posts",
					"desc" => "How many posts should appear in &ldquo;Featured Posts&rdquo; on the homepage?<br/> Default: <strong>5</strong>",
					"id"   => "featured_num",
					"std"  => "5",
					"type" => "text"),

		array("name" => "Autoplay Slider",
					"desc" => "Should the slider start rotating automatically?",
					"id"   => "featured_rotate",
					"std"  => "off",
					"type" => "checkbox"),

		array("name" => "Autoplay Interval",
					"desc" => "Select the interval (in miliseconds) at which the slider should change posts (if autoplay is enabled). Default: 3000 (3 seconds).",
					"id"   => "featured_interval",
					"std"  => "3000",
					"type" => "text"),

		array("name" => "Pause Slideshow on Mouse Hover",
					"id"   => "featured_pause",
					"std"  => "on",
					"type" => "checkbox")
),

 
"id7" => array(
	array("type" => "preheader",
				"name" => "Content Area Ad"),

		array("name" => "Enable ad space in the content area?",
					"id"   => "ad_content_select",
					"std"  => "off",
					"type" => "checkbox"),

		array("name"    => "Ad Position",
					"desc"    => "Do you want to place the banner before the article&rsquo;s content or after?",
					"id"      => "ad_content_pos",
					"options" => array('Before content', 'After content'),
					"std"     => "After content",
					"type"    => "select"),

		array("name" => "HTML Code (Adsense)",
					"desc" => "Enter complete HTML code for your banner (or Adsense code) or upload an image below.",
					"id"   => "ad_content_code",
					"std"  => "",
					"type" => "textarea"),

		array("name" => "Upload your image",
					"desc" => "Upload a banner image or enter the URL of an existing image.<br/>Recommended size: <strong>468 &times; 60px</strong>",
					"id"   => "ad_content_imgpath",
					"std"  => "",
					"type" => "upload"),

		array("name" => "Destination URL",
					"desc" => "Enter the URL where this banner ad points to.",
					"id"   => "ad_content_imgurl",
					"type" => "text"),

		array("name" => "Banner Title",
					"desc" => "Enter the title for this banner which will be used for ALT tag.",
					"id"   => "ad_content_imgalt",
					"type" => "text"),

	array("type" => "preheader",
				"name" => "Sidebar Ad"),

		array("name" => "Enable ad space in sidebar?",
					"id"   => "ad_side_select",
					"std"  => "off",
					"type" => "checkbox"),

		array("name"    => "Ad Position",
					"desc"    => "Do you want to place the banner before the widgets or after the widgets?",
					"id"      => "ad_side_pos",
					"options" => array('Before widgets', 'After widgets'),
					"std"     => "After widgets",
					"type"    => "select"),

		array("name" => "HTML Code (Adsense)",
					"desc" => "Enter complete HTML code for your banner (or Adsense code) or upload an image below.",
					"id"   => "ad_side_code",
					"std"  => "",
					"type" => "textarea"),

		array("name" => "Upload your image",
					"desc" => "Upload a banner image or enter the URL of an existing image.<br/>Recommended size: <strong>300 &times; 250px</strong>",
					"id"   => "ad_side_imgpath",
					"std"  => "",
					"type" => "upload"),

		array("name" => "Destination URL",
					"desc" => "Enter the URL where this banner ad points to.",
					"id"   => "ad_side_imgurl",
					"type" => "text"),

		array("name" => "Banner Title",
					"desc" => "Enter the title for this banner which will be used for ALT tag.",
					"id"   => "ad_side_imgalt",
					"type" => "text")
)

/* end return */);