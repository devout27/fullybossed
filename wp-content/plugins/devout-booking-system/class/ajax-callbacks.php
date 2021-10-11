<?php
   function get_DetailByEmail_callback() {
    global $wpdb;
    $result_arr = array();
    if(isset($_GET['status']) && trim($_GET['status']) == '1') {
        $table = $wpdb->prefix.'dc_bookings';
        $email = isset($_GET['email']) ? trim($_GET['email']):'';
        $querystr = "SELECT * FROM $table WHERE `email` = '$email' ORDER BY `id` DESC LIMIT 1";        
        $booking_posts = $wpdb->get_row($querystr, ARRAY_A);
        if($booking_posts) {
            $result_arr['status'] = true;
            $result_arr['msg'] = 'Success';
            $result_arr['user_data'] = $booking_posts;
        } else {
            $result_arr['status'] = false;
            $result_arr['msg'] = 'Record not exist.';
        }
    } else {
        $result_arr['status'] = false;
        $result_arr['msg'] = 'Request is invalid.';
    }
    wp_send_json($result_arr);
    exit();
}
function fb_discount_rules_callback() {
    $result = array();
    if(isset($_POST['status']) && $_POST['status'] == '1') {
        $discount_rules = isset($_POST['discount_rules']) ? $_POST['discount_rules'] : array();
        update_option( 'discount_rules', $discount_rules);
        $result['status'] = true;
        $result['msg'] = 'Data has been updated successfully.';
    } else {
        $result['status'] = false;
        $result['msg'] = 'Request is invalid';
    }		
    wp_send_json($result);
    exit();
}

function fb_calculate_speaking_booking_callback() {
	
    $result_arr = array();
    $total_hours = 0;
    //$hourly_price = intval(get_option('fb_speaking_hourly_price', 0));
    $sessionData = getSessionById(SPEEKING_SESSION_ID);
    $hourly_price=$sessionData['price'];
    $speakingpayment_html='';
    if(isset($_GET['status']) && trim($_GET['status']) == '1') {

        $input_time_from=$time_from = isset($_GET['time_from']) ? trim($_GET['time_from']) : '';
        $input_time_to=$time_to = isset($_GET['time_to']) ? trim($_GET['time_to']) : '';
        $input_time_date =$date= isset($_GET['selectedDate']) ? trim($_GET['selectedDate']) : '';
        $location_type=isset($_GET['location_type']) ? trim($_GET['location_type']) : 'online';
		
        if($time_from != '' && $time_to != '' && $date != '') {
			
			
            $from_time = date("y-m-d h:i A", strtotime($date." ".$time_from));
            $to_time = date("y-m-d h:i A", strtotime($date." ".$time_to));        
            $date1 = strtotime($from_time);
            $date2 = strtotime($to_time);
			$total_hours=$diff = (abs($date2 - $date1) / 60) / (60);
			if($date1 >=  $date2){
				$total_hours=0;
			}
           
			$speakingpayment_html='';
			if($location_type=='online'){
            $subtotal = ($hourly_price * $diff);
            $hts_amount = ($subtotal*HST_PERCENT)/100;
			$total = $subtotal + $hts_amount;
            $speakingpayment_html='<div class="booking-s-single-title">
									<h4>Total Price</h4>
								</div>

								<ul id="speaking-payment">

								
			    <li>
					<div class="row">
						<div class="col-md-6">
							<p>Price Per Hour</p>
						</div>
						<div class="col-md-6">
							<p class="text-right"><strong>'.CURRENCYSYMBOL.number_format($hourly_price,2).'</strong></p>
						</div>
					</div>
				</li> 
			    <li>
					<div class="row">
						<div class="col-md-6">
							<p>SubTotal</p>
						</div>
						<div class="col-md-6">
							<p class="text-right"><strong>'.CURRENCYSYMBOL.number_format($subtotal,2).'</strong></p>
						</div>
					</div>
				</li>
				<li>
					<div class="row">
						<div class="col-md-6">
							<p>Tax ('.HST_PERCENT.'% HST)</p>
						</div>
						<div class="col-md-6">
							<p class="text-right"><strong>'.CURRENCYSYMBOL.number_format($hts_amount,2).'</strong></p>
						</div>
					</div>
				</li>
				<li>
					<div class="row">
						<div class="col-md-6">
							<p>Total</p>
						</div>
						<div class="col-md-6">
							<p class="text-right"><strong>'.CURRENCYSYMBOL.number_format($total,2).'</strong></p>
						</div>
					</div>
				</li></ul>';
			}
			
            if($total_hours > 0){
				
			   check_speaking_booking_availability($input_time_from,$input_time_to, $input_time_date,$location_type);
               $status = true;
			   $msg = 'Success';
			   
            }else{
				
                $status = false;
                $msg = 'To Time Must Be Greater Than From Time'; 

            }
        } else {

            $status = false;
            $msg = 'Select required field.';
        }
    } else {
        $status = false;
        $msg = 'Request is invalid';
    }
    $result_arr['status'] = $status;
    $result_arr['msg'] = $msg;
    $result_arr['total_hours'] = $total_hours;
    $result_arr['speakingpayment_html'] = $speakingpayment_html;
    //wp_send_json
    echo json_encode($result_arr);
    die();
}


