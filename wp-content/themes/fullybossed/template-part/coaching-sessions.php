<?php
/*
 * Template Name: Coaching Sessions
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @page FullyBossed
 * @since FullyBossed 1.0
 */

    $service_id = isset($_GET['code']) ? base64_decode($_GET['code']):COACHING_SERVICE_ID;
	$session_id = isset($_GET['sessioncode']) ? base64_decode($_GET['sessioncode']):COACHING_SESSION_ID;
	$service_type = isset($_GET['service_type']) ? base64_decode($_GET['service_type']) : '';
	$session_date=date('Y-m-d');
    if(empty($service_id) || empty($session_id)){
		wp_redirect(home_url());
	}
	$session=getSessionById($session_id);
	if(!in_array($session['service_id'],array(COACHING_SERVICE_ID))){
		wp_redirect(home_url());

	}
    get_header();
    $allSessionDataTime=getSessionCoachingDatesTimeBySessionId($session_id);
	$session_date_type=$session['session_date_type'];
    $Services=getServices();

?>
<link rel="stylesheet" href="<?php echo home_url()?>/wp-content/themes/fullybossed/powerful-calendar/page.css">
<link rel="stylesheet" href="<?php echo home_url()?>/wp-content/themes/fullybossed/powerful-calendar/style.css">
<link rel="stylesheet" href="<?php echo home_url()?>/wp-content/themes/fullybossed/powerful-calendar/theme.css">
<link rel="shortcut icon" href="<?php echo home_url()?>/wp-content/themes/fullybossed/powerful-calendar/favicon.png">
<div class="content">
	<div class="booking-process u-h-spacing ubg-grey">
		<div class="container">
			<div class="booking-process-inner">
				<ul>
					<!--<li><span></span> Booking Sessions</li>-->
					<li class="active"><span></span> Booking Overview</li>
					<li><span></span> Booking Payment</li>
				</ul>
			</div>
		</div>
	</div>

	<form method="POST" id="supplierAdd" action="https://fullybossed.com/booking-payment">
	<input placeholder="Enter your first name" name="action" type="hidden" value="coaching_booking_save">
	<input type="hidden" name="service_id" value="<?php echo $service_id?>" id="service_id">
	<input type="hidden" name="session_id" value="<?php echo $session_id?>" id="session_id">
	<input type="hidden" name="session_date" value="<?php echo $session_date?>" id="session_date">
	<input type="hidden" name="booking_slot_id" value="" id="booking_slot_id">
	<input type="hidden" name="booking_sub_slot_time" value="" id="booking_sub_slot_time">
	<input type="hidden" name="booking_main_slot_id" value="" id="booking_main_slot_id">
	<input type="hidden" name="service_type" value="<?php echo $service_type; ?>" id="service_type">


	<div class="booking-fields u-spacing ubg-white">
		<div class="container">
			<div class="booking-summary-area">
				<div class="dark text-center">
					<h2>Your booking overview</h2>
				</div>
				<div style="text-align:center;">
					<label  id="login-msg" style="color:red"></label>
				</div>
				<div class="booking-u-f">
					<div class="row">
						<div class="col-md-6">
							<div class="booking-u-detials">

							<div id="booking-u-detials-loder-img" class="booking-u-detials-loader">
								<div>
									<img src="https://fullybossed.com/wp-content/plugins/devout-booking-system/loader.gif" width="80">
								</div>
							</div>


							<div class="u-f-fields sec1-one-third">
									<div class="one-third-sec">
										<div class="row">

										<div class="col-md-6">
											<div class="u-form-single">
												<label>Coaching type:</label>
												<select name="booking_type" required class="bc_booking_type">
													<option value="session">1 on 1 Coaching</option>
													<option value="group session">Group Coaching</option>
												</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="u-form-single">
											<label>Is it your 1st session?</label>
												<select name="booking_type" required class="session_type_opt">
												<option value="">Select</option>
													<option value="yes">Yes</option>
													<option value="no">No</option>
												</select>
											</div>
										</div>
										</div>
									</div>
								</div>

								<div class="dark">
									<h4>Contact details</h4>
									<!-- Fill your details -->
								</div>

								<div class="u-f-fields sec1-one-third">
									<div class="one-third-sec">
										<div class="row">

											<div class="col-md-6">
												<div class="u-form-single">
													<label>Email Address:</label>
													<input placeholder="Enter your email address" name="email" class="bc_email">
												</div>
											</div>

											<div class="col-md-6">
												<div class="u-form-single">
													<label>Name:</label>
													<input type="text" placeholder="Enter your name" name="name" class="bc_name" autocomplete="false">
												</div>
											</div>

											<div class="col-md-6">
												<div class="u-form-single">
													<label>Surname:</label>
													<input type="text" placeholder="Enter your name" name="surname" class="bc_surname">
												</div>
											</div>

											<div class="col-md-6">
												<div class="u-form-single">
													<label>Mobile Number:</label>
													<input placeholder="Enter your mobile number" name="mobile_number" type="text" class="bc_mobile_number">
												</div>
											</div>

										</div>
									</div>

								<div class="dark">
									<h4>Background</h4>
								</div>
								<div class="one-third-sec">
									<div class="row">
									<?php

									if(in_array($session['service_id'],array(195,223))){
	                                ?>


										<div class="col-md-6">
											<div class="u-form-single">
												<label>Who You are?:</label>
												<select name="who_you_are" required class="bc_who_you_are">
													<option value="Corporate professional">Corporate professional</option>
													<option value="Business owner/Co-Founder">Business owner/Co-Founder</option>
													<option value="Student/recently graduated">Student/recently graduated</option>
												</select>
											</div>
										</div>
									<?php
									}?>
									<?php
									 if(in_array($session['service_id'],array(195,223))){
	                                ?>
										<div class="col-md-6">
											<div class="u-form-single">
												<label>Current position:</label>
												<select name="current_position" required class="bc_current_position">
													<option value="Employed">Employed</option>
													<option  value="Career/Business break">Career/Business break</option>
													<option  value="Open to opportunities">Open to opportunities</option>
													<option  value="Student">Student</option>
												</select>
											</div>
										</div>
									 <?php
									 }?>
                                    <?php
									 if(in_array($session['service_id'],array(223))){
	                                ?>

										<div class="col-md-6">
											<div class="u-form-single">
												<label>Interested content:</label>
												<select name="interested_content" required class="bc_interested_content">
													<option value="Mindset">Mindset</option>
													<option value="Brand">Brand</option>
													<option value="Open to opportunities">Story</option>
													<option value="Checklist Orchestration ">Orchestration Checklist</option>
												</select>
											</div>
										</div>
									 <?php
									 }?>
                                     <?php
									 if(in_array($session['service_id'],array(223))){
	                                 ?>
										<div class="col-md-6">
											<div class="u-form-single">
												<label>Coaching type:</label>
												<select name="booking_type" required class="bc_booking_type">
													<option value="session">1 on 1 Coaching</option>
													<option value="group session">Group Coaching</option>
												</select>
											</div>
										</div>
									 <?php
									}?>
                                    <?php
									 if(in_array($session['service_id'],array(195,223))){
	                                 ?>
								<div class="col-md-6">
									<div class="u-form-single">
										<label>Goals:</label>
										<input placeholder="What do you want to achieve from the academy" name="goals" required class="bc_goals">
									</div>
									</div>
									 <?php
									 }?>

									 <?php
									 if(in_array($session['service_id'],array(195,223))){
	                                 ?>
										<div class="col-md-6">
											<div class="u-form-single">
												<label>Top strength:</label>
									            <input placeholder="Enter your top strength" name="top_strength" required class="bc_top_strength">
											</div>
										</div>
									 <?php
									 }?>
									 <?php
									 if(in_array($session['service_id'],array(195,223))){
	                                 ?>
										<div class="col-md-6">
											<div class="u-form-single">
												<label>Top development point:</label>
												<input placeholder="Enter your top development point" name="top_development_point" required class="bc_top_development_point">
											</div>
										</div>
									 <?php
									 }?>
									 <?php
									 if(in_array($session['service_id'],array(223))){
	                                 ?>
										<div class="col-md-6">
											<div class="u-form-single">
												<label># of Sessions:</label>
												<select name="number_of_sessions" required class="bc_number_of_sessions">
													<option value="1">1</option>
													<option value="5">5</option>
													<option value="10">10</option>
													<option value="15">15</option>
													<option value="20">20</option>
												</select>
											</div>
										</div>
									 <?php
									 }?>
									 <?php
									 if(in_array($session['service_id'],array(221))){
	                                 ?>
										<div class="col-md-6">
											<div class="u-form-single">
												<label>Date of speaking event:</label>
												<input type="date" placeholder="Date of speaking event" name="date_of_speaking_event" required class="bc_date_of_speaking_event">
											</div>
										</div>
									 <?php
									 }?>
									 <?php
									 if(in_array($session['service_id'],array(221))){
	                                 ?>
										<div class="col-md-6">
											<div class="u-form-single">
												<label>Heading/Topic:</label>
												<input placeholder="Heading/Topic" name="heading_topic" required class="bc_heading_topic">
											</div>
										</div>
									 <?php
									 }?>
									 <?php
									 if(in_array($session['service_id'],array(221))){
	                                 ?>
										<div class="col-md-6">
											<div class="u-form-single">
												<label>Organisation :</label>
												<input placeholder="organisation" name="organisation" required class="bc_organisation">
											</div>
										</div>
									 <?php
									 }?>
									  <?php
									 if(in_array($session['service_id'],array(221))){
	                                 ?>
										<div class="col-md-6">
											<div class="u-form-single">
												<label>Message Description :</label>
												<input placeholder="Message Description" name="message_description" required class="bc_message_description">
											</div>
										</div>
									 <?php
									 }?>

									 <?php
									 if(in_array($session['service_id'],array(221))){
	                                 ?>
										<div class="col-md-6">
											<div class="u-form-single">
												<label>Type of event:</label>
												<select name="type_of_event" required class="bc_type_of_event">
													<option value="note_speech">note_speech</option>
													<option  value="Talk">Talk</option>
													<option  value="Interview">Interview</option>
													<option  value="Panel">Panel</option>
												</select>
											</div>
										</div>
									 <?php
									 }?>

									<?php
									 if(in_array($session['service_id'],array(221))){
	                                 ?>
										<div class="col-md-6">
											<div class="u-form-single">
												<label>Materials Required:</label>
												<input placeholder="Materials Required" name="materials_required" required class="bc_materials_required">
											</div>
										</div>
									 <?php
									 }?>
									 <?php
									 if(in_array($session['service_id'],array(221))){
	                                 ?>
										<div class="col-md-6">
											<div class="u-form-single">
												<label>Location:</label>
												<input placeholder="Location" name="location" required class="bc_location">
											</div>
										</div>
									 <?php
									 }?>
									 <?php
									 if(in_array($session['service_id'],array(221))){
	                                 ?>
										<div class="col-md-6">
											<div class="u-form-single">
												<label>Audience size:</label>
									            <select name="audience_size" required class="bc_audience_size">
													<option value="<30"><30</option>
													<option  value="31-50">31-50</option>
													<option  value="51-100">51-100</option>
													<option  value="100+">100+</option>
												</select>
											</div>
										</div>
									 <?php
									 }?>

									 </div>
								</div>



								<div class="dark">
									<h4>Social Media</h4>
								</div>
								<div class="one-third-sec">
									<div class="row">
										 <?php
										 if(in_array($session['service_id'],array(195,223,221))){
	                                 ?>
										<div class="col-md-6">
											<div class="u-form-single">
												<label>Instagram handle:</label>
												<input placeholder="Enter your instagram handle" name="instagram_handle"  type="url" class="bc_instagram_handle">
											</div>
										</div>
										 <?php
										 }?>
	 									 <?php
										 if(in_array($session['service_id'],array(195,223,221))){
		                                 ?>
											<div class="col-md-6">
												<div class="u-form-single">
													<label>LinkedIn handle:</label>
													<input placeholder="Enter your linkedIn handle" name="linkedin_handle"  type="url" class="bc_linkedin_handle">
												</div>
											</div>
										 <?php
										 }?>


										 <?php
										 if(in_array($session['service_id'],array(195,223,221))){
		                                 ?>
											<div class="col-md-6">
												<div class="u-form-single">
													<label>Facebook handle:</label>
													<input placeholder="Enter your facebook handle" name="facebook_handle" type="url" class="bc_facebook_handle">
												</div>
											</div>
										 <?php
										 }?>


	                                    <?php
										 if(in_array($session['service_id'],array(195,223,221))){
		                                 ?>
											<div class="col-md-6">
												<div class="u-form-single">
													<label>Twitter handle:</label>
													<input placeholder="Enter your twitter handle" name="twitter_handle"  type="url" class="bc_twitter_handle">
												</div>
											</div>

										 <?php
										 }?>
									</div>
								</div>



								<div class="dark">
									<h4>Other</h4>
								</div>
								<div class="one-third-sec">
									<div class="row">
										 <?php
										 if(in_array($session['service_id'],array(195,223,221))){
		                                 ?>
		                                 <div class="col-md-12">
											<div class="u-form-single">
												<label>Comments:</label>
												<textarea placeholder="Enter your comments" name="comments" class="bc_comments"></textarea>
											</div>
										</div>
										 <?php
										 }?>

									</div>
								</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
                           <div class="booking-summary-single dark">
								<div class="booking-s-single-title">
									<h4>Select Date</h4>
								</div>
								<ul>
									<li>
										<div class="row">
											<div class="col-md-12">
                                                <div class="calendar-wrapper"></div>
											</div>
										</div>
									</li>
								</ul>
							</div>
						   <!--<div class="booking-summary-single dark">
								<div class="booking-s-single-title">
									<h4>Selected Service</h4>

								</div>
								<ul>
									<li>
										<div class="row">
											<div class="col-md-6">
												<p>Service</p>
											</div>
											<div class="col-md-6">
												<p class="text-right"><strong><?php echo $Services[$service_id]?></strong></p>

											</div>
										</div>
									</li>
								</ul>
							</div>-->

							<div class="booking-summary-single dark" id="slot_details">
								<div class="booking-s-single-title">
									<h4><?php echo $Services[$service_id] ?> Slot Details</h4>

								</div>
                                <?php
                                $SessionDataTime=array();
                                if(array_key_exists($session_date,$allSessionDataTime)){
                                    $SessionDataTime=$allSessionDataTime[$session_date];
                                }
                                ?>
								<ul id="slotData">
                                    <li>
										<div class="row">
											<div class="col-md-6">
											<p>Time</p>
											</div>
											<div class="col-md-3">
											<p>Price / hour</p>
											</div>
                                            <div class="col-md-3">
											<p>Availability</p>
											</div>
										</div>
									</li>
                                    <?php
                                    if(!empty($SessionDataTime)){
										echo '<li><div class="row">
										<div class="col-md-12">
										   <div class="alert alert-warning" role="alert">
											Please select the time slot
											</div>
										 </div>
									 </div></li>';

                                    // foreach($SessionDataTime as $timeData){

                                    //     $from_time=$timeData['from_time'];
                                    //     $to_time=$timeData['to_time'];

                                    //     $from_time_str=date('h:i A',strtotime($timeData['from_time']));
                                    //     $to_time_str=date('h:i A',strtotime($timeData['to_time']));
                                    //     $id=$timeData['id'];
                                    //     $price=$timeData['price'];
                                    //     $sql="SELECT * FROM XDk_dc_session_booking_dates WHERE service_id='$service_id' AND session_id='$session_id' AND session_date='$session_date' AND from_time='$from_time' AND to_time='$to_time'";

                                    //     $bookings=getRow($sql);
                                    //     $Availability=true;

                                    //     if(!empty($bookings)){

                                    //         $Availability=false;
                                    //     }

                                    // ?>
                                    <!-- //   <li>

									// 	<div class="row">
									// 		<div class="alert alert-warning" role="alert">
									// 		   Please select the time slot 2
                                    //            </div>
									// 		<div class="col-md-6">
									// 		<p>
                                    //          <?php if($Availability){?>
                                    //         <input type="radio" value="<?php  $id?>" name="slot_id" onchange="getSlotPayment(<?php echo $id ?>)">
                                    //         <?php }?>
                                    //         <span><?php echo $from_time_str?></span> - <span><?php echo $to_time_str?></span>
                                    //          </p>
									// 		</div>
									// 		<div class="col-md-3">
									// 		<p><?php echo CURRENCYSYMBOL.number_format($price,2);?></p>
									// 		</div>
                                    //         <div class="col-md-3">
									// 		<p>
                                    //          <?php if($Availability){?>
                                    //            <button type="button" class="btn btn-success"> Available</button>
                                    //            <?php
                                    //             }else{?>
                                    //              <button type="button" class="btn btn-danger">Booked</button>
                                    //             <?php }?>
                                    //        </p>
									// 		</div>
									// 	</div>
									// </li> -->
                                    <?php //}
                                    } else{ ?>
									<li>
										<div class="row">
                                           <div class="col-md-12">
                                              <div class="alert alert-warning" role="alert">
                                                No slots available date on  <?php echo date('d M Y',strtotime($session_date));?>
                                               </div>
											</div>
										</div>
									</li>
                                    <?php
                                    }?>
								</ul>
							</div>
							<div class="booking-summary-single dark" id="price_details">
								<div class="booking-s-single-title">
									<h4>Total Price</h4>
								</div>
								<ul  id="payemt-data">
								    <li>
										<div class="row">
                                           <div class="col-md-12">
                                              <div class="alert alert-warning" role="alert">
											   Please select the time slot
                                               </div>
											</div>
										</div>
									</li>

									<!--<li>
										<div class="row">
											<div class="col-md-6">
												<p>SubTotal</p>
											</div>
											<div class="col-md-6">
												<p class="text-right"><strong><?php echo CURRENCYSYMBOL.number_format($subtotal,2);?></strong></p>
											</div>
										</div>
									</li>
									<li>
										<div class="row">
											<div class="col-md-6">
												<p>Tax (<?php echo HST_PERCENT?>% HST)</p>
											</div>
											<div class="col-md-6">
												<p class="text-right"><strong><?php echo CURRENCYSYMBOL.number_format($hts_amount,2);?></strong></p>
											</div>
										</div>
									</li>
									<li>
										<div class="row">s
											<div class="col-md-6">
												<p>Total</p>
											</div>
											<div class="col-md-6">
												<p class="text-right"><strong><?php echo CURRENCYSYMBOL.number_format($total,2);?></strong></p>
											</div>
										</div>
									</li>-->
								</ul>
							</div>
							<div class="u-row text-center u-sitecolor-btn" id="proceed_to_pay">
								<a href="<?php echo home_url()?>/services/coaching/"><button type="button" class="back"><i class="fas fa-chevron-left"></i> Back</button></a>
								<button type="submit" id="add-supplier-btn">Proceed to pay</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<input type="hidden" name="discount_percent" value="0" id="discount_percent">
	<input type="hidden" name="discount_val" value="0" id="discount_val">
	<input type="hidden" name="subtotal_val" value="0" id="subtotal_val">
	</form>
