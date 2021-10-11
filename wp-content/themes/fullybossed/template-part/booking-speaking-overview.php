<?php
/*
 * Template Name: Booking Speaking Overview
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @page FullyBossed
 * @since FullyBossed 1.0
 */
	get_header();
	$service_id = SPEEKING_SERVICE_ID;
	$session_id = SPEEKING_SESSION_ID;
    if(empty($service_id) || empty($session_id)){
	   wp_redirect(home_url());
	}
	$session = getSessionById($session_id);
	if(!in_array($session['service_id'],array(SPEEKING_SERVICE_ID))){
		wp_redirect(home_url());

	}
	$session_date_type=$session['session_date_type'];
	$price=$session['price'];
	$id=$session['id'];
	// $subtotal=$session['price'];
	// $hts_amount=($subtotal*HST_PERCENT)/100;
	// $total=$subtotal+$hts_amount;
	$Services = getServices();
?>
<div class="content">
	<div class="booking-process u-h-spacing ubg-grey">
		<div class="container">
			<div class="booking-process-inner">
				<ul>
					<!--<li><span></span> Booking Sessions</li>-->
					<li class="active"><span></span> Booking Request</li>
					<!--<li><span></span> Booking Payment</li>-->
				</ul>
			</div>
		</div>
	</div>
	<form method="POST" id="fb_booking_speaking_form">
	<input placeholder="Enter your first name" name="action" type="hidden" value="speaking_booking_save">
	<input type="hidden" name="service_id"   value="<?php echo $service_id?>">
	<input type="hidden" name="session_id" value="<?php echo $id?>">
	<input type="hidden" name="session_date" id="" value="<?php echo date("Y-m-d"); ?>">
	<input type="hidden" name="selected_date" id="selected_date" value="">
	<input type="hidden" name="total_hour" id="speaking_total_hour" value="">

	<div class="booking-fields u-spacing ubg-white">
		<div class="container">
			<div class="booking-summary-area">
				<div class="dark text-center">
					<h2>Complete your Request</h2>
				</div>
				<div style="text-align:center;">
					<label  id="login-msg" style="color:red"></label>
				</div>
				<div class="booking-u-f">
					<div class="row">
						<div class="col-md-6">
							<div class="booking-u-detials">
								<div class="dark">
									<h4>Contact details</h4>
									<!-- Fill your details -->
								</div>
								<div class="u-f-fields sec1-one-third">
									<div class="one-third-sec">
										<div class="row">
											<div class="col-md-6">
												<div class="u-form-single">
													<label>Name:</label>
													<input type="text" placeholder="Enter your name" name="name">
												</div>
											</div>
											<div class="col-md-6">
												<div class="u-form-single">
													<label>Surname:</label>
													<input type="text" placeholder="Enter your name" name="surname">
												</div>
											</div>
											<div class="col-md-6">
												<div class="u-form-single">
													<label>Contact Number:</label>
													<input placeholder="Enter your mobile number" name="mobile_number" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<div class="u-form-single">
													<label>Email Address:</label>
													<input placeholder="Enter your email address" name="email">
												</div>
											</div>
										</div>
									</div>

								<div class="dark">
									<h4>Event Details</h4>
								</div>
								<div class="one-third-sec">
									<div class="row">

										<!--<div class="col-md-6">
											<div class="u-form-single">
												<label>Date of speaking event:</label>
												<input type="date" placeholder="Date of speaking event" name="date_of_speaking_event">
											</div>
										</div>-->

										<div class="col-md-6">
											<div class="u-form-single">
												<label>Heading/Topic:</label>
												<input placeholder="Heading/Topic" name="heading_topic" required>
											</div>
										</div>

										<div class="col-md-6">
											<div class="u-form-single">
												<label>Organisation :</label>
												<input placeholder="Organisation" name="organisation">
											</div>
										</div>

										<div class="col-md-6">
											<div class="u-form-single">
												<label>Message Description :</label>
												<input placeholder="Message Description" name="message_description">
											</div>
										</div>

										<div class="col-md-6">
											<div class="u-form-single">
												<label>Type of event:</label>
												<select name="type_of_event" required>
													<option value="key note speech">Key Note Speech</option>
													<option value="talk">Talk</option>
													<option value="interview">Interview</option>
													<option value="panel">Panel</option>
												</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="u-form-single">
												<label>Special Requests:</label>
												<input placeholder="Special Requests" name="special_requests">
											</div>
										</div>

										<div class="col-md-6">
											<div class="u-form-single">
												<label>Materials Required:</label>
												<input placeholder="Materials Required" name="materials_required">
											</div>
										</div>

										<div class="col-md-6">
											<div class="u-form-single">
												<label>Location Type:</label>
												<select name="location" required id="location-type">
													<option value="online">Online</option>
													<option value="in-personal">In Personal</option>
												</select>
											</div>
										</div>
										<div class="col-md-6 meating_link_div"  style="display:">

											<div class="u-form-single">
												<label>Meeting link:</label>
									<input placeholder="Meating Link" name="meating_link" id="meating_link">
											</div>

										</div>
										<div class="col-md-6 location_description_div"  style="display:none">

											<div class="u-form-single">
												<label>Address:</label>
												<input placeholder="Address" name="location_description" id="location_description">
											</div>

										</div>
                                        <div class="col-md-6 location_description_div" id="location_description_div" style="display:none">

											<div class="u-form-single">
												<label>Postal code</label>
												<input placeholder="Postal Code" name="postal_code" id="postal_code">
											</div>

										</div>
                                        <div class="col-md-6 location_description_div"  style="display:none">

											<div class="u-form-single">
												<label>Country:</label>
												<input placeholder="Country" name="country" id="country">
											</div>

										</div>

										<div class="col-md-6">
											<div class="u-form-single">
												<label>Audience size:</label>
												<select name="audience_size" required>
													<option value="<30"><30</option>
													<option  value="31-50">31-50</option>
													<option  value="51-100">51-100</option>
													<option  value="100+">100+</option>
												</select>
											</div>
										</div>

									 </div>
								</div>
								<div class="dark">
									<h4>Social Media</h4>
								</div>
								<div class="one-third-sec">
									<div class="row">
										<div class="col-md-6">
											<div class="u-form-single">
												<label>Instagram handle:</label>
												<input placeholder="Enter your instagram handle" name="instagram_handle"  type="url">
											</div>
										</div>

										<div class="col-md-6">
											<div class="u-form-single">
												<label>LinkedIn handle:</label>
												<input placeholder="Enter your linkedIn handle" name="linkedin_handle"  type="url">
											</div>
										</div>

										<div class="col-md-6">
											<div class="u-form-single">
												<label>Facebook handle:</label>
												<input placeholder="Enter your facebook handle" name="facebook_handle"  type="url">
											</div>
										</div>

										<div class="col-md-6">
											<div class="u-form-single">
												<label>Twitter handle:</label>
												<input placeholder="Enter your twitter handle" name="twitter_handle"  type="url">
											</div>
										</div>

									</div>
								</div>
								<!--<div class="dark">
									<h4>Other</h4>
								</div>
								<div class="one-third-sec">
									<div class="row">

		                                 <div class="col-md-12">
											<div class="u-form-single">
												<label>Comments:</label>
												<textarea placeholder="Enter your comments" name="comments"></textarea>
											</div>
										</div>
									</div>
								</div>-->

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
                                                <div class="fb-speaking-booking-overview-calendar" id="fb-speaking-booking-overview-calendar"></div>
											</div>
										</div>
									</li>
								</ul>
							</div>

							<div class="booking-summary-single dark" id="fb-speaking-service-time-sec" style="display:none;">
								<div class="booking-s-single-title">
								<h4>Select Time</h4>
								</div>
									<ul>
										<li>
											<div class="row">
												<div class="col-md-6">
													<p>From</p>
													<input type="text" class="fb-speaking-time" id="fb-speaking-time-from" placeholder="From Time" readonly name="from_time">
												</div>
												<div class="col-md-6">
													<p>To</p>
													<input type="text" class="fb-speaking-time" id="fb-speaking-time-to" placeholder="To Time" readonly name="to_time">
												</div>
											</div>
										</li>
									</ul>
							</div>

							<div class="booking-summary-single dark" id="fb-speaking-total-price-sec" style="display:none;">
								<div class="booking-s-single-title">
								<h4><?php echo $Services[$service_id] ?> Slot Details</h4>
								</div>
								<ul>

									<li>
										<div class="row">
											<div class="col-md-6">
												<p>Slot Time</p>
											</div>

											<div class="col-md-6">
												<p class="text-right"><strong id="fb-service-time"> </strong></p>
											</div>
										</div>
									</li>
                                    <li>
										<div class="row">

											<div class="col-md-6">
												<p>Total Hours</p>
											</div>
											<div class="col-md-6">
												<p class="text-right"> <strong id="fb-total-hours"> </strong> </p>
											</div>

										</div>
									</li>

									<!--<li>
										<div class="row">
											<div class="col-md-6">
												<p>Price Per Hours</p>
											</div>
											<div class="col-md-6">
												<p class="text-right"> <strong id="fb-price-per-hours"> <?php echo CURRENCYSYMBOL.$price?></strong> </p>
											</div>
										</div>
									</li>-->

									<li>
										<div class="row">

											<div class="col-md-6">
												<p>Slot Date</p>
											</div>

											<div class="col-md-6">
												<p class="text-right"> <strong id="fb-service-date"> </strong> </p>
											</div>

										</div>
									</li>

								</ul>
							</div>

							<div class="booking-summary-single dark" id="fb-speaking-total-price" style="display:none;">

							</div>
							<div class="u-row text-center u-sitecolor-btn" id="fb-speaking-proceed-to-pay" style="display:none;">

								<button type="submit" id="add-supplier-btn">Proceed</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>

<div class="modal" tabindex="-1" role="dialog" id="speaking-msg">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alert Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="speaking-msg-data"></p>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo home_url().'/wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/assets/js/validation.js'?>"></script>
<?php get_footer();
