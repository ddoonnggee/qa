@section('styles')
{!! Html::style('css/backend/plugin/jstree/themes/default/style.min.css') !!}
@stop

<div id="permission-tree"></div>
{!!Form::text('permissions','',['class'=>'hide'])!!}

@section('scripts')
{!! Html::script('js/backend/plugin/jstree/jstree.min.js') !!}
<script>
$(function () {
    var tree = $('#permission-tree');
    var check_dependencies = false;
    tree.jstree({
        'core' : {
            'data' : {!!$options['tree']!!}
        },
        "checkbox" : {
            "keep_selected_style" : true
        },
        "plugins" : ["checkbox"]
    }).on('ready.jstree', function() {
        tree.jstree('open_all');
        tree.jstree('hide_icons');
        check_dependencies = true;
    }).on('changed.jstree', function (event, object) {
        //Check all dependency nodes and disable
        if (check_dependencies) {
            if (!!object.node) { //bug 待修改
                if (!!object.node.li_attr.dependencies) {
                    if (object.node.li_attr.dependencies.length) {
                        var checked = tree.jstree('is_checked', object.node);
                        for (var i = 0; i < object.node.li_attr.dependencies.length; i++) {
                            if (checked) {
                                tree.jstree('check_node', object.node.li_attr.dependencies[i]);
                            }
                        }
                    }
                }
            }
        }
    });

    $("form").submit(function() {
        var checked_ids = [];
        $.each(tree.jstree("get_checked", true), function() {
            if(this.li_attr.group==0){
                checked_ids.push(this.id);
            }
        });
        $("input[name='permissions']").val(checked_ids);
    });

});
</script>
@stop