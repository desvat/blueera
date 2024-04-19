$(document).ready(function () {

  $(".products-sub-menu, #nav-wrapper-sub-animation")
    .mouseenter(function () {
      $('#nav-wrapper-sub-animation').addClass('perspective-animation-value-off').removeClass('perspective-animation-value-on');
      $('#nav-wrapper-corner').removeClass('nav-wrapper-border-radius');
      $("#header .header-contacts").hide();
    })
    .mouseleave(function () {
      $('#nav-wrapper-sub-animation').addClass('perspective-animation-value-on').removeClass('perspective-animation-value-off');
      $('#nav-wrapper-corner').addClass('nav-wrapper-border-radius');
      if ($(window).width() > 428) {
        $("#header .header-contacts").fadeIn();
      }
    });

  $("main #widget-products .items-wrapper")
    .mouseenter(function () {
      $(this).find('.items-text').addClass('perspective-animation-value-off').removeClass('perspective-animation-value-on');
    })
    .mouseleave(function () {
      $(this).find('.items-text').addClass('perspective-animation-value-on').removeClass('perspective-animation-value-off');
    });

  $("#nav-btn").click(function () {

    menuStatus = $("#nav-btn").attr('class');

    if (menuStatus == 'menu-closed') {
      console.log('1: ' + menuStatus);

      $("#nav-btn").removeClass().addClass('menu-open');
      $("nav .nav-menu-items").fadeIn();
      $(".nav-logo-and-button").removeClass('nav-logo-and-button-border-radius');
      // $( "body" ).removeClass().addClass('disable-scrollbar');
    } else {
      console.log('2: ' + menuStatus);

      $("#nav-btn").removeClass().addClass('menu-closed');
      $("nav .nav-menu-items").fadeOut();
      $(".nav-logo-and-button").addClass('nav-logo-and-button-border-radius');
      // $( "body" ).removeClass();
    }

  });

  //  loopLogoSVG();

  var elem = $('.logo-blink');
  //Start at 0
  i = 0;

  function loopLogoSVG() {

    //Loop through elements
    $(elem).each(function (index) {

      if (i == index) {
        //Show active element
        $(this).fadeIn(2000);
      } else if (i == $(elem).length) {
        //Show message
        $(this).fadeIn(2000);
        //Reset i lst number is reached
        i = 0;
      } else {
        //Hide all non active elements
        $(this).fadeOut(1000);
      }

    });

    i++;

  }
  //Run once the first time
  loopLogoSVG();
  //Repeat
  window.setInterval(loopLogoSVG, 3000);

  $("a").click(function (e) {

    console.log(111);

  });

});
