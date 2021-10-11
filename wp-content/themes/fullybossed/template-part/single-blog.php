<?php 
/*
 * Template Name: Single Blog Template
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @page FullyBossed
 * @since FullyBossed 1.0
 */
get_header(); 
?>

<div class="content">
	<div class="page-inner-title u-spacing ubg-grey">
		<div class="container">
			<div class="dark text-center">
				<h5>Blogs</h5>
				<h2>
					<mark class="mark-yellow">
						Brand
					</mark>
				</h2>
			</div>
		</div>
	</div>
	<div class="blog-single-section u-spacing ubg-white">
		<div class="container">
			<div class="blog-single-section-inner">
				<div class="blog-single-area dark">
					<h2>The power of sharing stories</h2>
				</div>
				<div class="blog-single-img">
					<img src="https://fullybossed.com/wp-content/uploads/2021/02/splash-screen.png">
				</div>
				<div class="cat-single">
					<p>Category: <strong>Innovation</strong></p>
				</div>
				<div class="social-icons">
               		<div>                                                                         
                      	<a target="_blank" href="#"><i class="fab fa-facebook-f"></i></a>
                      	<a target="_blank" href="#"><i class="fab fa-instagram"></i></a>
                      	<a target="_blank" href="#"><i class="fab fa-linkedin"></i></a>
                  		<a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                  		<a target="_blank" href="#"><i class="fab fa-whatsapp"></i></a>
				   		<a target="_blank" href="#"><i class="fas fa-envelope"></i></a>
              		</div>
           		</div>
				<div class="dark">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
				<div class="comment-section">
					<div class="single-comment">
						<div class="review-person">
							<span>User Name</span>
							<span class="review-person-time">04 Jan 2021</span>
						</div>
						<div class="review-text-box-section dark">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
						</div>
					</div>
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="write-comment">
							<div class="write-comment-title dark">
								<h3>Leave a Comment</h3>
							</div>
							<div class="u-f-fields">
								<div class="u-form-single">
									<label>Your Name *</label>
									<input type="text" name="user_name" value="">
								</div>
								<div class="u-form-single">
									<label>Your Email *</label>
									<input type="email" name="user_email" value="">
								</div>
								<div class="u-form-single">
									<label>Your Comment *</label>
									<textarea type="text" name="comment" maxlength="250"></textarea>
								</div>
								<div class="u-sitecolor-btn">
									<button type="submit">Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>