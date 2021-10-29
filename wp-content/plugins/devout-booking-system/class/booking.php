<?php
function getBookingById($booking_id)
{
    $sql = "select * From XDk_dc_bookings  WHERE  id=$booking_id";
    $booking = getRowByID($sql);
    return $booking;
}
function getBookingList()
{
    $sql = "select * From XDk_dc_bookings  WHERE  status IN (1,2) AND payment_status IN(2,3)";
    $booking = getRow($sql);
    return $booking;
}

function getBookingListByServiceId($service_id)
{
    $sql = "select * From XDk_dc_bookings  WHERE  status IN (1,2) AND payment_status IN(2,3) AND service_id='".$service_id."'";
    $booking = getRow($sql);
    return $booking;
}

function getBookingSpeakingListByServiceId($service_id)
{
    $sql = "select * From XDk_dc_bookings  WHERE  status IN (2) AND payment_status IN(2,3) AND service_id='".$service_id."'";
    $booking = getRow($sql);
    return $booking;
}
function getBookingRequestSpeakingListByServiceId($service_id)
{
    $sql = "select * From XDk_dc_bookings  WHERE  status IN (1,4,5) AND payment_status IN(1) AND service_id='".$service_id."'";
    $booking = getRow($sql);
    return $booking;
}

function getBookingSessionDatesByBookingId($booking_id)
{
    $sql = "select * From XDk_dc_session_booking_dates  WHERE  booking_id=$booking_id ORDER By session_date";
    $booking = getRow($sql);
    return $booking;
}
function getAllDownloadHistoryList()
{
    $sql = "select * From XDk_dc_downloads";
    $booking = getRow($sql);
    return $booking;

}
function getEmailSubscriptionList()
{
    $sql = "select * From XDk_dc_subscribe_emails";
    $booking = getRow($sql);
    return $booking;

}
function emailTemplate($subject, $body)
{
	$logo_url = get_stylesheet_directory_uri().'/images/fully-bossed-logo-min.png';
    $html = '<div style="font-family: Raleway, sans-serif !important; width:100%; max-width:600px; height:auto; text-align:center; padding:0px;background: #f3f3f3">
   <div style="padding: 30px 10px 0px 10px; text-align: center;">
      <img src="'.$logo_url.'" style="width: 100px;"><br>
      <div style="font-size: 20px; text-align: center; margin-top: 20px; color: #000; font-weight: 600;background: #a8d08d;display: inline-block;padding: 10px 20px;">'.$subject.'</div>
   </div>
   <div style="padding: 30px;text-align: left;font-size: 14px;">
      ' . $body . '
      <p style="line-height: 20px; display: block; margin: 0px 0px 5px 0px;color: #333; padding: 20px 0px 0px 0px; border-top: 1px solid rgba(0,0,0,0.1);">
	  Please let us know if you have any questions.</p>
      <p style="line-height: 20px; display: block; margin: 0px 0px 5px 0px;color: #333">			We look forward to seeing you then!.		</p>
      <p style="line-height: 20px; display: block; margin: 0px 0px 0px 0px;color: #000; font-weight: 600">			Fully Bossed</p>
   </div>
   <div style="background-color: #000;">
      <div style="padding: 20px 10px 20px 10px;"><span style="font-size: 14px; display: block;color: #fff;text-shadow: 1px 1px 10px rgba(0,0,0,0.1);">© 2021 All rights reserved</span></div>
   </div>
</div>';
    return $html;
}
#echo getBookingEmailHtml('Test test test test test test test test test test ','203','tthistestingboddy'); die();
function getBookingEmailHtml($subject,$booking_id,$body=null)
{
	$booking = getBookingById($booking_id);
	$Srvices = getServices();
	$html = fullyBossedAcedemyEmailHtml($subject,$booking_id,$body);
	return $html;
}

function getCoachingBookingEmailHtml($subject,$booking_id,$body=null)
{

	$booking = getBookingById($booking_id);
	$Srvices = getServices();
	$html=coachingBookingEmailHtml($subject,$booking_id,$body);
	return $html;
}


function getSpeakingBookingEmailHtml($subject,$booking_id,$body=null)
{
	$booking = getBookingById($booking_id);
	if($booking['location']=='in-personal'){
		$html  = SpeakingGetBookingInPersonalEmailHtml($booking_id,$subject,$body);
	}else{
		$html = SpeakingGetBookingEmailHtml($booking_id,$subject,$body);
	}
	return $html;
}

function getBookingHtml($booking_id) {

    $booking = getBookingById($booking_id);
    $Srvices = getServices();
    $payment_status = $booking['payment_status'] == 2 ? 'Success' : 'Failed';
    $booking_status = $booking['status'] == 2 ? 'Confirmed' : 'Pending';
	$service_id=$booking['service_id'];
    $html = '<div style="font-family: Raleway, sans-serif !important; width:100%; max-width:100%; height:auto; text-align:center; padding:0px;background: #f3f3f3">
	<div style="padding: 30px; text-align:left;font-size: 14px;">
	<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);">Booking Details</h5>
	<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; padding: 15px 0px 0px 0px; border-top: 1px solid rgba(0,0,0,0.1);color: #333"> Booking Id: <strong style="color: #000; font-weight: 600;">#' .$booking['id'].'</strong>			<br>
	Booking Date: <strong style="color: #000; font-weight: 600;">' .dateFormate($booking['created']).'</strong><br>
	Booking Status: <strong style="color: #000; font-weight: 600;">'.$booking_status. '</strong><br>Service: <strong style="color: #000; font-weight: 600;">'.$booking['service_name'].'</strong>';


		$html .='<br>Session Name: <strong style="color: #000; font-weight: 600;">'.$booking['session_name'].'</strong><br>Session Time: <strong style="color: #000; font-weight: 600;">'.ftimeFormate($booking['from_time']).' - '.ftimeFormate($booking['to_time']);
		if ($booking['session_date_type'] == 1) {
			$html .= "daily";
		}
		$html .= "</strong>";
		if ($booking['session_date_type'] == 2) {
			$sessionDates = getBookingSessionDatesByBookingId($booking_id);
			$html .= '<br>Session Date: <strong style="color: #000; font-weight: 600;">';
			foreach ($sessionDates as $date) {
				$session_date=$date['session_date'];
				$html .= date('F d Y', strtotime($session_date)). '</br>';
			}
			$html .= '</strong>';
		} else {
			$html .= '<br>Session Date: <strong style="color: #000; font-weight: 600;">' .date('F d', strtotime($booking['from_date'])).' - '.date('d, Y', strtotime($booking['to_date'])).'</strong>';
		}

	$html .= '</p>
	<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);">Payment Details</h5>
	<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	Name: <strong style="color: #000; font-weight: 600;">' .$booking['name']. '</strong>	<br>Email Address: <strong style="color: #000; font-weight: 600;">'.$booking['email'].'</strong><br>Mobile Number: <strong style="color: #000; font-weight: 600;">'.$booking['mobile_number'] . '</strong>	<br>Payment Status: <strong style="color: #000; font-weight: 600;">' . $payment_status . '</strong><br>Transaction ID: <strong style="color: #000; font-weight: 600;">' . $booking['transaction_id'] .'</strong><br>SubTotal: <strong style="color: #000; font-weight: 600;">' . CURRENCYSYMBOL.number_format($booking['subtotal'], 2).'</strong>			<br>		Tax ('.number_format($booking['total'], 0).'% HST): <strong style="color: #000; font-weight: 600;">'.CURRENCYSYMBOL.number_format($booking['hst_amount'], 2) . '</strong><br>Total: <strong style="color: #000; font-weight: 600;">'.CURRENCYSYMBOL.number_format($booking['total'], 2).'</strong></p>';
	$html .= '</p>
	<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);">User Details</h5>';

	$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 0px 0px; color: #333;">	Who You are?: <strong style="color: #000; font-weight: 600;">' .$booking['who_you_are']. '</strong></p>';

	$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 0px 0px; color: #333;">	Current position: <strong style="color: #000; font-weight: 600;">' .$booking['current_position']. '</strong></p>';




		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 0px 0px; color: #333;">	Goals: <strong style="color: #000; font-weight: 600;">' .$booking['goals']. '</strong></p>';

		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 0px 0px; color: #333;">	Top strength: <strong style="color: #000; font-weight: 600;">' .$booking['top_strength']. '</strong></p>';


		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 0px 0px; color: #333;">	Top development point: <strong style="color: #000; font-weight: 600;">' .$booking['top_development_point']. '</strong></p>';

		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 0px 0px; color: #333;">Instagram handle: <strong style="color: #000; font-weight: 600;">' .$booking['instagram_handle']. '</strong></p>';

		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 0px 0px; color: #333;">LinkedIn handle: <strong style="color: #000; font-weight: 600;">' .$booking['linkedin_handle']. '</strong></p>';

		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 0px 0px; color: #333;">Facebook handle: <strong style="color: #000; font-weight: 600;">' .$booking['facebook_handle']. '</strong></p>';

		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 0px 0px; color: #333;">Twitter handle: <strong style="color: #000; font-weight: 600;">' .$booking['twitter_handle']. '</strong></p>';

		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 0px 0px; color: #333;">Comments: <strong style="color: #000; font-weight: 600;">' .$booking['comments']. '</strong></p>';
		$html .='</div></div>';
	return $html;

}
#echo fullyBossedAcedemyEmailHtml('Tetin gddsf','191','sffsfsfsfsfff'); die();
function fullyBossedAcedemyEmailHtml($subject,$booking_id,$body){

	$booking = getBookingById($booking_id);
	#pr($booking,1);
	$Srvices = getServices();
	$StatusTypes = array(1 =>'<button <button style="background:#f4b083;">Pending</button>', 2 => '<button style="background:#a8d08d;">Confirmed</button>', 3 => '<button  style="background:#ee5656;">Canceled</button>',4 => '<button style="background:#a8d08d;">Approved</button>',5 => '<button style="background:#ee5656;">Declined</button>');
	$paymentStatus = array(1 => '<button  style="background:#f4b083;">Pending</button>', 2 => '<button style="background:#a8d08d;">Success</button>', 3 => '<button style="background:#ee5656;">Failed</button>');

	$paymentStatus = array(1 =>'<button  style="background:#f4b083;">Pending</button>', 2 => '<button style="background:#a8d08d;">Success</button>', 3 => '<button style="background:#ee5656;">Failed</button>');
	$payment_status = $paymentStatus[$booking['payment_status']];
    $booking_status = $StatusTypes[$booking['status']];
	$service_id=$booking['service_id'];
	$SessionDate='';
	if ($booking['session_date_type'] == 2) {
			foreach ($sessionDates as $date) {
				$session_date=$date['session_date'];
				$SessionDate .= date('F d Y', strtotime($session_date)). '<br>';
			}
	} else {
		$SessionDate= date('F d', strtotime($booking['from_date'])).' - '.date('d, Y', strtotime($booking['to_date']));
	}
	ob_start();
	include(PLUGIN_DIR_PATH.'email-template/fully-bossed-acedemy-booking-email.php');
	return ob_get_clean();


}