function check_speaking_booking_availability($time_from,$time_to,$date,$location_type){
	
	global $wpdb;
	$date = date('Y-m-d',strtotime($date));
	
	$sql="SELECT XDk_dc_session_booking_dates.*,XDk_dc_bookings.location FROM XDk_dc_session_booking_dates LEFT JOIN XDk_dc_bookings ON XDk_dc_bookings.id=XDk_dc_session_booking_dates.booking_id WHERE XDk_dc_bookings.service_id='".SPEEKING_SERVICE_ID."' AND  XDk_dc_bookings.status=2 AND XDk_dc_bookings.payment_status=2 AND XDk_dc_session_booking_dates.session_date='".$date."'";
	$speaking_booking_dates = $wpdb->get_results($sql);
	
	if(count($speaking_booking_dates) > 0 && $location_type=='in-personal'){
		
		$msg="Selected date already booked";
		$result_arr['status'] = false;
		$result_arr['msg'] = $msg;
		$result_arr['total_hours'] = 0;
		$result_arr['speakingpayment_html'] ='';
		echo json_encode($result_arr);
		die();
		
	}else{
		
		/*$sql="SELECT XDk_dc_session_booking_dates.*,XDk_dc_bookings.location FROM XDk_dc_session_booking_dates LEFT JOIN XDk_dc_bookings ON XDk_dc_bookings.id=XDk_dc_session_booking_dates.booking_id WHERE XDk_dc_bookings.service_id='".SPEEKING_SERVICE_ID."' AND  XDk_dc_bookings.status=2 AND XDk_dc_bookings.payment_status=2 AND XDk_dc_session_booking_dates.session_date='".$date."'";
	    $speaking_booking_dates = $wpdb->get_results($sql);*/
		
		$time_booked=false;
		if(count($speaking_booking_dates) > 0){
			
			foreach($speaking_booking_dates as $val){
				
				$from_time=$val->from_time;
				$from_time=substr($from_time,0,2);
				$to_time=$val->to_time;
				$to_time=substr($to_time,0,2);
				$time_from=substr($time_from,0,2);
				$time_to=substr($time_to,0,2);
				$from_time=(int)$from_time;
				$to_time=(int)$to_time;
				$time_from=(int)$time_from;
				$time_to=(int)$time_to;
				
				if($from_time <= $time_from && $to_time >= $time_from){
					$time_booked=true;
					break;
				}else if($from_time <= $time_to && $to_time >= $time_to){
					$time_booked=true;
					break;
				}
			}
		}
		if($time_booked){
			$msg="Selected time already booked";
			$result_arr['status'] = false;
			$result_arr['msg'] = $msg;
			$result_arr['total_hours'] = 0;
			$result_arr['speakingpayment_html'] ='';
			echo json_encode($result_arr);
			die();
		}
	}
	
	
	
}
?>