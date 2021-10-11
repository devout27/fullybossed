<?php 
/*
 * Template Name: Booking Payment Template
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @page FullyBossed
 * @since FullyBossed 1.0
 */
$booking_id=isset($_REQUEST['booking_id']) ? base64_decode($_REQUEST['booking_id']):'';
if(empty($booking_id)){
	//wp_redirect(home_url());
}
 get_header(); 
 if(isset($_POST['action']) && $_POST['action'] == 'booking-payment'){	
	$booking_id = $_POST['booking_id'];
	$postData['card_number'] = $_POST['card_number'];
	$postData['card_exp_month'] = $_POST['card_exp_month'];
	$postData['card_exp_year'] = $_POST['card_exp_year'];
	$stripeToken=$postData['stripeToken'] = $_POST['stripeToken'];
	$postData['card_cvc'] = $_POST['card_cvc'];
	$table='XDk_dc_bookings';
	$postData['updated'] = date('Y-m-d H:i:s');
	$booking = getBookingById($booking_id);
	$email = $booking['email'];
	$name = $booking['name'];
	$item_name = $booking['session_name'];
	$total = $booking['total'];	
	if(!empty($booking_id)){
		$STRIPE_SECRET_KEY = STRIPE_SECRET_KEY;
		$stripe = new \Stripe\StripeClient($STRIPE_SECRET_KEY);
		$customer = $stripe->customers->create([
		'description' => 'buy '.$item_name,
		'email' =>$email,
		'source'  => $stripeToken
		]);
		$txn_id = $payment_customer_id = $balance_transaction='';		
		if(!empty($customer->id)){			
		   $total_amount = $total*100;
		   //Charge a credit or a debit card 
		   $charge = $stripe->charges->create(array(
					'customer'    => $customer->id, 
					'amount'      => $total_amount, 
					'currency'    => CURRENCY,
					'description' => 'buy '.$item_name, 
					'metadata' => array(
					'customer_email' =>$email					
					) 
			));			
			$chargeJson = $charge->jsonSerialize(); 
		    $status=$chargeJson['status'];
			$balance_transaction=$chargeJson['balance_transaction'];
			$payment_id=$chargeJson['id'];
			$payment_customer_id=$customer->id;
			#pr($chargeJson,1);
			
			if($status=="succeeded"){
				
				$txn_id=$payment_id;	
			}	
	    }
		if(!empty($txn_id)){			
	        $postData['status']=2;
		    $postData['payment_status']=2;
		}else{			
			$postData['status']=1;
			$postData['payment_status']=3;
		}
		
		$postData['id'] = $booking_id;
		$postData['transaction_id']=$txn_id;
		$postData['balance_transaction_id']=$balance_transaction;
		$postData['payment_customer_id']=$payment_customer_id;
	    updateRow($table,$postData,array('id'=>$booking_id));
		
		$subject='Fully Bossed | Booking Request - Now Confirmed';
		$body="<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
				Hi $name,</p>
				<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
				Your booking has been confirmed.Our Fully Bossed Academy will be refreshed each quarter, bringing you the latest thinking, tips, considerations and guest speakers! We recommended refreshing your knowledge and learning in the group setting every 8 months.
				</p>
				<p style='margin: 0; padding: 0 0 6px 9px; font-family: Gotham;'>
                In the meantime, if you have any questions or want to share any further details with us. Please get in touch <a href='".home_url()."'>here</a></p>";
				
		$body =getBookingEmailHtml($subject,$booking_id,$body);
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$headers[] = 'From: Fully Bossed <info@fullybossed.com>';
		#$admin_email=get_option('admin_email');
		$admin_email=ADMIN_EMAIL;
		$headers[] = "Cc: $admin_email";	
	    wp_mail($email,$subject,$body,$headers);
		$success_msg = 'Thanks for booking your appopintment with The Fully Bossed Succeed';
		$url = home_url().'/booking-payment-details/?booking-id='.base64_encode($booking_id);
		#wp_redirect($url);
		echo '<script>
			location.assign("'.$url.'");
			</script>';
		exit();
	}else{
		$error_msg='Your booking appopintment has been unsuccessfully';
	}	
 }
?>
<div class="content">
	<div class="booking-process u-h-spacing ubg-grey">
		<div class="container">
			<div class="booking-process-inner">
				<ul>
					<li><span></span> Booking Sessions</li>
					<li><span></span> Booking Overview</li>
					<li class="active"><span></span> Booking Payment</li>
				</ul>
			</div>
		</div>
	</div>
	