function coaching_GetBookingHtml($booking_id) {

    $booking = getBookingById($booking_id);
    $Srvices = getServices();
    $payment_status = $booking['payment_status'] == 2 ? 'Success' : 'Failed';
    $booking_status = $booking['status'] == 2 ? 'Confirmed' : 'Pending';
	$ZoomMeetingDetails = get_ZoomMeetingDetails($booking_id);

	$meeting_date = date("d-M-Y", strtotime($ZoomMeetingDetails[0]->start_time));
	$meeting_time = date("h:i A", strtotime($ZoomMeetingDetails[0]->start_time));
	$service_id = $booking['service_id'];

    $html = '<div style="font-family: Raleway, sans-serif !important; width:100%; max-width:100%; height:auto; text-align:center; padding:0px;background: #f3f3f3">
	<div style="padding: 30px; text-align:left;font-size: 14px;">
	<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);">Booking Details</h5>
	<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; padding: 15px 0px 0px 0px; border-top: 1px solid rgba(0,0,0,0.1);color: #333"> Booking Id: <strong style="color: #000; font-weight: 600;">#' .$booking['id'].'</strong> <br>
	Booking Date: <strong style="color: #000; font-weight: 600;">' .dateFormate($booking['created']).'</strong><br>
	Booking Status: <strong style="color: #000; font-weight: 600;">'.$booking_status. '</strong><br>Service: <strong style="color: #000; font-weight: 600;">'.$booking['service_name'].'</strong>';

	    $sql_main_slot_id = "SELECT * FROM XDk_dc_session_booking_dates WHERE booking_id = '$booking_id'";
	$booking_main_slot_id = getRow($sql_main_slot_id);
	$sub_slots_time = '<ul class="sub_slots_list ss-lists">';
	$total_booked_hours = 0;
	if(count($booking_main_slot_id) > 0) {

			$per_hour_rate = $booking_main_slot_id[0]['price'];
			$total_booked_hours = count($booking_main_slot_id);
			$last_time = $booking_main_slot_id[$total_booked_hours-1]['to_time'];
			$last_time_final = date("h:i A", strtotime($last_time));
			$slot_hours = $total_booked_hours;
			$booking_subtotal = $per_hour_rate * $total_booked_hours;
			$sub_slots_time .= '<p class="p_sub_slots_list">';
			foreach($booking_main_slot_id as $value) {
				$sub_slots_time .= '<li><strong style="color: #000; font-weight: 600;">'.ftimeFormate($value['from_time']).'-'.ftimeFormate($value['to_time']).'</li></strong>';
			}
			$sub_slots_time .= '</p>';
	}
	$sub_slots_time .= '</ul>';
	if($total_booked_hours == 1) {

			$total_booked_hours = $total_booked_hours.' hour';
	} elseif($total_booked_hours > 1) {
			$total_booked_hours = $total_booked_hours.' hours';
	}

	$sessionDates = getBookingSessionDatesByBookingId($booking_id);
	$sessionDates = $sessionDates[0];
	$slot_date = date('d, M Y', strtotime($sessionDates['session_date']));
	$html .='<br>Slot Date : <strong style="color: #000; font-weight: 600;">'.date('d, M Y', strtotime($sessionDates['session_date'])).'</strong><br> Total Slot Time Booked : <strong style="color: #000; font-weight: 600;">'.$total_booked_hours.'</strong>';
	if(!empty($sub_slots_time)) {

			$html .='<br> Sub Slots Time: '.rtrim(trim($sub_slots_time), ',');
	}
	if(isset($booking['discount_percent']) && !empty($booking['discount_percent'])) {
		$discount_percent = $booking['discount_percent'];
	} else {
		$discount_percent = 0;
	}

	if(isset($booking['discount_val']) && !empty($booking['discount_val'])) {
		$discount_val = $booking['discount_val'];
	} else {
		$discount_val = 0;
	}
	$html .= '</p>
	<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);">Payment</h5>
	<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	Name: <strong style="color: #000; font-weight: 600;">' .$booking['name']. '</strong> <br> Email Address: <strong style="color: #000; font-weight: 600;">'.$booking['email'].'</strong><br>Mobile Number: <strong style="color: #000; font-weight: 600;">'.$booking['mobile_number'] . '</strong>	<br>Payment Status: <strong style="color: #000; font-weight: 600;">' . $payment_status . '</strong><br>Transaction ID: <strong style="color: #000; font-weight: 600;">' . $booking['transaction_id'] .'</strong><br>SubTotal: <strong style="color: #000; font-weight: 600;">' . CURRENCYSYMBOL.number_format($booking_subtotal, 2).'</strong> <br> Tax ('.number_format($booking['hst_percent'], 0).'% HST): <strong style="color: #000; font-weight: 600;">'.CURRENCYSYMBOL.number_format($booking['hst_amount'], 2) . '</strong> <br> Discount ('.number_format($discount_percent, 0).'%): <strong style="color: #000; font-weight: 600;">'.CURRENCYSYMBOL.number_format(($discount_val), 2) . '</strong> <br>Total: <strong style="color: #000; font-weight: 600;">'.CURRENCYSYMBOL.number_format($booking['total'], 2).'</strong></p>';

	if(count($ZoomMeetingDetails) > 0) {
		$html .= '<p>
		<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);">Zoom Meeting Invitation Details</h5>
		<h5 style="font-size: 14px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);">Fully Bossed is inviting you to a scheduled Zoom meeting.</h5><p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;"> Topic: <strong style="color: #000; font-weight: 600;">' .$ZoomMeetingDetails[0]->topic. '</strong> <br> Date: <strong style="color: #000; font-weight: 600;">'.$slot_date.'</strong>';


		foreach ($ZoomMeetingDetails as $value) {
			//echo count($ZoomMeetingDetails);

			$meeting_time = date("h:i A", strtotime($value->start_time));
			$html .= ' <hr style="width:100%"> Slot timing: <strong style="color: #000; font-weight: 600;">'.$meeting_time.'-'.$last_time_final.'</strong> <br> Join Zoom Meeting URL: <strong style="color: #000; font-weight: 600;"><a target="_blank" href="'.$value->join_url.'">'.$value->join_url . '</a></strong> <br> Meeting ID: <strong style="color: #000; font-weight: 600;">' . $value->meeting_id . '</strong><br> Passcode: <strong style="color: #000; font-weight: 600;">' . $value->password .'</strong>';
		}
		$html .= '</p>';
	}
	$html .= '</p>
	<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);">User Details</h5>';

	$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	Who You are?: <strong style="color: #000; font-weight: 600;">' .$booking['who_you_are']. '</strong></p>';
		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	Current position: <strong style="color: #000; font-weight: 600;">' .$booking['current_position']. '</strong></p>';

		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	Interested content: <strong style="color: #000; font-weight: 600;">' .$booking['interested_content']. '</strong></p>';

		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	Booking type: <strong style="color: #000; font-weight: 600;">' .$booking['booking_type']. '</strong></p>';

		if($booking['booking_type']=='Group Coaching'){
		   $html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	Number of Group Members: <strong style="color: #000; font-weight: 600;">' .$booking['number_of_group_members']. '</strong></p>';
		}
		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	Is it your 1st session?: <strong style="color: #000; font-weight: 600;">' .$booking['first_session']. '</strong></p>';

		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	Goals: <strong style="color: #000; font-weight: 600;">' .$booking['goals']. '</strong></p>';


		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	Top strength: <strong style="color: #000; font-weight: 600;">' .$booking['top_strength']. '</strong></p>';

		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	Top development point: <strong style="color: #000; font-weight: 600;">' .$booking['top_development_point']. '</strong></p>';

		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	# of Sessions: <strong style="color: #000; font-weight: 600;">' .$booking['number_of_sessions']. '</strong></p>';

		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">Instagram handle: <strong style="color: #000; font-weight: 600;">' .$booking['instagram_handle']. '</strong></p>';

		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">LinkedIn handle: <strong style="color: #000; font-weight: 600;">' .$booking['linkedin_handle']. '</strong></p>';

		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">Facebook handle: <strong style="color: #000; font-weight: 600;">' .$booking['facebook_handle']. '</strong></p>';

		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">Twitter handle: <strong style="color: #000; font-weight: 600;">' .$booking['twitter_handle']. '</strong></p>';
		$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">Comments: <strong style="color: #000; font-weight: 600;">' .$booking['comments']. '</strong></p>';

	$html .='</div></div>';
	return $html;
}
#echo coachingBookingEmailHtml('Testing',194,'Testing Site'); die('Ok');
function coachingBookingEmailHtml($subject,$booking_id,$body=null){

	$booking = getBookingById($booking_id);
	$Srvices = getServices();
	$StatusTypes = array(1 =>'<button <button style="background:#f4b083;">Pending</button>', 2 => '<button style="background:#a8d08d;">Confirmed</button>', 3 => '<button  style="background:#ee5656;">Canceled</button>',4 => '<button style="background:#a8d08d;">Approved</button>',5 => '<button style="background:#ee5656;">Declined</button>');
	$paymentStatus = array(1 => '<button  style="background:#f4b083;">Pending</button>', 2 => '<button style="background:#a8d08d;">Success</button>', 3 => '<button style="background:#ee5656;">Failed</button>');

	$paymentStatus = array(1 =>'<button  style="background:#f4b083;">Pending</button>', 2 => '<button style="background:#a8d08d;">Success</button>', 3 => '<button style="background:#ee5656;">Failed</button>');

	$payment_status = $paymentStatus[$booking['payment_status']];
    $booking_status = $StatusTypes[$booking['status']];
	$ZoomMeetingDetails=array();
	$ZoomMeetingDetails = get_ZoomMeetingDetails($booking_id);
	$meeting_date = date("d-M-Y", strtotime($ZoomMeetingDetails[0]->start_time));
	$meeting_time = date("h:i A", strtotime($ZoomMeetingDetails[0]->start_time));

	$service_id = $booking['service_id'];
	 $sql_main_slot_id = "SELECT * FROM XDk_dc_session_booking_dates WHERE booking_id = '$booking_id'";
		$booking_main_slot_id = getRow($sql_main_slot_id);
		$sub_slots_time = '';
		$total_booked_hours = 0;
		if(count($booking_main_slot_id) > 0) {
			$per_hour_rate = $booking_main_slot_id[0]['price'];
			$total_booked_hours = count($booking_main_slot_id);
			$last_time = $booking_main_slot_id[$total_booked_hours-1]['to_time'];
			$last_time_final = date("h:i A", strtotime($last_time));
			$slot_hours = $total_booked_hours;
			$booking_subtotal = $per_hour_rate * $total_booked_hours;
			foreach($booking_main_slot_id as $value) {
				$sub_slots_time .= '<strong style="color: #000; font-weight: 600;">'.ftimeFormate($value['from_time']).'-'.ftimeFormate($value['to_time']).'</strong><br>';
			}
		}
		if($total_booked_hours == 1) {

			$total_booked_hours = $total_booked_hours.' hour';
		} elseif($total_booked_hours > 1) {
			$total_booked_hours = $total_booked_hours.' hours';
	}
	$sessionDates = getBookingSessionDatesByBookingId($booking_id);
	$sessionDates = $sessionDates[0];
	$slot_date = date('d, M Y', strtotime($sessionDates['session_date']));
	if(isset($booking['discount_percent']) && !empty($booking['discount_percent'])) {
		$discount_percent = $booking['discount_percent'];
	} else {
		$discount_percent = 0;
	}

	if(isset($booking['discount_val']) && !empty($booking['discount_val'])) {
		$discount_val = $booking['discount_val'];
	} else {

		$discount_val = 0;
	}
	ob_start();
	include(PLUGIN_DIR_PATH.'email-template/coaching-booking-email.php');
	return ob_get_clean();

}