</div>

<div class="modal" tabindex="-1" role="dialog" id="ErrorModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p style="color:red">Please select time slot</p>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo home_url().'/wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/assets/js/validation.js'?>"></script>
<script src="<?php echo home_url()?>/wp-content/themes/fullybossed/powerful-calendar/calendar.min.js"></script>
<script src="https://unpkg.com/codeflask/build/codeflask.min.js"></script>
<script>

</script>

<script type="text/javascript">
//  var config = `var defaultConfig = {
//   weekDayLength: 1,
//   //date: new Date(),
//   date:'<?php //echo $request_date?>',
//   onClickDate: selectDate,
//   showYearDropdown: true,
//   startOnMonday: true,
//   showTodayButton: true,
//   min:crdate
// };`;

//jQuery('.calendar-wrapper').calendar(defaultConfig);
      //eval(config);
    //   const flask = new CodeFlask('#editor', {
    //     language: 'js',
    //     lineNumbers: true
    //   });
    //   flask.updateCode(config);
    //   flask.onUpdate((code) => {
    //     try {
    //       eval(code);
    //     } catch(e) {

	// 	}
    // });

    // function CheckAvailability(date){
	// 	$('#proceed_to_pay').show();
	// 	var url ='<?php echo get_home_url();?>/wp-admin/admin-ajax.php';
	// 	service_id=$("#service_id").val();
	// 	session_id=$("#session_id").val();
	// 	$("#booking_slot_id").val('');
	// 	$("#payemt-data").html('<li><div class="row"><div class="col-md-12"><div class="alert alert-warning" role="alert">Please select the time slot</div></div></div></li>');
	// 	$.ajax({
	// 			type: "POST",
	// 			url: url,
	// 			data: {'action':'check_slot_availability','session_date':date,'service_id':service_id,'session_id':session_id}, // serializes the form's elements.
	// 			beforeSend:function() {
	// 				$("#loder-img").show();
	// 			    $('button[type=submit]').attr('disabled', true);
	// 			},
	// 			success: function(data) {
    //                 $("#loder-img").hide();
	// 				$('button[type=submit]').attr('disabled', false);
	// 				let response = JSON.parse(data);
	// 				if(response.status == 'success') {
	// 					$('#slot_details').show();
	// 					$("#slotData").html(response.html);
	// 					$(response.all_booked_slots).each(function(index,value) {
	// 						console.log(value);
	// 					});

	// 				}
	// 			},
	// 			error: function (error) {
	// 				$("#loder-img").hide();
	// 			},
	// 	});
    // }

	// function getSlotPayment(slot_id) {
	// 	var url ='<?php //echo get_home_url();?>/wp-admin/admin-ajax.php';
	// 	$("#booking_slot_id").val('');
	// 	var html_slot_id = 'slot_id_'+slot_id;
	// 	$.ajax({
	// 			type: "POST",
	// 			url: url,
	// 			data: {'action':'get_slot_payment','slot_id':slot_id}, // serializes the form's elements.
	// 			beforeSend:function() {
	// 				$("#loder-img").show();
	// 				$('button[type=submit]').attr('disabled', true);
	// 			},
	// 			success: function(data) {
	// 				$("#loder-img").hide();
	// 				$('button[type=submit]').attr('disabled', false);
	// 				let response = JSON.parse(data);
	// 				if(response.status == 'success') {
	// 					$('#price_details').show();
	// 					$("#payemt-data").html(response.html);
	// 					$("#booking_slot_id").val(response.slot_id);
	// 					$('#' + html_slot_id + ' '+'.sub-slots').show();
	// 				}
	// 			}, error: function (error) {
	// 				$("#loder-img").hide();
	// 			},
	// 	});
	// }

 </script>
<?php get_footer(); ?>