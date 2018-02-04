@extends('layout.backend')

@section('styles')
{!! Html::style('css/backend/plugin/nestable/jquery.nestable.css') !!}
{!! Html::style('css/backend/plugin/jstree/themes/default/style.min.css') !!}
@stop

@section('breadcrumbs')
    {!! Breadcrumbs::render($route['current']) !!}
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
              	<h3 class="box-title">分组排序</h3>
				<div class="pull-right box-tools">
					@can($route['table'].'_create')
					<a class="btn btn-success" title="{{trans('messages.new')}}" id="tree-new"><i class="fa fa-fw fa-plus"></i>{{ trans('messages.new') }}</a>
					@endcan
				</div>
            </div>
            <div class="box-body">
                    <div class="dd permission-hierarchy">{!!$groups_hierarchy!!}</div><!--master-list-->
                </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col (left) -->
    @can('permissiongroups_build_tree')
    <div class="col-md-6">
        <div class="box box-success">
            <div class="box-header">
              	<h3 class="box-title">权限树</h3>
				<div class="pull-right box-tools">
					@can($route['table'].'_update')
					<a class="btn btn-primary hide" title="{{trans('messages.edit')}}" id="tree-edit"><i class="fa fa-pencil"> {{trans('messages.edit')}}</i></a>
					@endcan
					@can($route['table'].'_delete')
					<a class="btn btn-danger hide" title="{{trans('messages.delete')}}" id="tree-delete"><i class="fa fa-trash"> {{trans('messages.delete')}}</i></a>
					@endcan
				</div>
            </div>
            <div class="box-body">
                    <div id="permission-tree"></div>
                    <div id="tree"></div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col (right) -->
    @endcan
</div><!-- /.row -->
@stop

@section('scripts')
{!! Html::script('js/backend/plugin/nestable/jquery.nestable.js') !!}
{!! Html::script('js/backend/plugin/jstree/jstree.min.js') !!}
<script>
$(function() {
    var hierarchy = $('.permission-hierarchy');
    var tree = $('#permission-tree');

    hierarchy.nestable({maxDepth:2});
    hierarchy.on('change', function() {
        @can('permissiongroups_update_sort')
            $.ajax({
                url : "{!! route('admin.permissiongroups.update_sort') !!}",
                type: "post",
                data : {data:hierarchy.nestable('serialize')},
                success: function(data) {
                    if (data.status == "OK"){
                        toastr.success("{{ trans('messages.saved') }}");
                        tree.jstree("refresh",-1);
                    }
                    else
                        toastr.error("{{ trans('messages.error')}}.");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error("{{ trans('messages.error')}}: " + errorThrown);
                }
            });
        @else
            toastr.error("{{ trans('messages.permission_denied')}}");
        @endcan
    });

@can('permissiongroups_build_tree')
	tree.jstree({
		'core' : {
			'data' : {
				'url' : "{!! route('admin.permissiongroups.build_tree') !!}"
			}
		},
	    "types" : {
	      "default" : {
	        "icon" : "fa fa-file-o"
	      }
	    },
	    "plugins" : [ "types" ]
	}).on('ready.jstree', function() {
	    tree.jstree('open_all');
	}).on('open_node.jstree', function (e, data) {
		data.instance.set_icon(data.node, "fa fa-folder-open-o");
	}).on('close_node.jstree', function (e, data) {
		data.instance.set_icon(data.node, "fa fa-folder-o");
	});

    tree.bind(
        "select_node.jstree", function(evt, data){
            $('#tree-edit').removeClass('hide');
            $('#tree-delete').removeClass('hide');
        }
    );

    $('#tree-new').click(function(e) {
        e.preventDefault();
        if(get('ajax-modal')=='true') {
            $.get('{{ url(Request::path()) }}/create', function(data){
                bootbox.dialog({
                    closeButton: false,
                    message: data,
                });
            });
        }else{
            window.location.href = '{{ url(Request::path()) }}/create';
        }
    });

    $('#tree-edit').click(function(e) {
        e.preventDefault();
		var CurrentNode = tree.jstree("get_selected");
		if(!CurrentNode.length) {
			toastr.error("请选择要编辑的权限树节点.");
			return false;
		}
	    var id = $('#'+CurrentNode).data('id');
        window.location.href = '{{ url(Request::path()) }}/'+id+'/edit';
    });

    $('#tree-delete').click(function(e) {
        e.preventDefault();
		var CurrentNode = tree.jstree("get_selected");
		if(!CurrentNode.length) {
			toastr.error("请选择要删除的权限树节点.");
			return false;
		}
	    var id = $('#'+CurrentNode).data('id');
        bootbox.confirm("{{ trans('messages.delete.confirm')}}<mark>"+$('#'+CurrentNode).data('name')+"</mark>？", function(result) {
            if (result) {
                $.ajax({
                    type: 'DELETE',
                    url: '{{ url(Request::path()) }}/'+id,
                    data: id,
                    cache: false,
                    dataType: 'json',
                    success: function(data) {
                        if(data.type == 'success'){
                            toastr.options.onHidden = function() { window.location.reload(); }
                        }
                        toastr[data.type](data.status);
                    }
                });
            }
        });
    });
@endcan

});


</script>
@stop