function SpeakingGetBookingHtml($booking_id) {

    $booking = getBookingById($booking_id);
    $Srvices = getServices();

	$StatusTypes = array(1 => '<button class="btn btn-warning">Pending</button>', 2 => '<button class="btn btn-success">Confirmed</button>', 3 => '<button class="btn btn-danger">Canceled</button>',4 => '<button class="btn btn-success">Approved</button>',5 => '<button class="btn btn-danger">Declined</button>');
    $paymentStatus = array(1 => '<button class="btn btn-warning">Pending</button>', 2 => '<button class="btn btn-success">Success</button>', 3 => '<button class="btn btn-danger">Failed</button>');

    $payment_status = $paymentStatus[$booking['payment_status']];
    $booking_status = $StatusTypes[$booking['status']];

	$ZoomMeetingDetails=array();
	$ZoomMeetingDetails = get_ZoomMeetingDetails($booking_id);
	$service_id = $booking['service_id'];
	$html='<div style="font-family: Raleway, sans-serif !important; width:100%; max-width:100%; height:auto; text-align:center; padding:0px;background: #f3f3f3">
	<div style="padding: 30px; text-align:left;font-size: 14px;">';
	if(!empty($booking['decline_comment'])){
	$html .= '
	<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);">Declined Reason</h5><p>'.$booking['decline_comment'].'</p>';
	}
	if($booking['status']==2 || $booking['status']==4){
	$html .= '
	<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);font-family: GoudyOS !important;">Payment</h5>
	<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	Name: <strong style="color: #000; font-weight: 600;">' .$booking['name']. '</strong> <br> Email Address: <strong style="color: #000; font-weight: 600;">'.$booking['email'].'</strong><br>Mobile Number: <strong style="color: #000; font-weight: 600;">'.$booking['mobile_number'] . '</strong>	<br>Payment Status: <strong style="color: #000; font-weight: 600;">' . $payment_status . '</strong><br>Transaction ID: <strong style="color: #000; font-weight: 600;">' . $booking['transaction_id'] .'</strong><br>SubTotal: <strong style="color: #000; font-weight: 600;">' . CURRENCYSYMBOL.number_format($booking['subtotal'], 2).'</strong> <br> Tax ('.number_format($booking['hst_percent'], 0).'% HST): <strong style="color: #000; font-weight: 600;">'.CURRENCYSYMBOL.number_format($booking['hst_amount'], 2) . '</strong><br>Total: <strong style="color: #000; font-weight: 600;">'.CURRENCYSYMBOL.number_format($booking['total'], 2).'</strong></p>';
	}
    $html .= '
	<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);font-family: GoudyOS !important;">Booking Details</h5>
	<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; padding: 15px 0px 0px 0px; border-top: 1px solid rgba(0,0,0,0.1);color: #333"> Booking Id: <strong style="color: #000; font-weight: 600;">#' .$booking['id'].'</strong> <br>
	Booking Date: <strong style="color: #000; font-weight: 600;">' .dateFormate($booking['created']).'</strong><br>
	Booking Status: <strong style="color: #000; font-weight: 600;">'.$booking_status. '</strong><br>Service: <strong style="color: #000; font-weight: 600;">'.$booking['service_name'].'</strong>';
	$sql = "SELECT * FROM XDk_dc_session_booking_dates WHERE booking_id = '$booking_id'";
	$booking_main_slot_id = getRowByID($sql);

	$total_booked_hours = 0;
	if(count($booking_main_slot_id) > 0) {

		$per_hour_rate = $booking_main_slot_id['price'];
		$total_booked_hours =  $booking_main_slot_id['total_hours'];
		$to_time = $booking_main_slot_id['to_time'];
		$to_time = date("h:i A", strtotime($to_time));

		$from_time = $booking_main_slot_id['from_time'];
		$from_time = date("h:i A", strtotime($from_time));
		$slot_date = date('d, M Y', strtotime($booking_main_slot_id['session_date']));
		$sub_slots_time .= 'Slots Time:<strong style="color: #000; font-weight: 600;">'.$from_time.'-'.$to_time .'</strong><br>';

	}
	if($total_booked_hours == 1) {

	   $total_booked_hours = number_format($total_booked_hours,0).' hour';

	} elseif($total_booked_hours > 1) {

		$total_booked_hours = number_format($total_booked_hours,0).' hours';
	}

	$sessionDates = getBookingSessionDatesByBookingId($booking_id);
	$sessionDates = $sessionDates[0];
	$html .='Slot Date : <strong style="color: #000; font-weight: 600;">'.$slot_date.'</strong><br>';
	$html .=$sub_slots_time;
	$html .='Total Hours: <strong style="color: #000; font-weight: 600;">'.$total_booked_hours.'</strong></p><p>Price Per Hours : <strong style="color: #000; font-weight: 600;">'.CURRENCYSYMBOL.$per_hour_rate.'</strong><br>';
	$html .='</p>';
	$html .= '</p>
	<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);font-family: GoudyOS !important;">Event Details</h5>';
	$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">Heading/Topic: <strong style="color: #000; font-weight: 600;">' .$booking['heading_topic']. '</strong><br>';
	$html .='Organisation: <strong style="color: #000; font-weight: 600;">' .$booking['organisation']. '</strong><br>';
	$html .='Message Description: <strong style="color: #000; font-weight: 600;">' .$booking['message_description']. '</strong><br>';

	$html .='Type of event: <strong style="color: #000; font-weight: 600;">' .$booking['type_of_event']. '</strong><br>';

	$html .='Special Requests: <strong style="color: #000; font-weight: 600;">' .$booking['special_requests']. '</strong><br>';

	$html .='Materials Required: <strong style="color: #000; font-weight: 600;">' .$booking['materials_required']. '</strong><br>';

	$html .='Meeting Link: <strong style="color: #000; font-weight: 600;">' .$booking['meating_link']. '</strong><br>';

	$html .='Location Type: <strong style="color: #000; font-weight: 600;">' .$booking['location']. '</strong><br>';

	$html .='Audience size: <strong style="color: #000; font-weight: 600;">' .$booking['audience_size']. '</strong><br>';

	$html .='Instagram handle: <strong style="color: #000; font-weight: 600;">' .$booking['instagram_handle']. '</strong><br>';

    $html .='LinkedIn handle: <strong style="color: #000; font-weight: 600;">' .$booking['linkedin_handle']. '</strong><br>';
	$html .='Facebook handle: <strong style="color: #000; font-weight: 600;">' .$booking['facebook_handle']. '</strong><br>';
	$html .='Twitter handle: <strong style="color: #000; font-weight: 600;">' .$booking['twitter_handle']. '</strong><br>';

	if($booking['status']==1 || $booking['status']==5 || $booking['status']==3){
	$html .= '
	<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);">Payment</h5>
	<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	Name: <strong style="color: #000; font-weight: 600;">' .$booking['name']. '</strong> <br> Email Address: <strong style="color: #000; font-weight: 600;">'.$booking['email'].'</strong><br>Mobile Number: <strong style="color: #000; font-weight: 600;">'.$booking['mobile_number'] . '</strong>	<br>Payment Status: <strong style="color: #000; font-weight: 600;">' . $payment_status . '</strong><br>Transaction ID: <strong style="color: #000; font-weight: 600;">' . $booking['transaction_id'] .'</strong><br>SubTotal: <strong style="color: #000; font-weight: 600;">' . CURRENCYSYMBOL.number_format($booking['subtotal'], 2).'</strong> <br> Tax ('.number_format($booking['hst_percent'], 0).'% HST): <strong style="color: #000; font-weight: 600;">'.CURRENCYSYMBOL.number_format($booking['hst_amount'], 2) . '</strong><br>Total: <strong style="color: #000; font-weight: 600;">'.CURRENCYSYMBOL.number_format($booking['total'], 2).'</strong></p>';
	}
	$html .='</div></div>';
	return $html;

}
function SpeakingGetBookingEmailHtml($booking_id,$subject,$body=null){
	$booking = getBookingById($booking_id);
	$Srvices = getServices();
	$StatusTypes = array(1 =>'<button <button style="background:#f4b083;">Pending</button>', 2 => '<button style="background:#a8d08d;">Confirmed</button>', 3 => '<button  style="background:#ee5656;">Canceled</button>',4 => '<button style="background:#a8d08d;">Approved</button>',5 => '<button style="background:#ee5656;">Declined</button>');
	$paymentStatus = array(1 => '<button  style="background:#f4b083;">Pending</button>', 2 => '<button style="background:#a8d08d;">Success</button>', 3 => '<button style="background:#ee5656;">Failed</button>');

	$paymentStatus = array(1 =>'<button  style="background:#f4b083;">Pending</button>', 2 => '<button style="background:#a8d08d;">Success</button>', 3 => '<button style="background:#ee5656;">Failed</button>');

	$payment_status = $paymentStatus[$booking['payment_status']];
    $booking_status = $StatusTypes[$booking['status']];
	$ZoomMeetingDetails=array();
	$service_id = $booking['service_id'];
	$sql = "SELECT * FROM XDk_dc_session_booking_dates WHERE booking_id = '$booking_id'";
	$booking_main_slot_id = getRowByID($sql);
	$total_booked_hours = 0;
	if(count($booking_main_slot_id) > 0) {

		$per_hour_rate = $booking_main_slot_id['price'];
		$total_booked_hours =  $booking_main_slot_id['total_hours'];
		$to_time = $booking_main_slot_id['to_time'];
		$to_time = date("h:i A", strtotime($to_time));

		$from_time = $booking_main_slot_id['from_time'];
		$from_time = date("h:i A", strtotime($from_time));
		$slot_date = date('d, M Y', strtotime($booking_main_slot_id['session_date']));
		$sub_slots_time .= $from_time.'-'.$to_time;

	}

	if($total_booked_hours == 1) {

	   $total_booked_hours = number_format($total_booked_hours,0).' hour';

	} elseif($total_booked_hours > 1) {

		$total_booked_hours = number_format($total_booked_hours,0).' hours';
	}
	ob_start();
	include(PLUGIN_DIR_PATH.'email-template/speaking-online-booking-email.php');
	return ob_get_clean();

}

