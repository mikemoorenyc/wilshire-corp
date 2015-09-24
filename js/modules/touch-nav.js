$('.touch-open, .touch-close').click(function(){
  $('html').toggleClass('_touch-menu-open');
  return false;
});
$('nav ul li a').click(function(){
  $('html').removeClass('_touch-menu-open');
});
