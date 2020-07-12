$(document).ready(function() {
    // mise en place des bulles
    $('*[data-toggle="tooltip"]').tooltip();

    var mouseDown = false;
    var changed = false;
    $(document).mousedown(function(e) {
        mouseDown = true;
    });
    $(document).mouseup(function(e) {
        mouseDown = false;
        if (changed) {
            $('#formFilters').submit();
        }
    });

    $('#formFilters').on('change', function(e) {
        // 2 évènements sont appelés, on garde celui de l'input
        if (e.target.tagName.toLowerCase() == 'input') {
            // lorsqu'on est en train de déplacer le slider, on envoie pas
            changed = true;
        }
    });

    $('#i-filter-text').on('input', function(e) {
        var divs = $('.content .rootstock .card-header');
        var reFilter = new RegExp($(e.target).val(),"gi");
        for (var i=0; i < divs.length ; i++) {
            if ($(divs.get(i)).text().match(reFilter)) {
                $(divs.get(i)).parent().show();
            }
            else {
                $(divs.get(i)).parent().hide();
            }
        }
    });
    $('#i-filter-content').on('input', function(e) {
        var divs = $('.content .rootstock > .card-body');
        var reFilter = new RegExp($(e.target).val(),"gi");
        for (var i=0; i < divs.length ; i++) {
            if ($(divs.get(i)).text().match(reFilter)) {
                $(divs.get(i)).closest('.rootstock').show();
            }
            else {
                $(divs.get(i)).closest('.rootstock').hide();
            }
        }
    });
});