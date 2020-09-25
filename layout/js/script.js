$(document).ready(function () {
  $('.toggle-search').click(function () {
    $('.search-overlay').slideUp();
  });
  $('[placeholder]').focus(function () {
    $(this).attr('data-text', $(this).attr('placeholder'));
    $(this)
      .attr('placeholder', '')
      .blur(function () {
        $(this).attr('placeholder', $(this).attr('data-text'));
      });
  });
  //$('.search-overlay').delay(5000).slideUp();
});
