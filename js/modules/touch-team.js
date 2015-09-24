function runnerteam() {
  if(!(Modernizr.touch)) {
    $('#background-image').append($('#team-bg-holder').html());
    $('#team-bg-holder').remove();
    $('.team-bg img').load(function(){
      var count = $(this).parent().data('count');
      $('#team-list li[data-count="'+count+'"]').addClass('__bg-loaded');
    });
  }
}


if(!(Modernizr.touch)) {
  $(document).on('mouseenter', '#team-list li a', function(){
    var count = $(this).data('count');
    $('.team-bg.count-'+count).addClass('__hovering');
  });
  $(document).on('mouseleave', '#team-list li a', function(){
    $('.team-bg').removeClass('__hovering');
  });
}