function SpeakingGetBookingInPersonalHtml($booking_id) {

	$booking = getBookingById($booking_id);
    $Srvices = getServices();
	$StatusTypes = array(1 => '<button class="btn btn-warning">Pending</button>', 2 => '<button class="btn btn-success">Confirmed</button>', 3 => '<button class="btn btn-danger">Canceled</button>',4 => '<button class="btn btn-success">Approved</button>',5 => '<button class="btn btn-danger">Declined</button>');
    $paymentStatus = array(1 => '<button class="btn btn-warning">Pending</button>', 2 => '<button class="btn btn-success">Success</button>', 3 => '<button class="btn btn-danger">Failed</button>');
    $payment_status = $paymentStatus[$booking['payment_status']];
    $booking_status = $StatusTypes[$booking['status']];
	$ZoomMeetingDetails=array();
	$service_id = $booking['service_id'];
	$html='<div style="font-family: Raleway, sans-serif !important; width:100%; max-width:100%; height:auto; text-align:center; padding:0px;background: #f3f3f3">
	<div style="padding: 30px; text-align:left;font-size: 14px;">';
	if(!empty($booking['decline_comment'])){
	$html .= '
	<h5 style="font-size: 18px; font-family: "GoudyOS" !important; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);">Declined Reason</h5><p>'.$booking['decline_comment'].'</p>';

	}
	if($booking['status']==2 || $booking['status']==4){
		$html .= '
			<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);font-family: GoudyOS !important;">Payment</h5>
			<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	Name: <strong style="color: #000; font-weight: 600;">' .$booking['name']. '</strong> <br> Email Address: <strong style="color: #000; font-weight: 600;">'.$booking['email'].'</strong><br>Mobile Number: <strong style="color: #000; font-weight: 600;">'.$booking['mobile_number'] . '</strong>';

		if($booking['status']==2 || $booking['status']==4){

			$html .= '<br>Payment Status: <strong style="color: #000; font-weight: 600;">' . $payment_status . '</strong><br>Transaction ID: <strong style="color: #000; font-weight: 600;">' . $booking['transaction_id'] .'</strong>
			<br>Travel Expenses: <strong style="color: #000; font-weight: 600;">' . CURRENCYSYMBOL.number_format($booking['travel_expenses'], 2).'</strong>
			<br>Base Price For Event: <strong style="color: #000; font-weight: 600;">' . CURRENCYSYMBOL.number_format($booking['base_price_for_event'], 2).'</strong>
			<br>Service Charge: <strong style="color: #000; font-weight: 600;">' . CURRENCYSYMBOL.number_format($booking['service_charge'], 2).'</strong>
			<br>SubTotal: <strong style="color: #000; font-weight: 600;">' . CURRENCYSYMBOL.number_format($booking['subtotal'], 2).'</strong> <br> Tax ('.number_format($booking['hst_percent'], 0).'% HST): <strong style="color: #000; font-weight: 600;">'.CURRENCYSYMBOL.number_format($booking['hst_amount'], 2) . '</strong><br>Total: <strong style="color: #000; font-weight: 600;">'.CURRENCYSYMBOL.number_format($booking['total'], 2).'</strong>';

		}
		$html .='</p>';
	}

    $html .= '
	<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);font-family: GoudyOS !important;">Booking Details</h5>
	<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; padding: 15px 0px 0px 0px; border-top: 1px solid rgba(0,0,0,0.1);color: #333"> Booking Id: <strong style="color: #000; font-weight: 600;">#' .$booking['id'].'</strong> <br>
	Booking Date: <strong style="color: #000; font-weight: 600;">' .dateFormate($booking['created']).'</strong><br>
	Booking Status: <strong style="color: #000; font-weight: 600;">'.$booking_status. '</strong><br>Service: <strong style="color: #000; font-weight: 600;">'.$booking['service_name'].'</strong><br>';

	$sql = "SELECT * FROM XDk_dc_session_booking_dates WHERE booking_id = '$booking_id'";

	$booking_main_slot_id = getRowByID($sql);
	$total_booked_hours = 0;
	if(count($booking_main_slot_id) > 0) {

		$per_hour_rate = $booking_main_slot_id['price'];
		$total_booked_hours =  $booking_main_slot_id['total_hours'];
		$to_time = $booking_main_slot_id['to_time'];
		$to_time = date("h:i A", strtotime($to_time));

		$from_time = $booking_main_slot_id['from_time'];
		$from_time = date("h:i A", strtotime($from_time));
		$slot_date = date('d, M Y', strtotime($booking_main_slot_id['session_date']));
		$sub_slots_time .= 'Slots Time:<strong style="color: #000; font-weight: 600;">'.$from_time.'-'.$to_time .'</strong><br>';

	}

	if($total_booked_hours == 1) {

	   $total_booked_hours = number_format($total_booked_hours,0).' hour';

	} elseif($total_booked_hours > 1) {

		$total_booked_hours = number_format($total_booked_hours,0).' hours';
	}

	$sessionDates = getBookingSessionDatesByBookingId($booking_id);
	$sessionDates = $sessionDates[0];
	$html .='Slot Date : <strong style="color: #000; font-weight: 600;">'.$slot_date.'</strong><br>';
	$html .=$sub_slots_time;
	$html .='Total Hours: <strong style="color: #000; font-weight: 600;">'.$total_booked_hours.'</strong>';
	$html .='</p>';
	$html .='<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);font-family: GoudyOS !important;">Event Details</h5>';
	$html .='<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">Heading/Topic: <strong style="color: #000; font-weight: 600;">' .$booking['heading_topic']. '</strong><br>';
	$html .='Organisation: <strong style="color: #000; font-weight: 600;">' .$booking['organisation']. '</strong><br>';
	$html .='Message Description: <strong style="color: #000; font-weight: 600;">' .$booking['message_description']. '</strong><br>';
	$html .='Type of event: <strong style="color: #000; font-weight: 600;">' .$booking['type_of_event']. '</strong><br>';

	$html .='Special Requests: <strong style="color: #000; font-weight: 600;">' .$booking['special_requests']. '</strong><br>';

	$html .='Materials Required: <strong style="color: #000; font-weight: 600;">' .$booking['materials_required']. '</strong><br>';

	$html .='Location Type: <strong style="color: #000; font-weight: 600;">' .$booking['location']. '</strong><br>';

	$html .='Address: <strong style="color: #000; font-weight: 600;">' .$booking['location_description']. '</strong><br>';

	$html .='Postal Code: <strong style="color: #000; font-weight: 600;">' .$booking['postal_code']. '</strong><br>';

	$html .='Country: <strong style="color: #000; font-weight: 600;">' .$booking['country']. '</strong><br>';

	$html .='Audience size: <strong style="color: #000; font-weight: 600;">' .$booking['audience_size']. '</strong><br>';

	$html .='Instagram handle: <strong style="color: #000; font-weight: 600;">' .$booking['instagram_handle']. '</strong><br>';

    $html .='LinkedIn handle: <strong style="color: #000; font-weight: 600;">' .$booking['linkedin_handle']. '</strong><br>';
	$html .='Facebook handle: <strong style="color: #000; font-weight: 600;">' .$booking['facebook_handle']. '</strong><br>';
	$html .='Twitter handle: <strong style="color: #000; font-weight: 600;">' .$booking['twitter_handle']. '</strong><br>';

	if($booking['status']==1 || $booking['status']==5 || $booking['status']==3){
		$html .= '
			<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);">Payment</h5>
			<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; color: #333;">	Name: <strong style="color: #000; font-weight: 600;">' .$booking['name']. '</strong> <br> Email Address: <strong style="color: #000; font-weight: 600;">'.$booking['email'].'</strong><br>Mobile Number: <strong style="color: #000; font-weight: 600;">'.$booking['mobile_number'] . '</strong>';

		if($booking['status']==2 || $booking['status']==4){

			$html .= '<br>Payment Status: <strong style="color: #000; font-weight: 600;">' . $payment_status . '</strong><br>Transaction ID: <strong style="color: #000; font-weight: 600;">' . $booking['transaction_id'] .'</strong>
			<br>Travel Expenses: <strong style="color: #000; font-weight: 600;">' . CURRENCYSYMBOL.number_format($booking['travel_expenses'], 2).'</strong>
			<br>Base Price For Event: <strong style="color: #000; font-weight: 600;">' . CURRENCYSYMBOL.number_format($booking['base_price_for_event'], 2).'</strong>
			<br>Service Charge: <strong style="color: #000; font-weight: 600;">' . CURRENCYSYMBOL.number_format($booking['service_charge'], 2).'</strong>
			<br>SubTotal: <strong style="color: #000; font-weight: 600;">' . CURRENCYSYMBOL.number_format($booking['subtotal'], 2).'</strong> <br> Tax ('.number_format($booking['hst_percent'], 0).'% HST): <strong style="color: #000; font-weight: 600;">'.CURRENCYSYMBOL.number_format($booking['hst_amount'], 2) . '</strong><br>Total: <strong style="color: #000; font-weight: 600;">'.CURRENCYSYMBOL.number_format($booking['total'], 2).'</strong>';

		}
		$html .='</p>';

	}
	$html .='</div></div>';
	return $html;

}

