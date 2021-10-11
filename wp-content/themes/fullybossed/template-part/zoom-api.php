<?php 
	/*
	 * Template Name: Zoom API
	 * * @link https://codex.wordpress.org/Template_Hierarchy
	 * @page FullyBossed
	 * @since FullyBossed 1.0
	 */	
	get_header();	
	include $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/fullybossed/zoom-meeting-code/config.php';
	include $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/fullybossed/zoom-meeting-code/api.php';
 ?>
 	<div>
 		<div style="margin-top:150px;">
		 <?php 


		function dateDiff($datetime1, $datetime2)
		{
			$date1 = strtotime($datetime1);
			$date2 = strtotime($datetime2);
			$diff = abs($date2 - $date1) / 60;
			return $diff;
		}


		 	echo '2021-06-24 00:02:15';
			echo '<br>';
		 	$booking_id = 18;
		 	$booking_dates = get_BookingDateTime($booking_id);
			
			echo '<pre>';
			print_r($booking_dates);
			echo $booking_dates->session_date;
			echo '<br>';
			echo $booking_dates->from_time;
			echo '<br> Time';
			echo date("y-m-d h:i A", strtotime($booking_dates->session_date." ".$booking_dates->from_time));
			echo '<br>';
			echo '<br>';
			echo '<br>';

			// echo $from_time = date("y-m-d h:i A", strtotime($booking_dates->session_date." ".$booking_dates->from_time));
			// echo '<br>';
			// echo $to_time = date("y-m-d h:i A", strtotime($booking_dates->session_date." ".$booking_dates->to_time));;
			// echo '<br>';
			//echo $diff = $to_time - $from_time;

			// echo $date1 = date($booking_dates->session_date." ".$to_time);
			// echo '<br>';
			// echo $date2 = date($booking_dates->session_date." ".$from_time);
			// date_diff($end,$start);

			// $diff = dateDiff($from_time, $to_time);
			// echo '<br>';
			// print_r($diff);


			//echo date('h:i',strtotime($diff));


			echo '</pre>';

			// $arr = array();
			// $arr['topic'] = 'Test By Devout';
			// $arr['start_date'] = date('2021-06-24 00:02:15');
			// $arr['duration'] = 10;
			// $arr['password'] = 'devout';
			// $arr['type'] = '2';
			// $arr['topic'] = 'Test By Devout';			
			//$result = createMeeting($arr);
			//$result = meetingList();
			// global $wpdb;
			// $table_name = 'XDk_zoom_links';
			// $insert_data = array(
			// 	'topic' => $result->topic,
			// 	'meeting_id' => $result->id,
			// 	'start_time' => $result->start_time,
			// 	'join_url' => $result->join_url,
			// 	'password' => $result->password,
			// );
			// $format = array('%s','%s','%s','%s','%s');
			// $wpdb->insert($table_name,$insert_data,$format);
			// echo '<pre>';
			// print_r($insert_data);
			// ========================================================================
			// Zoom Meeting Invitation
			// Fully Bossed is inviting you to a scheduled Zoom meeting.
			// Topic: $result['topic'];
			// Time: $new_date;
			// Join Zoom Meeting: $result['join_url'];
			// Meeting ID: $result['id'];
			// Passcode: $result['password']
			
			// if(isset($result->id)) {
			// 	echo "Join URL: <a target='_blank' href='".$result->join_url."'>".$result->join_url."</a></br>";
			// 	echo "Password :".$result->password."</br>";
			// 	echo "Start Time :".$result->start_time."</br>";
			// 	echo "Duration :".$result->start_time."</br>";
			// } else {

			// }
			echo '</pre>';
		 ?>
		</div> 
	</div>
<?php get_footer(); ?>