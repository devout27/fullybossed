<?php 
	/*
	 * Template Name: Coaching Booking Payment Details
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 * @page FullyBossed
	 * @since FullyBossed 1.0
	 */
	$booking_id=isset($_GET['booking-id']) ? base64_decode($_GET['booking-id']):'';
	if(empty($booking_id)){
		wp_redirect(home_url());
	}
    get_header();
	$booking = getBookingById($booking_id);
	$payment_status = $booking['payment_status'] == 2 ? 'Success' : 'Failed';
    $booking_status = $booking['status'] == 2 ? 'Confirm' : 'Pending';
	$success_msg = $error_msg = '';
	if($booking['payment_status'] == 2){
		$success_msg='Your payment has been successfully processed';
	}else{
		$error_msg='Your payment has been failed';
	}
 ?>
<div class="content">
	<div class="booking-fields u-spacing ubg-white">
		<div class="container">
			<div class="booking-payment-area text-center">
				<?php 
				if(!empty($success_msg)){
					echo '<div class="alert alert-success text-center" role="alert">
					'.$success_msg.'
					</div>'
					?>	
					<script>
					//setTimeout(function(){ location.assign("<?php echo home_url()?>"); }, 3000);
					</script>
					<?php
				}
				?>
				<?php 
				if(!empty($error_msg)) {
					echo '<div class="alert alert-danger text-center" role="alert">
					'.$error_msg.'
					</div>'
					?> <?php
				}
				?>
				<div>
				<?php
				   echo coaching_GetBookingHtml($booking_id);
				?>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>
<?php get_footer(); ?>