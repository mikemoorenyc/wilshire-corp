function runnerprofile () {
  var plength = $('#home-page-content p').length;
  $('#home-page-content').append('<div class="read-more-content"></div>');
  $('#home-page-content p').each(function(e){
    if(e >0) {
      $('.read-more-content').append($(this));
    }
  });
  $('#home-page-content .read-more-content').after('<a href="#" class="read-more"><span class="text">Read More</span><svg><use xlink:href="#down-arrow-sm" /></svg></a>')
}
$(document).on('click','#home-page-content a.read-more', function(){
  if($(this).hasClass('_opened') == false) {
    $('.read-more-content').slideDown(ts);
    $(this).addClass('_opened');
    $(this).find('.text').html('Read Less');
  } else {
    $('.read-more-content').slideUp(ts);
    $(this).removeClass('_opened');
    $(this).find('.text').html('Read More');
  }

  return false;
});
