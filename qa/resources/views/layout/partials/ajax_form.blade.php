<div class="box {{($route['action']== 'create') ? 'box-success': 'box-primary'}}">
    <div class="box-header">
        <h3 class="box-title">{{($route['action']== 'index') ? trans('messages.'.$route['table']) : trans('messages.'.$route['action']).trans('messages.'.$route['table'])}}</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" onclick="bootbox.hideAll()"><i class="fa fa-times class"></i></button>
          </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!!form($form)!!}
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="form-group">
            <div class="text-right">
                <button class="btn btn-default pull-left" onclick="bootbox.hideAll()"><i class="fa fa-times fa-fw"></i>{{ trans('messages.cancel') }}</button>
                <button class="btn btn-primary" id="ajax_edit"><i class="fa fa-floppy-o fa-fw"></i>{{ trans('messages.save') }}</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var frm = $('.bootbox-body').find('form');
frm.on('submit', function(e){
    e.preventDefault();
    $.ajax({
        type: frm.attr('method'),
        url: frm.attr('action'),
        data: frm.serialize(),
        cache: false,
        dataType: 'json',
        success: function(data) {
            if($('#data-table').length > 0) {
                toastr.options.onShown = function() {  $('#data-table').DataTable().ajax.reload( null, false );}
            }else{
                toastr.options.onHidden = function() { window.location.reload(); }
            }
            bootbox.hideAll();
            toastr[data.type](data.status);
        }
    });
});
$('#ajax_edit').click(function(e) {
    $('#submitButton').trigger('click');
});
@if(isset($script))
$.getScript( "{{asset($script)}}");
@endif
</script>