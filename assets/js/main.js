// (function ($) {
//     $(document).ready(function () {
//
//         $('#search').keyup(function () {
//             var Search = $('#search').val();
//
//             if (Search != "") {
//                 $.ajax({
//                     url: 'includes/search.php', //какой урл тут подключить?
//                     method: 'POST',
//                     data: {search: Search},
//                     success: function (data) {
//                         $('#content').html(data);
//                     }
//                 })
//             } else {
//                 $('#content').html('');
//             }
//             $(document).on('click', 'a', function () {
//                 $('#Search').val($(this).text());
//                 $('#content').html('');
//             })
//         })
//
//         $(document).on('click', '#btn_search', function () {
//             var value = $('#search').val();
//             $.ajax({
//                 url: 'includes/display', //какой url?
//                 method: 'POST',
//                 data: {query: value},
//                 success: function (data) {
//                     $('#products-table tbody').html(data);
//                 }
//             })
//         })
//
//     });
//
// })(jQuery);

$('#btn-search').click(() => {
    console.log('xxx');
    $.ajax({
        url: 'products/search',
        method: 'POST',
        data: {query: $('#search').val()},
        success: function (response) {
            console.log(response);
            //$(tablica).delete()
            //$(roditelTablica).html(response);
        }
    })
});
