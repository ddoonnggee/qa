/**
 * custom.js [v1.0.0]
 *
 * Editor: Hiro
 */

var getIdCheckBox = function() {
    $('input[type=checkbox]').each(function () {
        if (this.checked) {
            id = $(this).val();
        }
    });
    return id;
};

var store = function(name, val) {
    if (typeof (Storage) !== "undefined") {
        localStorage.setItem(name, val);
    } else {
        window.alert('浏览器不支持，请更换浏览器');
    }
}

var get = function(name) {
    if (typeof (Storage) !== "undefined") {
      return localStorage.getItem(name);
    } else {
        window.alert('浏览器不支持，请更换浏览器');
    }
}

var AdminLTEOptions = {
    // sidebarSlimScroll: true,
    // sidebarExpandOnHover: true,
    animationSpeed: 100,
 };


var my_skins = [
    "skin-blue",
    "skin-black",
    "skin-red",
    "skin-yellow",
    "skin-purple",
    "skin-green",
    "skin-blue-light",
    "skin-black-light",
    "skin-red-light",
    "skin-yellow-light",
    "skin-purple-light",
    "skin-green-light"
];


var change_skin = function (cls) {
        $.each(my_skins, function(i) {
            $("body").removeClass(my_skins[i]);
        });

        $("body").addClass(cls);
        store('skin', cls);
        return false;
}

var check_sidebar = function() {
    $("body").addClass('sidebar-mini');
    if (get('sidebar-hide')=='true') {
        $("body").addClass('sidebar-collapse');
    }
}

var check_ajax = function() {
    if(get('ajax-modal')=='true') {
        $('#ajax-toggle').prop('checked', true);
    }
}


function backend_setup() {
    var tmp = get('skin');
    if (tmp && $.inArray(tmp, my_skins)){
      change_skin(tmp);
    }
    $("[data-skin]").on('click', function (e) {
          e.preventDefault();
          change_skin($(this).data('skin'));
    });

    check_sidebar();
    $('.sidebar-toggle').on('click', function (e) {
        e.preventDefault();
        store('sidebar-hide', !$('body').hasClass('sidebar-collapse'));
        // console.log(get('sidebar-hide'));
    });

    check_ajax();
    $('#ajax-toggle').on('change', function() {
        store('ajax-modal',$(this).is(":checked"));
    });

    $('.fullscreen-toggle').on('click', function (e) {
        e.preventDefault();
        if (screenfull.enabled) {
            screenfull.toggle();
        }
    });
    if (screenfull.enabled) {
        document.addEventListener(screenfull.raw.fullscreenchange, function () {
            $('.fullscreen-toggle').find('i').toggleClass('ion-arrow-expand ion-arrow-shrink')
        });
    }

}


$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        error   : function ( jqXhr, json, errorThrown ){
            var errors = jqXhr.responseJSON;
            var errorsHtml= '';
            $.each( errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>';
            });
            toastr.error( errorsHtml , "Error " + jqXhr.status +': '+ errorThrown);
        }
    });

    backend_setup();

	$('#frmModel .btn-apply').click(function(e){
        e.preventDefault();
        $('input[name=task]').val('apply');
        $('#submitButton').trigger('click');
        // $('#frmModel form').submit();
    });

    $('#frmModel .btn-primary').click(function(e){
        e.preventDefault();
        // $('#frmModel form').submit();
        $('#submitButton').trigger('click');
    });

/*    $("select").each(function(index) {
        var id = $(this).attr('id');
        if (id) $('#'+id).selectize();
    });*/

    $.extend( true, $.fn.dataTable.defaults, {
        language: {
            "sProcessing": "处理中...",
            "sLengthMenu": "_MENU_ ",
            "sZeroRecords": "没有匹配结果",
            "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
            "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
            "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
            "sInfoPostFix": "",
            "search": "_INPUT_",
            "searchPlaceholder": "搜索",
            "sUrl": "",
            "sEmptyTable": "表中数据为空",
            "sLoadingRecords": "载入中...",
            "sInfoThousands": ",",
            "oPaginate": {
                "sFirst": "首页",
                "sPrevious": "上页",
                "sNext": "下页",
                "sLast": "末页"
            },
            "oAria": {
                "sSortAscending": ": 以升序排列此列",
                "sSortDescending": ": 以降序排列此列"
            }
        },
        dom:
            "<'row'<'col-sm-6'<'toolbar'>><'col-sm-6'<'pull-right'f><'pull-right'l>C>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        processing: true,
        serverSide: true,
        lengthMenu: [ 10, 20, 50, 100 ],
        pageLength: 20,
/*        "searching": false,
        "ordering": false*/
    } );


    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "2000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

});