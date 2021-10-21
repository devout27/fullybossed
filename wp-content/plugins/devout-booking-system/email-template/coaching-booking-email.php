<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Fully Bossed</title>
</head>
<body>
<div class="container" style="width: 600px; margin: 0 auto;">
    <div class="header" style="width: 600px; padding: 0 0 15px; /* background-color: #A8D08D; */ text-align: center; border: 1px solid #000; border-bottom: none;">
      <div class="logo" style="width: 180px; margin: 10px auto; letter-spacing: 0.25em; text-transform: uppercase;">
          <img src="<?php echo PLUGIN_DIR_URL?>email-template/fully-bossed-logo-CAUDEX-REGULAR-2.png" alt="" style="width: 100%; display: block;">
      </div>
   </div>
   <div style="width: 100%; padding: 20px 0 20px; background-color: #fff; text-align: center; border: 1px solid #000; border-top: none; border-bottom: none;">
      <div style="font-size: 20.0px;text-align: center;margin: 0 0 0 0;color: rgb(0,0,0);font-weight: 600; /*background: #FFDA67;*/ display: inline-block;padding: 10.0px 20.0px; font-family: Gotham;"><?php echo $subject;?></div>
      <hr style="width: 40%; margin: 10px auto; color: #FFDA67; height: 2px; background: #FFDA67; border: none;">
   </div>
   <div class="Dear" style="width: 602px; color: #000; background-color: #fff;  box-sizing: border-box; padding: 0 30px 0 30px; font-size: 18px; border: 1px solid #000; border-top: none; border-bottom: none;"">
     <?php echo $body;?>
   </div>
    <div class="content" style="width: 602px; color: #fff; padding: 15px 0 5px; background-color: #fff; box-sizing: border-box; border: 1px solid #000; border-top: none; border-bottom: none;">
      <div style="padding: 0 30.0px;text-align: left;font-size: 14.0px;">
        <div>
          <hr style="width: 35%; margin: 10px auto; color: #a8d08d; border: none; height: 2px; background: #a8d08d;">
          <h5 style="font-size: 18.0px;line-height: 25.0px;display: block;margin: 0.0px 0.0px 15.0px 0.0px;padding: 15.0px 0.0px 0.0px 0.0px;color: rgb(51,51,51);text-transform: uppercase;letter-spacing: 1.0px; font-family: GoudyOS; color: #000;">Booking Details</h5>

          <p style="line-height: 25.0px;display: block;margin: 0.0px 0.0px 20.0px 0.0px;padding: 0 0; color: rgb(51,51,51); color: #000; font-family: Gotham;">
            Booking Id: <strong style="color: rgb(0,0,0); color: #000; font-weight: 600; float: right;">#<?php echo $booking['id'];?></strong> <br>
            Booking Date: <strong style="color: rgb(0,0,0); color: #000; font-weight: 600; float: right;"><?php echo dateFormate($booking['created']);?></strong><br>
            Booking Status: <strong style="color: rgb(0,0,0); font-weight: 600; float: right;"><?php echo $booking_status;?></strong><br>
            Service: <strong style="color: rgb(0,0,0); color: #000; font-weight: 600; float: right;"><?php echo $booking['service_name'];?></strong> <br>
            Slot Date : <strong style="color: rgb(0,0,0); color: #000; font-weight: 600; float: right;"><?php echo date('d, M Y', strtotime($sessionDates['session_date']))?></strong><br>
            Total Slot Time Booked:<strong style="color: rgb(0,0,0); color: #000; font-weight: 600;float: right;"><?php echo $total_booked_hours?></strong>
			<br>
			<?php if(!empty($sub_slots_time)) {?>
            Sub Slots Time:
			 <strong style="color: rgb(0,0,0); color: #000; font-weight: 600; float: right;"><?php echo rtrim(trim($sub_slots_time), ',')?>
			 </strong>
			<?php
			}?>
			</p>
			<p>
			</p>
          </div>
		  <div>
        <hr style="width: 35%; margin: 10px auto; color: #a8d08d; border: none; height: 2px; background: #a8d08d;">
            <h5 style="font-size: 18.0px;line-height: 25.0px;display: block;margin: 0.0px 0.0px 15.0px 0.0px;padding: 15.0px 0.0px 0.0px 0.0px;color: rgb(51,51,51);text-transform: uppercase;letter-spacing: 1.0px; color: #000; font-family: GoudyOS;">Payment</h5>
            <p style="line-height: 25.0px;display: block;margin: 0.0px 0.0px 20.0px 0.0px;color: rgb(51,51,51); color: #000; font-family: Gotham;">
              Name: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['name']?></strong> <br>
              Email Address: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><a style="color: #000;" href="mailto:<?php echo $booking['email']?>" target="_blank"><?php echo $booking['email']?></a></strong><br>
              Mobile Number: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['mobile_number']?></strong> <br>
              Payment Status: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $payment_status?></strong><br>
              Transaction ID: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['transaction_id']?></strong>
			  <br>
              SubTotal: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo CURRENCYSYMBOL.number_format($booking['subtotal'], 2)?></strong>
			  <br>
			  Tax (<?php echo number_format($booking['hst_percent'], 0)?>% HST) : <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo CURRENCYSYMBOL.number_format($booking['hst_amount'], 2)?></strong> <br>

			  Discount (<?php echo number_format($discount_percent, 0)?>% HST) : <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo CURRENCYSYMBOL.number_format($discount_val, 2)?></strong> <br>
			  Total: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo CURRENCYSYMBOL.number_format($booking['total'], 2)?></strong>
			  </p>
         </div>
		 <?php if(count($ZoomMeetingDetails) > 0) {
		 ?>
		 <div>
      <hr style="width: 35%; margin: 10px auto; color: #a8d08d; border: none; height: 2px; background: #a8d08d;">
			<h5 style="font-size: 18px;line-height: 25px;display: block;margin: 0.0px 0.0px 15.0px 0.0px;padding: 15.0px 0.0px 0.0px 0.0px;color: rgb(51,51,51);text-transform: uppercase;letter-spacing: 1.0px; color: #000; font-family: GoudyOS;">Fully Bossed is inviting you to a scheduled Zoom meeting.</h5>
            <p style="line-height: 25.0px;display: block;margin: 0.0px 0.0px 20.0px 0.0px;color: rgb(51,51,51); color: #000; font-family: Gotham;">
              Topic: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $ZoomMeetingDetails[0]->topic;?></strong> <br>
              Date: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $slot_date;?></strong><br>

			  <?php
			  foreach ($ZoomMeetingDetails as $value) {

				//echo count($ZoomMeetingDetails);
				$meeting_time = date("h:i A", strtotime($value->start_time));
				echo 'Slot timing:<strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;">'.$meeting_time.'-'.$last_time_final.'</strong> <br> Meeting ID:<strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;">' . $value->meeting_id . '</strong><br> Passcode: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;">' . $value->password .'</strong><br>Join Zoom Meeting URL: <strong style="color: rgb(0,0,0); color: #000; font-weight: 600;"><a target="_blank" href="'.$value->join_url.'">'.$value->join_url . '</a></strong> <br>';
		      }
			  ?>
			  </p>
         </div>
		 <?php
		 }?>
          <div>
            <hr style="width: 35%; margin: 10px auto; color: #a8d08d; border: none; height: 2px; background: #a8d08d;">
            <h5 style="font-size: 18.0px;line-height: 25.0px;display: block;margin: 0.0px 0.0px 15.0px 0.0px;padding: 15.0px 0.0px 0.0px 0.0px;color: rgb(51,51,51); color: #000; text-transform: uppercase;letter-spacing: 1.0px; font-family: GoudyOS;">User Details</h5>
            <p style="line-height: 25.0px;display: block;margin: 0.0px 0.0px 20.0px 0.0px;color: rgb(51,51,51); color: #000; font-family: Gotham;">
              Who You are?: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['who_you_are']?></strong><br>
             Current position: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['current_position']?></strong><br>
			 Interested content: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['interested_content']?></strong><br>
			 Booking Type: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;">
			 <?php echo $booking['booking_type']?></strong><br>
			 <?php 
			 if($booking['booking_type']=='Group Coaching'){
				 
			 ?>
			     Number of Group Members: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['number_of_group_members']?></strong>
				 <br>
			 <?php 
			 }?>
			 Is it your 1st session?: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['first_session']?></strong><br>
             Goals: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['goals']?></strong><br>
             Top strength: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['top_strength']?></strong><br>
             Top development point: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['top_development_point']?></strong><br>
			 # of Sessions: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['number_of_sessions']?></strong><br>
              Instagram handle: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['instagram_handle']?></strong><br>
              LinkedIn handle: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['linkedin_handle']?></strong><br>Facebook handle: <strong style="color: rgb(0,0,0); color: #fff; float: right;font-weight: 600;"><?php echo $booking['facebook_handle']?></strong><br>Twitter handle: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['twitter_handle']?></strong><br>
			  Comments: <strong style="color: rgb(0,0,0); color: #000;font-weight: 600;"><?php echo $booking['comments']?></strong><br>

            </p>
          </div>
          </div>
          <div style="width: 100%;color: #fff; box-sizing: border-box; padding: 0 0px 0 30px;">
          <hr style="width: 35%; margin: 10px auto; color: #a8d08d; border: none; height: 2px; background: #a8d08d;">
            <p style="line-height: 25.0px;display: block;margin: 15px 0 10px 0;color: rgb(51,51,51); color: #000; font-family: Gotham;">Thanks <br> Team Fully Bossed.</p>
          </div>
    </div>
    <div class="footer" style="width: 602px; text-align: center; color: #000; border-top: solid 1px #00000085; background-color: #A8D08D; padding: 5px 0 5px;">
      <p style="font-family: Gotham;">Copyright © www.FullyBossed.com</p>
    </div>
</div>

  </body>
  </html>