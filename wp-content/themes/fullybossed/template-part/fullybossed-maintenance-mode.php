<?php
/*
 * Template Name: fullybossed maintenance mode
 */
get_header();
$theme_url = get_template_directory_uri();

?>
<!doctype html>
<html lang="en">
<head>
  <link rel="stylesheet" href="<?php echo $theme_url.'/css/fullybossed-maintenance-mode/style.css';?> ">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="<?php echo $theme_url.'/css/fullybossed-maintenance-mode/line-awesome.min.css';?> ">

  <title>Fully Bossed Website Maintenance Mode</title>
</head>
<body>
<div class="content">
  <div class="comingsoon">
    <div class="container">
      <div class="inner-sec">
        <div class="row">
          <div class="col-md-6">
            <div class="coming-s-images">
              <img src="<?php echo $theme_url.'/css/fullybossed-maintenance-mode/images/bannerimg.png';?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="coming-s-info">
              <div class="short-title">
                <h4> Hello you! </h4>
              </div>
              <div class="title">
                <h2>Our website is <br> coming soon…</h2>
              </div>
              <div class="text">
                <p>We’re working really hard to create an online home for our business supporting career professionals. We just can’t wait to show you what we’ve been up to! </p>
                <p>Want to be notified when we launch and get more information? Enter your details below! </p>
              </div>
              <div class="details-sec">
			    <div id="newsletter-msg-home-data"></div>
                <form id="subscribe_home_form" method="post">
                  <div class="form-group f-subscribe">
				    <input type="hidden" name="type" value="home">
				    <input type="hidden" name="action" value="fb_subscribe_us_action">
                    <input type="text" name="home_name" placeholder="Your Name" id="home_name"style="width: 77%;">
                  </div>
                  <div class="form-group f-subscribe">
                    <input type="home_email" name="home_email" placeholder="Your Email" style="width: 77%;">
                  </div>
                  <div class="s-btn">
                    <button type="submit" class=" btn1">Subscribe</button>
                  </div>
                </form> 
                <?php 
				//echo do_shortcode( '[contact-form-7 id="1140" title="Contact form 1"]'); 
				?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
  </html>
  <?php get_footer();