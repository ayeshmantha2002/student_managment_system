$(document).ready(function () {
  var sidenav = true;

  $(".toggle").click(function () {
    if (sidenav == true) {
      $(".side_nav").css("transform", "translateX(-250px)");
      $(".toggle img").css("rotate", "180deg");
      $(".content").css("margin-left", "40px");
      sidenav = false;
    } else {
      $(".side_nav").css("transform", "translateX(0)");
      $(".content").css("margin-left", "290px");
      $(".toggle img").css("rotate", "360deg");
      sidenav = true;
    }
  });
});
