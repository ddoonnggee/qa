@section('styles')
{!! Html::style('css/backend/plugin/nestable/jquery.nestable.css') !!}
@stop
@if($options['permissions'][0]>1)
{!!Form::label('[]', $options['label'])!!}
<div class="dd permission-hierarchy">{!!$options['permissions'][1]!!}</div><!--master-list-->
@endif
@section('scripts')
{!! Html::script('js/backend/plugin/nestable/jquery.nestable.js') !!}
<script>
$(function() {
    var hierarchy = $('.permission-hierarchy');
    hierarchy.nestable({maxDepth:1});
    hierarchy.on('change', function() {
        @can('permissions_update')
            $.ajax({
                url : "{!! route('admin.permissions.update_sort') !!}",
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
});
</script>
@stop