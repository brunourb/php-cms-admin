/**
 * Created by bruno on 09/07/17.
 */
$(function() {
    var i = -1;
    var toastCount = 0;
    var $toastlast;

    toastr.options = {
        closeButton: true,
        debug: false,
        progressBar: true,
        positionClass: "toast-top-right",
        showDuration: 300,
        hideDuration: 1000,
        timeOut: 5000,
        extendedTimeOut: 1000,
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
        preventDuplicates: false,
        onclick: null
    }
});