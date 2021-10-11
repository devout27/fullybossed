<?php 
/*
 * Template Name: Booking Overview Template
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @page FullyBossed
 * @since FullyBossed 1.0
 */
    $service_id=isset($_GET['code']) ? base64_decode($_GET['code']):'';
	$session_id=isset($_GET['sessioncode']) ? base64_decode($_GET['sessioncode']):'';
	$session_date=isset($_GET['session_date']) ? $_GET['session_date']:'';
    if(empty($service_id) || empty($session_id)){
		wp_redirect(home_url());
	}
	$session=getSessionById($session_id);
	if(in_array($session['service_id'],array(223,221)) && empty($session_date)){
		
		wp_redirect(home_url());
		
	}
    get_header();
    $session=getSessionById($session_id);
	$session_date_type=$session['session_date_type'];
	$from_time=$session['from_time'];
	$to_time=$session['to_time'];
	$from_date=$session['from_date'];
	$to_date=$session['to_date'];
	$price=$session['price'];
	$id=$session['id'];
	$Services=getServices();
	$subtotal=$session['price'];
	$hts_amount=($subtotal*HST_PERCENT)/100;
	$total=$subtotal+$hts_amount;
?>
<div class="content">
	<div class="booking-process u-h-spacing ubg-grey">
		<div class="container">
			<div class="booking-process-inner">
				<ul>
					<li><span></span> Booking Sessions</li>
					<li class="active"><span></span> Booking Overview</li>
					<li><span></span> Booking Payment</li>
				</ul>
			</div>
		</div>
	</div>
	
	<form method="POST" id="FullbossedServiceForm">
	<input placeholder="Enter your first name" name="action" type="hidden" value="booking_save">
	<input type="hidden" name="service_id"   value="<?php echo $service_id?>">
	<input type="hidden" name="session_id" value="<?php echo $id?>">
	<input type="hidden" name="session_date" value="<?php echo $session_date?>">
	
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
								<div class="dark">
									<h4>Contact details</h4>

									<!-- Fill your details -->
								</div>
								<!-- <div class="u-f-fields">
									<div class="row">
										<div class="col-md-6">
											<div class="u-form-single">
												<label>First name:</label>
												<input placeholder="Enter your first name" name="first_name" required="">
											</div>
										</div>
										<div class="col-md-6">
											<div class="u-form-single">
												<label>Last name:</label>
												<input placeholder="Enter your last name" name="last_name" required="">
											</div>
										</div>
									</div>									
									<div class="u-form-single">
										<label>Email Address:</label>
										<input placeholder="Enter your email address" name="email" required="">
									</div>
									<div class="u-form-single">
										<label>Mobile Number:</label>
										<input placeholder="Enter your mobile number" name="mobile_number" required="">
									</div>
								</div> -->
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
													<label>Mobile Number:</label>
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
												<select name="who_you_are" required>
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
												<select name="current_position" required>
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
												<select name="interested_content" required>
													<option value="Mindset">Mindset</option>
													<option  value="Brand">Brand</option>
													<option  value="Open to opportunities">Story</option>
													<option  value="Checklist Orchestration ">Orchestration Checklist</option>
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
												<label>Booking type:</label>
												<select name="booking_type" required>
													<option value="session">Session</option>
													<option  value="group session">group session</option>
													
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
										<input placeholder="What do you want to achieve from the academy" name="goals" required>
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
									            <input placeholder="Enter your top strength" name="top_strength" required>
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
												<input placeholder="Enter your top development point" name="top_development_point" required>
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
												<select name="number_of_sessions" required>
													<option value="1">1</option>
													<option  value="5">5</option>
													<option  value="10">10</option>
													<option  value="15">15</option>
													<option  value="20">20</option>
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
												<input type="date" placeholder="Date of speaking event" name="date_of_speaking_event" required>
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
												<input placeholder="Heading/Topic" name="heading_topic" required>
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
												<input placeholder="organisation" name="organisation" required>
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
								<input placeholder="Message Description" name="message_description" required>
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
												<select name="type_of_event" required>
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
									<input placeholder="Materials Required" name="materials_required" required>
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
									<input placeholder="Location" name="location" required>
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
									            <select name="audience_size" required>
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
												<input placeholder="Enter your instagram handle" name="instagram_handle"  type="url">
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
													<input placeholder="Enter your linkedIn handle" name="linkedin_handle"  type="url">
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
													<input placeholder="Enter your facebook handle" name="facebook_handle"  type="url">
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
													<input placeholder="Enter your twitter handle" name="twitter_handle"  type="url"> 
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
												<textarea placeholder="Enter your comments" name="comments"></textarea>
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
									<h4>Selected Service</h4>
									<!-- <a href="<?php echo home_url()?>/services">Edit</a> -->
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
							</div>
							<div class="booking-summary-single dark">
								<div class="booking-s-single-title">
									<h4>Session Details</h4>
									<!-- <a href="<?php echo home_url()?>/booking-sessions/?code=<?php echo base64_encode($service_id)?>">Edit</a> -->
								</div>
								<ul>
									<li>
										<div class="row">
											<div class="col-md-6">
												<p>Session Name</p>
											</div>
											<div class="col-md-6">
												<p class="text-right">
												<strong><?php echo $session['name']?></strong>
												</p>
												
											</div>
										</div>
									</li>
									<li>
										<div class="row">
											<div class="col-md-6">
												<p>Session Time</p>
											</div>
											<div class="col-md-6">
												<p class="text-right"><strong><?php echo ftimeFormate($from_time)?> - <?php echo ftimeFormate($to_time)?> 
											<?php if($session_date_type==1){
												echo "daily";
											}
											?></strong></p>
											</div>
										</div>
									</li>
									<li>
										<div class="row">
										   <?php 
											if($session_date_type==2){
												$sessionDates=getSessionDatesBySessionId($id);
											?>
											<div class="col-md-6">
												<p>Session Date</p>
											</div>
											<div class="col-md-6">
											
												<p class="text-right"><strong>
												<?php 
												if(in_array($session['service_id'],array(223,221)) && !empty($session_date)){
		                                             
		                                              echo date('F d Y',strtotime($session_date)).'</br>';
		
	                                            }else{
											    foreach($sessionDates as $date){
													
													echo date('F d Y',strtotime($date)).'</br>';
	                                              } 
	                                            }
											    ?>
												</strong>
												</p>
											</div>
											<?php }else{?>
											<div class="col-md-6">
												<p>Session Date</p>
											</div>
											<div class="col-md-6">
												<p class="text-right"><strong><?php echo date('F d',strtotime($from_date))?> - <?php echo date('d, Y',strtotime($to_date))?></strong></p>
											</div>
											<?php 
											}?>
										</div>
									</li>
									
									<li>
										<div class="row">
											<div class="col-md-6">
												<p>Session Price</p>
											</div>
											<div class="col-md-6">
												<p class="text-right"><strong><?php echo CURRENCYSYMBOL.number_format($price,2);?></strong></p>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<div class="booking-summary-single dark">
								<div class="booking-s-single-title">
									<h4>Total Price</h4>
								</div>
								<ul>
									<li>
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
										<div class="row">
											<div class="col-md-6">
												<p>Total</p>
											</div>
											<div class="col-md-6">
												<p class="text-right"><strong><?php echo CURRENCYSYMBOL.number_format($total,2);?></strong></p>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<div class="u-row text-center u-sitecolor-btn">
								<a href="<?php echo home_url()?>/booking-sessions/?code=<?php echo base64_encode($service_id)?>"><button type="button" class="back"><i class="fas fa-chevron-left"></i> Back</button></a>
								<button type="submit" id="add-supplier-btn">Proceed to pay</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>
