
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
        var times = response;
        var options = '';
        times.forEach(function (value) {
            options += "<option value='" + value + "'>" + value + "</option>";
        })

        var visitTimeSelect = $('#visit-time');
        visitTimeSelect.removeData();
        visitTimeSelect.html(options);
    });
}


