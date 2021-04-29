$(document).ready(function () {
   $("#sweety").DataTable();
});

$(document).ready(function () {
   $("#cats").on("change", function () {
      var cat_id = $(this).val();
      $.ajax({
         url: 'getBookByCatId/' + cat_id,
         method: 'post',
         data: "cat_id" + cat_id
      }).done(function (books_option) {
         $("#books").html(books_option);
      })
   })
});
