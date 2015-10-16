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
      $('.bg-flipper.count-'+count).addClass('__activated');
      $('.strat-block.__activated .content').velocity('slideUp',{duration:ts, complete:function(){
        $(theParent).find('.content').velocity('slideDown',{duration:ts});
        $(theParent).addClass('__activated');

      }});
      $('.strat-block.__activated').removeClass('__activated');
    } else {
      $(theParent).find('.content').velocity('slideDown',{duration:ts});
      $(theParent).addClass('__activated');
      $('.bg-flipper.count-'+count).addClass('__activated');
    }





  } else {
    $(theParent).find('.content').velocity('slideUp',{duration:ts});
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
    $('.strat-block .sub-content.__activated').velocity('slideUp',{duration:ts,complete:function(){
      $(this).removeClass("__activated");
      $('.strat-block .sub-content[data-count="'+count+'"]').velocity('slideDown',{duration:ts}).addClass("__activated");
    }});

  }
  return false;
});

//STRATEGY TOUCH
if(!(Modernizr.touch)) {
  $(document).on('mouseenter', 'h1.strat-title a', function(){
    var count = $(this).closest('.strat-block').data('count');
    $('.bg-flipper').addClass('__diminished')
    $('.bg-flipper.count-'+count).addClass('__hovering').removeClass('__diminished');
  });
  $(document).on('mouseleave', 'h1.strat-title a', function(){
    $('.bg-flipper').removeClass("__hovering").removeClass("__diminished");
  });
}
