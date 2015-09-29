function runnerfilearchive() {
  $('.date-opener.section-0 ul.file-list').slideDown(ts);
  $('.date-opener.section-0').addClass('__opened');
}
$('.date-opener h4 a').click(function(){
  if($(this).closest('.date-opener').hasClass('__opened') == true) {
    $(this).closest('.date-opener').removeClass('__opened');
    $(this).closest('.date-opener').find('ul.file-list').slideUp(ts);

  } else {
    $(this).closest('.date-opener').addClass('__opened');
    $(this).closest('.date-opener').find('ul.file-list').slideDown(ts);
  }
  return false;
});
