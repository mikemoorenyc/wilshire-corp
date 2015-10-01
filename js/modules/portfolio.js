function runnerportfolio() {
  $('#port-list .img-holder > img').each(function(){
    var theImg = $(this);

    $(theImg).attr('src', $(theImg).data('thumb'));
    $(theImg).load(function(){
      $(theImg).closest('.img-holder').css('background-image', 'url('+$(theImg).attr('src')+')');
      $(theImg).closest('a').addClass('__activated');
    });
  });

  if(!(Modernizr.touch)) {
    $('#port-list li a .overlay').after('<span class="hover"><svg><use xlink:href="#port-hover" /></svg></span>');
  }

  //INTERIOR
  portfolioInnerSizer();

  $('#port-gallery .slide.count-0 img').load(function(){
  //  galleryMaker();
  //  galleryInit();
    if(windoww < dt) {
      galleryMaker();
      galleryInit();
    } else {
      var structureChecker = setInterval(function(){
        if(dtportReady = true) {
          galleryMaker();
          galleryInit();
          clearInterval(structureChecker);
          return false;
        }
      },10);
    }
  });

  $('#port-gallery .the-gallery .slide img').each(function(){
    $(this).attr('src', $(this).data('src'));
    $(this).load(function(){
      $(this).addClass('__loaded');
    });
  });


}

$(window).resize(function(){
  portfolioInnerSizer();
});


function portfolioInnerSizer() {

  var navH = $('header').height();
  var headerH = $('#port-header').height();
  var contentH = $('#port-content').height();
  if(windoww < dt) {
    $('#port-gallery .slide').height(
      windowh - (navH+headerH+contentH)
    );
  } else {
    $('#port-gallery .the-gallery').prepend('<div class="slide copy-slide"><div class="copy-holder"></div></div>');
    $('.copy-slide .copy-holder').append($('#portfolio-title'));
    $('.copy-slide .copy-holder').append($('#port-copy-main'));
    $('#port-gallery .slide').height(
      windowh
    );
    dtportReady = true;
    $('#scrolling-frame').after($('#port-gallery'));
  }
}

function galleryInit() {
  var slideLength = $('#port-gallery .the-gallery .slide').length;
  if(slideLength > 1 && (Modernizr.touch)) {
    $('#port-gallery .the-gallery').after('<div class="mobile-swiper dt-hide"><svg><use xlink:href="#swiper" /></svg></div>');
    setTimeout(function(){
      $('#port-gallery .mobile-swiper').fadeOut(ts);
    },ts*4);
  }
}





function galleryMaker() {
  $('#port-gallery .the-gallery').slick({
    arrows: false,
    mobileFirst: true,
    responsive: [
      {
        breakpoint: dt,
        settings: {
          infinite: false,
          arrows: true,
          prevArrow: '<span href="#" class="gal-arrow left"><svg><use xlink:href="#gal-left-arrow" /></svg></span>',
          nextArrow: '<span href="#" class="gal-arrow right"><svg><use xlink:href="#gal-right-arrow" /></svg></span>',
        }
      }
    ]
  }).addClass('__activated');
}
