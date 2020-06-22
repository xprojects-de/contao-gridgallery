
(function ($) {
  $(document).ready(function () {

    $('div.xextendedgalleryitem').mouseenter(function () {
      $(this).find('.xextendedgalleryitem-overlay').stop(true).fadeIn(400);
      //$(this).find('.xextendedgalleryitem-image').stop(true).animate({opacity: 'scale(1.075)'}, 200);
    });
    $('div.xextendedgalleryitem').mouseleave(function () {
      $(this).find('.xextendedgalleryitem-overlay').stop(true).fadeOut(400);
      //$(this).find('.xextendedgalleryitem-image').stop(true).animate({transform: 'scale(1.0)'}, 200);
    });

  });
})(jQuery);

