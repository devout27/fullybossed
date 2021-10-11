<?php
/*
 * Template Name: Booking Sessions Template
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @page FullyBossed
 * @since FullyBossed 1.0
 */
    $service_id=isset($_GET['code']) ? base64_decode($_GET['code']):'';
    if(empty($service_id)){
		wp_redirect(home_url());
	}
    get_header();
    $sessionLists = getAllSessionByServiceId($service_id);
    ?>
<div class="content">

	<div class="booking-process u-h-spacing ubg-grey">
		<div class="container">
			<div class="booking-process-inner">
				<ul>
					<li class="active"><span></span> Booking Sessions</li>
					<li><span></span> Booking Overview</li>
					<li><span></span> Booking Payment</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="booking-fields u-spacing ubg-white">
		<div class="container">
			<div class="dark up-h-booking text-center">
				<h2><mark>Fully Bossed –The Academy</mark></h2>
				<h4>Get ready to be transformed in our 3-day workshop</h4>
			</div>
			<div class="dark bown-p-booking text-center">
				<!-- <h4>This Academy is aimed at:</h4> -->
				<p>Utilising our Fully Bossed Blueprint, our Academy aims to help you get vital tips, tools and
					insights to help you advance in your career by focusing on our 4 core topics. We'll bring this to
					you over a 3 day period.</p>
				<!-- <p>- Start-ups looking to effectively launch their business or advance it</p> -->
			</div>
			<br>
			<div class="booking-img more-btn">
				<!-- <img src="<?php echo get_template_directory_uri(); ?>/images/your-ambition.png"> -->
				<p>
					<strong>
						Click here to see
						<a data-toggle="modal" data-target="#imageModal1">Full Agenda</a>
					</strong>
				</p>
			</div>
		</div>
	</div>
	<div class="booking-fields u-spacing ubg-white minus-spacing">
		<div class="container">
			<div class="booking-summary-area">

				<div class="booking-summary-left">
				<div class="dark book-sec text-center">
					<h2>Select your booking session</h2>
				</div>
				<div class="b-summary-l">
                <?php
				if(!empty($sessionLists)){

					foreach($sessionLists as $key=>$session){

						$session_date_type=$session['session_date_type'];
						$from_time=$session['from_time'];
						$to_time=$session['to_time'];
						$from_date=$session['from_date'];
						$to_date=$session['to_date'];
						$price=$session['price'];
						$regular_price=$session['regular_price'];
						$id=$session['id'];

				?>
                <form action="<?php echo home_url()?>/booking-overview/">
                        <input type="hidden" name="code" value="<?php  echo base64_encode($service_id)?>">
                        <input type="hidden" name="sessioncode" value="<?php  echo base64_encode($id)?>">
						<div class="b-summary-l-single session-one-two">
							<div class="b-session-name">
								<span><?php echo $session['name']?></span>
							</div>
							<div class="row align-items-end">
								<div class="col-md-9">
									<div class="dark">
										<div>
										    <?php echo $session['description']?>
										</div>
										<p>
										    <strong><a href="#"><img src="https://fullybossed.com/wp-content/themes/fullybossed/images/cal-icon.png" class="cal-icon" alt=""></a> Time:</strong> <?php echo ftimeFormate($from_time)?> - <?php echo ftimeFormate($to_time)?>
											<?php if($session_date_type==1){
												echo "daily";
											}
											?>
											<br>
											<?php
											if($session_date_type==2){
												$sessionDates=getSessionDatesBySessionId($id);
											?>
											    <strong>Session Date:</strong><br>
											    <?php

											    foreach($sessionDates as $date){

													if(in_array($session['service_id'],array(223,221))){

		                                                 echo '<input type="radio" id="male" name="session_date" value="'.$date.'" required>  '.date('F d Y',strtotime($date)).'</br>';
	                                                }else{
														echo date('F d Y',strtotime($date)).'</br>';
													}


												}
											    ?>
											<?php
											}else{
											?>
											   <strong>Session Dates:</strong> <?php echo date('F d',strtotime($from_date))?> - <?php echo date('d, Y',strtotime($to_date))?>
											<?php
											}?>
										</p>
									</div>
								</div>
								<div class="col-md-3 tablet text-right">
									<div class="u-sitecolor-btn text-right">
										<?php if($regular_price > $price){?>
										<span style="text-decoration: line-through !important; color: #ff0000;"><b><?php echo CURRENCYSYMBOL.number_format($regular_price,2);?></b></span>
										<?php
										}?>
										<span><?php echo CURRENCYSYMBOL.number_format($price,2);?></span>

										<button>Continue</button>
									</div>
								</div>
							</div>
						</div>
				</form>
				    <?php
					    }
				    }else{
					?>
						<div class="alert alert-warning" role="alert">
						  No session available this service !
						</div>
					<?php
					}
					?>
				</div>
			</div>
		   </div>
		</div>
	</div>
	<div class="booking-summary-right">
		<div class="container">
			<p>If you would like to focus on a single module or parts of various modules, please enquire about a <a href="https://fullybossed.com/services/coaching/" class="link-to-cs">coaching session</a></p>
		</div>
	</div>
</div>

<?php get_footer(); ?>