function SpeakingGetBookingInPersonalEmailHtml($booking_id,$subject,$body=null){


	$booking = getBookingById($booking_id);
	$Srvices = getServices();
	$StatusTypes = array(1 =>'<button <button style="background:#f4b083;">Pending</button>', 2 => '<button style="background:#a8d08d;">Confirmed</button>', 3 => '<button  style="background:#ee5656;">Canceled</button>',4 => '<button style="background:#a8d08d;">Approved</button>',5 => '<button style="background:#ee5656;">Declined</button>');

	$paymentStatus = array(1 => '<button  style="background:#f4b083;">Pending</button>', 2 => '<button style="background:#a8d08d;">Success</button>', 3 => '<button style="background:#ee5656;">Failed</button>');
	$payment_status = $paymentStatus[$booking['payment_status']];
    $booking_status = $StatusTypes[$booking['status']];
	$ZoomMeetingDetails=array();
	$service_id = $booking['service_id'];

	$sql = "SELECT * FROM XDk_dc_session_booking_dates WHERE booking_id = '$booking_id'";
	$booking_main_slot_id = getRowByID($sql);
	$total_booked_hours = 0;
	if(count($booking_main_slot_id) > 0) {

		$per_hour_rate = $booking_main_slot_id['price'];
		$total_booked_hours =  $booking_main_slot_id['total_hours'];
		$to_time = $booking_main_slot_id['to_time'];
		$to_time = date("h:i A", strtotime($to_time));

		$from_time = $booking_main_slot_id['from_time'];
		$from_time = date("h:i A", strtotime($from_time));
		$slot_date = date('d, M Y', strtotime($booking_main_slot_id['session_date']));
		$sub_slots_time .= $from_time.'-'.$to_time;

	}

	if($total_booked_hours == 1) {

	   $total_booked_hours = number_format($total_booked_hours,0).' hour';

	} elseif($total_booked_hours > 1) {

		$total_booked_hours = number_format($total_booked_hours,0).' hours';
	}


	ob_start();
	include(PLUGIN_DIR_PATH.'email-template/speaking-in-personal-booking-email.php');
	return ob_get_clean();

}
function getBookingDetails(){

	$booking_id = $_POST['id'];
	$booking = getBookingById($booking_id);
	if($booking['service_id'] == COACHING_SERVICE_ID) {

		echo coaching_GetBookingHtml($booking_id);
	}
	if($booking['service_id'] == SPEEKING_SERVICE_ID) {

		if($booking['location']=='in-personal'){

		    echo SpeakingGetBookingInPersonalHtml($booking_id);

		}else{

			echo SpeakingGetBookingHtml($booking_id);
		}
	}
	else {
		echo getBookingHtml($booking_id);
	}

	exit();
}

function bookingSave(){

	$json=array('status'=>'error','msg'=>'invalid request','id'=>'');
	if(isset($_POST['action']) && $_POST['action']=='booking_save'){

		$service_id = $postData['service_id'] = $_POST['service_id'];
		$session_id = $postData['session_id'] = $_POST['session_id'];
		$session_date = $_POST['session_date'];
		$Services = getServices();
		$session = getSessionById($session_id);
		$session_date_type = $session['session_date_type'];
		$from_time = $session['from_time'];
		$to_time = $session['to_time'];
		$from_date = $session['from_date'];
		$to_date = $session['to_date'];
		$price = $session['price'];
		$Services = getServices();
		$subtotal = $session['price'];
		$hts_amount = ($subtotal*HST_PERCENT)/100;
		$total = $subtotal+$hts_amount;

		$name = $postData['name'] = $_POST['name'];
		$surname = $_POST['surname'];
		$name = $name.' '.$surname;
		$email = $postData['email'] = $_POST['email'];
		$postData['mobile_number'] = $_POST['mobile_number'];
		$postData['name'] =$name;
		$postData['surname'] =$surname;
		$postData['price'] = $price;
		$postData['subtotal'] = $subtotal;
		$postData['hst_percent'] = HST_PERCENT;
		$postData['hst_amount'] = $hts_amount;
		$postData['total']           =$total;

		$postData['session_name']        =$session['name'];
		$postData['service_name']        =$Services[$service_id];
		$postData['session_description'] =$session['description'];
		$postData['from_time']        =$session['from_time'];
		$postData['to_time']          =$session['to_time'];
		$postData['from_time']        =$session['from_time'];
		$postData['to_time']          =$session['to_time'];
		$postData['from_date']        =$session['from_date'];
		$postData['to_date']          =$session['to_date'];
		$postData['session_date_type']=$session['session_date_type'];
		#extra Fild
		$postData['who_you_are']              =$_POST['who_you_are'];
		$postData['current_position']         =$_POST['current_position'];
		$postData['interested_content']       =$_POST['interested_content'];
		$postData['booking_type']             =$_POST['booking_type'];
		$postData['goals']                    =$_POST['goals'];
		$postData['top_strength']             =$_POST['top_strength'];
		$postData['top_development_point']    =$_POST['top_development_point'];
		$postData['number_of_sessions']       =$_POST['number_of_sessions'];
		$postData['date_of_speaking_event']   =$_POST['date_of_speaking_event'];
		$postData['heading_topic']            =$_POST['heading_topic'];
		$postData['organisation']             =$_POST['organisation'];
		$postData['message_description']      =$_POST['message_description'];
		$postData['type_of_event']            =$_POST['type_of_event'];
		$postData['materials_required']       =$_POST['materials_required'];
		$postData['location']                 =$_POST['location'];
		$postData['audience_size']            =$_POST['audience_size'];
		$postData['instagram_handle']         =$_POST['instagram_handle'];
		$postData['linkedin_handle']          =$_POST['linkedin_handle'];
		$postData['facebook_handle']          =$_POST['facebook_handle'];
		$postData['twitter_handle']           =$_POST['twitter_handle'];
		$postData['comments']                 =$_POST['comments'];


		$sessionDates = $sessionDates=getSessionDatesBySessionId($session_id);
		if($postData['session_date_type']==1){

			$sessionDates=array();

		}else{
			if(!empty($session_date)){

				$sessionDates=array($session_date);
			}
			$postData['from_date']       ='0000-00-00';
			$postData['to_date']         ='0000-00-00';
		}

		$table='XDk_dc_bookings';
		$postData['created']= $postData['updated']=date('Y-m-d H:i:s');
		$insert_id=insertRow($table,$postData);

		if(!empty($insert_id)){

			    $json['msg']='Booking payment processing successed';
				$json['status']='success';
				$json['id']=base64_encode($insert_id);
				foreach($sessionDates as $date){

					$saveSessionDate=array();
					$saveSessionDate['session_id']=$postData['session_id'];
					$saveSessionDate['session_date']=$date;
					$saveSessionDate['service_id']=$postData['service_id'];
					$saveSessionDate['booking_id']=$insert_id;
					if(!in_array($date,$datesNew) && !empty($date)){
					   $datesNew[]=$date;
					   insertRow('XDk_dc_session_booking_dates',$saveSessionDate);
					}
				}
		}else{
			$json['msg']='Booking payment processing failed please retry';
		}
    }
	echo json_encode($json);
	exit();
}

