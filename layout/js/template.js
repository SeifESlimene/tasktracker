$(document).ready(function () {
  $('[placeholder]').focus(function () {
    $(this).attr('data-text', $(this).attr('placeholder'));
    $(this)
      .attr('placeholder', '')
      .blur(function () {
        $(this).attr('placeholder', $(this).attr('data-text'));
      });
  });
  $('i').click(function () {
    $('.table proj').slideUp(5000);
  });
  $('.search-overlay').delay(2000).fadeOut(1000);

  $('.Nomproj').click(function () {
    $('.pourproj').hide();
  });
});
