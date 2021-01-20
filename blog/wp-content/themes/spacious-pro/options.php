<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {
	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = 'spacious';
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	$options = array();
	$spacious_googlefonts = spacious_google_fonts();

	// Header Options Area
	$options[] = array(
		'name' => __( 'Header', 'spacious' ),
		'type' => 'heading'
	);

	// Header Logo upload option
	$options[] = array(
		'name' 	=> __( 'Header Logo', 'spacious' ),
		'desc' 	=> __( 'Upload logo for your header.', 'spacious' ),
		'id' 		=> 'spacious_header_logo_image',
		'type' 	=> 'upload'
	);

	// Header logo and text display type option
	$header_display_array = array(
		'logo_only' 	=> __( 'Header Logo Only', 'spacious' ),
		'text_only' 	=> __( 'Header Text Only', 'spacious' ),
		'both' 	=> __( 'Show Both', 'spacious' ),
		'none'		 	=> __( 'Disable', 'spacious' )
	);
	$options[] = array(
		'name' 		=> __( 'Show', 'spacious' ),
		'desc' 		=> __( 'Choose the option that you want.', 'spacious' ),
		'id' 			=> 'spacious_show_header_logo_text',
		'std' 		=> 'text_only',
		'type' 		=> 'radio',
		'options' 	=> $header_display_array 
	);

	// Header display type option
	$options[] = array(
		'name' 		=> __( 'Header Display Type', 'spacious' ),
		'desc' 		=> __( 'Choose the header display type that you want.', 'spacious' ),
		'id' 			=> 'spacious_header_display_type',
		'std' 		=> 'one',
		'type' 		=> 'radio',
		'options' 	=> array(
							'one' => __( 'Type 1 (Default): Header text & logo on left, menu on the right', 'spacious' ),
							'two' => __( 'Type 2: Menu on left, header text & logo on right', 'spacious' )
						)
	);

	// Header Top bar activate option
	$options[] = array(
		'name' 		=> __( 'Activate Header Top Bar', 'spacious' ),
		'desc' 		=> __( 'Check to show top header bar. The top header bar includes social icons area, small text area and menu area.', 'spacious' ),
		'id' 			=> 'spacious_activate_top_header_bar',
		'std' 		=> '0',
		'type' 		=> 'checkbox'
	);

	// Header top bar display type option
	$options[] = array(
		'name' 		=> __( 'Heder Top Bar Display Type', 'spacious' ),
		'desc' 		=> __( 'Choose top bar display type.', 'spacious' ),
		'id' 			=> 'spacious_top_bar_display_type',
		'std' 		=> 'one',
		'type' 		=> 'radio',
		'options' 	=> array(
							'one' => __( 'Type 1 (Default): Social icons & small text area on left, menu area on right', 'spacious' ),
							'two' => __( 'Type 2: Social icons & small text area on right, menu area on left', 'spacious' )
						)
	);

	// Header area small text option
	$wp_editor_settings = array(
		'wpautop' 			=> true, // Default
		'textarea_rows' 	=> 5,
		'tinymce' 			=> array( 'plugins' => 'wordpress' )
	);
	$options[] = array(
		'name' 		=> __( 'Header Info Text', 'spacious' ),
		'desc' 		=> __( 'You can add phone numbers, other contact info here as you like. This box also accepts shortcodes.', 'spacious'	),
		'id' 			=> 'spacious_header_info_text',
		'type' 		=> 'editor',
		'settings' 	=> $wp_editor_settings );

	// Header Image replace postion
	$options[] = array(
		'name' => __( 'Need to replace Header Image?', 'spacious' ),
		'desc' => sprintf( __( '<a href="%1$s">Click Here</a>', 'spacious' ), admin_url('themes.php?page=custom-header') ),
		'type' => 'info'
	);

	// Header image position option
	$options[] = array(
		'name' 		=> __( 'Heder Image Position', 'spacious' ),
		'desc' 		=> __( 'Choose top header image display position.', 'spacious' ),
		'id' 			=> 'spacious_header_image_position',
		'std' 		=> 'above',
		'type' 		=> 'radio',
		'options' 	=> array(
							'above' => __( 'Position Above (Default): Display the Header image just above the site title and main menu part.', 'spacious' ),
							'below' => __( 'Position Below: Display the Header image just below the site title and main menu part.', 'spacious' )
						)

	);

	// make header image as link opion
	$options[] = array(
		'desc' 		=> __( 'Check to make header image link back to home page.', 'spacious' ),
		'id' 			=> 'spacious_header_image_link',
		'std' 		=> '0',
		'type' 		=> 'checkbox'
	);

	/*************************************************************************/

	$options[] = array(
		'name' => __( 'Design', 'spacious' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' 		=> __( 'Site Layout', 'spacious' ),
		'desc' 		=> __( 'Choose your site layout. The change is reflected in whole site.', 'spacious' ),
		'id' 			=> 'spacious_site_layout',
		'std' 		=> 'box_1218px',
		'type' 		=> 'radio',
		'options' 	=> array(
							'box_1218px' 	=> __( 'Boxed layout with content width of 1218px', 'spacious' ),
							'box_978px' 	=> __( 'Boxed layout with content width of 978px', 'spacious' ),
							'wide_1218px' 	=> __( 'Wide layout with content width of 1218px', 'spacious' ),
							'wide_978px' 	=> __( 'Wide layout with content width of 978px', 'spacious' ),
						)
	);

	$options[] = array(
		'name' 		=> __( 'Default layout', 'spacious' ),
		'desc' 		=> __( 'Select default layout. This layout will be reflected in whole site archives, search etc. The layout for a single post and page can be controlled from below options.', 'spacious' ),
		'id' 			=> 'spacious_default_layout',
		'std' 		=> 'right_sidebar',
		'type' 		=> 'images',
		'options' 	=> array(
								'right_sidebar' 	=> SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
								'left_sidebar' 		=> SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
								'no_sidebar_full_width'				=> SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
								'no_sidebar_content_centered'		=> SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
							)
	);

	$options[] = array(
		'name' 		=> __( 'Default layout for pages only', 'spacious' ),
		'desc' 		=> __( 'Select default layout for pages. This layout will be reflected in all pages unless unique layout is set for specific page.', 'spacious' ),
		'id' 			=> 'spacious_pages_default_layout',
		'std' 		=> 'right_sidebar',
		'type' 		=> 'images',
		'options' 	=> array(
								'right_sidebar' 	=> SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
								'left_sidebar' 		=> SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
								'no_sidebar_full_width'				=> SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
								'no_sidebar_content_centered'		=> SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
							)
	);

	$options[] = array(
		'name' 		=> __( 'Default layout for single posts only', 'spacious' ),
		'desc' 		=> __( 'Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for specific post.', 'spacious' ),
		'id' 			=> 'spacious_single_posts_default_layout',
		'std' 		=> 'right_sidebar',
		'type' 		=> 'images',
		'options' 	=> array(
								'right_sidebar' 	=> SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
								'left_sidebar' 		=> SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
								'no_sidebar_full_width'				=> SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
								'no_sidebar_content_centered'		=> SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
							)
	);

	$options[] = array(
		'name' 		=> __( 'Archive/Category/Index posts listing display type', 'spacious' ),
		'desc' 		=> __( 'Choose the display type for the archive/category view.', 'spacious' ),
		'id' 			=> 'spacious_archive_display_type',
		'std' 		=> 'blog_large',
		'type' 		=> 'radio',
		'options' 	=> array(
							'blog_large' 	=> __( 'Blog Image Large', 'spacious' ),
							'blog_medium' 	=> __( 'Blog Image Medium', 'spacious' ),
							'blog_medium_alternate' 	=> __( 'Blog Image Alternate Medium', 'spacious' ),
							'blog_medium_round' 			=> __( 'Blog Image Round Medium', 'spacious' ),
							'blog_medium_round_alternate' 	=> __( 'Blog Image Round Alternate Medium', 'spacious' ),
							'blog_full_content' 	=> __( 'Blog Full Content', 'spacious' )
						)
	);

	// Site primary color option
	$options[] = array(
		'name' 		=> __( 'Primary color option', 'spacious' ),
		'desc' 		=> __( 'This will reflect in links, buttons and many others. Choose a color to match your site.', 'spacious' ),
		'id' 			=> 'spacious_primary_color',
		'std' 		=> '#0FBE7C',
		'type' 		=> 'color' 
	);

	// Site dark light skin option
	$options[] = array(
		'name' 		=> __( 'Color Skin', 'spacious' ),
		'desc' 		=> __( 'Choose the light or dark skin. This will be reflected in whole site.', 'spacious' ),
		'id' 			=> 'spacious_color_skin',
		'std' 		=> 'light',
		'type' 		=> 'images',
		'options' 	=> array(
							'light' 	=> SPACIOUS_ADMIN_IMAGES_URL . '/light-color.jpg',
							'dark' 	=> SPACIOUS_ADMIN_IMAGES_URL . '/dark-color.jpg'
						)
	);	

	$options[] = array(
		'name' 		=> __( 'Need to replace default background?', 'spacious' ),
		'desc' 		=> sprintf( __( '<a href="%1$s">Click Here</a>', 'spacious' ), admin_url('themes.php?page=custom-background') ).'&nbsp;&nbsp;&nbsp;'.__( 'Note: The background will only be seen if you choose any of the boxed layout option in site layout option.', 'spacious' ),
		'type' 		=> 'info'
	);

	$options[] = array(
		'name' 		=> __( 'Custom CSS', 'spacious' ),
		'desc' 		=> __( 'Write your custom css.', 'spacious' ),
		'id' 			=> 'spacious_custom_css',
		'std' 		=> '',
		'type' 		=> 'textarea'
	);

	/*************************************************************************/

	$options[] = array(
		'name' => __( 'Social Links', 'spacious' ),
		'type' => 'heading'
	);

	// Social links activate option
	$options[] = array(
		'name' 		=> __( 'Activate social links area', 'spacious' ),
		'desc' 		=> __( 'Check to activate social links area. You also need to activate the header top bar section in Header options to show this social links area', 'spacious' ),
		'id' 			=> 'spacious_activate_social_links',
		'std' 		=> '0',
		'type' 		=> 'checkbox'
	);

	$spacious_social_links = array( 'spacious_social_facebook' 	=> __( 'Facebook', 'spacious' ),
									'spacious_social_twitter' 		=> __( 'Twitter', 'spacious' ),									
									'spacious_social_googleplus' 	=> __( 'GooglePlus' , 'spacious' ),
									'spacious_social_instagram' 	=> __( 'Instagram', 'spacious' ),
									'spacious_social_codepen'		=> __( 'CodePen', 'spacious' ),
									'spacious_social_digg' 			=> __( 'Digg', 'spacious' ),
									'spacious_social_dribbble' 	=> __( 'Dribbble', 'spacious' ),
									'spacious_social_flickr' 		=> __( 'Flickr', 'spacious' ),
									'spacious_social_github' 		=> __( 'GitHub', 'spacious' ),
									'spacious_social_linkedin' 	=> __( 'LinkedIn', 'spacious' ),
									'spacious_social_pinterest' 	=> __( 'Pinterest', 'spacious' ),
									'spacious_social_polldaddy' 	=> __( 'Polldaddy', 'spacious' ),
									'spacious_social_pocket' 		=> __( 'Pocket', 'spacious' ),
									'spacious_social_reddit' 		=> __( 'Reddit', 'spacious' ),
									'spacious_social_skype' 		=> __( 'Skype', 'spacious' ),
									'spacious_social_stumbleupon' => __( 'StumbleUpon', 'spacious' ),
									'spacious_social_tumblr' 		=> __( 'Tumblr', 'spacious' ),
									'spacious_social_vimeo'			=> __( 'Vimeo', 'spacious' ),
									'spacious_social_wordpress' 	=> __( 'WordPress', 'spacious' ),
									'spacious_social_youtube' 		=> __( 'YouTube', 'spacious' ),
									'spacious_social_rss' 			=> __( 'RSS', 'spacious' ),
									'spacious_social_mail' 			=> __( 'Mail', 'spacious' )
							 	);	

	foreach ( $spacious_social_links as $key => $value ) {
		$options[] = array(
			'name' 		=> $value,
			'desc' 		=> sprintf( __( 'Add link for %1$s', 'spacious' ), $value ),
			'id' 			=> $key,
			'std' 		=> '',
			'type' 		=> 'text'
		);
		$options[] = array(
			'name' 		=> '',
			'desc' 		=> __( 'Check to show in new tab', 'spacious' ),
			'id' 			=> $key.'new_tab',
			'std' 		=> '0',
			'type' 		=> 'checkbox'
		);
	}

	/*************************************************************************/

	$options[] = array(
		'name' => __( 'Additional', 'spacious' ),
		'type' => 'heading'
	);

	// Favicon activate option
	$options[] = array(
		'name' 		=> __( 'Activate favicon', 'spacious' ),
		'desc' 		=> __( 'Check to activate favicon. Upload fav icon from below option', 'spacious' ),
		'id' 			=> 'spacious_activate_favicon',
		'std' 		=> '0',
		'type' 		=> 'checkbox'
	);

	// Fav icon upload option
	$options[] = array(
		'name' 	=> __( 'Upload favicon', 'spacious' ),
		'desc' 	=> __( 'Upload favicon for your site.', 'spacious' ),
		'id' 		=> 'spacious_favicon',
		'type' 	=> 'upload'
	);

	// Excerpt Options
	$options[] = array(
		'name' => __('Excerpt Length', 'spacious'),
		'desc' => __('Enter the number of Words you wish to show on excerpt. Default value is 40 words.', 'spacious'),
		'id' => 'spacious_excerpt_length',
		'std' => '40',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Excerpt Read More Text', 'spacious'),
		'desc' => __('Replace the default Read more text with your own words', 'spacious'),
		'id' => 'spacious_read_more_text',
		'std' => __( 'Read more', 'spacious' ),
		'class' => 'mini',
		'type' => 'text');

	// Footer editor option
	$default_footer_value = __( 'Copyright &copy; ', 'spacious' ).'[the-year] [site-link] '.__( 'Theme by: ', 'spacious' ).'[tg-link] '.__( 'Powered by: ', 'spacious' ).'[wp-link]';

	$options[] = array(
		'name' 		=> __( 'Footer Copyright Editor', 'spacious' ),
		'desc' 		=> __( 'Edit the Copyright information in your footer. You can also use shortcodes [the-year], [site-link], [wp-link], [tg-link] for current year, your site link, WordPress site link and ThemeGrill site link respectively.', 'spacious'	),
		'id' 			=> 'spacious_footer_editor',
		'std' 		=> $default_footer_value,
		'type' 		=> 'editor',
		'settings' 	=> $wp_editor_settings );

	/*************************************************************************/

	$options[] = array(
		'name' => __( 'Slider', 'spacious' ),
		'type' => 'heading'
	);

	// Slider activate option
	$options[] = array(
		'name' 		=> __( 'Activate slider', 'spacious' ),
		'desc' 		=> __( 'Check to activate slider.', 'spacious' ),
		'id' 			=> 'spacious_activate_slider',
		'std' 		=> '0',
		'type' 		=> 'checkbox'
	);

	// Slider status option
	$options[] = array(
		'name' 		=> __( 'Slider Status', 'spacious' ),
		'desc' 		=> __( 'Choose the slider status that you want.', 'spacious' ),
		'id' 			=> 'spacious_slider_status',
		'std' 		=> 'home_front_page',
		'type' 		=> 'radio',
		'options' 	=> array(
							'home_front_page' => __( 'Slider on Home/Front page', 'spacious' ),
							'all_page' 			=> __( 'Slider on all pages', 'spacious' ),
						)
	);

	// Slider status option
	$options[] = array(
		'name' 		=> __( 'Slider Settings', 'spacious' ),
		'desc' 		=> __( 'Slider transition effect', 'spacious' ).'  '.__( 'Choose the transition effect that you like. Default is "fade".', 'spacious' ),
		'id' 			=> 'spacious_slider_transition_effect',
		'std' 		=> 'fade',
		'type' 		=> 'select',
		'class'		=> 'mini',
		'options' 	=> array(
							'fade' 			=> __( 'Fade', 'spacious' ),
							'wipe'			=> __( 'Wipe', 'spacious' ),
							'scrollUp'		=> __( 'scrollUp', 'spacious' ),
							'scrollDown'	=> __( 'scrollDown', 'spacious' ),
							'scrollLeft'	=> __( 'scrollLeft', 'spacious' ),
							'scrollRight'	=> __( 'scrollRight', 'spacious' ),
							'blindX'			=> __( 'blindX', 'spacious' ),
							'blindY'			=> __( 'blindY', 'spacious' ),
							'blindZ'			=> __( 'blindZ', 'spacious' ),
							'cover'			=> __( 'Cover', 'spacious' ),
							'shuffle'		=> __( 'Shuffle', 'spacious' ),
						)
	);

	// Slider transition delay time
	$options[] = array(
		'desc' 		=> __( 'Slider transition delay time', 'spacious' ).'  '.__( 'Add number in seconds. Default is 4.', 'spacious' ),
		'id' 			=> 'spacious_slider_transition_delay',
		'std' 		=> 4,
		'type' 		=> 'text',
		'class'		=> 'mini'
	);

	// Slider transition length time
	$options[] = array(
		'desc' 		=> __( 'Slider transition length time', 'spacious' ).'  '.__( 'Add number in seconds. Default is 1.', 'spacious' ),
		'id' 			=> 'spacious_slider_transition_length',
		'std' 		=> 1,
		'type' 		=> 'text',
		'class'		=> 'mini'
	);

	// Slider transition length time
	$options[] = array(
		'desc' 		=> __( 'Number of slides', 'spacious' ).'  '.__( 'Enter the number of slides you want then click save.', 'spacious' ),
		'id' 			=> 'spacious_slider_number',
		'std' 		=> 5,
		'type' 		=> 'text',
		'class'		=> 'mini'
	);

	$num_of_slides = of_get_option( 'spacious_slider_number', '5' );

	// Slide options
	for( $i=1; $i<=$num_of_slides; $i++) {
		$options[] = array(
			'name' 	=>	sprintf( __( 'Image Upload #%1$s', 'spacious' ), $i ),
			'desc' 	=> __( 'Upload slider image.', 'spacious' ),
			'id' 		=> 'spacious_slider_image'.$i,
			'type' 	=> 'upload'
		);
		$options[] = array(
			'desc' 	=> __( 'Enter title for your slider.', 'spacious' ),
			'id' 		=> 'spacious_slider_title'.$i,
			'std' 	=> '',
			'type' 	=> 'text'
		);
		$options[] = array(
			'desc' 	=> __( 'Enter your slider description.', 'spacious' ),
			'id' 		=> 'spacious_slider_text'.$i,
			'std' 	=> '',
			'type' 	=> 'textarea'
		);
		$options[] = array(
		'desc' 		=> __( 'Slider text position.', 'spacious' ),
		'id' 			=> 'spacious_slide_text_position'.$i,
		'std' 		=> 'left',
		'type' 		=> 'radio',
		'options' 	=> array(
							'right' 	=> __( 'Right side', 'spacious' ),
							'left' 	=> __( 'Left side', 'spacious' )
						)
	);
		$options[] = array(
			'desc' 	=> __( 'Enter the button text. Default is "Read more"', 'spacious' ),
			'id' 		=> 'spacious_slider_button_text'.$i,
			'std' 	=> __( 'Read more', 'spacious' ),
			'type' 	=> 'text'
		);
		$options[] = array(
			'desc' 	=> __( 'Enter link to redirect slider when clicked', 'spacious' ),
			'id' 		=> 'spacious_slider_link'.$i,
			'std' 	=> '',
			'type' 	=> 'text'
		);
	}

	/*************************************************************************/

	$options[] = array(
		'name' => __( 'Typography', 'spacious' ),
		'type' => 'heading'
	);	

	// Font family options
	$options[] = array(
		'name' 		=> __( 'Google Font Options', 'spacious' ),
		'desc' 		=> __( 'Site title font. Default is "Lato".', 'spacious' ),
		'id' 			=> 'spacious_site_title_font',
		'std' 		=> 'Lato',
		'type' 		=> 'select',
		'options' 	=> $spacious_googlefonts
	);

	$options[] = array(
		'desc' 		=> __( 'Site tagline font. Default is "Lato".', 'spacious' ),
		'id' 			=> 'spacious_site_tagline_font',
		'std' 		=> 'Lato',
		'type' 		=> 'select',
		'options' 	=> $spacious_googlefonts
	);

	$options[] = array(
		'desc' 		=> __( 'Menu font. Default is "Lato".', 'spacious' ),
		'id' 			=> 'spacious_menu_font',
		'std' 		=> 'Lato',
		'type' 		=> 'select',
		'options' 	=> $spacious_googlefonts
	);

	$options[] = array(
		'desc' 		=> __( 'All Titles font. Default is "Lato".', 'spacious' ),
		'id' 			=> 'spacious_titles_font',
		'std' 		=> 'Lato',
		'type' 		=> 'select',
		'options' 	=> $spacious_googlefonts
	);

	$options[] = array(
		'desc' 		=> __( 'Content font and for others. Default is "Lato".', 'spacious' ),
		'id' 			=> 'spacious_content_font',
		'std' 		=> 'Lato',
		'type' 		=> 'select',
		'options' 	=> $spacious_googlefonts
	);

	// Font Size options
	$spacious_font_size_range_10_16 = array(
		'10'	=> '10',
		'11'	=> '11',
		'12' 	=> '12',
		'13' 	=> '13',
		'14' 	=> '14',
		'15' 	=> '15',
		'16' 	=> '16'
	);
	$spacious_font_size_range_10_18 = array(
		'10'	=> '10',
		'11'	=> '11',
		'12' 	=> '12',
		'13' 	=> '13',
		'14' 	=> '14',
		'15' 	=> '15',
		'16' 	=> '16',
		'17' 	=> '17',
		'18' 	=> '18'
	);	
	$spacious_font_size_range_12_20 = array(
		'12' 	=> '12',
		'13' 	=> '13',
		'14' 	=> '14',
		'15' 	=> '15',
		'16' 	=> '16',
		'17' 	=> '17',
		'18' 	=> '18',
		'19' 	=> '19',
		'20' 	=> '20'
	);	
	$spacious_font_size_range_16_30 = array(
		'16' 	=> '16',
		'17' 	=> '17',
		'18' 	=> '18',
		'19'	=> '19',
		'20'	=> '20',
		'21'	=> '21',
		'22'	=> '22',
		'23'	=> '23',
		'24'	=> '24',
		'25'	=> '25',
		'26' 	=> '26',
		'27' 	=> '27',
		'28' 	=> '28',
		'29' 	=> '29',
		'30' 	=> '30'
	);
	$spacious_font_size_range_18_30 = array(
		'18' 	=> '18',
		'19' 	=> '19',
		'20' 	=> '20',
		'21'	=> '21',
		'22'	=> '22',
		'23'	=> '23',
		'24'	=> '24',
		'25'	=> '25',
		'26' 	=> '26',
		'27' 	=> '27',
		'28' 	=> '28',
		'29' 	=> '29',
		'30' 	=> '30'
	);
	$spacious_font_size_range_20_34 = array(
		'20'	=> '20',
		'21'	=> '21',
		'22'	=> '22',
		'23'	=> '23',
		'24'	=> '24',
		'25'	=> '25',
		'26' 	=> '26',
		'27' 	=> '27',
		'28' 	=> '28',
		'29' 	=> '29',
		'30' 	=> '30',
		'31' 	=> '31',
		'32' 	=> '32',
		'33' 	=> '33',
		'34' 	=> '34'
	);
	$spacious_font_size_range_24_40 = array(
		'24'	=> '24',
		'25'	=> '25',
		'26' 	=> '26',
		'27' 	=> '27',
		'28' 	=> '28',
		'29' 	=> '29',
		'30' 	=> '30',
		'31' 	=> '31',
		'32' 	=> '32',
		'33' 	=> '33',
		'34' 	=> '34',
		'35' 	=> '35',
		'36' 	=> '36',
		'37' 	=> '37',
		'38' 	=> '38',
		'39' 	=> '39',
		'40' 	=> '40'
	);
	$spacious_font_size_range_26_46 = array(
		'26' 	=> '26',
		'27' 	=> '27',
		'28' 	=> '28',
		'29' 	=> '29',
		'30' 	=> '30',
		'31' 	=> '31',
		'32' 	=> '32',
		'33' 	=> '33',
		'34' 	=> '34',
		'35' 	=> '35',
		'36' 	=> '36',
		'37' 	=> '37',
		'38' 	=> '38',
		'39' 	=> '39',
		'40' 	=> '40',
		'41' 	=> '41',
		'42' 	=> '42',
		'43' 	=> '43',
		'44' 	=> '44',
		'45' 	=> '45',
		'46' 	=> '46'
	);

	$options[] = array(
		'name' 		=> __( 'Header font size Options', 'spacious' ),
		'desc' 		=> __( 'Site title font size. Default is 36px.', 'spacious' ),
		'id' 			=> 'spacious_site_title_font_size',
		'std' 		=> '36',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_26_46
	);
	$options[] = array(
		'desc' 		=> __( 'Site tagline font size. Default is 16px.', 'spacious' ),
		'id' 			=> 'spacious_tagline_font_size',
		'std' 		=> '16',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_12_20
	);
	$options[] = array(
		'desc' 		=> __( 'Primary menu. Default is 16px.', 'spacious' ),
		'id' 			=> 'spacious_primary_menu_font_size',
		'std' 		=> '16',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_12_20
	);	
	$options[] = array(
		'desc' 		=> __( 'Primary sub menu. Default is 13px.', 'spacious' ),
		'id' 			=> 'spacious_primary_sub_menu_font_size',
		'std' 		=> '13',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_10_18
	);	
	$options[] = array(
		'desc' 		=> __( 'Header small menu. Default is 12px.', 'spacious' ),
		'id' 			=> 'spacious_small_header_menu_font_size',
		'std' 		=> '12',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_10_16
	);
	$options[] = array(
		'desc' 		=> __( 'Header top bar small info text. Default is 12px.', 'spacious' ),
		'id' 			=> 'spacious_small_info_text_size',
		'std' 		=> '12',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_10_16
	);
	$options[] = array(
		'name' 		=> __( 'Slider font size Options', 'spacious' ),
		'desc' 		=> __( 'Slider title. Default is 26px.', 'spacious' ),
		'id' 			=> 'spacious_slider_title_font_size',
		'std' 		=> '26',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_20_34
	);
	$options[] = array(
		'desc' 		=> __( 'Slider content. Default is 16px.', 'spacious' ),
		'id' 			=> 'spacious_slider_content_font_size',
		'std' 		=> '16',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_12_20
	);	
	$options[] = array(
		'desc' 		=> __( 'Slider button text. Default is 20px.', 'spacious' ),
		'id' 			=> 'spacious_slider_button_font_size',
		'std' 		=> '20',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_16_30
	);
	$options[] = array(
		'name' 		=> __( 'Header Bar font size options', 'spacious' ),
		'desc' 		=> __( 'Breadcrumb Text. Default is 12px. Breadcrumb appears in header bar right side after installing Breadcrumb NavXT', 'spacious' ),
		'id' 			=> 'spacious_breadcrumb_text_font_size',
		'std' 		=> '12',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_10_16
	);	
	$options[] = array(
		'desc' 		=> __( 'Page title and post title in single view. Default is 22px. Appears in header bar just before content.', 'spacious' ),
		'id' 			=> 'spacious_title_font_size',
		'std' 		=> '22',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_18_30
	);
	$options[] = array(
		'name' 		=> __( 'Title and widget related font size options', 'spacious' ),
		'desc' 		=> __( 'Title in posts listing or blog/category view. Also for posts titles in TG:Featured Posts widget. Default is 26px.', 'spacious' ),
		'id' 			=> 'spacious_archive_title_font_size',
		'std' 		=> '26',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_20_34
	);
	$options[] = array(
		'desc' 		=> __( 'Widget title font size. Default is 22px.', 'spacious' ),
		'id' 			=> 'spacious_widget_title_font_size',
		'std' 		=> '22',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_18_30
	);
	$options[] = array(
		'desc' 		=> __( 'Main title of TG: Featured Posts widget and TG: Our Clients widget. Default is 30px.', 'spacious' ),
		'id' 			=> 'spacious_client_widget_title_font_size',
		'std' 		=> '30',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_24_40
	);
	$options[] = array(
		'desc' 		=> __( 'Title of TG: Call To Action widget. Default is 24px.', 'spacious' ),
		'id' 			=> 'spacious_call_to_action_title_font_size',
		'std' 		=> '24',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_20_34
	);
	$options[] = array(
		'desc' 		=> __( 'Button text of TG: Call To Action widget. Default is 22px.', 'spacious' ),
		'id' 			=> 'spacious_call_to_action_button_font_size',
		'std' 		=> '22',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_18_30
	);
	$options[] = array(
		'desc' 		=> __( 'Comment Title. Default is 26px.', 'spacious' ),
		'id' 			=> 'spacious_comment_title_font_size',
		'std' 		=> '26',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_20_34
	);
	$options[] = array(
		'name' 		=> __( 'Content font size options', 'spacious' ),
		'desc' 		=> __( 'Content font size, also applies to other text like in search fields, post comment button etc. Default is 16px.', 'spacious' ),
		'id' 			=> 'spacious_content_font_size',
		'std' 		=> '16',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_12_20
	);	
	$options[] = array(
		'desc' 		=> __( 'Post meta font size. Default is 14px. Post meta includes date, author, category etc. information of post.', 'spacious' ),
		'id' 			=> 'spacious_post_meta_font_size',
		'std' 		=> '14',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_10_18
	);
	$options[] = array(
		'desc' 		=> __( 'Read more link font size. Default is 14px. Read more in post meta, TG: Featured Single Page widget and TG: Services widget.', 'spacious' ),
		'id' 			=> 'spacious_read_more_font_size',
		'std' 		=> '14',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_10_18
	);
	$options[] = array(
		'name' 		=> __( 'Footer font size options', 'spacious' ),
		'desc' 		=> __( 'Footer widget title font size. Default is 22px.', 'spacious' ),
		'id' 			=> 'spacious_footer_widget_title_font_size',
		'std' 		=> '22',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_18_30
	);
	$options[] = array(
		'desc' 		=> __( 'Footer widget content font size. Default is 14px.', 'spacious' ),
		'id' 			=> 'spacious_footer_widget_content_font_size',
		'std' 		=> '14',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_10_18
	);
	$options[] = array(
		'desc' 		=> __( 'Footer copyright text font size. Default is 12px.', 'spacious' ),
		'id' 			=> 'spacious_footer_copyright_text_font_size',
		'std' 		=> '12',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_10_16
	);
	$options[] = array(
		'desc' 		=> __( 'Footer small menu. Default is 12px.', 'spacious' ),
		'id' 			=> 'spacious_small_footer_menu_font_size',
		'std' 		=> '12',
		'type' 		=> 'select',
		'class' 		=> 'mini',
		'options' 	=> $spacious_font_size_range_10_16
	);

	/*************************************************************************/

	$options[] = array(
		'name' => __( 'Color', 'spacious' ),
		'type' => 'heading'
	);	

	// Font Color options
	$options[] = array(
		'name' 		=> __( 'Header Color Options', 'spacious' ),
		'desc' 		=> __( 'Site Title and tagline color option can be set from Appearance -> Header', 'spacious' ),
		'type' 		=> 'info' 
	);
	$options[] = array(
		'desc' 		=> __( 'Primary menu text color. Default is #444444.', 'spacious' ),
		'id' 			=> 'spacious_primary_menu_text_color',
		'std' 		=> '#444444',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Primary sub menu text color. Default is #666666.', 'spacious' ),
		'id' 			=> 'spacious_primary_sub_menu_text_color',
		'std' 		=> '#666666',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Header background color. Default is #FFFFFF.', 'spacious' ),
		'id' 			=> 'spacious_header_background_color',
		'std' 		=> '#FFFFFF',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Header top bar background color. Default is #F8F8F8.', 'spacious' ),
		'id' 			=> 'spacious_header_top_bar_background_color',
		'std' 		=> '#F8F8F8',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Header top bar info text color. Default is #555555.', 'spacious' ),
		'id' 			=> 'spacious_header_info_text_color',
		'std' 		=> '#555555',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Header small menu text color. Default is #666666.', 'spacious' ),
		'id' 			=> 'spacious_header_small_menu_text_color',
		'std' 		=> '#666666',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'name'		=> __( 'Slider part color options', 'spacious' ),
		'desc' 		=> __( 'Slider title. Default is #FFFFFF.', 'spacious' ),
		'id' 			=> 'spacious_slider_title_color',
		'std' 		=> '#FFFFFF',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Slider content. Default is #FFFFFF.', 'spacious' ),
		'id' 			=> 'spacious_slider_content_color',
		'std' 		=> '#FFFFFF',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Slider button text color. Default is #FFFFFF.', 'spacious' ),
		'id' 			=> 'spacious_slider_button_color',
		'std' 		=> '#FFFFFF',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Slider button background color. Default is #0FBE7C.', 'spacious' ),
		'id' 			=> 'spacious_slider_button_background_color',
		'std' 		=> '#0FBE7C',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'name' 		=> __( 'General Color Options', 'spacious' ),
		'desc' 		=> __( 'Border lines. These lines are used in various parts as seperator and as borders. Default is #EAEAEA.', 'spacious' ),
		'id' 			=> 'spacious_border_lines_color',
		'std' 		=> '#EAEAEA',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'name' 		=> __( 'Header Bar Color Options', 'spacious' ),
		'desc' 		=> __( 'Page title and post title in single view. Default is #222222', 'spacious' ),
		'id' 			=> 'spacious_page_post_title_color',
		'std' 		=> '#222222',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Breadcrumb text color. Default is #666666.', 'spacious' ),
		'id' 			=> 'spacious_breadcrumb_text_color',
		'std' 		=> '#666666',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Header bar background color. Default is #FFFFFF.', 'spacious' ),
		'id' 			=> 'spacious_header_bar_background_color',
		'std' 		=> '#FFFFFF',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'name'		=> __( 'Content part color options', 'spacious' ),
		'desc' 		=> __( 'Title in posts listing or blog/category view. Also for posts titles in TG:Featured Posts widget. Default is #222222.', 'spacious' ),
		'id' 			=> 'spacious_posts_title_color',
		'std' 		=> '#222222',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Widget title color. Default is #FFFFFF.', 'spacious' ),
		'id' 			=> 'spacious_widget_title_color',
		'std' 		=> '#222222',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Content text color. Default is #666666.', 'spacious' ),
		'id' 			=> 'spacious_content_text_color',
		'std' 		=> '#666666',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Post meta icon color. Post meta includes date, author, category etc. information of post. Default is #999999.', 'spacious' ),
		'id' 			=> 'spacious_post_meta_icon_color',
		'std' 		=> '#999999',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Post meta text color. Post meta includes date, author, category etc. information of post. Default is #999999.', 'spacious' ),
		'id' 			=> 'spacious_post_meta_color',
		'std' 		=> '#999999',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Read more text in post meta. Default is #FFFFFF.', 'spacious' ),
		'id' 			=> 'spacious_post_meta_read_more_color',
		'std' 		=> '#FFFFFF',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Read more text background color. Default is #0FBE7C.', 'spacious' ),
		'id' 			=> 'spacious_post_meta_read_more_background_color',
		'std' 		=> '#0FBE7C',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Read more link color for TG: Featured Single Page widget and TG: Services widget. Default is #0FBE7C.', 'spacious' ),
		'id' 			=> 'spacious_tg_widget_read_more_color',
		'std' 		=> '#0FBE7C',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Content part background color. Default is #FFFFFF.', 'spacious' ),
		'id' 			=> 'spacious_content_background_color',
		'std' 		=> '#FFFFFF',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'name'		=> __( 'Comment part color options', 'spacious' ),
		'desc' 		=> __( 'Comment part background color. Default is #FFFFFF.', 'spacious' ),
		'id' 			=> 'spacious_comment_part_background_color',
		'std' 		=> '#FFFFFF',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Comment title color. Default is #222222.', 'spacious' ),
		'id' 			=> 'spacious_comment_title_color',
		'std' 		=> '#222222',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Comment meta color. Like name, date etc. Default is #999999.', 'spacious' ),
		'id' 			=> 'spacious_comment_meta_color',
		'std' 		=> '#999999',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Single comment background color. Like name, date etc. Default is #F8F8F8.', 'spacious' ),
		'id' 			=> 'spacious_single_comment_background_color',
		'std' 		=> '#F8F8F8',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Commenting field background color. Like name, date etc. Default is #F8F8F8.', 'spacious' ),
		'id' 			=> 'spacious_commenting_field_background_color',
		'std' 		=> '#F8F8F8',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'name'		=> __( 'TG:Call to action widget color options', 'spacious' ),
		'desc' 		=> __( 'Title color. Default is #222222.', 'spacious' ),
		'id' 			=> 'spacious_call_to_action_title_color',
		'std' 		=> '#222222',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Background color. Default is #F8F8F8.', 'spacious' ),
		'id' 			=> 'spacious_call_to_action_background_color',
		'std' 		=> '#F8F8F8',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Button text color. Default is #FFFFFF.', 'spacious' ),
		'id' 			=> 'spacious_call_to_action_button_color',
		'std' 		=> '#FFFFFF',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Button background color. Default is #0FBE7C.', 'spacious' ),
		'id' 			=> 'spacious_call_to_action_button_background_color',
		'std' 		=> '#0FBE7C',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'name'		=> __( 'Footer part color options', 'spacious' ),
		'desc' 		=> __( 'Widget title color. Default is #D5D5D5.', 'spacious' ),
		'id' 			=> 'spacious_footer_widget_title_color',
		'std' 		=> '#D5D5D5',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Widget content color. Default is #999999.', 'spacious' ),
		'id' 			=> 'spacious_footer_widget_content_color',
		'std' 		=> '#999999',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Widget background color. Default is #333333.', 'spacious' ),
		'id' 			=> 'spacious_footer_widget_background_color',
		'std' 		=> '#333333',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Footer copyright text color. Default is #666666.', 'spacious' ),
		'id' 			=> 'spacious_footer_copyright_text_color',
		'std' 		=> '#666666',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Footer small menu text color. Default is #666666.', 'spacious' ),
		'id' 			=> 'spacious_footer_small_menu_color',
		'std' 		=> '#666666',
		'type' 		=> 'color' 
	);
	$options[] = array(
		'desc' 		=> __( 'Footer copyright part background color. Default is #F8F8F8.', 'spacious' ),
		'id' 			=> 'spacious_footer_copyright_part_background_color',
		'std' 		=> '#F8F8F8',
		'type' 		=> 'color' 
	);

	return $options;
}

add_action( 'optionsframework_after','spacious_options_display_sidebar' );

/**
 * Spacious admin sidebar
 */
function spacious_options_display_sidebar() { ?>
	<div id="optionsframework-sidebar">
		<div class="metabox-holder">
	    	<div class="postbox">
	    		<h3><?php esc_attr_e( 'Spacious Pro', 'spacious' ); ?></h3>
      			<div class="inside"> 
					<div class="option-btn"><a class="btn support" target="_blank" href="<?php echo esc_url( 'http://themegrill.com/support-forum/' ); ?>"><?php esc_attr_e( 'Support Forum' , 'spacious' ); ?></a></div>
					<div class="option-btn"><a class="btn doc" target="_blank" href="<?php echo esc_url( 'http://themegrill.com/theme-instruction/spacious-pro/' ); ?>"><?php esc_attr_e( 'Documentation' , 'spacious' ); ?></a></div>
					<div class="option-btn"><a class="btn demo" target="_blank" href="<?php echo esc_url( 'http://demo.themegrill.com/spacious-pro/' ); ?>"><?php esc_attr_e( 'View Demo' , 'spacious' ); ?></a></div>
      			</div><!-- inside -->
	    	</div><!-- .postbox -->
	  	</div><!-- .metabox-holder -->
	</div><!-- #optionsframework-sidebar -->
<?php
}

function spacious_google_fonts(){

	$spacious_googlefonts = array(	
	"ABeeZee" => "ABeeZee",
	"Abel" => "Abel",
	"Abril Fatface" => "Abril+Fatface",
	"Aclonica" => "Aclonica",
	"Acme" => "Acme",
	"Actor" => "Actor",
	"Adamina" => "Adamina",
	"Advent Pro" => "Advent+Pro",
	"Aguafina Script" => "Aguafina+Script",
	"Akronim" => "Akronim",
	"Aladin" => "Aladin",
	"Aldrich" => "Aldrich",
	"Alegreya" => "Alegreya",
	"Alegreya SC" => "Alegreya+SC",
	"Alex Brush" => "Alex+Brush",
	"Alfa Slab One" => "Alfa+Slab+One",
	"Alice" => "Alice",
	"Alike" => "Alike",
	"Alike Angular" => "Alike+Angular",
	"Allan" => "Allan",
	"Allerta" => "Allerta",
	"Allerta Stencil" => "Allerta+Stencil",
	"Allura" => "Allura",
	"Almendra" => "Almendra",
	"Almendra Display" => "Almendra+Display",
	"Almendra SC" => "Almendra+SC",
	"Amarante" => "Amarante",
	"Amaranth" => "Amaranth",
	"Amatic SC" => "Amatic+SC",
	"Amethysta" => "Amethysta",
	"Anaheim" => "Anaheim",
	"Andada" => "Andada",
	"Andika" => "Andika",
	"Angkor" => "Angkor",
	"Annie Use Your Telescope" => "Annie+Use+Your+Telescope",
	"Anonymous Pro" => "Anonymous+Pro",
	"Antic" => "Antic",
	"Antic Didone" => "Antic+Didone",
	"Antic Slab" => "Antic+Slab",
	"Anton" => "Anton",
	"Arapey" => "Arapey",
	"Arbutus" => "Arbutus",
	"Arbutus Slab" => "Arbutus+Slab",
	"Architects Daughter" => "Architects+Daughter",
	"Archivo Black" => "Archivo+Black",
	"Archivo Narrow" => "Archivo+Narrow",
	"Arimo" => "Arimo",
	"Arizonia" => "Arizonia",
	"Armata" => "Armata",
	"Artifika" => "Artifika",
	"Arvo" => "Arvo",
	"Asap" => "Asap",
	"Asset" => "Asset",
	"Astloch" => "Astloch",
	"Asul" => "Asul",
	"Atomic Age" => "Atomic+Age",
	"Aubrey" => "Aubrey",
	"Audiowide" => "Audiowide",
	"Autour One" => "Autour+One",
	"Average" => "Average",
	"Average Sans" => "Average+Sans",
	"Averia Gruesa Libre" => "Averia+Gruesa+Libre",
	"Averia Libre" => "Averia+Libre",
	"Averia Sans Libre" => "Averia+Sans+Libre",
	"Averia Serif Libre" => "Averia+Serif+Libre",
	"Bad Script" => "Bad+Script",
	"Balthazar" => "Balthazar",
	"Bangers" => "Bangers",
	"Basic" => "Basic",
	"Battambang" => "Battambang",
	"Baumans" => "Baumans",
	"Bayon" => "Bayon",
	"Belgrano" => "Belgrano",
	"Belleza" => "Belleza",
	"BenchNine" => "BenchNine",
	"Bentham" => "Bentham",
	"Berkshire Swash" => "Berkshire+Swash",
	"Bevan" => "Bevan",
	"Bigelow Rules" => "Bigelow+Rules",
	"Bigshot One" => "Bigshot+One",
	"Bilbo" => "Bilbo",
	"Bilbo Swash Caps" => "Bilbo+Swash+Caps",
	"Bitter" => "Bitter",
	"Black Ops One" => "Black+Ops+One",
	"Bokor" => "Bokor",
	"Bonbon" => "Bonbon",
	"Boogaloo" => "Boogaloo",
	"Bowlby One" => "Bowlby+One",
	"Bowlby One SC" => "Bowlby+One+SC",
	"Brawler" => "Brawler",
	"Bree Serif" => "Bree+Serif",
	"Bubblegum Sans" => "Bubblegum+Sans",
	"Bubbler One" => "Bubbler+One",
	"Buda" => "Buda",
	"Buenard" => "Buenard",
	"Butcherman" => "Butcherman",
	"Butterfly Kids" => "Butterfly+Kids",
	"Cabin" => "Cabin",
	"Cabin Condensed" => "Cabin+Condensed",
	"Cabin Sketch" => "Cabin+Sketch",
	"Caesar Dressing" => "Caesar+Dressing",
	"Cagliostro" => "Cagliostro",
	"Calligraffitti" => "Calligraffitti",
	"Cambo" => "Cambo",
	"Candal" => "Candal",
	"Cantarell" => "Cantarell",
	"Cantata One" => "Cantata+One",
	"Cantora One" => "Cantora+One",
	"Capriola" => "Capriola",
	"Cardo" => "Cardo",
	"Carme" => "Carme",
	"Carrois Gothic" => "Carrois+Gothic",
	"Carrois Gothic SC" => "Carrois+Gothic+SC",
	"Carter One" => "Carter+One",
	"Caudex" => "Caudex",
	"Cedarville Cursive" => "Cedarville+Cursive",
	"Ceviche One" => "Ceviche+One",
	"Changa One" => "Changa+One",
	"Chango" => "Chango",
	"Chau Philomene One" => "Chau+Philomene+One",
	"Chela One" => "Chela+One",
	"Chelsea Market" => "Chelsea+Market",
	"Chenla" => "Chenla",
	"Cherry Cream Soda" => "Cherry+Cream+Soda",
	"Cherry Swash" => "Cherry+Swash",
	"Chewy" => "Chewy",
	"Chicle" => "Chicle",
	"Chivo" => "Chivo",
	"Cinzel" => "Cinzel",
	"Cinzel Decorative" => "Cinzel+Decorative",
	"Clicker Script" => "Clicker+Script",
	"Coda" => "Coda",
	"Coda Caption" => "Coda+Caption",
	"Codystar" => "Codystar",
	"Combo" => "Combo",
	"Comfortaa" => "Comfortaa",
	"Coming Soon" => "Coming+Soon",
	"Concert One" => "Concert+One",
	"Condiment" => "Condiment",
	"Content" => "Content",
	"Contrail One" => "Contrail+One",
	"Convergence" => "Convergence",
	"Cookie" => "Cookie",
	"Copse" => "Copse",
	"Corben" => "Corben",
	"Courgette" => "Courgette",
	"Cousine" => "Cousine",
	"Coustard" => "Coustard",
	"Covered By Your Grace" => "Covered+By+Your+Grace",
	"Crafty Girls" => "Crafty+Girls",
	"Creepster" => "Creepster",
	"Crete Round" => "Crete+Round",
	"Crimson Text" => "Crimson+Text",
	"Croissant One" => "Croissant+One",
	"Crushed" => "Crushed",
	"Cuprum" => "Cuprum",
	"Cutive" => "Cutive",
	"Cutive Mono" => "Cutive+Mono",
	"Damion" => "Damion",
	"Dancing Script" => "Dancing+Script",
	"Dangrek" => "Dangrek",
	"Dawning of a New Day" => "Dawning+of+a+New+Day",
	"Days One" => "Days+One",
	"Delius" => "Delius",
	"Delius Swash Caps" => "Delius+Swash+Caps",
	"Delius Unicase" => "Delius+Unicase",
	"Della Respira" => "Della+Respira",
	"Denk One" => "Denk+One",
	"Devonshire" => "Devonshire",
	"Didact Gothic" => "Didact+Gothic",
	"Diplomata" => "Diplomata",
	"Diplomata SC" => "Diplomata+SC",
	"Domine" => "Domine",
	"Donegal One" => "Donegal+One",
	"Doppio One" => "Doppio+One",
	"Dorsa" => "Dorsa",
	"Dosis" => "Dosis",
	"Dr Sugiyama" => "Dr+Sugiyama",
	"Droid Sans" => "Droid+Sans",
	"Droid Sans Mono" => "Droid+Sans+Mono",
	"Droid Serif" => "Droid+Serif",
	"Duru Sans" => "Duru+Sans",
	"Dynalight" => "Dynalight",
	"EB Garamond" => "EB+Garamond",
	"Eagle Lake" => "Eagle+Lake",
	"Eater" => "Eater",
	"Economica" => "Economica",
	"Electrolize" => "Electrolize",
	"Elsie" => "Elsie",
	"Elsie Swash Caps" => "Elsie+Swash+Caps",
	"Emblema One" => "Emblema+One",
	"Emilys Candy" => "Emilys+Candy",
	"Engagement" => "Engagement",
	"Englebert" => "Englebert",
	"Enriqueta" => "Enriqueta",
	"Erica One" => "Erica+One",
	"Esteban" => "Esteban",
	"Euphoria Script" => "Euphoria+Script",
	"Ewert" => "Ewert",
	"Exo" => "Exo",
	"Expletus Sans" => "Expletus+Sans",
	"Fanwood Text" => "Fanwood+Text",
	"Fascinate" => "Fascinate",
	"Fascinate Inline" => "Fascinate+Inline",
	"Faster One" => "Faster+One",
	"Fasthand" => "Fasthand",
	"Federant" => "Federant",
	"Federo" => "Federo",
	"Felipa" => "Felipa",
	"Fenix" => "Fenix",
	"Finger Paint" => "Finger+Paint",
	"Fjalla One" => "Fjalla+One",
	"Fjord One" => "Fjord+One",
	"Flamenco" => "Flamenco",
	"Flavors" => "Flavors",
	"Fondamento" => "Fondamento",
	"Fontdiner Swanky" => "Fontdiner+Swanky",
	"Forum" => "Forum",
	"Francois One" => "Francois+One",
	"Freckle Face" => "Freckle+Face",
	"Fredericka the Great" => "Fredericka+the+Great",
	"Fredoka One" => "Fredoka+One",
	"Freehand" => "Freehand",
	"Fresca" => "Fresca",
	"Frijole" => "Frijole",
	"Fruktur" => "Fruktur",
	"Fugaz One" => "Fugaz+One",
	"GFS Didot" => "GFS+Didot",
	"GFS Neohellenic" => "GFS+Neohellenic",
	"Gabriela" => "Gabriela",
	"Gafata" => "Gafata",
	"Galdeano" => "Galdeano",
	"Galindo" => "Galindo",
	"Gentium Basic" => "Gentium+Basic",
	"Gentium Book Basic" => "Gentium+Book+Basic",
	"Geo" => "Geo",
	"Geostar" => "Geostar",
	"Geostar Fill" => "Geostar+Fill",
	"Germania One" => "Germania+One",
	"Gilda Display" => "Gilda+Display",
	"Give You Glory" => "Give+You+Glory",
	"Glass Antiqua" => "Glass+Antiqua",
	"Glegoo" => "Glegoo",
	"Gloria Hallelujah" => "Gloria+Hallelujah",
	"Goblin One" => "Goblin+One",
	"Gochi Hand" => "Gochi+Hand",
	"Gorditas" => "Gorditas",
	"Goudy Bookletter 1911" => "Goudy+Bookletter+1911",
	"Graduate" => "Graduate",
	"Grand Hotel" => "Grand+Hotel",
	"Gravitas One" => "Gravitas+One",
	"Great Vibes" => "Great+Vibes",
	"Griffy" => "Griffy",
	"Gruppo" => "Gruppo",
	"Gudea" => "Gudea",
	"Habibi" => "Habibi",
	"Hammersmith One" => "Hammersmith+One",
	"Hanalei" => "Hanalei",
	"Hanalei Fill" => "Hanalei+Fill",
	"Handlee" => "Handlee",
	"Hanuman" => "Hanuman",
	"Happy Monkey" => "Happy+Monkey",
	"Headland One" => "Headland+One",
	"Henny Penny" => "Henny+Penny",
	"Herr Von Muellerhoff" => "Herr+Von+Muellerhoff",
	"Holtwood One SC" => "Holtwood+One+SC",
	"Homemade Apple" => "Homemade+Apple",
	"Homenaje" => "Homenaje",
	"IM Fell DW Pica" => "IM+Fell+DW+Pica",
	"IM Fell DW Pica SC" => "IM+Fell+DW+Pica+SC",
	"IM Fell Double Pica" => "IM+Fell+Double+Pica",
	"IM Fell Double Pica SC" => "IM+Fell+Double+Pica+SC",
	"IM Fell English" => "IM+Fell+English",
	"IM Fell English SC" => "IM+Fell+English+SC",
	"IM Fell French Canon" => "IM+Fell+French+Canon",
	"IM Fell French Canon SC" => "IM+Fell+French+Canon+SC",
	"IM Fell Great Primer" => "IM+Fell+Great+Primer",
	"IM Fell Great Primer SC" => "IM+Fell+Great+Primer+SC",
	"Iceberg" => "Iceberg",
	"Iceland" => "Iceland",
	"Imprima" => "Imprima",
	"Inconsolata" => "Inconsolata",
	"Inder" => "Inder",
	"Indie Flower" => "Indie+Flower",
	"Inika" => "Inika",
	"Irish Grover" => "Irish+Grover",
	"Istok Web" => "Istok+Web",
	"Italiana" => "Italiana",
	"Italianno" => "Italianno",
	"Jacques Francois" => "Jacques+Francois",
	"Jacques Francois Shadow" => "Jacques+Francois+Shadow",
	"Jim Nightshade" => "Jim+Nightshade",
	"Jockey One" => "Jockey+One",
	"Jolly Lodger" => "Jolly+Lodger",
	"Josefin Sans" => "Josefin+Sans",
	"Josefin Slab" => "Josefin+Slab",
	"Joti One" => "Joti+One",
	"Judson" => "Judson",
	"Julee" => "Julee",
	"Julius Sans One" => "Julius+Sans+One",
	"Junge" => "Junge",
	"Jura" => "Jura",
	"Just Another Hand" => "Just+Another+Hand",
	"Just Me Again Down Here" => "Just+Me+Again+Down+Here",
	"Kameron" => "Kameron",
	"Karla" => "Karla",
	"Kaushan Script" => "Kaushan+Script",
	"Kavoon" => "Kavoon",
	"Keania One" => "Keania+One",
	"Kelly Slab" => "Kelly+Slab",
	"Kenia" => "Kenia",
	"Khmer" => "Khmer",
	"Kite One" => "Kite+One",
	"Knewave" => "Knewave",
	"Kotta One" => "Kotta+One",
	"Koulen" => "Koulen",
	"Kranky" => "Kranky",
	"Kreon" => "Kreon",
	"Kristi" => "Kristi",
	"Krona One" => "Krona+One",
	"La Belle Aurore" => "La+Belle+Aurore",
	"Lancelot" => "Lancelot",
	"Lato" => "Lato",
	"League Script" => "League+Script",
	"Leckerli One" => "Leckerli+One",
	"Ledger" => "Ledger",
	"Lekton" => "Lekton",
	"Lemon" => "Lemon",
	"Libre Baskerville" => "Libre+Baskerville",
	"Life Savers" => "Life+Savers",
	"Lilita One" => "Lilita+One",
	"Limelight" => "Limelight",
	"Linden Hill" => "Linden+Hill",
	"Lobster" => "Lobster",
	"Lobster Two" => "Lobster+Two",
	"Londrina Outline" => "Londrina+Outline",
	"Londrina Shadow" => "Londrina+Shadow",
	"Londrina Sketch" => "Londrina+Sketch",
	"Londrina Solid" => "Londrina+Solid",
	"Lora" => "Lora",
	"Love Ya Like A Sister" => "Love+Ya+Like+A+Sister",
	"Loved by the King" => "Loved+by+the+King",
	"Lovers Quarrel" => "Lovers+Quarrel",
	"Luckiest Guy" => "Luckiest+Guy",
	"Lusitana" => "Lusitana",
	"Lustria" => "Lustria",
	"Macondo" => "Macondo",
	"Macondo Swash Caps" => "Macondo+Swash+Caps",
	"Magra" => "Magra",
	"Maiden Orange" => "Maiden+Orange",
	"Mako" => "Mako",
	"Marcellus" => "Marcellus",
	"Marcellus SC" => "Marcellus+SC",
	"Marck Script" => "Marck+Script",
	"Margarine" => "Margarine",
	"Marko One" => "Marko+One",
	"Marmelad" => "Marmelad",
	"Marvel" => "Marvel",
	"Mate" => "Mate",
	"Mate SC" => "Mate+SC",
	"Maven Pro" => "Maven+Pro",
	"McLaren" => "McLaren",
	"Meddon" => "Meddon",
	"MedievalSharp" => "MedievalSharp",
	"Medula One" => "Medula+One",
	"Megrim" => "Megrim",
	"Meie Script" => "Meie+Script",
	"Merienda" => "Merienda",
	"Merienda One" => "Merienda+One",
	"Merriweather" => "Merriweather",
	"Merriweather Sans" => "Merriweather+Sans",
	"Metal" => "Metal",
	"Metal Mania" => "Metal+Mania",
	"Metamorphous" => "Metamorphous",
	"Metrophobic" => "Metrophobic",
	"Michroma" => "Michroma",
	"Milonga" => "Milonga",
	"Miltonian" => "Miltonian",
	"Miltonian Tattoo" => "Miltonian+Tattoo",
	"Miniver" => "Miniver",
	"Miss Fajardose" => "Miss+Fajardose",
	"Modern Antiqua" => "Modern+Antiqua",
	"Molengo" => "Molengo",
	"Molle" => "Molle",
	"Monda" => "Monda",
	"Monofett" => "Monofett",
	"Monoton" => "Monoton",
	"Monsieur La Doulaise" => "Monsieur+La+Doulaise",
	"Montaga" => "Montaga",
	"Montez" => "Montez",
	"Montserrat" => "Montserrat",
	"Montserrat Alternates" => "Montserrat+Alternates",
	"Montserrat Subrayada" => "Montserrat+Subrayada",
	"Moul" => "Moul",
	"Moulpali" => "Moulpali",
	"Mountains of Christmas" => "Mountains+of+Christmas",
	"Mouse Memoirs" => "Mouse+Memoirs",
	"Mr Bedfort" => "Mr+Bedfort",
	"Mr Dafoe" => "Mr+Dafoe",
	"Mr De Haviland" => "Mr+De+Haviland",
	"Mrs Saint Delafield" => "Mrs+Saint+Delafield",
	"Mrs Sheppards" => "Mrs+Sheppards",
	"Muli" => "Muli",
	"Mystery Quest" => "Mystery+Quest",
	"Neucha" => "Neucha",
	"Neuton" => "Neuton",
	"New Rocker" => "New+Rocker",
	"News Cycle" => "News+Cycle",
	"Niconne" => "Niconne",
	"Nixie One" => "Nixie+One",
	"Nobile" => "Nobile",
	"Nokora" => "Nokora",
	"Norican" => "Norican",
	"Nosifer" => "Nosifer",
	"Nothing You Could Do" => "Nothing+You+Could+Do",
	"Noticia Text" => "Noticia+Text",
	"Nova Cut" => "Nova+Cut",
	"Nova Flat" => "Nova+Flat",
	"Nova Mono" => "Nova+Mono",
	"Nova Oval" => "Nova+Oval",
	"Nova Round" => "Nova+Round",
	"Nova Script" => "Nova+Script",
	"Nova Slim" => "Nova+Slim",
	"Nova Square" => "Nova+Square",
	"Numans" => "Numans",
	"Nunito" => "Nunito",
	"Odor Mean Chey" => "Odor+Mean+Chey",
	"Offside" => "Offside",
	"Old Standard TT" => "Old+Standard+TT",
	"Oldenburg" => "Oldenburg",
	"Oleo Script" => "Oleo+Script",
	"Oleo Script Swash Caps" => "Oleo+Script+Swash+Caps",
	"Open Sans" => "Open+Sans",
	"Open Sans Condensed" => "Open+Sans+Condensed",
	"Oranienbaum" => "Oranienbaum",
	"Orbitron" => "Orbitron",
	"Oregano" => "Oregano",
	"Orienta" => "Orienta",
	"Original Surfer" => "Original+Surfer",
	"Oswald" => "Oswald",
	"Over the Rainbow" => "Over+the+Rainbow",
	"Overlock" => "Overlock",
	"Overlock SC" => "Overlock+SC",
	"Ovo" => "Ovo",
	"Oxygen" => "Oxygen",
	"Oxygen Mono" => "Oxygen+Mono",
	"PT Mono" => "PT+Mono",
	"PT Sans" => "PT+Sans",
	"PT Sans Caption" => "PT+Sans+Caption",
	"PT Sans Narrow" => "PT+Sans+Narrow",
	"PT Serif" => "PT+Serif",
	"PT Serif Caption" => "PT+Serif+Caption",
	"Pacifico" => "Pacifico",
	"Paprika" => "Paprika",
	"Parisienne" => "Parisienne",
	"Passero One" => "Passero+One",
	"Passion One" => "Passion+One",
	"Patrick Hand" => "Patrick+Hand",
	"Patrick Hand SC" => "Patrick+Hand+SC",
	"Patua One" => "Patua+One",
	"Paytone One" => "Paytone+One",
	"Peralta" => "Peralta",
	"Permanent Marker" => "Permanent+Marker",
	"Petit Formal Script" => "Petit+Formal+Script",
	"Petrona" => "Petrona",
	"Philosopher" => "Philosopher",
	"Piedra" => "Piedra",
	"Pinyon Script" => "Pinyon+Script",
	"Pirata One" => "Pirata+One",
	"Plaster" => "Plaster",
	"Play" => "Play",
	"Playball" => "Playball",
	"Playfair Display" => "Playfair+Display",
	"Playfair Display SC" => "Playfair+Display+SC",
	"Podkova" => "Podkova",
	"Poiret One" => "Poiret+One",
	"Poller One" => "Poller+One",
	"Poly" => "Poly",
	"Pompiere" => "Pompiere",
	"Pontano Sans" => "Pontano+Sans",
	"Port Lligat Sans" => "Port+Lligat+Sans",
	"Port Lligat Slab" => "Port+Lligat+Slab",
	"Prata" => "Prata",
	"Preahvihear" => "Preahvihear",
	"Press Start 2P" => "Press+Start+2P",
	"Princess Sofia" => "Princess+Sofia",
	"Prociono" => "Prociono",
	"Prosto One" => "Prosto+One",
	"Puritan" => "Puritan",
	"Purple Purse" => "Purple+Purse",
	"Quando" => "Quando",
	"Quantico" => "Quantico",
	"Quattrocento" => "Quattrocento",
	"Quattrocento Sans" => "Quattrocento+Sans",
	"Questrial" => "Questrial",
	"Quicksand" => "Quicksand",
	"Quintessential" => "Quintessential",
	"Qwigley" => "Qwigley",
	"Racing Sans One" => "Racing+Sans+One",
	"Radley" => "Radley",
	"Raleway" => "Raleway",
	"Raleway Dots" => "Raleway+Dots",
	"Rambla" => "Rambla",
	"Rammetto One" => "Rammetto+One",
	"Ranchers" => "Ranchers",
	"Rancho" => "Rancho",
	"Rationale" => "Rationale",
	"Redressed" => "Redressed",
	"Reenie Beanie" => "Reenie+Beanie",
	"Revalia" => "Revalia",
	"Ribeye" => "Ribeye",
	"Ribeye Marrow" => "Ribeye+Marrow",
	"Righteous" => "Righteous",
	"Risque" => "Risque",
	"Roboto" => "Roboto",
	"Roboto Condensed" => "Roboto+Condensed",
	"Rochester" => "Rochester",
	"Rock Salt" => "Rock+Salt",
	"Rokkitt" => "Rokkitt",
	"Romanesco" => "Romanesco",
	"Ropa Sans" => "Ropa+Sans",
	"Rosario" => "Rosario",
	"Rosarivo" => "Rosarivo",
	"Rouge Script" => "Rouge+Script",
	"Ruda" => "Ruda",
	"Rufina" => "Rufina",
	"Ruge Boogie" => "Ruge+Boogie",
	"Ruluko" => "Ruluko",
	"Rum Raisin" => "Rum+Raisin",
	"Ruslan Display" => "Ruslan+Display",
	"Russo One" => "Russo+One",
	"Ruthie" => "Ruthie",
	"Rye" => "Rye",
	"Sacramento" => "Sacramento",
	"Sail" => "Sail",
	"Salsa" => "Salsa",
	"Sanchez" => "Sanchez",
	"Sancreek" => "Sancreek",
	"Sansita One" => "Sansita+One",
	"Sarina" => "Sarina",
	"Satisfy" => "Satisfy",
	"Scada" => "Scada",
	"Schoolbell" => "Schoolbell",
	"Seaweed Script" => "Seaweed+Script",
	"Sevillana" => "Sevillana",
	"Seymour One" => "Seymour+One",
	"Shadows Into Light" => "Shadows+Into+Light",
	"Shadows Into Light Two" => "Shadows+Into+Light+Two",
	"Shanti" => "Shanti",
	"Share" => "Share",
	"Share Tech" => "Share+Tech",
	"Share Tech Mono" => "Share+Tech+Mono",
	"Shojumaru" => "Shojumaru",
	"Short Stack" => "Short+Stack",
	"Siemreap" => "Siemreap",
	"Sigmar One" => "Sigmar+One",
	"Signika" => "Signika",
	"Signika Negative" => "Signika+Negative",
	"Simonetta" => "Simonetta",
	"Sintony" => "Sintony",
	"Sirin Stencil" => "Sirin+Stencil",
	"Six Caps" => "Six+Caps",
	"Skranji" => "Skranji",
	"Slackey" => "Slackey",
	"Smokum" => "Smokum",
	"Smythe" => "Smythe",
	"Sniglet" => "Sniglet",
	"Snippet" => "Snippet",
	"Snowburst One" => "Snowburst+One",
	"Sofadi One" => "Sofadi+One",
	"Sofia" => "Sofia",
	"Sonsie One" => "Sonsie+One",
	"Sorts Mill Goudy" => "Sorts+Mill+Goudy",
	"Source Code Pro" => "Source+Code+Pro",
	"Source Sans Pro" => "Source+Sans+Pro",
	"Special Elite" => "Special+Elite",
	"Spicy Rice" => "Spicy+Rice",
	"Spinnaker" => "Spinnaker",
	"Spirax" => "Spirax",
	"Squada One" => "Squada+One",
	"Stalemate" => "Stalemate",
	"Stalinist One" => "Stalinist+One",
	"Stardos Stencil" => "Stardos+Stencil",
	"Stint Ultra Condensed" => "Stint+Ultra+Condensed",
	"Stint Ultra Expanded" => "Stint+Ultra+Expanded",
	"Stoke" => "Stoke",
	"Strait" => "Strait",
	"Sue Ellen Francisco" => "Sue+Ellen+Francisco",
	"Sunshiney" => "Sunshiney",
	"Supermercado One" => "Supermercado+One",
	"Suwannaphum" => "Suwannaphum",
	"Swanky and Moo Moo" => "Swanky+and+Moo+Moo",
	"Syncopate" => "Syncopate",
	"Tangerine" => "Tangerine",
	"Taprom" => "Taprom",
	"Tauri" => "Tauri",
	"Telex" => "Telex",
	"Tenor Sans" => "Tenor+Sans",
	"Text Me One" => "Text+Me+One",
	"The Girl Next Door" => "The+Girl+Next+Door",
	"Tienne" => "Tienne",
	"Tinos" => "Tinos",
	"Titan One" => "Titan+One",
	"Titillium Web" => "Titillium+Web",
	"Trade Winds" => "Trade+Winds",
	"Trocchi" => "Trocchi",
	"Trochut" => "Trochut",
	"Trykker" => "Trykker",
	"Tulpen One" => "Tulpen+One",
	"Ubuntu" => "Ubuntu",
	"Ubuntu Condensed" => "Ubuntu+Condensed",
	"Ubuntu Mono" => "Ubuntu+Mono",
	"Ultra" => "Ultra",
	"Uncial Antiqua" => "Uncial+Antiqua",
	"Underdog" => "Underdog",
	"Unica One" => "Unica+One",
	"UnifrakturCook" => "UnifrakturCook",
	"UnifrakturMaguntia" => "UnifrakturMaguntia",
	"Unkempt" => "Unkempt",
	"Unlock" => "Unlock",
	"Unna" => "Unna",
	"VT323" => "VT323",
	"Vampiro One" => "Vampiro+One",
	"Varela" => "Varela",
	"Varela Round" => "Varela+Round",
	"Vast Shadow" => "Vast+Shadow",
	"Vibur" => "Vibur",
	"Vidaloka" => "Vidaloka",
	"Viga" => "Viga",
	"Voces" => "Voces",
	"Volkhov" => "Volkhov",
	"Vollkorn" => "Vollkorn",
	"Voltaire" => "Voltaire",
	"Waiting for the Sunrise" => "Waiting+for+the+Sunrise",
	"Wallpoet" => "Wallpoet",
	"Walter Turncoat" => "Walter+Turncoat",
	"Warnes" => "Warnes",
	"Wellfleet" => "Wellfleet",
	"Wendy One" => "Wendy+One",
	"Wire One" => "Wire+One",
	"Yanone Kaffeesatz" => "Yanone+Kaffeesatz",
	"Yellowtail" => "Yellowtail",
	"Yeseva One" => "Yeseva+One",
	"Yesteryear" => "Yesteryear",
	"Zeyada" => "Zeyada",
	);
	return $spacious_googlefonts;
}