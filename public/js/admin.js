function isHybridClicked(i) {
    if ($(i).is(':checked')) {
        $('#hybrid-card .card-body').collapse('show');
    }
    else {
        $('#hybrid-card .card-body').collapse('hide');
    }
}

$(document).ready(function() {
    var parsedUrl = new URL(window.location.href);

    // page admin des ROOTSTOCK
    if (parsedUrl.pathname.match(/\/rootstock\/(create|update)/)) {
        $('input[name="isHybrid"]').on('click', function(e) {
            isHybridClicked(e.target);
        });
        // move the hybrid because it doesn't with custom html, shame
        $('.hybrid-field').parent().appendTo($('#hybrid-card .card-body'));
        isHybridClicked($('input[name="isHybrid"]'));
    }
});

