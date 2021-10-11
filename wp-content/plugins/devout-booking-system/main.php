<?php 
/*
* Devout Booking System
Plugin Name: Devout Booking System
Plugin URL: https://divilife.com/"
Description: Devout Booking System
Version: 2.1
Author: DEVOUT TECH CONSULTANTS
Author URI: https://devouttechconsultants.com/
 *
 * This plugin offers a starting point for replacing the WordPress dashboard.  If you are familiar with object oriented
 * programming, just subclass and overwrite the set_title() and page_content() methods. Otherwise, just alter the
 * set_title() and page_content() functions as needed.
 *
 * Customize which users are redirected to the custom dashboard by changing the capability property.
 *
 * If you don't want this plugin to be deactivated, just drop this file in the mu-plugins folder in the wp-content
 * directory.  If you don't have an mu-plugins folder, just create one.
 */
    $plugin_dir_path=plugin_dir_path(__FILE__);
	$plugin_dir_url=plugin_dir_url(__FILE__);
	define('PLUGIN_DIR_PATH',$plugin_dir_path);
	define('PLUGIN_DIR_URL',$plugin_dir_url);
    define('PLUGIN_DIR_NAME','devout-booking-system');
	$filename='Fully Bossed Blueprint_v1.1.pdf';
	$filename=plugin_dir_path(__FILE__).'ppt/'.$filename;
	define('PPT_FILE_PATH',$filename);
	
	
	require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/class/common.php');
	require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/class/ajax.php');
	require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/class/shortcode.php');
	require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/class/session.php');
	require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/class/booking.php');
	require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/class/ajax-callbacks.php');
	require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/stripe-php-master/vendor/autoload.php');
	
	function service_admin_menu(){

		add_menu_page(__('booking', 'booking'), __('Booking System', 'booking'), 'activate_plugins', 'booking', 'bookings','dashicons-admin-users',56);
		add_submenu_page('booking', __('Booking History Fully Bossed Academy', 'booking'), __('Booking History Fully Bossed Academy', 'booking'), 'activate_plugins', 'bookings-fully-bossed-academy', 'bookings_fully_bossed_academy');
		add_submenu_page('booking', __('Booking History Coaching', 'booking'), __('Booking History Coaching', 'booking'), 'activate_plugins', 'bookings-coaching', 'bookings_coaching');
		add_submenu_page('booking', __('Booking History Speaking', 'booking'), __('Booking History Speaking', 'booking'), 'activate_plugins', 'bookings-speaking', 'bookings_speaking');
		
		add_submenu_page('booking', __('Booking Request Speaking', 'booking'), __('Booking Request Speaking', 'booking'), 'activate_plugins', 'bookings-speaking-request', 'bookings_speaking_request');
		
		add_submenu_page('booking', __('Manage Sessions', 'booking'), __('Manage Fully Bossed Academy Sessions', 'booking'), 'activate_plugins', 'session', 'sessions');
		add_submenu_page('booking', __('Manage Coaching Sessions', 'booking'), __('Manage Coaching Sessions', 'booking'), 'activate_plugins', 'coaching-slot-availability', 'coachingSlotAvailability');
		add_submenu_page('booking', __('Manage Speaking Hourly Prices', 'fb-speaking-searvice'), __('Manage Speaking Hourly Prices', 'fb-speaking-searvice'), 'manage_options', 'fb-hourly-prices', 'fbHourlyPrices_callback');
		add_submenu_page('booking', __('Booking Discounts', 'booking'), __('Booking Discounts', 'booking'), 'activate_plugins', 'fb-booking-discounts', 'fb_admin_menu_callback');
		

        add_submenu_page('booking', __('Download History', 'booking'), __('Download History', 'booking'), 'activate_plugins', 'download-history', 'download_history');
		add_submenu_page('booking', __('Email Subscription', 'booking'), __('Email Subscription', 'booking'), 'activate_plugins', 'email-subscription', 'email_subscription');
		add_submenu_page('booking', __('', 'booking'), __('', 'booking'), 'activate_plugins', 'add-edit-session', 'addEditSession');

	}
	add_action('admin_menu', 'service_admin_menu');

	/*function fb_speaking_service_admin_menu(){
		add_menu_page(__('speaking', 'speaking'), __('Speaking Service', 'speaking'), 'manage_options', 'fb-speaking-searvice', 'fb_speaking','dashicons-admin-users',56);

		add_submenu_page('fb-speaking-searvice', __('Booking History', 'fb-speaking-searvice'), __('Booking History', 'fb-speaking-searvice'), 'manage_options', 'fb-speaking-searvice', 'fb_speaking');

		add_submenu_page('fb-speaking-searvice', __('Manage Hourly Prices', 'fb-speaking-searvice'), __('Manage Hourly Prices', 'fb-speaking-searvice'), 'manage_options', 'fb-hourly-prices', 'fbHourlyPrices_callback');	
	}
	add_action('admin_menu', 'fb_speaking_service_admin_menu');*/

	function fb_speaking() {
		echo '<p> Booking History </p>';
	}
	function fbHourlyPrices_callback() {
		require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/speaking-hourly-prices.php');
	}
	function bookings(){		
		require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/booking.php');
	}
	function bookings_fully_bossed_academy(){		
		require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/bookings_fully_bossed_academy.php');
	}
	function bookings_coaching(){		
		require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/bookings_coaching.php');
	}
	function bookings_speaking(){		
		require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/bookings_speaking.php');
	}
	
	function bookings_speaking_request(){		
		require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/bookings_speaking_request.php');
	}
	function addEditSession(){
		require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/add-edit-session.php');
	}
	function sessions(){
		
		require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/session.php');
	}
	function coachingSlotAvailability(){		
		require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/coaching-slot-availability.php');
	}
	function fb_admin_menu_callback(){		
		require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/fb-booking-discount-html.php');
	}
	function download_history(){
		
		require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/download.php');
	}
	function email_subscription(){
		
		require_once(ABSPATH . 'wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/email_subscription.php');
	}
	
	function fb_scripts() {
		$site_url = get_site_url();
        $session_dates_arr=array();
		global $post,$wp_scripts, $wp_styles;
    	// $page_slug = $post->post_name;
		$plugin_dir_url = plugin_dir_url(__DIR__);
		$img_sorting_url = $plugin_dir_url.'/devout-booking-system/sorting.png';
		wp_enqueue_script( 'jquery-ui-sortable');
		$discount_rules = json_encode(get_option( 'discount_rules'));
		// create my own version codes
		$my_js_ver = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'template/assets/js/fullybossed-frontend.js'));
		$my_css_ver = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'template/assets/css/fullybossed-frontend.css'));
		// if($page_slug == 'booking-speaking-overview') {
		// 	wp_enqueue_script('fb-calendar-min-js', plugin_dir_url(__FILE__).'template/assets/js/calendar.min.js', array(),'1.3.6', true );
		// }
		
		wp_enqueue_script('jquery-timepicker-js', plugin_dir_url(__FILE__).'/template/assets/js/jquery-timepicker.js', array(), '5.6.9' ,true);
		wp_enqueue_script('fb-frontend-js', plugin_dir_url(__FILE__).'/template/assets/js/fullybossed-frontend.js?wsx=8.6.9', array(), $my_js_ver );
		wp_enqueue_style('fb-frontend-css', plugin_dir_url(__FILE__).'/template/assets/css/fullybossed-frontend.css', array(), $my_css_ver, 'all' );
		
		wp_enqueue_style('fb-powerful-calendar-page-css', plugin_dir_url(__FILE__).'/template/assets/css/powerful-calendar/page.css', array(), $my_css_ver, 'all');
		
		wp_enqueue_style('fb-powerful-calendar-style-css', plugin_dir_url(__FILE__).'/template/assets/css/powerful-calendar/style.css', array(), $my_css_ver, 'all' );
		wp_enqueue_style('fb-powerful-calendar-theme-css', plugin_dir_url(__FILE__).'/template/assets/css/powerful-calendar/theme.css', array(), $my_css_ver, 'all' );
		wp_enqueue_style('fb-timePicker-css', plugin_dir_url(__FILE__).'/template/assets/css/timePicker.css', array(), $my_css_ver, 'all' );

		wp_enqueue_style('fb-booking-discount-css', plugin_dir_url(__FILE__).'/template/assets/css/fb-booking-discount-admin.css', array(), $my_css_ver, 'all' );
		
			global $wpdb;
			$session_dates = $wpdb->get_results( "SELECT * FROM XDk_dc_session_dates WHERE from_time != '' AND to_time != ''");
			if(count($session_dates) > 0) {
				foreach($session_dates as $val) {
					$pdate  = strtotime(date('M d Y'));
					$mydate = strtotime(date('M d Y',strtotime($val->session_date)));
					if ($mydate > $pdate) {
						$session_dates_arr[] = date('D M d Y',strtotime($val->session_date));
						//$session_dates_arr[] = intval(date("d", strtotime($val->session_date)));
					}
				}
			} else {
				$session_dates_arr = array();
			}
			wp_enqueue_script('fb-booking-discount-js', plugin_dir_url(__FILE__).'/template/assets/js/fb-booking-discount-admin.js', array(), '5.6.9' );
			$ajax_object = array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'session_dates_arr' => $session_dates_arr,
				'session_dates_qry' => $session_dates,
				'crdate'=> date("Y-m-d"),
				'discount_rules' => $discount_rules,
				'img_sorting_url'=>$img_sorting_url,
				'site_url' => $site_url
		);
		
		wp_localize_script( 'fb-frontend-js', 'FB_AJAX',$ajax_object);
		
		$speaking_booking_dates = $wpdb->get_results( "SELECT XDk_dc_session_booking_dates.session_date FROM XDk_dc_session_booking_dates LEFT JOIN XDk_dc_bookings ON XDk_dc_bookings.id=XDk_dc_session_booking_dates.booking_id WHERE XDk_dc_bookings.service_id='".SPEEKING_SERVICE_ID."' AND  XDk_dc_bookings.status='2' AND XDk_dc_bookings.payment_status='2' AND XDk_dc_bookings.location='in-personal' ORDER BY XDk_dc_session_booking_dates.session_date");
		
		if(count($speaking_booking_dates) > 0){
				
				foreach($speaking_booking_dates as $val) {
					
					$pdate  = strtotime(date('M d Y'));
					$mydate = strtotime(date('M d Y',strtotime($val->session_date)));
					
					if ($mydate >= $pdate) {
						
						$session_dates_arr_speaking_online[] = date('D M d Y',strtotime($val->session_date));
					}
				}
				
			} else {
				$session_dates_arr_speaking_online = array();
		}
		
		//pr($speaking_booking_dates);
		//pr($session_dates_arr_speaking_online,1);
		
		$speaking_booking_dates = $wpdb->get_results( "SELECT XDk_dc_session_booking_dates.session_date FROM XDk_dc_session_booking_dates LEFT JOIN XDk_dc_bookings ON XDk_dc_bookings.id=XDk_dc_session_booking_dates.booking_id WHERE XDk_dc_bookings.service_id='".SPEEKING_SERVICE_ID."' AND  XDk_dc_bookings.status='2' AND XDk_dc_bookings.payment_status='2' ORDER BY XDk_dc_session_booking_dates.session_date");
		
		if(count($speaking_booking_dates) > 0){
				
				foreach($speaking_booking_dates as $val) {
					
					$pdate  = strtotime(date('M d Y'));
					$mydate = strtotime(date('M d Y',strtotime($val->session_date)));
					
					if ($mydate >= $pdate) {
						$session_dates_arr_speaking_inpersonal[] = date('D M d Y',strtotime($val->session_date));
					}
				}
				
			} else {
				
				$session_dates_arr_speaking_inpersonal = array();
		}
		$ajax_speaking_object = array( 
				'ajaxurl' => admin_url( 'admin-ajax.php'),
				// 'session_dates_arr_speaking_online' => $session_dates_arr_speaking_online,
				// 'session_dates_arr_speaking_inpersonal' => $session_dates_arr_speaking_inpersonal,
				'crdate'=> date("Y-m-d"),
				'img_sorting_url'=>$img_sorting_url,
				'site_url' => $site_url,
				'location_type'=>'online'
		);
		//pr($ajax_speaking_object,1);
		wp_localize_script( 'fb-frontend-js', 'FB_AJAX_SPEAKING',$ajax_speaking_object);
		
	}
    add_action('wp_enqueue_scripts', 'fb_scripts');
	add_action('admin_enqueue_scripts', 'fb_scripts');
	
	function fb_js_css_version($url) {
		return add_query_arg(array('qaz' => time()), $url);
	}
	add_filter('script_loader_src', 'fb_js_css_version',9999);
	add_filter('style_loader_src', 'fb_js_css_version',9999);
	function add_cors_http_header(){
		header("Access-Control-Allow-Origin: *");
	}
	//add_action('init','add_cors_http_header');
