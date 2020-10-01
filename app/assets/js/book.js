$("#dismiss").on("click", function () {
    var top = $("#menu").offset().top + $("#menu").height();
  
    $("#sidebar").offset({ top: top, left: -250 });
  });
  
  var active = false;
  $("#sidebarCollapse").on("click", function () {
    var top = $("#menu").offset().top + $("#menu").height();
    if (!active) {
      $("#sidebar").offset({ top: top, left: 0 });
      active = true;
    } else {
      $("#sidebar").offset({ top: top, left: -250 });
      active = false;
    }
  });
  