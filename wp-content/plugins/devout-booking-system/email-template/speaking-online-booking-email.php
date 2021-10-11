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
      <div style="font-size: 20.0px;text-align: center;margin: 0 0 0 0;color: rgb(0,0,0);font-weight: 600;background: #FFDA67;display: inline-block;padding: 10.0px 20.0px; font-family: Gotham;"><?php echo $subject;?></div>
   </div>
   <div class="Dear" style="width: 602px; color: #000; background-color: #fff; box-sizing: border-box; padding: 0 30px 0 30px; font-size: 18px; border: 1px solid #000; border-top: none; border-bottom: none;">
     <?php echo $body;?>
   </div>
    <div class="content" style="width: 602px; color: #fff; padding: 15px 0 5px; background-color: #fff; box-sizing: border-box; border: 1px solid #000; border-top: none; border-bottom: none;">
      <div style="padding: 0 30.0px;text-align: left;font-size: 14.0px;">
	  <?php if(!empty($booking['decline_comment'])){ ?>
	  <div style="/*border: 1px solid #000; padding: 0 15px;*/">
          <hr style="width: 35%; margin: 10px auto; color: #a8d08d;">
          <h5 style="font-size: 18.0px;line-height: 25.0px;display: block;margin: 0.0px 0.0px 15.0px 0.0px;padding: 15.0px 0.0px 0.0px 0.0px;color: rgb(51,51,51);text-transform: uppercase;letter-spacing: 1.0px; font-family: GoudyOS; color: #000;">Declined Reason</h5>

           <p style="line-height: 25.0px;display: block;margin: 0.0px 0.0px 20.0px 0.0px;padding: 0 0; color: rgb(51,51,51); color: #000; font-family: Gotham;">
           <?php echo $booking['decline_comment'];?>
		   </p>
			<p>
			</p>
       </div>
	 <?php
	 }?>
     <?php
	 if($booking['status']==2 || $booking['status']==4){?>
          <div style="/*border: 1px solid #000; padding: 0 15px; margin: 15px 0 0 0; margin-bottom: 13px;*/">
          <hr style="width: 35%; margin: 10px auto; color: #a8d08d;">
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
			  Tax (<?php echo number_format($booking['hst_percent'], 0)?>% HST') : <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo CURRENCYSYMBOL.number_format($booking['hst_amount'], 2)?></strong> <br>
			  Total: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo CURRENCYSYMBOL.number_format($booking['total'], 2)?></strong>
			  </p>
            </div>
		  <?php
		  }?>
        <div style="/*border: 1px solid #000; padding: 0 15px;*/">
        <hr style="width: 35%; margin: 10px auto; color: #a8d08d;">
          <h5 style="font-size: 18.0px;line-height: 25.0px;display: block;margin: 0.0px 0.0px 15.0px 0.0px;padding: 15.0px 0.0px 0.0px 0.0px;color: rgb(51,51,51);text-transform: uppercase;letter-spacing: 1.0px; font-family: GoudyOS; color: #000;">Booking Details</h5>

          <p style="line-height: 25.0px;display: block;margin: 0.0px 0.0px 20.0px 0.0px;padding: 0 0; color: rgb(51,51,51); color: #000; font-family: Gotham;">
            Booking Id: <strong style="color: rgb(0,0,0); color: #000; font-weight: 600; float: right;">#<?php echo $booking['id'];?></strong> <br>
            Booking Date: <strong style="color: rgb(0,0,0); color: #000; font-weight: 600; float: right;"><?php echo dateFormate($booking['created']);?></strong><br>
            Booking Status: <strong style="color: rgb(0,0,0); font-weight: 600; float: right;"><?php echo $booking_status;?></strong><br>
            Service: <strong style="color: rgb(0,0,0); color: #000; font-weight: 600; float: right;"><?php echo $booking['service_name'];?></strong> <br>
            Slot Date : <strong style="color: rgb(0,0,0); color: #000; font-weight: 600; float: right;"><?php echo $slot_date?></strong><br>
            Slots Time:<strong style="color: rgb(0,0,0); color: #000; font-weight: 600;float: right;"><?php echo $sub_slots_time?></strong><br>
            Total Hours: <strong style="color: rgb(0,0,0); color: #000; font-weight: 600; float: right;"><?php echo $total_booked_hours?></strong>
			<br>
           Price Per Hours: <strong style="color: rgb(0,0,0); color: #000; font-weight: 600; float: right;"><?php echo CURRENCYSYMBOL.$per_hour_rate?></strong>
			</p>
			<p>
			</p>
          </div>
          <div style="/*border: 1px solid #000; padding: 0 15px; margin: 15px 0 0 0;*/">
          <hr style="width: 35%; margin: 10px auto; color: #a8d08d;">
            <h5 style="font-size: 18.0px;line-height: 25.0px;display: block;margin: 0.0px 0.0px 15.0px 0.0px;padding: 15.0px 0.0px 0.0px 0.0px;color: rgb(51,51,51); color: #000; text-transform: uppercase;letter-spacing: 1.0px; font-family: GoudyOS;">Event Details</h5>
            <p style="line-height: 25.0px;display: block;margin: 0.0px 0.0px 20.0px 0.0px;color: rgb(51,51,51); color: #000; font-family: Gotham;">
              Heading/Topic: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['heading_topic']?></strong><br>
              Organisation: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['organisation']?></strong><br>
              Message Description: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['message_description']?></strong><br>
              Type of event: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['type_of_event']?></strong><br>
              Special Requests: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['special_requests']?></strong><br>
              Materials Required: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['materials_required']?></strong><br>
              Meeting Link: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['meating_link']?></strong><br>
              Location Type: <strong style="color: rgb(0,0,0) color: #000; float: right; ;font-weight: 600;"><?php echo $booking['location']?></strong><br>
              Audience size: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['audience_size']?></strong><br>
              Instagram handle: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['instagram_handle']?></strong><br>
              LinkedIn handle: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['linkedin_handle']?></strong><br>Facebook handle: <strong style="color: rgb(0,0,0); color: #fff; float: right;font-weight: 600;"><?php echo $booking['facebook_handle']?></strong><br>Twitter handle: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo $booking['twitter_handle']?></strong><br>
            </p>
          </div>
		  <?php if($booking['status']==1 || $booking['status']==5 || $booking['status']==3){?>
            <div style="/*border: 1px solid #000; padding: 0 15px; margin: 15px 0 0 0;*/">
            <hr style="width: 35%; margin: 10px auto; color: #a8d08d;">
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
			  Tax (<?php echo number_format($booking['hst_percent'], 0)?>% HST') : <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo CURRENCYSYMBOL.number_format($booking['hst_amount'], 2)?></strong> <br>
			  Total: <strong style="color: rgb(0,0,0); color: #000; float: right; font-weight: 600;"><?php echo CURRENCYSYMBOL.number_format($booking['total'], 2)?></strong>
			  </p>
            </div>
		  <?php
		  }?>
          </div>
          <div style="width: 100%;color: #fff; box-sizing: border-box; padding: 0 0px 0 30px;">
          <hr style="width: 35%; margin: 10px auto; color: #a8d08d;">
            <p style="line-height: 25.0px;display: block;margin: 15px 0 10px 0;color: rgb(51,51,51); color: #000; font-family: Gotham;">Thank You, <br> Team Fully Bossed.</p>
          </div>
    </div>
    <div class="footer" style="width: 602px; text-align: center; color: #000; border-top: solid 1px #00000085; background-color: #A8D08D; padding: 5px 0 5px;">
      <p style="font-family: Gotham;">Copyright © www.FullyBossed.com</p>
    </div>
</div>
  </body>
 </html>