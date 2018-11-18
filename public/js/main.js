
$(document).ready(function () {
    var hrefUrl = window.location.href;
    $(".sidebar-menu li").each(function () {
        var link = $(this).find("a").attr("href");
        if ( hrefUrl.indexOf(link) !== -1) {
            $(this).addClass("active");
        }
    });
});


