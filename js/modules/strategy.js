function runnerstrategy() {
  $('#background-image').append($('#strat-imgs').html());

  $('.strat-block .headers h2:first-child a').addClass('__activated');
  $('.strat-block .sub-content[data-count="0"]').show().addClass('__activated');
}
$(document).on('click', 'h1.strat-title a',function(){
  var theParent = $(this).closest('.strat-block');
  var count = $(theParent).data('count');
  if($(theParent).hasClass('__activated') == false) {
    if($('.strat-block.__activated').length > 0) {
      $('.bg-flipper.__activated').removeClass("__activated");
      $('.strat-block.__activated .content').slideUp(ts, function(){
        $(theParent).find('.content').slideDown(ts);
        $(theParent).addClass('__activated');

        $('.bg-flipper.count-'+count).addClass('__activated');
      });
      $('.strat-block.__activated').removeClass('__activated');
    } else {
      $(theParent).find('.content').slideDown(ts);
      $(theParent).addClass('__activated');
      $('.bg-flipper.count-'+count).addClass('__activated');
    }





  } else {
    $(theParent).find('.content').slideUp(ts);
    $(theParent).removeClass('__activated');
    $('.bg-flipper.__activated').removeClass("__activated");
  }
  return false;

});

$(document).on('click', '.strat-block .headers a', function(){
  if($(this).hasClass("__activated") == false) {
    var count = $(this).data('count');
    $('.strat-block .headers h2 a').removeClass('__activated');
    $(this).addClass('__activated');
    $('.strat-block .sub-content.__activated').slideUp(ts,function(){
      $(this).removeClass("__activated");
      $('.strat-block .sub-content[data-count="'+count+'"]').slideDown(ts).addClass("__activated");
    });

  }
  return false;
});
