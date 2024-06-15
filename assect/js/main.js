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

  var tute = true;
  $("#enable_tutes").click(function () {
    if (tute == true) {
      $(".view_tute").css("display", "block");
      tute = false;
    } else {
      $(".view_tute").css("display", "none");
      tute = true;
    }
  });

  $("#add_year").click(function () {
    $(".add_class_page").css("z-index", "1");
    $(".add_class_page").css("opacity", "1");
  });

  $("#add_class").click(function () {
    $(".add_class_time").css("z-index", "1");
    $(".add_class_time").css("opacity", "1");
  });

  $("#view_more").click(function () {
    $(".view_more").css("z-index", "1");
    $(".view_more").css("opacity", "1");
  });

  $(".close_btn").click(function () {
    $(".popup_forms").css("z-index", "-2");
    $(".popup_forms").css("opacity", "0");
    $(".update_students").css("display", "none");
  });
});
