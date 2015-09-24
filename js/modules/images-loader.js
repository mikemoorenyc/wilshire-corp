function imagesLoader(linkSlug) {
  function doOnLoad(linkSlug) {

/*
    if (typeof window['runner'+linkSlug] == 'function') {

      window['runner'+linkSlug]();
    } else {

    }*/
      $('html').removeClass("__page-loading");
  }

  //SET UP PRELOAD
  var preLoadCount = $('img.preload').length;
  var preLoaded = 0;
  if(preLoadCount == 0) {
    doOnLoad(linkSlug);

  }
  $('img.preload').each(function(){
    $(this).load(function(){
      preLoaded++;
      if(preLoadCount == preLoaded) {
        doOnLoad(linkSlug);

      }
    });
  });

  //DYNANIMC LOAD
  function dynaload() {
    $('img.dyna-load').each(function(){
      var imgLg = $(this).data('lg');
      var imgSm = $(this).data('sm');
      if(windoww < dt) {
        $(this).attr('src', imgSm);
      } else {
        $(this).attr('src',imgLg);
      }

    });
  }
  dynaload();

  $(window).resize(function(){
    dynaload();
  });

  //BACKGROUND IMAGE
  $('img.bg-loader').each(function(){
    $(this).load(function(){
      $(this).parent().css("background-image", 'url('+$(this).attr('src')+')').addClass('__loaded');
    });
  });

}
