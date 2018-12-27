
$(document).ready(function () {
    var hrefUrl = window.location.href;
    $(".sidebar-menu li").each(function () {
        var link = $(this).find("a").attr("href");
        if ( hrefUrl.indexOf(link) !== -1) {
            $(this).addClass("active");
        }
    });
});

function loadTimeSelect(platenId, date, url, reservationId = null)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.post(url, {
        platenId      : platenId,
        date          : date,
        reservationId : reservationId
    }, function (response) {
        var times           = response;
        var visitTimeSelect = $('#visit-time');
        var addButton       = $('[name=add-button]');
        if (times.length) {
            var options = '';
            times.forEach(function (value) {
                options += "<option value='" + value + "'>" + value + "</option>";
            });
            visitTimeSelect.html(options);
            addButton.show();
        } else {
            visitTimeSelect.html('');
            addButton.hide();
            alert('На указанную дату и стол нет свободного времени! Бронируйте на другой стол/дату :)');
        }
    });
}


