@extends('layout.backend')

@section('toolbars')
@if(!isset($no_toolbars))
<div class="toolbars">
    @can($route['table'].'_create')
    <a class="btn btn-success btn-new"><i class="fa fa-fw fa-plus"></i>{{ trans('messages.new') }}</a>
    @endcan
    @can($route['table'].'_delete')
    <a class="btn btn-danger btn-remove hide"><i class="fa fa-fw fa-times"></i>{{ trans('messages.delete') }}</a>
    @endcan
</div>
@endif
@stop

@section('breadcrumbs')
    {!! Breadcrumbs::render($route['current']) !!}
@stop


@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    {!! Form::open(['method' => 'DELETE', 'id' => 'frmList', 'route' => ['admin.'.$route['table'].'.destroy', null]]) !!}
                            <table class="table table-striped table-condensed table-hover responsive" id="data-table"></table>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function (){
    var rows_selected = [];
    var dom_table = $('#data-table');
    var table = dom_table.DataTable({
        stateSave: true,
        ajax: '',
        order: [1, 'desc'],
        columns: {!! $html !!},
        initComplete: function( settings, json ) {
/*            $('#data-table_filter').parent().remove();
            var foot = dom_table.find('tfoot');
            if (!foot.length) {
                foot = $('<tfoot>').appendTo(dom_table);
                var tr=$("<tr></tr>");
                for (var i = 0; i < dom_table.find('thead th').length; i++) {
                    $('<th>').appendTo(tr);
                }
                foot.append(tr);
            }
            yadcf.init(table, [
                    {column_number: 2,filter_type: "text", filter_default_label: "搜索"},
                    {column_number: 3,filter_type: "text", filter_default_label: "搜索"},
                    {
                        column_number: 4,
                        data: [{
                            value: '1',
                            label: '文章'
                        }, {
                            value: '3',
                            label: '配置'
                        }, {
                            value: '4',
                            label: '帐户'
                        }],
                        filter_default_label: "Custom func filter",
                    },
                                ], 'footer'
            );
            //boot option
            var filterInput = $('.yadcf-filter, .yadcf-filter-range, .yadcf-filter-date'),
                filterReset = $('.yadcf-filter-reset-button');
            filterInput.addClass('form-control').parent().addClass('input-group input-group-sm');
            filterReset.addClass('btn btn-default btn-flat').html('<i class="fa fa-times"></i>').wrap('<span class="input-group-btn"></span>');
            $('.yadcf-filter-wrapper').css('width','100%');*/

        },
        fnDrawCallback: function( settings ) {
            // $('div.dataTables_filter input').addClass('input[type=search]');
            $('.btn-edit').click(function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                if(get('ajax-modal')=='true' && !!$(this).data("ajaxedit")) {
                    $.get('{{ url(Request::path()) }}/'+id+'/edit', function(data){
                        bootbox.dialog({
                            size: 'large',
                            closeButton: false,
                            message: data,
                        });
                    });
                }else{
                    window.location.href = '{{ url(Request::path()) }}/'+id+'/edit';
                }
            });
            $('.btn-delete').click(function(e) {
                e.preventDefault();
                deleteDataTableSelect($(this));
                return false;
            });
            var api = this.api();
            var info = api.page.info()
            if(info.page == info.pages && info.pages!=0){
                var table = this.DataTable();
                table.page('last').draw(false);
                window.location.reload();
            }
        }
    });

    $('div.toolbar').append($('div.toolbars').contents());

    $('.btn-new').click(function(e) {
        e.preventDefault();
        if(get('ajax-modal')=='true') {
            $.get('{{ url(Request::path()) }}/create', function(data){
                bootbox.dialog({
                    size: 'large',
                    closeButton: false,
                    message: data,
                });
            });
        }else{
            window.location.href = '{{ url(Request::path()) }}/create';
        }
    });

    $('.btn-remove').click(function(e) {
        e.preventDefault();
        deleteDataTableSelect($(this));
        return false;
    });

    function checkDeleteTitle(tr){//判断删除框取哪个td的标题
        var firstTd = tr.find("td:first").children().first().prop('nodeName');
        if(firstTd == "INPUT"){
            title = "<mark>"+tr.find("td:eq(2)").html()+"</mark>";
        }else{
            title = "<mark>"+tr.find("td:eq(1)").html()+"</mark>";
        }
        return title;
    }

    function deleteDataTableSelect(button){//判断来源哪个删除按钮
        var title = "{{ trans('messages.delete.confirm')}}";
        if (typeof button.data("id") === "undefined") {//remove button
            var checkedValues = $('tbody input:checkbox:checked').map(function() {
                return this.value;
            }).get();
            var count = $('tbody input:checkbox:checked').length;
            if(count>1){
                title += "<mark>"+count+"条</mark>";
                title += "{{trans('messages.'.$route['table'])}}";
            }else{
                title += "{{trans('messages.'.$route['table'])}}";
                title += checkDeleteTitle($('tbody input:checkbox:checked').parent().parent());
            }
        }else{//single button
            var checkedValues = button.data("id");
            title += "{{trans('messages.'.$route['table'])}}";
            title += checkDeleteTitle(button.parent().parent());
        }
        bootbox.confirm({
            title: title+"？",
            // message: "{{ trans('messages.delete.message') }}",
            message: "<h3><i class='fa fa-warning text-red'></i> {{ trans('messages.delete.message') }}.</h3>",
            buttons: {
                'cancel': {
                    label: "{{ trans('messages.cancel') }}",
                    className: 'btn-default pull-left'
                },
                'confirm': {
                    label: "{{ trans('messages.delete') }}",
                    className: 'btn-danger pull-right'
                }
            },
            callback: function(result) {
                if (result) {
                    var frm = $('#frmList');
                    $.ajax({
                        type: frm.attr('method'),
                        url: frm.attr('action')+'/'+checkedValues,
                        data: frm.serialize(),
                        cache: false,
                        dataType: 'json',
                        success: function(data) {
                            bootbox.hideAll();
                            toastr[data.type](data.status);
                            dom_table.DataTable().ajax.reload( null, false ); // user paging is not reset on reload
                        }
                    });
                }
            }
        });
    }


    @if (str_contains($html, 'select_all'))
    //http://www.gyrocode.com/articles/jquery-datatables-checkboxes/
    function updateDataTableSelectAllCtrl(table){
       var $table             = table.table().node();
       var $chkbox_all        = $('tbody input[type="checkbox"]:not(:disabled)', $table);
       var $chkbox_checked    = $('tbody input[type="checkbox"]:checked:not(:disabled)', $table);
       var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);
       if($chkbox_all.length === 0){
            $('thead input[name="select_all"]').prop("disabled", true);
       }else{
            $('thead input[name="select_all"]').prop("disabled", false);
       }
       $('.btn-remove').removeClass('hide');
       // If none of the checkboxes are checked
       if($chkbox_checked.length === 0){
            $('.btn-remove').addClass('hide');
            chkbox_select_all.checked = false;
            if('indeterminate' in chkbox_select_all){
                chkbox_select_all.indeterminate = false;
            }
       // If all of the checkboxes are checked
        } else if ($chkbox_checked.length === $chkbox_all.length){
            chkbox_select_all.checked = true;
            if('indeterminate' in chkbox_select_all){
                chkbox_select_all.indeterminate = false;
            }
       // If some of the checkboxes are checked
       } else {
            chkbox_select_all.checked = true;
            if('indeterminate' in chkbox_select_all){
                chkbox_select_all.indeterminate = true;
            }
        }
    }

    // Handle click on checkbox
    dom_table.find('tbody').on('click', 'input[type="checkbox"]:not(:disabled)', function(e){
        var $row = $(this).closest('tr');
        // Get row data
        var data = table.row($row).data();
        // Get row ID
        var rowId = data[0];
        // Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);
        // If checkbox is checked and row ID is not in list of selected row IDs
        if(this.checked && index === -1){
            rows_selected.push(rowId);
        // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1){
            rows_selected.splice(index, 1);
        }

        if(this.checked){
            $row.addClass('danger');
        } else {
            $row.removeClass('danger');
        }
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });

   // Handle click on table cells with checkboxes
   dom_table.on('click', 'tbody td, thead th:first-child', function(e){
     // $(this).parent().find('input[type="checkbox"]').trigger('click');
      $(this).parent().effect("highlight", {}, 1000);
   });

   // Handle click on "Select all" control
    dom_table.find('thead input[name="select_all"]').on('click', function(e){
        if(this.checked){
            dom_table.find('tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            dom_table.find('tbody input[type="checkbox"]:checked').trigger('click');
        }
        // Prevent click event from propagating to parent
        e.stopPropagation();
    });

   // Handle table draw event
    table.on('draw', function(){
        // Update state of "Select all" control
        if ( dom_table.find('thead input[name="select_all"]').length ){
            updateDataTableSelectAllCtrl(table);
        }
    });
    @endif
});
</script>
@stop
