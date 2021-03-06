
$(document).ready(function () {
    var hrefUrl = window.location.href;
    $(".sidebar-menu li").each(function () {
        var link = $(this).find("a").attr("href");
        if ( hrefUrl.indexOf(link) !== -1) {
            $(this).addClass("active");
        }
    });

    changeReservationStatus($('#status-id').val() == 3);
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

function changeSidebarTransform() {
    var mainSidebar    = $('.main-sidebar');
    var transformClass = 'zero-sidebar-transform';
    if (mainSidebar.hasClass(transformClass)) {
        mainSidebar.removeClass(transformClass);
    } else {
        mainSidebar.addClass(transformClass);
    }
}

function changeReservationStatus(isRejected)
{
    var cancelReasonDiv = $('#cancel-reason');
    var cancelReasonInput = $('input[name=cancel-reason]');
    cancelReasonDiv.hide();
    cancelReasonInput.removeAttr('required');
    if (isRejected) {
        cancelReasonDiv.show();
        cancelReasonInput.attr('required', 'required');
    }
}

function getReservations(currentKey, message, alert, url)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.post(url, {
        currentKey : currentKey,
        message    : message,
        alert      : alert,
    }, function (response) {
        $('section.content').html(response);
    });
}

