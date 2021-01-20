<?php
/**
 * Contains all the fucntions and components related to header part.
 *
 * @package 		ThemeGrill
 * @subpackage 		Spacious
 * @since 			Spacious 1.0
 */

/****************************************************************************************/

add_filter( 'wp_title', 'spacious_filter_wp_title' );
if ( ! function_exists( 'spacious_filter_wp_title' ) ) :
/**
 * Modifying the Title
 *
 * Function tied to the wp_title filter hook.
 * @uses filter wp_title
 */
function spacious_filter_wp_title( $title ) {
	global $page, $paged;
	
	// Get the Site Name
   $site_name = get_bloginfo( 'name' );

   // Get the Site Description
   $site_description = get_bloginfo( 'description' );

   $filtered_title = ''; 

	// For Homepage or Frontpage
   if(  is_home() || is_front_page() ) {		
		$filtered_title .= $site_name;	
		if ( !empty( $site_description ) )  {
        	$filtered_title .= ' &#124; '. $site_description;
		}
   }
	elseif( is_feed() ) {
		$filtered_title = '';
	}
	else{	
		$filtered_title = $title . $site_name;
	}

	// Add a page number if necessary:
	if( $paged >= 2 || $page >= 2 ) {
		$filtered_title .= ' &#124; ' . sprintf( __( 'Page %s', 'spacious' ), max( $paged, $page ) );
	}
	
	// Return the modified title
   return $filtered_title;
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'spacious_social_links' ) ) :
/**
 * This function is for social links display on header
 *
 * Get links through Theme Options
 */
function spacious_social_links() {

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
	?>
	<div class="social-links clearfix">
		<ul>
		<?php			
			$i=0;
			$spacious_links_output = '';
			foreach( $spacious_social_links as $key => $value ) {
				$link = of_get_option( $key , '' );
				if ( !empty( $link ) ) {
					if ( of_get_option( $key.'new_tab', '0' ) == '1' ) { $new_tab = 'target="_blank"'; } else { $new_tab = ''; }
					$spacious_links_output .=
						'<li class="spacious-'.strtolower($value).'"><a href="'.esc_url( $link ).'"'.$new_tab.'></a></li>';
				}
				$i++;
			}
			echo $spacious_links_output;
		?>				
		</ul>
	</div><!-- .social-links -->
	<?php
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'spacious_header_info_text' ) ) :
/**
 * Shows the small info text on top header part
 */
function spacious_header_info_text() {
	if( of_get_option( 'spacious_header_info_text', '' ) == '' ) return; 

	$spacious_header_info_text = '<div class="small-info-text"><p>'.of_get_option( 'spacious_header_info_text', '' ).'</p></div>';
	echo do_shortcode( $spacious_header_info_text );
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'spacious_render_header_image' ) ) :
/**
 * Shows the small info text on top header part
 */
function spacious_render_header_image() {
	$header_image = get_header_image();
	if( !empty( $header_image ) ) {
		if( of_get_option( 'spacious_header_image_link', 0 ) == 1 ) { 
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		<?php
		}
		?>
		<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		<?php
		if( of_get_option( 'spacious_header_image_link', 0 ) == 1 ) { 
		?>
		</a>
		<?php
		}
	}
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'spacious_pass_slider_parameters' ) ) :
/**
 * Function to pass the slider effectr parameters from php file to js file.
 */
function spacious_pass_slider_parameters() {
	$transition_effect = of_get_option( 'spacious_slider_transition_effect', 'fade' );
	
	$transition_delay = of_get_option( 'spacious_slider_transition_delay', 4 );
	$transition_duration = of_get_option( 'spacious_slider_transition_length', 1 );
	$transition_delay = intval($transition_delay);
	$transition_duration = intval($transition_duration);

	if ( $transition_delay != 0 ) { $transition_delay = $transition_delay * 1000; }
	else { $transition_delay = 4000; }
	if ( $transition_duration != 0 ) { $transition_duration = $transition_duration * 1000; }
	else { $transition_duration = 1000; }

	wp_localize_script( 
		'spacious_slider',
		'spacious_slider_value',
		array(
			'transition_effect' 		=> $transition_effect,
			'transition_delay' 		=> $transition_delay,
			'transition_duration' 	=> $transition_duration
		)
	);    
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'spacious_featured_image_slider' ) ) :
/**
 * display featured post slider
 */
