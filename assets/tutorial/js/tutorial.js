$(document).ready(function() {
  $('.animsition').animsition({
      inClass             : 'fade-in',
      outClass            : 'fade-out',
      inDuration          : 400,
      outDuration         : 200,
      linkElement         : 'a[href]:not([target="_blank"]):not([href^="mailto\\:"]):not([href^="\\#"])',
      loading             : true,
      loadingParentElement: 'body',
      loadingClass        : 'animsition-loading',
      unSupportCss        : ['animation-duration', '-webkit-animation-duration', '-o-animation-duration'],
      overlay             : false,
      overlayClass        : 'animsition-overlay-slide',
      overlayParentElement: 'body'
  });

  //bootstrap scrollspy
  $('body').scrollspy({ target: '#scrollspy', offset: 150 });

  //bootstrap affix
  $('.daftarisi').affix({
    offset: {
      top: 0
    }
  });

  // jQuery for page scrolling feature - requires jQuery Easing plugin
  $('a.page-scroll').bind('click', function(event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top - 50)
    }, 1250, 'easeInOutExpo');
    event.preventDefault();
  });

  lightbox.option({
        'maxWidth': 12,
        'fitImagesInViewport': false
      })


});