function coachingbookingSave(){

	$json = array('status'=>'error','msg'=>'invalid request','id'=>'');
	if(isset($_POST['action']) && $_POST['action'] == 'coaching_booking_save'){
		$booking_sub_slot_time = explode(',',$_POST['booking_sub_slot_time']);
		$service_id = $postData['service_id'] = $_POST['service_id'];
		$session_id = $postData['session_id'] = $_POST['session_id'];
		$session_date = $_POST['session_date'];
		$booking_slot_id = $_POST['booking_slot_id'];
        $slotData = getSessionCoachingDatesById($booking_slot_id);
		$Services = getServices();
		$session = getSessionById($session_id);
		$session_date_type = $session['session_date_type'];
		$from_time = $session['from_time'];
		$to_time = $session['to_time'];
		$from_date = $session['from_date'];
		$to_date = $session['to_date'];
		$price = $slotData['price'];
		$Services = getServices();
		//$subtotal = $slotData['price'];
		$subtotal = $_POST['subtotal_val'];

		$hts_amount = ($subtotal*HST_PERCENT)/100;
		$total = ($subtotal + $hts_amount) - $_POST['discount_val'];
		$name = $postData['name'] = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $postData['email'] = $_POST['email'];
		$postData['mobile_number'] = $_POST['mobile_number'];

		$postData['name'] = $name;
		$postData['surname'] = $surname;
		$postData['price'] = $price;
		$postData['subtotal'] = $subtotal;
		$postData['hst_percent'] = HST_PERCENT;
		$postData['hst_amount'] = $hts_amount;
		$postData['total'] = $total;

		$postData['session_name'] = $session['name'];
		$postData['service_name'] = $Services[$service_id];
		$postData['session_description'] = $session['description'];

		$postData['from_time'] = $session['from_time'];
		$postData['to_time'] = $session['to_time'];

		$postData['from_date'] = $session['from_date'];
		$postData['to_date'] = $session['to_date'];
		$postData['session_date_type'] = $session['session_date_type'];
		#extra Fild
		$postData['who_you_are'] = $_POST['who_you_are'];
		$postData['current_position'] = $_POST['current_position'];
		$postData['interested_content'] = $_POST['interested_content'];
		$postData['booking_type'] = $_POST['booking_type'];
		$postData['first_session'] = $_POST['first_session'];
		$postData['number_of_group_members'] = !empty($_POST['number_of_group_members']) ? $_POST['number_of_group_members']:0;

		$postData['goals'] = $_POST['goals'];
		$postData['top_strength'] = $_POST['top_strength'];
		$postData['top_development_point'] = $_POST['top_development_point'];
		$postData['number_of_sessions'] = $_POST['number_of_sessions'];
		$postData['date_of_speaking_event'] = $_POST['date_of_speaking_event'];
		$postData['heading_topic'] =$_POST['heading_topic'];
		$postData['organisation'] = $_POST['organisation'];
		$postData['message_description'] = $_POST['message_description'];
		$postData['type_of_event'] = $_POST['type_of_event'];
		$postData['materials_required'] = $_POST['materials_required'];
		$postData['location'] = $_POST['location'];
		$postData['audience_size'] = $_POST['audience_size'];
		$postData['instagram_handle'] = $_POST['instagram_handle'];
		$postData['linkedin_handle'] = $_POST['linkedin_handle'];
		$postData['facebook_handle'] = $_POST['facebook_handle'];
		$postData['twitter_handle'] = $_POST['twitter_handle'];
		$postData['comments'] = $_POST['comments'];

		$postData['discount_percent'] = $_POST['discount_percent'];
		$postData['discount_val'] = $_POST['discount_val'];

		$booking_main_slot_id = $_POST['booking_main_slot_id'];

		$sessionDates = $sessionDates = getSessionDatesBySessionId($session_id);
		if($postData['session_date_type'] == 1){
			$sessionDates=array();
		}else{
			$postData['from_date'] = '0000-00-00';
			$postData['to_date'] = '0000-00-00';
		}

		$table = 'XDk_dc_bookings';
		$postData['created'] = $postData['updated']=date('Y-m-d H:i:s');
		#pr($postData,1);
		$insert_id = insertRow($table,$postData);

		if($insert_id > 0){

			foreach($booking_sub_slot_time as $value) {
				$from_to_time = explode('-',trim($value));
				$json['msg'] = 'Booking payment processing successed';
				$json['status'] = 'success';
				$json['id'] = base64_encode($insert_id);
				$saveSessionDate = array();
				$saveSessionDate['service_id'] = $slotData['service_id'];
				$saveSessionDate['session_id'] = $slotData['session_id'];
				$saveSessionDate['session_date'] = $slotData['session_date'];
				$saveSessionDate['from_time'] = $from_to_time[0];
				$saveSessionDate['to_time'] = $from_to_time[1];
				$saveSessionDate['price'] = $slotData['price'];
				$saveSessionDate['booking_id'] = $insert_id;
				$saveSessionDate['booking_main_slot_id'] = $booking_main_slot_id;
				insertRow('XDk_dc_session_booking_dates',$saveSessionDate);
			}
		} else {
			$json['msg'] = 'Booking payment processing failed please retry';
		}
    }
	echo json_encode($json);
	exit();
}

function speakingBookingSave(){

	$json = array('status'=>'error','msg'=>'invalid request','id'=>'');
	if(isset($_POST['action']) && $_POST['action'] == 'speaking_booking_save'){

		$service_id = $postData['service_id'] = $_POST['service_id'];
		$session_id = $postData['session_id'] = $_POST['session_id'];
		$session_date = $_POST['selected_date'];
		$location_type=$postData['location'] = $_POST['location'];
		$Services = getServices();
		$session = getSessionById($session_id);
        $to_time = $_POST['to_time'].':00';
		$from_time = $_POST['from_time'].':00';
		$total_hour=$_POST['total_hour'];
        if(empty($total_hour)){
			$total_hour=0;
		}
		$session_date_type = $session['session_date_type'];
		$Services = getServices();
		$price=$subtotal=$hts_amount=$total=0;

		if($location_type=='online'){
			$price = $session['price'];
			$subtotal = ($total_hour*$price);
			$hts_amount = ($subtotal*HST_PERCENT)/100;
			$total = $subtotal + $hts_amount;
		}

		$name = $postData['name'] = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $postData['email'] = $_POST['email'];
		$postData['mobile_number'] = $_POST['mobile_number'];
		$postData['name'] = $name;
		$postData['surname'] = $surname;
		$postData['price'] = $price;
		$postData['subtotal'] = $subtotal;
		$postData['hst_percent'] = HST_PERCENT;
		$postData['hst_amount'] = $hts_amount;
		$postData['total'] = $total;

		$postData['session_name'] = $session['name'];
		$postData['service_name'] = $Services[$service_id];
		$postData['session_description'] = $session['description'];

		$postData['from_time'] =$to_time;
		$postData['to_time'] = $to_time;

		$postData['session_date_type'] = $session['session_date_type'];
		#extra Fild
		$postData['heading_topic'] =$_POST['heading_topic'];
		$postData['organisation'] = $_POST['organisation'];
		$postData['message_description'] = $_POST['message_description'];
		$postData['type_of_event'] = $_POST['type_of_event'];
		$postData['materials_required'] = $_POST['materials_required'];
		$postData['special_requests'] = $_POST['special_requests'];
		$postData['location_description'] = $_POST['location_description'];
		$postData['audience_size'] = $_POST['audience_size'];
		$postData['instagram_handle'] = $_POST['instagram_handle'];
		$postData['linkedin_handle'] = $_POST['linkedin_handle'];
		$postData['facebook_handle'] = $_POST['facebook_handle'];
		$postData['twitter_handle'] = $_POST['twitter_handle'];
		$postData['meating_link'] = $_POST['meating_link'];
		$postData['postal_code'] = $_POST['postal_code'];
		$postData['country'] = $_POST['country'];

		//$postData['comments'] = $_POST['comments'];
		$postData['status'] =1;
		$sessionDates = $sessionDates = getSessionDatesBySessionId($session_id);
		if($postData['session_date_type'] == 1){
			$sessionDates=array();
		}else{
			$postData['from_date'] = '0000-00-00';
			$postData['to_date']   = '0000-00-00';
		}
		$table = 'XDk_dc_bookings';
		$postData['created'] = $postData['updated']=date('Y-m-d H:i:s');
		$insert_id = insertRow($table,$postData);
		if($insert_id > 0){

				$json['msg'] = 'Thank you for your booking. You will now receive an email, confirming your request. However, before your request is approved we need to confirm our availability and also take payment.</br>'.PHP_EOL.'Please Note - Our fees for this customised event will also be confirmed.';
				$json['status'] = 'success';
				$json['id'] = base64_encode($insert_id);
				$saveSessionDate = array();
				$saveSessionDate['service_id'] =$service_id;
				$saveSessionDate['session_id'] =$session_id;
				$saveSessionDate['session_date'] = $session_date;
				$saveSessionDate['from_time'] = $from_time;
				$saveSessionDate['to_time'] =$to_time;
				$saveSessionDate['price'] = $price;
				$saveSessionDate['total_hours'] = $total_hour;
				$saveSessionDate['booking_id'] = $insert_id;

				insertRow('XDk_dc_session_booking_dates',$saveSessionDate);
				$fullname=$name.' '.$surname;
				$subject='Fully Bossed | New Speaker Request';
				$body="<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'> Hello $fullname,</p>
				<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>Thank you very much for considering Fully Bossed for speaking at your upcoming event.</p><p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>For us every speaking opportunity is a chance to create an experience whilst putting irresistible storytelling in action. We live for those moments.</p><p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>We are working hard to review your requests, and others, and we will get back within 48hrs to confirm our attendance or ask for more information.</p>";
				$body = getSpeakingBookingEmailHtml($subject,$insert_id,$body);
				$headers = array('Content-Type: text/html; charset=UTF-8');
                $headers[] = 'From: Fully Bossed <info@fullybossed.com>';
				$admin_email = ADMIN_EMAIL;
				$headers[] = "Cc: $admin_email";
				wp_mail($email, $subject, $body, $headers);

		} else {
			$json['msg'] = 'Your booking request has been  unsuccessfully processed';
		}
    }
	echo json_encode($json);
	exit();

}