function spacious_featured_image_slider() {
	global $post;
	?>
		<section id="featured-slider">
			<div class="slider-cycle">
				<?php
				$num_of_slides = of_get_option( 'spacious_slider_number', '5' );
				for( $i = 1; $i <= $num_of_slides; $i++ ) {
					$spacious_slider_title = of_get_option( 'spacious_slider_title'.$i , '' );
					$spacious_slider_text = of_get_option( 'spacious_slider_text'.$i , '' );
					$spacious_slider_image = of_get_option( 'spacious_slider_image'.$i , '' );
					$spacious_slide_text_position = of_get_option( 'spacious_slide_text_position'.$i , 'left' );
					$spacious_slider_button_text = of_get_option( 'spacious_slider_button_text'.$i , __( 'Read more', 'spacious' ) );
					$spacious_slider_link = of_get_option( 'spacious_slider_link'.$i , '#' );

					// For WPML plugin compatibility 
			 		if ( function_exists( 'icl_register_string' ) ) {
						icl_register_string( 'Spacious Pro', 'Slider Title '.$i , $spacious_slider_title );
						icl_register_string( 'Spacious Pro', 'Slider Description '.$i , $spacious_slider_text );
						icl_register_string( 'Spacious Pro', 'Slider Button Text '.$i , $spacious_slider_button_text );
					}
					
					if( !empty( $spacious_header_title ) || !empty( $spacious_slider_text ) || !empty( $spacious_slider_image ) ) {
						if ( $i == 1 ) { $classes = "slides displayblock"; } else { $classes = "slides displaynone"; }

						if ( $spacious_slide_text_position == 'right' ) { $classes2 = "entry-container entry-container-right"; }
						else { $classes2 = "entry-container"; }
						?>
						<div class="<?php echo $classes; ?>">

							<?php
							// For WPML plugin compatibility 
					 		if ( function_exists( 'icl_t' ) ) {
								$spacious_slider_title = icl_t( 'Spacious Pro', 'Slider Title '.$i , $spacious_slider_title );
								$spacious_slider_text = icl_t( 'Spacious Pro', 'Slider Description '.$i , $spacious_slider_text );
								$spacious_slider_button_text = icl_t( 'Spacious Pro', 'Slider Button Text '.$i , $spacious_slider_button_text );
							}
							?>

							<figure>
								<img alt="<?php echo esc_attr( $spacious_slider_title ); ?>" src="<?php echo esc_url( $spacious_slider_image ); ?>">
							</figure>
							<div class="<?php echo $classes2; ?>">
								<?php if( !empty( $spacious_slider_title ) || !empty( $spacious_slider_text ) ) { ?>
								<div class="entry-description-container">
									<div class="slider-title-head"><h3 class="entry-title"><a href="<?php echo esc_url( $spacious_slider_link ); ?>" title="<?php echo esc_attr( $spacious_slider_title ); ?>"><span><?php echo $spacious_slider_title; ?></span></a></h3></div>
									<div class="entry-content"><p><?php echo $spacious_slider_text; ?></p></div>
								</div>
								<?php } ?>
								<div class="clearfix"></div>
								<?php if( !empty( $spacious_slider_button_text ) ) { ?>
								<a class="slider-read-more-button" href="<?php echo esc_url( $spacious_slider_link ); ?>" title="<?php echo esc_attr( $spacious_slider_title ); ?>"><?php echo $spacious_slider_button_text; ?></a>
								<?php } ?>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
			<nav id="controllers" class="clearfix"></nav>
		</section>

		<?php
}
endif;



if ( ! function_exists( 'spacious_header_title' ) ) :
/**
 * Show the title in header
 */
function spacious_header_title() {
	if( is_archive() ) {
		if ( is_category() ) :
			$spacious_header_title = single_cat_title( '', FALSE );

		elseif ( is_tag() ) :
			$spacious_header_title = single_tag_title( '', FALSE );

		elseif ( is_author() ) :
			/* Queue the first post, that way we know
			 * what author we're dealing with (if that is the case).
			*/
			the_post();
			$spacious_header_title =  sprintf( __( 'Author: %s', 'spacious' ), '<span class="vcard">' . get_the_author() . '</span>' );
			/* Since we called the_post() above, we need to
			 * rewind the loop back to the beginning that way
			 * we can run the loop properly, in full.
			 */
			rewind_posts();

		elseif ( is_day() ) :
			$spacious_header_title = sprintf( __( 'Day: %s', 'spacious' ), '<span>' . get_the_date() . '</span>' );

		elseif ( is_month() ) :
			$spacious_header_title = sprintf( __( 'Month: %s', 'spacious' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

		elseif ( is_year() ) :
			$spacious_header_title = sprintf( __( 'Year: %s', 'spacious' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

		elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
			$spacious_header_title = __( 'Asides', 'spacious' );

		elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
			$spacious_header_title = __( 'Images', 'spacious');

		elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
			$spacious_header_title = __( 'Videos', 'spacious' );

		elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
			$spacious_header_title = __( 'Quotes', 'spacious' );

		elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
			$spacious_header_title = __( 'Links', 'spacious' );

		elseif ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) :
			$spacious_header_title = woocommerce_page_title( false );

		else :
			$spacious_header_title = __( 'Archives', 'spacious' );

		endif;
	}
	elseif( is_404() ) {
		$spacious_header_title = __( 'Page NOT Found', 'spacious' );
	}
	elseif( is_search() ) {
		$spacious_header_title = __( 'Search Results', 'spacious' );
	}
	elseif( is_page()  ) {
		$spacious_header_title = get_the_title();
	}
	elseif( is_single()  ) {
		$spacious_header_title = get_the_title();
	}
	else {
		$spacious_header_title = '';
	}

	return $spacious_header_title;

}
endif;

/****************************************************************************************/

if ( ! function_exists( 'spacious_breadcrumb' ) ) :
/**
 * Display breadcrumb on header.
 *
 * If the page is home or front page, slider is displayed.
 * In other pages, breadcrumb will display if breadcrumb NavXT plugin exists.
 */
function spacious_breadcrumb() {
	if( function_exists( 'bcn_display' ) ) {
		echo '<div class="breadcrumb">'; 
		echo '<span class="breadcrumb-title">'.__( 'You are here:', 'spacious' ).'</span>';           
		bcn_display();               
		echo '</div> <!-- .breadcrumb -->'; 
	}   
}
endif;

?>