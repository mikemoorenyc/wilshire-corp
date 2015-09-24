function siteInit() {
  //GLOBALS
  ts = 500,
  tab = 401,
  dt = 801;
  windoww = $(window).width();
  windowh = $(window).height();
  orientationClass();
  $(window).resize(function(){
    windoww = $(window).width();
    windowh = $(window).height();
    orientationClass();
  });

  //MAKE THE SPACER WORK

  $(window).resize(function(){
    $('#scrolling-frame > .spacer').height(windowh - $('header').height());
  });

  Modernizr.addTest('mix-blend-mode', function(){
    return Modernizr.testProp('mixBlendMode');
  });

  //CREATE THE SCROLLING FRAME
  



  theHistory();


  //CHECK IF CSS IS LOADED
  /*
  var thechecker = setInterval(function(){
    var ztest = $('#css-checker').css('height');

    if(ztest == '1px') {
      cssLoaded = true;
      clearInterval(thechecker);
      console.log('css loaded');
    }
  }, 10);
  */




  //GET INITIAL INFO

  var initialSlug = $('#dynamic-page-content').data('navslug');
  pageTitle = $('title').last().html();

  pageLoader(initialSlug);

  $('html').addClass('_page-loaded');
  console.log('scripts loaded');
}






function orientationClass() {
  if (windoww >= windowh) {
    $('html').addClass('_orientation-landscape').removeClass('_orientation-portrait');
  } else {
    $('html').removeClass('_orientation-landscape').addClass('_orientation-portrait');
  }
}



//DON'T TOUCH
siteScriptsLoaded = true;
siteInit();