function speakingBookingRequestApproved($booking_id){

	$json = array('status'=>'error','msg'=>'Booking Request Approved Unsuccessfully');
	if($booking_id > 0){

		$postData['status'] =4;
		$postData['id'] =$booking_id;
		$table = 'XDk_dc_bookings';
		$booking_id=updateRow($table,$postData,array('id'=>$booking_id));
		if($booking_id > 0){
			$json['status']='success';
			$bookingData=getBookingById($booking_id);
			$email=$bookingData['email'];

			$subject='Fully Bossed | New Speaker Request Approved – Payment Required';
			$paynow_link=home_url();
			$name=$bookingData['name'].' '.$bookingData['surname'];

			$paynow_link .='/speaking-booking-payment/?code='.base64_encode($booking_id);
			$body="<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'> Hello $name,</p>
			<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
			Thank you again for considering Fully Bossed to speak at your upcoming event. We carefully select who we're able to work with and we are happy to confirm that we would be delighted to have the opportunity to work with you!</p>
			<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
			We look forward to your event and delivering a memorable speaking experience for you and your audience.</p>
			<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
            Before we can get going, we need you to complete <a href='".$paynow_link."'>payment </a>  within 24hrs so we can confirm your booking. A breakdown of the payment and the booking details are shown below for your convenience.</p>";
			$body = getSpeakingBookingEmailHtml($subject,$booking_id,$body);
			$headers = array('Content-Type: text/html; charset=UTF-8');
            $headers[] = 'From: Fully Bossed <info@fullybossed.com>';
			$admin_email = ADMIN_EMAIL;
			$headers[] = "Cc: $admin_email";
			wp_mail($email, $subject, $body, $headers);
			$json['msg'] = 'Booking Request Approved Successfully';
		}
	}

	return json_encode($json);
	exit();


}

function setBookingPrice(){

	$json = array('status'=>'error','msg'=>'Booking Request Approved Unsuccessfully');
	$booking_id=$_POST['booking_id'];
	$travel_expenses=!empty($_POST['travel_expenses']) ? $_POST['travel_expenses']:0;
	$base_price_for_event=!empty($_POST['base_price_for_event']) ? $_POST['base_price_for_event']:0;
	$service_charge=!empty($_POST['service_charge']) ? $_POST['service_charge']:0;

	if($booking_id > 0){

		$postData['status'] =4;
		$postData['travel_expenses'] =$travel_expenses;
		$postData['base_price_for_event'] =$base_price_for_event;
		$postData['service_charge'] =$service_charge;
		$postData['id'] =$booking_id;
		$price = $travel_expenses+$base_price_for_event+$service_charge;
		$subtotal =$price;
		$hts_amount = ($subtotal*HST_PERCENT)/100;
		$total = $subtotal + $hts_amount;

		$postData['price'] = $price;
		$postData['subtotal'] = $subtotal;
		$postData['hst_percent'] = HST_PERCENT;
		$postData['hst_amount'] = $hts_amount;
		$postData['total'] = $total;

		$table = 'XDk_dc_bookings';
		$booking_id=updateRow($table,$postData,array('id'=>$booking_id));
		if($booking_id > 0){
			$bookingData=getBookingById($booking_id);
			$email = $bookingData['email'];
			//$email = TESTING_EMAIL_FROM;
			$subject = 'Fully Bossed | Speaker Request - Now Approved';
			$paynow_link = home_url();
			$name = $bookingData['name'].' '.$bookingData['surname'];

			$paynow_link .='/speaking-booking-payment/?code='.base64_encode($booking_id);
			$body="<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'> Hello $name,</p>
			<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
			Thank you very much for considering Fully Bossed for speaking at your upcoming event. We carefully select who we're able to work with and we are delighted to have the opportunity to work with you!.</p>
			<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
			For us every speaking opportunity is a chance to create an experience whilst putting irresistible storytelling in action. We live for those moments. We look forward to your event and delivering a memorable speaking experience for you and your audience.</p>
			<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
            Before we can get going, we need you to complete <a href='".$paynow_link."'>payment </a>  within 24hrs so we can confirm your booking. A breakdown of the payment and the booking details are shown below for your convenience.</p>";

			$body = getSpeakingBookingEmailHtml($subject,$booking_id,$body);
			$headers = array('Content-Type: text/html; charset=UTF-8');
            $headers[] = 'From: Fully Bossed <info@fullybossed.com>';
			$admin_email = ADMIN_EMAIL;
			$headers[] = "Cc: $admin_email";
			wp_mail($email, $subject, $body, $headers);
			$json['status']='success';
			$json['msg'] = 'Booking Request Approved Successfully';
		}
	}
	echo json_encode($json);
	exit();

}
function speakingBookingRequestDisapproved($booking_id){

	$json = array('status'=>'error','msg'=>'Booking Request Declined Unsuccessfully');
	$booking_id=$_POST['booking_id'];
	$decline_comment=!empty($_POST['decline_comment']) ? $_POST['decline_comment']:'';
	//pr($_POST,1);
	if($booking_id > 0){

		$postData['status'] =5;
		$postData['id'] =$booking_id;
		$postData['decline_comment'] =$decline_comment;
		$table = 'XDk_dc_bookings';
		updateRow($table,$postData,array('id'=>$booking_id));
		if($booking_id > 0){

			$bookingData=getBookingById($booking_id);
			$email=$bookingData['email'];
			$name=$bookingData['name'].' '.$bookingData['surname'];
			$subject='Fully Bossed | Speaker Request - Now Declined';
			$paynow_link=home_url();
			$paynow_link .='/speaking-booking-payment/?code='.base64_encode($booking_id);
			$body="<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>Hi $name</p>
			<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
			Your Booking Request Declined</p>";
			//body .='<br>Declined Reason:'.$decline_comment;
			$body = getSpeakingBookingEmailHtml($subject,$booking_id,$body);
			$headers = array('Content-Type: text/html; charset=UTF-8');
			$headers[] = 'From: Fully Bossed <info@fullybossed.com>';
			$admin_email = ADMIN_EMAIL;
			$headers[] = "Cc: $admin_email";
			wp_mail($email, $subject, $body, $headers);
			$json['status']='success';
			$json['msg'] = 'Booking Request Declined Successfully';
		}
	}
	echo json_encode($json);
	exit();

}

function checkSlotavAilability(){
	ini_set('display_errors', 1);
	$json=array('status'=>'error','msg'=>'invalid request','html'=>'');
	if(isset($_POST['action']) && $_POST['action']=='check_slot_availability'){

		$service_id=$_POST['service_id'];
		$session_id=$_POST['session_id'];
		$session_date=$_POST['session_date'];
		if(!empty($service_id) && !empty($service_id) && !empty($session_date)){
			$allSessionDataTime = getSessionCoachingDatesTimeBySessionId($session_id);
			$SessionDataTime = array();
			if(array_key_exists($session_date,$allSessionDataTime)){
				$SessionDataTime = $allSessionDataTime[$session_date];
			}
			//print_r($SessionDataTime); die;
			$json['status']='success';
			$html='<li>
			<div class="row">
				<div class="col-md-6">
				<p>Time</p>
				</div>
				<div class="col-md-3">
				<p>Price / hour </p>
				</div>
				<div class="col-md-3">
				<p>Availability</p>
				</div>
			</div>
		    </li>';

            if(!empty($SessionDataTime)){
				foreach($SessionDataTime as $timeData){
					$from_time = $timeData['from_time'];
					$to_time = $timeData['to_time'];
					$from_time_str = date('H:i',strtotime($timeData['from_time']));
					$to_time_str = date('H:i',strtotime($timeData['to_time']));
					//print_r($timeData);
					$date1 = strtotime($from_time_str);
					$date2 = strtotime($to_time_str);
					$time_Diff = (abs($date2 - $date1) / 60) / 60;
					//echo '<br>';
					$id = $timeData['id'];
					$booking_main_slot_id = $timeData['id'];
					$price = $timeData['price'];

					// XDk_dc_session_booking_dates
					$sql = "SELECT * FROM XDk_dc_bookings WHERE service_id = '$service_id' AND session_id = '$session_id' AND session_date = '$session_date' AND from_time = '$from_time' AND to_time = '$to_time' AND status = 2";
					$bookings = getRow($sql);

					//print_r($bookings);
					$Availability = true;
					if(!empty($bookings)){
						$Availability = false;
					}
					$html .= '<li>
					<div class="row">
						<div class="col-md-6" id="slot_id_'.$id.'">
						<p>';
						if($Availability){
							$html .='<input type="radio" value="'.$id.'" name="slot_id" class="slot_radio_btns">';
						}
						$html .='<span>&nbsp;'.$from_time_str.'</span> - <span>'.$to_time_str.'</span></p>';

						$html .= '</div>
						<div class="col-md-3">
						<p>'.CURRENCYSYMBOL.number_format($price,2).'</p>
						</div>
						<div class="col-md-3">
						<p>';

						if($Availability){
								$html .='<span class="badge badge-success">Available</span>';
							}else{
								$html .='<span class="badge badge-danger">Booked</span>';
							}
						$html .='</p>
						</div>
					</div>';
					if($Availability) {
						if($time_Diff > 0) {
							$time_Diff_html = '<div class="form-row sub-slots" style="display:none;">';
							$all_booked = 0;
							for($i = 1; $i <= $time_Diff; $i++) {
								$t_time = rand().time();
								if($i == 1) {
									$startTime = $timeData['from_time'];
									$time = strtotime($startTime);
									$startTime = date("H:i", strtotime('+0 minutes',$time));
									$check_startTime = date("H:i:s", strtotime('+0 minutes',$time));
									$check_endTime = date("H:i:s", strtotime('+60 minutes', $time));

									$endTime = date("H:i", strtotime('+60 minutes', $time));
								} else {
									$time = strtotime($startTime);
									$endTime = strtotime($endTime);
									$startTime = date("H:i", strtotime('+60 minutes', $time));
									$check_startTime = date("H:i:s", strtotime('+60 minutes', $time));
									$check_endTime = date("H:i:s", strtotime('+60 minutes', $endTime));
									$endTime = date("H:i", strtotime('+60 minutes', $endTime));
								}

								$sql_1 = "SELECT * FROM XDk_dc_session_booking_dates WHERE service_id = '$service_id' AND session_id = '$session_id' AND session_date = '$session_date' AND from_time = '$check_startTime' AND to_time = '$check_endTime' AND booking_main_slot_id = '$booking_main_slot_id'";
								$check_bookings = getRow($sql_1);

								$temp_booking_id = $check_bookings[0]['booking_id'];

								$sql_2 = "SELECT * FROM XDk_dc_bookings WHERE service_id = '$service_id' AND session_id = '$session_id' AND id = '$temp_booking_id' AND status = 2";
								$check_bookings_2 = getRow($sql_2);
								//print_r($check_bookings_2);

								if($check_bookings) {
									$all_booked++;
									$checkbox_id = 'customCheck'.$startTime.$endTime.$t_time;
									$time_Diff_html .= '<div class="custom-control custom-checkbox">';
									$time_Diff_html .= '<input type="checkbox" name="subslots" class="custom-control-input subslots_cls" id="'.$checkbox_id.'" value="'.$startTime.'-'.$endTime.'" data-slot-id="'.$id.'" disabled="disabled">';
									$time_Diff_html .= '<label class="custom-control-label" for="'.$checkbox_id.'">
									'.$startTime.' - '.$endTime.'</label>';
									$time_Diff_html .= '&nbsp;<span class="badge badge-danger fb-available-badges"> Booked </span>';
									$time_Diff_html .= '</div>';
								} else {
									$checkbox_id = 'customCheck'.$startTime.$endTime.$t_time;
									$time_Diff_html .= '<div class="custom-control custom-checkbox">';
									$time_Diff_html .= '<input type="checkbox" name="subslots" class="custom-control-input subslots_cls" id="'.$checkbox_id.'" value="'.$startTime.'-'.$endTime.'" data-slot-id="'.$id.'">';
									$time_Diff_html .= '<label class="custom-control-label" for="'.$checkbox_id.'">
									'.$startTime.' - '.$endTime.'</label>';
									$time_Diff_html .= '&nbsp;<span class="badge badge-success fb-available-badges"> Available </span>';
									$time_Diff_html .= '</div>';
								}
							}
							if($all_booked == $time_Diff) {
								$all_booked_slots[] = $booking_main_slot_id;
								$Availability = false;
							}
							$time_Diff_html .= '</div>';
						}
						$html .= $time_Diff_html;
						$time_Diff_html = '';
					}

					$html .= '</li>';
				}
			} else{
				$html .='<li>
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-warning" role="alert">
						No slots available date on '.date('d M Y',strtotime($session_date)).'
						</div>
					</div>
				</div>
			</li>';
			}
			$json['html'] = $html;
			$json['all_booked_slots'] = $all_booked_slots;
		}
    }
	echo json_encode($json);
	exit();
}

