(function ($) {

  $(document).ready(function(){
    $(".bar-icon").click(function () {
      $(".c-menu").toggleClass("active");
      $(".header").toggleClass("active");
      $(this).toggleClass("active");
    });
  });

  function headerOnScroll(){
    let $header = $('.header'),
      $scroll = $(window).scrollTop();
    if($scroll > 60){
      if(!$header.hasClass('scrolled')) $header.addClass('scrolled');
    }
    else $header.removeClass('scrolled');
  }
  headerOnScroll();
  $(window).on('scroll resize',headerOnScroll);

})(jQuery)