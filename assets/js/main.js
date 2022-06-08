$('#btn-search').click(() => {
    $.ajax({
        url: 'products/search',
        method: 'POST',
        data: {query: $('#search').val()},
        success: function (response) {
            //console.log(response);
            //$(tablica).delete()
            $('.products').html(response);
        }
    })
});

