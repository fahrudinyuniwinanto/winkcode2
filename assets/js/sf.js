$(document).ready(function() {
    oSetInputValidation();

});

function oSetInputValidation() {
    $('.numeric').keyup(function() {
        var start = this.selectionStart,
            end = this.selectionEnd;
        this.value = this.value.replace(/[^0-9\.]/g, '');
        this.setSelectionRange(start, end);
    });
    $('.letteric').bind('keyup blur', function() {
        var start = this.selectionStart,
            end = this.selectionEnd;
        var node = $(this);
        node.val(node.val().replace(/[^a-z\ ]/g, ''));
        this.setSelectionRange(start, end);
    });
    $('.text-uppercase').keyup(function() {
        var start = this.selectionStart,
            end = this.selectionEnd;
        this.value = this.value.toUpperCase();
        this.setSelectionRange(start, end);
    });
    $('.text-lowercase').focusout(function() {
        var start = this.selectionStart,
            end = this.selectionEnd;
        this.value = this.value.toLowerCase();
        this.setSelectionRange(start, end);
    });
    $('.preventsubmit').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
    $('input.date').datepicker({
        format: 'yyyy/mm/dd',
        orientation: "auto",
        autoclose: true,
        todayHighlight: true
    });
    $('.date-ym').datepicker({
        format: "yyyy/mm",
        viewMode: "months",
        minViewMode: "months",
        autoclose: true
    });
    $('.date-m').datepicker({
        format: "mm",
        viewMode: "months",
        minViewMode: "months",
        autoclose: true
    });
    $('.date-y').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true
    });

}

function fNum(a) {
    var x = a.toString().split('.')
    a = x[0]
    b = a.replace(/[^\d]/g, "");

    if (b < -922337203685477 || b > 922337203685477) {
        b = "922337203685477";
    }
    c = "";
    panjang = b.length;
    j = 0;
    for (i = panjang; i > 0; i--) {
        j = j + 1;
        if (((j % 3) == 1) && (j != 1)) {
            c = b.substr(i - 1, 1) + "," + c;
        } else {
            c = b.substr(i - 1, 1) + c;
        }
    }
    if (x[1] == undefined) {
        ret = c;
    } else {
        ret = c + '.' + x[1];
    }
    return ret;
}

function oLoadPagination(selector, fn) {
    $(selector + ' .pagination a').on('click', function(event) {
        event.preventDefault();
        if ($(this).attr('href') != '#') {
            // $("html, body").animate({
            //     scrollTop: 0
            // }, "fast");
            $(selector).load($(this).attr('href'), function() {
                oLoadPagination(selector, fn);
            });
        }
    });
    if (fn) fn();
}

function copyToClipboard(element) {
    var $temp = $("<textarea>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
}

function sfdialog(id, caption, size, fn) {
    /**
    contoh pakai :
    sfdialog("symenu", "Cari Menu", "modal-sm", function(){
                    $("#sfdialog-symenu .modal-body").html('test body');
                });
    **/
    $.post("CIndex/getSfdialog", { id: id, caption: caption, size: size }, function(data) {
        if (!$("#sfdialog-" + id).length) {
            $("body").append("<div id='" + "sfdialog-" + id + "'></div>");
        }
        $("#sfdialog-" + id).html(data);
        if (fn) fn();
    });
}

function sflookup(url, fn) {
    var id = 'sflookup-d-' + url.replace(/[^a-z0-9]/gi, '');
    sfdialog(id, "Lookup Data", "modal-lg", function() {
        sflookupsearch(id, url, fn);
    });
}


function sflookupsearch(id, url, fn) {
    if (!$("#" + id + " .modal-body input.q-search").length) {
        var q = '';
    } else {
        var q = $("#" + id + " .modal-body input.q-search").val();
    }
    if (url.indexOf("?") >= 0) {
        var opr = "&";
    } else {
        var opr = "?";
    }
    $("#" + id + " .modal-body").load(url + opr + "q=" + q, function() {
        oLoadPagination("#" + id + " .modal-body", function() {
            sflookupevent(id, url, fn)
        });
        // sflookupevent(id, url, fn);
    });

}

function sflookupevent(id, url, fn) {
    $("#" + id + " .modal-body input.q-search").on("keydown", function(e) {
        if (e.keyCode == 13)
            sflookupsearch(id, url, fn);
    });
    $("#" + id + " .modal-body span.btn-search").on("click", function(e) {
        sflookupsearch(id, url, fn);
    });
    $("#" + id + " .modal-body table tr.onclicktrlookup").on('click', function() {
        if (fn) {
            fn($(this).attr('data-id'), $(this).attr('data-name'));
            $("#" + id).modal('hide');
        }
    });
    $("#" + id + " .modal-body input.q-search").focus()
}

function exportExcel(id) {
    window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#' + id).html()));
}

function html2popup(id) {
    var str = $("#" + id).html();
    var w = window.open("CIndex/showLayout/?pg=sfprint", 'callScriptPopup', 'width = 500, height = 500');

    $(w.document.body).append(str);
    alert(str);
}


//===================================== MODAL
    function lookup(url,idhtml){
        var q = $("#q").val();
           $.ajax({
            url:url,
            type:"GET",
            dataType:"html",
            data:{q:q,idhtml:idhtml},
            success:function(data){
                $(".modal-body").html(data);
                $('#lookup').modal();
                $("#q").val("");
            }
        });
        }

       
    function setVal(id,valid,valnm){
        $('#'+id).val(valid); 
        $('#nm_'+id).val(valnm); 
        $('#lookup').modal('hide');
    }

    //===================================== END MODAL
        