<script src="<?php echo home_url().'/wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/assets/js/validation.js'?>"></script>
<script>

    jQuery('#FullbossedServiceForm').validate({
        rules: {
			name: {
				required: true,
			},
			email: {
				required: true,
				email:true
			},
			mobile_number:{
			    required: true,
				maxlength:12,
				minlength:8
				
			}
		},
        messages: {
			service_id:{
				required: 'Select Service',
			},
            name:{
				required: 'Please Enter Name',
			},
			email:{
				required: 'Please Enter Email',
			},
			mobile_number:{
				required: 'Please Enter Mobile Number',
			}
        },
		submitHandler: function(form) {
			
		  $("#loder-img").show();
          $("#login-msg").html('');		  
          var url ='<?php echo get_home_url();?>/wp-admin/admin-ajax.php';
          $("#login-msg").html('');
          $.ajax({
            type: "POST",
            url: url,
            data: $(form).serialize(), // serializes the form's elements.
            beforeSend:function() {
               $('button[type=submit]').attr('disabled', true);
            },
            success: function(data) {
                $('button[type=submit]').attr('disabled', false);
				let response = JSON.parse(data);
                if(response.status == 'success') {
					
					window.location.href='<?php echo home_url()?>/booking-payment/?booking_id='+response.id;
					
                }else{
					$("#loder-img").hide();	
                    $("#login-msg").html(response.msg);
				}
            },
            error: function (error) {
				
				 $("#loder-img").hide();	
                 $("#login-msg").html(response.msg);
            },
          });
        },
    });
	
	/*jQuery('#add-supplier-btn').click(function() {
        if (jQuery('#supplierAdd').valid()) {
			showLoader();
        }
    });*/
	
	function showLoader(){
		jQuery("#loder-img").show();
	}
</script>
<?php get_footer(); ?>