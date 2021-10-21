<?php
/**
 * Theme Name: FullyBossed
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package WordPress
 * @subpackage FullyBossed
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
function add_theme_scripts() {
	global $wp_query;
	wp_enqueue_style( 'plugin', get_template_directory_uri() . '/css/plugin-min.css?qaz=798', array(), '3.5.9', 'all');
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css?qaz=798', array(), '3.5.9', 'all');	
	wp_enqueue_script( 'plugin', get_template_directory_uri() . '/js/plugin-min.js', array ( 'jquery' ), 1.3, true);
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js?ver_qaz=456', array ( 'jquery' ), 'ver_qaz=456', true);	
	$admin_logged_in = false;
	$current_user_role='';
	$post = $wp_query->get_queried_object();
  	$pagename = $post->post_name;
	if( current_user_can('administrator') ) {
		$admin_logged_in = true;
	}

	if(get_current_user_id()) {
		$user_id = get_current_user_id();
		$user_meta = get_userdata($user_id);
		$current_user_role = $user_meta->roles[0];
	}
	wp_localize_script( 'custom', 'fullyBossed_Theme_AJAX',
        array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'admin_logged_in' => $admin_logged_in,
			'site_url' => get_site_url(),
			'pagename' => $pagename,
			'current_user_role' => $current_user_role
        )
    );
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );
register_nav_menus(array(
	'Primary' => __('Primary Menu', 'FullyBossed'),
	'Secondary' => __('Footer Menu','FullyBossed'),
	'Social' => __('Social Menu','FullyBossed')
));
function wpb_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Copywrite', 'wpb' ),
		'id' => 'sidebar-1',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
}
add_action( 'widgets_init', 'wpb_widgets_init');

function fullybossed_custom_logo_setup() {
	 $defaults = array(
		 'height'      => 80,
		 'width'       => 'auto',
		 'flex-height' => true,
		 'flex-width'  => true,
		 'header-text' => array( 'Fully Bossed' ),
	 );
	add_theme_support( 'custom-logo', $defaults );
}	
add_action( 'after_setup_theme', 'fullybossed_custom_logo_setup' );
add_theme_support('post-thumbnails');
add_theme_support('custom-field');

function wpb_demo_shortcode1() {
	$message = '
		<div class="coaching-testi text-center">
			<div class="swiper-container coaching-slide">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="home-testi-single dark">
							<h4>“Just want to formally say thank you for helping me prepare with my performance review sessions at work, it helped me take a step back, without over thinking it.”</h4>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="home-testi-single dark">
							<h4>“‘I’m writing this to formally thank you as I look back after year one in my start-up. I owe a lot to you personally! Through our intense projects together, I learnt how to consult to a high standard. Each stroke of your red pen would set the bar. It was in those project battlegrounds that I really found my working confidence. Your belief and sponsorship in me have meant more than you might imagine.”</h4>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="home-testi-single dark">
							<h4>“You never gave up on me and always saw my true abilities even before I did. I really appreciate that and thank you for making the time.”</h4>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="home-testi-single dark">
							<h4>“I have learnt and experienced so much – which you have been a massive part of do thank you for everything and all your support. You have been a massive advocate of mine and it’s’ been really appreciated and can’t thank you enough…”</h4>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="home-testi-single dark">
							<h4>“Yesss thanks Oli! I’m definitely working through a lot of what you said to me regarding my own confidence, self belief and story. I’m realising there’s a lot of layers to it. So THANK YOU. I feel more determined to continue to explore other avenues. You’ve definitely inspired me!!!”</h4>
						</div>
					</div>
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
	';
	return $message;
}
add_shortcode('coaching_testimonial', 'wpb_demo_shortcode1');
function fb_theme_js_css_version($url) {
	return add_query_arg(array('qaz' => time()), $url);
}
add_filter('script_loader_src', 'fb_theme_js_css_version',9999);
add_filter('style_loader_src', 'fb_theme_js_css_version',9999);
//add_action( 'template_redirect', 'fb_tr');
function fb_tr(){	
	global $wp_query, $post;
    $user_id = get_current_user_id();
	$user_meta = get_userdata($user_id);	
	if(!is_front_page() && (is_page('about') || is_page('blog-single') || is_page('booking-calender') || is_page('booking-calender') || is_page('coaching'))) {
		if($user_meta->roles[0] != 'administrator' || !is_user_logged_in()) {
			wp_redirect( home_url() );
			exit();
		}
	}
}

/*function fb_subscribe_us_callback() {
	
	$result_array = array();
	if(isset($_POST['status']) && trim($_POST['status']) == '1') {
		
		$email = isset($_POST['email']) ? trim($_POST['email']) : '';
		$subject = 'Fully Bossed | New Subscription';		
		$body = "<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
		Hello $email,</p>
		<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
		Thank you for subscribing with us! We’re delighted you’ve joined the Fully Bossed tribe. We’re continuing to work really hard in the background to bring you the best set of career advancing services. It worked well for us and we can’t wait to share all the tips (and secrets) with you!
		</p>";
		$img  = PLUGIN_DIR_URL.'email-template/fully-bossed-logo-CAUDEX-REGULAR-2.png';
		$final_body = '<!doctype html>
		<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Fully Bossed</title>
		</head>
		<body>
		<div class="container" style="width: 600px; margin: 0 auto;">
			<div class="header" style="width: 598px; padding: 0 0 15px; /* background-color: #A8D08D;  text-align: center; border: 1px solid #A8D08D;">
			  <div class="logo" style="width: 180px; margin: 10px auto; letter-spacing: 0.25em; text-transform: uppercase;">
				  <img src="'.$img.'" alt="" style="width: 100%; display: block;">
			  </div>
		   </div>
		   <div style="width: 100%; padding: 20px 0 20px; background-color: #A8D08D;;text-align: center;">
			  <div style="font-size: 20.0px;text-align: center;margin: 0 0 0 0;color: rgb(0,0,0);font-weight: 600;background: #FFDA67;display: inline-block;padding: 10.0px 20.0px; font-family: Gotham;">'.$subject.'</div>
		   </div>
		   <div class="Dear" style="width: 100%; color: #000; background-color: #A8D08D;  box-sizing: border-box; padding: 0 0px 0 30px;padding-right: 30px;padding-left: 30px;">
			 '.$body.'
		   </div>
			<div class="content" style="width: 100%; color: #fff; padding: 15px 0 5px; background-color: #A8D08D; box-sizing: border-box;">
			  
			<div style="width: 100%;color: #fff; box-sizing: border-box; padding: 0 0px 0 36px;">
			<p style="line-height: 25.0px;display: block;margin: 15px 0 10px 0;color: rgb(51,51,51); color: #000; font-family: Gotham;">Stay tuned, <br> Team Fully Bossed.</p>
			</div>
			</div>
			<div class="footer" style="width: 100%; text-align: center; color: #000; border-top: solid 1px #00000085; background-color: #F4B083; padding: 5px 0 5px;">
			  <p style="font-family: Gotham;">Copyright © www.FullyBossed.com</p>
			</div>
		</div>		
		  </body>
		  </html>';
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$headers[] = 'From: Fully Bossed <info@fullybossed.com>';				
		$admin_email = ADMIN_EMAIL;
		$headers[] = "Cc: $admin_email";	
		wp_mail($email, $subject, $final_body, $headers);
		$status = true;
		$msg = 'Success';
	} else {
		$status = false;
		$msg = 'Fail';
	}
	$result_array['status'] = $status;
	$result_array['msg'] = $msg;
	wp_send_json($result_array);
}*/



