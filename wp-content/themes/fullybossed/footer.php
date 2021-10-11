<div class="footer-copywrite ubg-dark">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-7">
				<div class="light-small custome-footer-text">
					<?php
                        if (is_active_sidebar('sidebar-1')) {
                            dynamic_sidebar('sidebar-1');
                        }
                    ?>
					<p> |
						<?php $menus=wp_get_nav_menu_items('Footer-Menu'); ?>
						<?php foreach ($menus as $menu) {
                        $menu=(array)($menu);
                        $menu_item_parent=$menu['menu_item_parent'];
                        if ($menu_item_parent==0) {
                            $menu_id=$menu['ID']; ?>
						    	<a href="<?php echo $menu['url']?>"><?php echo $menu['title']; ?></a> <span>|</span>
						<?php
                        }
                    }
                        ?>
						<mark class="decorated-yellow custome-s1"><a data-toggle="modal" data-target="#newsletterModal">Subscribe</a></mark> <span>|</span>
					</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="social-icons custome-footer-icons">
					<div class="light">
						<h5>
							<mark class="decorated-yellow">Follow our journey</mark>
						</h5>
						<?php $menus=wp_get_nav_menu_items('Social-Menu'); ?>
						<?php foreach ($menus as $menu) {
                            $menu=(array)($menu);
                            $menu_item_parent=$menu['menu_item_parent'];
                            if ($menu_item_parent==0) {
                                $menu_id=$menu['ID']; ?>
						    	<a target="_blank" href="<?php echo $menu['url']?>"><i class="<?php echo $menu['title']; ?>"></i></a>
						<?php
                            }
                        }
                        ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade subs-modal" id="newsletterModal" tabindex="-1" role="dialog" aria-labelledby="newsletterModalTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
      		<div class="modal-body">
      			<div class="modal-head dark">
      					<h3>Subscribe Us!</h3>
      				 <div class="dark bown-p-booking">
      					<p>Follow our journey and make sure you get our latest insights, tips and news about our events"</p>
      				</div>
	    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<i class="fas fa-times"></i>
	        		</button>
      			</div>
				<div id="newsletter-msg-data"></div>
      			<form action="" id="subscribe_us_form">
	       			<div class="u-f-fields">
						<div class="u-form-single">
							<label>Email:</label>
							 <input type="hidden" name="type" value="footer">
							<input type="hidden" name="action" value="fb_subscribe_us_action">
							<input type="text" id="email" placeholder="Enter your email address" require name="email">

						</div>
						<div class="u-sitecolor-btn">
							<button type="submit" id="subscribe_us_btn">Subscribe</button>
						</div>
	       			</div>
	       		</form>
     		</div>
		</div>
  	</div>
</div>

<div class="modal fade subs-modal img-modal" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
      		<div class="modal-body">
      			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
				<img src="https://fullybossed.com/wp-content/uploads/2021/04/your-ambition.png">
     		</div>
		</div>
  	</div>
</div>

<div class="modal fade subs-modal img-modal" id="imageModal1" tabindex="-1" role="dialog" aria-labelledby="imageTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
      		<div class="modal-body">
      			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
				<img src="https://fullybossed.com/wp-content/uploads/2021/04/your-ambition2.png">
     		</div>
		</div>
  	</div>
</div>

<div class="modal fade custom-modal" id="subscribeModal" tabindex="-1" role="dialog" aria-labelledby="subscribeModalTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
      		<div class="modal-body">
      			<div class="modal-head dark">
      				<h3>To unlock our secret gems!</h3>
	    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<i class="fas fa-times"></i>
	        		</button>
      			</div>
				<div id="speaking-msg-data"></div>
      			<form id="DownloadcopyFrom" method="post">
				    <input type="hidden" value="download_a_copy" name="action" >
	       			<div class="u-f-fields">
						<div class="row">
							<div class="col-md-2">
								<div class="u-form-single">
									<label>Surname:</label>
									<select name="surname">
										<option>Mr.</option>
										<option>Mrs.</option>
										<option>Miss.</option>
										<option>Dr.</option>

									</select>
								</div>
							</div>
							<div class="col-md-5">
								<div class="u-form-single">
									<label>First Name:</label>
									<input type="text" name="first_name" >
								</div>
							</div>
							<div class="col-md-5">
								<div class="u-form-single">
									<label>Last Name:</label>
									<input type="text" name="last_name">
								</div>
							</div>
							<div class="col-md-4">
								<div class="u-form-single">
									<label>Gender:</label>
									<select name="gender">
										<option>Male</option>
										<option>Female</option>
									</select>
								</div>
							</div>
							<div class="col-md-8">
								<div class="u-form-single">
									<label>Email:</label>
									<input type="email" name="email">
								</div>
							</div>
						</div>
						<div class="u-sitecolor-btn">
							<button type="submit">Download a copy</button>
						</div>
	       			</div>
	       		</form>

     		</div>
		</div>
  	</div>
</div>

<?php wp_footer(); ?>
<script src="<?php echo home_url().'/wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/assets/js/validation.js'?>"></script>
</body>
<script>
		$(".icon").click(function(){
		$(".header-menu-area").toggleClass("active");
		});
</script>

</html>