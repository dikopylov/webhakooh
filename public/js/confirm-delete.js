function deleteItem (itemId, url) {
    if (confirm('Вы уверены, что хотите удалить эту запись, где ID = ' + itemId + ' ?')) {
        $.ajax({
            headers: {
                'Access-Control-Allow-Methods': 'GET, POST, OPTIONS, DELETE',
                'X-CSRF-TOKEN'                : $('meta[name="csrf-token"]').attr('content')
            },
            url    : url,
            type   : "DELETE",
            success: function () {
                $("#" + itemId).remove();
            },
        });
    }


}