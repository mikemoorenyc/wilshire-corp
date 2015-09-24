//PAGE LOADER FUNCTION
function pageLoader(linkSlug) {
  $('#scrolling-frame > .spacer').height(windowh - $('header').height());
  $('#scrolling-frame').css('top', ($('header').height())+'px');
  $('#scrolling-frame > .inner').scrollbar();

  // BASE STUFF

  //NAV ACTIVE CLASSES
  $('nav ul li, nav > ul > li a').removeClass('__active');
  $('nav ul > li.'+linkSlug).addClass('__active');
  $('nav ul > li.'+linkSlug).find('a').addClass('__active');



  //MAKE INTERNAL LINKS
  var siteURL = "http://" + top.location.host.toString();
  var internalLinks = $("a[href^='"+siteURL+"'], a[href^='/'], a[href^='./'], a[href^='../']");
  $(internalLinks).addClass('internal');
  $('a.internal').each(function(){
    var linkstr = $(this).attr('href');
    if($(this).attr('target') == "_blank" || linkstr.indexOf('.pdf') >= 0 || linkstr.indexOf('.jpg') >= 0 || linkstr.indexOf('.png') >= 0 || $(this).hasClass('no-history'))  {
      $(this).removeClass('internal');
    }
  });



  //RUN PAGE SPECIFIC FUNCTIONS
  if (typeof window['runner'+linkSlug] == 'function') {

    window['runner'+linkSlug]();
  } else {

  }



  imagesLoader(linkSlug);



}
