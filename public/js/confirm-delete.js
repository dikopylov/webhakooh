function deleteItem (userId, url) {
    console.log(url);
    if (confirm('Вы уверены, что хотите удалить эту запись?')) {
        $.ajax({
            headers: {
                'Access-Control-Allow-Methods': 'GET, POST, OPTIONS, DELETE',
                'X-CSRF-TOKEN'                : $('meta[name="csrf-token"]').attr('content')
            },
            url    : url, //'/users/' + userId,
            type   : "DELETE",
            success: function () {
                location.reload();
            }
        });
    }


}