$(document).ready(function() {
    $('.modal-wide').modal('show');
    var height = $(window).height() - 200;
    $(this).find(".modal-body").css("max-height", height);
});