<form method="post" id="paymentFrm">
    <input placeholder="Enter your first name" name="booking_id" required="" type="hidden" value="<?php echo $booking_id?>">
	<input placeholder="Enter your first name" name="action" required="" type="hidden" value="booking-payment">
	<div class="booking-fields u-spacing ubg-white">
		<div class="container">
			<div class="booking-payment-area">
				<div class="dark text-center">
					<h2>Complete your Booking Payment</h2>
				</div>
				<?php 
				if(!empty($success_msg)){					
					/*echo '<div class="alert alert-success text-center" role="alert">
					'.$success_msg.'
					</div>';*/
					$url=home_url().'/booking-payment-details/?booking-id='.base64_encode($insert_id);
				?>	
				<script>
				   location.assign("<?php echo $url?>");
				</script>
				<?php
				 }
				?>
				<?php 
				if(!empty($error_msg)){
					
					echo '<div class="alert alert-danger text-center" role="alert">
					'.$error_msg.'
					</div>'
				?>	
				
				<?php
				 }
				?>
				<div class="payment-box">
					<div class="u-f-fields">
					    <div class="payment-status" style="color:red"></div>
						<div class="u-form-single">
							<label>Card Number:</label>
							<input placeholder="Enter card number here" required name="card_number" id="card_number" placeholder="1234 1234 1234 1234" autocomplete="off" required="" onkeypress="javascript:return isNumber(event)" maxlength="16">
						</div>
						<div class="row">
							<div class="col-md-7">
								<div class="u-form-single">
									<label>Expiry:</label>
									<div class="row">
										<div class="col-md-6">
											<select required="" name="card_exp_month" id="card_exp_month">
												<option value="">MM</option>
												<option value="01">01</option>
												<option value="02">02</option>
												<option value="03">03</option>
												<option value="04">04</option>
												<option value="05">05</option>
												<option value="06">06</option>
												<option value="07">07</option>
												<option value="08">08</option>
												<option value="09">09</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
											</select>
										</div>
										<div class="col-md-6">
											<select required="" name="card_exp_year" id="card_exp_year">
												<option value="">YY</option>
												<option value="21">21</option>
												<option value="22">22</option>
												<option value="23">23</option>
												<option value="24">24</option>
												<option value="25">25</option>
												<option value="26">26</option>
												<option value="27">27</option>
												<option value="28">28</option>
												<option value="29">29</option>
												<option value="30">30</option>
												<option value="31">31</option>
												<option value="32">32</option>
												<option value="33">33</option>
												<option value="34">34</option>
												<option value="35">35</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="u-form-single">
									<label>CVV:</label>
									<input placeholder="CVV" type="text" required="" onkeypress="javascript:return isNumber(event)"   maxlength="3" name="card_cvc" id="card_cvc" >
								</div>
							</div>
						</div>
						<div class="u-sitecolor-btn">
							<button type="submit" id="payBtn">Pay</button>
						</div>
					</div>
				</div>
				<div class="u-row text-center u-sitecolor-btn">
					<!--<a href="/booking-overview"><button type="submit" class="back"><i class="fas fa-chevron-left"></i> Back</button></a>-->
					
				</div>
			</div>
		</div>
	</div>
	</form>
</div>
<script src="https://js.stripe.com/v2/"></script>
<script>
    function isNumber(evt) {

        var iKeyCode = (evt.which) ? evt.which : evt.keyCode

        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;
			
       return true;
    } 
</script>
<script>
  jQuery(document).ready(function() {
    jQuery("#paymentFrm").submit(function() {
		
		jQuery("#loder-img").show();
        // Disable the submit button to prevent repeated clicks
        jQuery('#payBtn').attr("disabled", "disabled");
        // Create single-use token to charge the user
        Stripe.createToken({
            number: jQuery('#card_number').val(),
            exp_month: jQuery('#card_exp_month').val(),
            exp_year: jQuery('#card_exp_year').val(),
            cvc: jQuery('#card_cvc').val()
        }, stripeResponseHandler);
        //Submit from callback
        return false;
    });
});

//Set your publishable key
Stripe.setPublishableKey('<?php echo STRIPE_PUBLIC_KEY?>');
//Callback to handle the response from stripe
function stripeResponseHandler(status, response) {
	console.log(response);
    if (response.error) {
        // Enable the submit button
        jQuery('#payBtn').removeAttr("disabled");
		jQuery("#loder-img").hide();
        // Display the errors on the form
        jQuery(".payment-status").html('<p>'+response.error.message+'</p>');
    } else {
        var form$ = jQuery("#paymentFrm");
        // Get token id
        var token = response.id;
        // Insert the token into the form
        form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
        // Submit form to the server
        form$.get(0).submit();
    }
}
</script>
<?php get_footer(); ?>