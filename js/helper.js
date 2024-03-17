function showToastr (toastrMessage, toastrType, options) {
    var defaults = {
        closeButton: false,
        debug: false,
        positionClass: "toast-top-right",
        onclick: null,
        showDuration: "1000",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "100000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };

    var opt = defaults;
    if (typeof options == "object") {
        opt = $.extend(defaults, options);
    }
    toastr.options = opt;
    toastrType = typeof toastrType !== "undefined" ? toastrType : "success";
    toastr[toastrType](toastrMessage);
};


//check value null validation
function ValidateControl(obj) {
    if ($(obj).val() != null && $(obj).val() != undefined && $(obj).val() != '') {
        return true;
    } else {
        return false;
    }
}