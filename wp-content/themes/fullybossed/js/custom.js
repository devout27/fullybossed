(function ($) {
  $(document).ready(function(){
	  
    /*jQuery('#subscribe_us_form').on('submit', function() {
      var subscribe_us_email = jQuery('#subscribe_us_email').val();
      var data = {
        'action': 'fb_subscribe_us_action',
        'status': '1',
        'email': subscribe_us_emails
      };
      // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
      jQuery.post(FB_AJAX.ajaxurl, data, function(response) {
        console.log(response);
        if(response.status) {
			
          jQuery('#subscribe_us_email').val('');
          jQuery('#newsletterModal').modal('hide');
        }        
      })
        return false;
    });*/
	
    if(fullyBossed_Theme_AJAX.admin_logged_in == false) {
      if(fullyBossed_Theme_AJAX.pagename == 'fully-bossed-website-maintenance-mode') {
        jQuery('.container-fluid.site-header, .footer-copywrite.ubg-dark').hide();
        jQuery('.content').css('margin-top','0px');
      }
    }
    


    


    $('#multi_hero_style').typeIt({
         strings: ["believers", "storytellers", "go-getters", "Fully Bossed."],
         speed: 80,
         breakLines: false,
         autoStart: false,
      loop: false,
      startDelay: 250,
      loopDelay: 750,
      startDelete: false
    });
  });

  function headerOnScroll(){
    let $header = $('.site-header'),
      $scroll = $(window).scrollTop();
    if($scroll > 60){
      if(!$header.hasClass('scrolled')) $header.addClass('scrolled');
    }
    else $header.removeClass('scrolled');
  }
  headerOnScroll();
  $(window).on('scroll resize',headerOnScroll);

  function myFunction(x) {
    if (x.matches) { 
      var swiper = new Swiper('.swiper-container.coaching-slide', {
        slidesPerView: 1,
        spaceBetween: 30,
        autoplay: 
			{
			  delay: 4000,
			},
        speed: 800,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
          dynamicBullets: true,
        },
      });
    } else {
        var swiper = new Swiper('.swiper-container.coaching-slide', {
        slidesPerView: 1,
        spaceBetween: 30,
        autoplay: 
			{
			  delay: 4000,
			},
        speed: 800,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
          dynamicBullets: true,
        },
      });
    }
  }
  var x = window.matchMedia("(max-width: 768px)");
  myFunction(x);
  x.addListener(myFunction);
  
})(jQuery)