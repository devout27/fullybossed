<?php 
    add_action('wp_ajax_booking_details', 'getBookingDetails');
    add_action('wp_ajax_nopriv_booking_details', 'getBookingDetails');
    add_action('wp_ajax_session_details', 'getSessionDetails');
    add_action('wp_ajax_nopriv_session_details', 'getSessionDetails');

    add_action('wp_ajax_booking_save', 'bookingSave');
    add_action('wp_ajax_nopriv_booking_save', 'bookingSave');

    add_action('wp_ajax_coaching_booking_save', 'coachingBookingSave');
    add_action('wp_ajax_nopriv_coaching_booking_save', 'coachingBookingSave');

    add_action('wp_ajax_speaking_booking_save', 'speakingBookingSave');
    add_action('wp_ajax_nopriv_speaking_booking_save', 'speakingBookingSave');

    add_action('wp_ajax_check_slot_availability', 'checkSlotavAilability');
    add_action('wp_ajax_nopriv_check_slot_availability', 'checkSlotavAilability');

    add_action('wp_ajax_get_slot_payment', 'getSlotPayment');
    add_action('wp_ajax_nopriv_get_slot_payment', 'getSlotPayment');

    add_action('wp_ajax_get_DetailByEmail_action', 'get_DetailByEmail_callback');
    add_action('wp_ajax_nopriv_get_DetailByEmail_action', 'get_DetailByEmail_callback');
    add_action('wp_ajax_fb_discount_rules_action', 'fb_discount_rules_callback');

    add_action('wp_ajax_fb_calculate_speaking_booking_action', 'fb_calculate_speaking_booking_callback');
    add_action('wp_ajax_nopriv_fb_calculate_speaking_booking_action', 'fb_calculate_speaking_booking_callback');
	
	add_action('wp_ajax_set_booking_price', 'setBookingPrice');
	
	add_action('wp_ajax_nopriv_set_booking_price', 'setBookingPrice');
	
	add_action('wp_ajax_set_booking_decline', 'speakingBookingRequestDisapproved');
	
	add_action('wp_ajax_nopriv_set_booking_decline', 'speakingBookingRequestDisapproved');
	
	
	add_action('wp_ajax_download_a_copy', 'DownloadAcopy');
	
	add_action('wp_ajax_nopriv_download_a_copy', 'DownloadAcopy');
	
	add_action( 'wp_ajax_fb_subscribe_us_action', 'fb_subscribe_us_callback');
    add_action( 'wp_ajax_nopriv_fb_subscribe_us_action', 'fb_subscribe_us_callback');
?>