function getSlotPayment(){
	ini_set('display_errors', 1);
	//pr($_POST,1);

	$json = array('status'=>'error','msg'=>'invalid request','html'=>'','slot_id'=>'');
	if(isset($_POST['action']) && $_POST['action']=='get_slot_payment'){
		$slot_id = $_POST['slot_id'];
		if( !empty($slot_id)){
			$slotData = getSessionCoachingDatesById($slot_id);
			$session_date = $slotData['session_date'] ;
			$from_time = $slotData['from_time'];
			$to_time = $slotData['to_time'];

			// $from_time = date("y-m-d h:i A", strtotime($session_date." ".$from_time));
			// $to_time = date("y-m-d h:i A", strtotime($session_date." ".$to_time));
			// $date1 = strtotime($from_time);
			// $date2 = strtotime($to_time);
			// $slot_hours = (abs($date2 - $date1) / 60) / 60;

			$slot_hours = count($_POST['subSlots_data']);
			$discount_rules = get_option( 'discount_rules');

			$fb_bd_hours_input = array_column($discount_rules, 'fb_bd_hours_input');
			$count_arr = count($discount_rules);
			$max_hours = intval($discount_rules[$count_arr-1]['fb_bd_hours_input']);
			$found_key = array_search($slot_hours, $fb_bd_hours_input);
			if ($found_key !== false) {
				$discount = $discount_rules[$found_key]['fb_bd_discount_input'];
			} elseif($slot_hours >= $max_hours) {
				$discount = $discount_rules[$count_arr-1]['fb_bd_discount_input'];
			} else {
				$discount = 0;
			}

			$json['status']='success';
				$html='<li>
				<div class="row">
				<div class="col-md-12">
					<div class="alert alert-warning" role="alert">
					Please select the time slot
					</div>
					</div>
				</div>
			</li>';
            if(!empty($slotData)){
				$price = $slotData['price'];
				$id = $slotData['id'];
				$subtotal = $slotData['price'] * $slot_hours;
				$discount_val = ($discount / 100) * $subtotal;
				$hts_amount = ($subtotal*HST_PERCENT)/100;
				$total = $subtotal + $hts_amount;
				$total = $total - $discount_val;
				$html='<li>
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
							<p>Discount ('.$discount.'%)</p>
						</div>
						<div class="col-md-6">
							<p class="text-right"><strong>'.CURRENCYSYMBOL.number_format($discount_val,2).'</strong></p>
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
				</li>';
                $json['subtotal'] = $subtotal;
				$json['discount_percent'] = $discount;
				$json['discount_val'] = $discount_val;
				$json['slot_id'] = $slotData['id'];
			}
			$json['html'] = $html;
		}
    }
	echo json_encode($json);
	exit();
}

function DownloadAcopy(){

	$json = array('status'=>'error','msg'=>'invalid request','id'=>'');

	if(isset($_POST['action']) && $_POST['action'] == 'download_a_copy'){

		$surname  = $_POST['surname'];
		$first_name  = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
		$name =$first_name.' '.$last_name;
		$postData['name'] = $name;
		$postData['surname'] = $surname;
		$postData['fname'] = $first_name;
		$postData['lname'] = $last_name;
		$postData['gender'] = $gender;
		$postData['email'] = $email;

		$table = 'XDk_dc_downloads';
		$postData['created'] = $postData['updated']=date('Y-m-d H:i:s');
		$insert_id = insertRow($table,$postData);
		if($insert_id > 0){
			    $subject = 'Fully Bossed |  Download Request';
                $body="Thank you for downloading with us!";
				ob_start();
	            include(PLUGIN_DIR_PATH.'email-template/download-copy.php');
	            $body=ob_get_clean();
				$attachments = array(PPT_FILE_PATH);
				$headers = array('Content-Type: text/html; charset=UTF-8');
                $headers[] = 'From: Fully Bossed <info@fullybossed.com>';
				$admin_email = ADMIN_EMAIL;
				$headers[] = "Cc: $admin_email";
				wp_mail($email, $subject, $body, $headers,$attachments);

				$json['msg'] = 'Thank you for downloading with us!. Your download link has been send your email.';
				$json['status'] = 'success';

		} else {
			$json['msg'] = 'Your  download request has been  processed unsuccessfully';
		}
    }
	echo json_encode($json);
	exit();
}
function fb_subscribe_us_callback(){

	$json = array('status'=>'error','msg'=>'invalid request','id'=>'');

	if(isset($_POST['action']) && $_POST['action'] == 'fb_subscribe_us_action'){

		$type = $_POST['type'];
		if($type=='home'){

			$email=$_POST['home_email'];
			$name=$_POST['home_name'];
			$postData['email'] = $email;
			$postData['name'] = $name;
		}else{

			$email=$_POST['email'];
			$name=$email;
			$postData['email'] = $email;
		}

		$table = 'XDk_dc_subscribe_emails';
		$postData['created'] = $postData['updated']=date('Y-m-d H:i:s');
		$insert_id = insertRow($table,$postData);

		if($insert_id > 0){

				$json['msg'] = 'Thank you for subscribing with us! We’re delighted you’ve joined the Fully Bossed tribe.';
				$json['status'] = 'success';
				$subject = 'Fully Bossed | New Subscription';
				if($type=='home'){
				$body = "<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
				Hello $name,</p>
				<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
				Thank you for subscribing with us! We are working really hard in the background to bring you the best set of career advancing services. It worked well for us and we can’t wait to share all the tips (and secrets) with you!
				</p>";
				ob_start();
	            include(PLUGIN_DIR_PATH.'email-template/email-subscribe-home.php');
	            $body=ob_get_clean();

				}else{

				$body = "<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
				Hello $name,</p>
				<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
				Thank you for subscribing with us! We’re delighted you’ve joined the Fully Bossed tribe. We’re continuing to work really hard in the background to bring you the best set of career advancing services. It worked well for us and we can’t wait to share all the tips (and secrets) with you!
				</p>";
				ob_start();
	            include(PLUGIN_DIR_PATH.'email-template/email-subscribe.php');
	            $body=ob_get_clean();

				}
				$headers = array('Content-Type: text/html; charset=UTF-8');
                $headers[] = 'From: Fully Bossed <info@fullybossed.com>';
				$admin_email = ADMIN_EMAIL;
				$headers[] = "Cc: $admin_email";
				wp_mail($email, $subject, $body, $headers);


		} else {
			$json['msg'] = 'Your  subscribing request has been  processed unsuccessfully';
		}
    }
	echo json_encode($json);
	exit();

}

function DownloadFile(){
if(file_exists(PPT_FILE_PATH)) {

	        header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename(PPT_FILE_PATH).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize(PPT_FILE_PATH));
            flush(); // Flush system output buffer
            readfile(PPT_FILE_PATH);
			exit();
	}
}
function get_ZoomMeetingDetails($booking_id) {
	global $wpdb;
    $table = $wpdb->prefix.'zoom_links';
    $querystr = "SELECT * FROM $table WHERE booking_id = $booking_id LIMIT 1";
    $booking_posts = $wpdb->get_results($querystr, OBJECT);
	return $booking_posts;
}

function time_Diff($from_time,$to_time) {
	$date1 = strtotime($from_time);
	$date2 = strtotime($to_time);
	$slot_hours = (abs($date2 - $date1) / 60) / 60;
	return $slot_hours;
}


?>
