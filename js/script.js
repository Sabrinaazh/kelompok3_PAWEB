$(document).ready(function () {
  $("#tombol-cari").hide();
  $("#keyword").on("keyup", function () {
    $("#container").load("ajax/barang.php?keyword=" + $("#keyword").val());
  });
  //   $.get("ajax/barang.php?keyword=" + $("#keyword").val(), function (data) {
  //     $("#container").html(data);
  //   });
});
