<style type="text/css">
.group:nth-of-type(odd) {
    background-color: #f9f9f9;
}
</style>
	{!!Form::label('[]', $options['label'])!!}
<div class="form-group" id="permission_dependencies">
		@foreach ($options['choices'] as $group)
		<div class="col-xs-8 col-md-4 group">
			<ul class="list-inline">
			@foreach ($group as $val => $permisson)
				@if($options['current']!=$val)
				<li>
				{!!Form::checkbox('name', $val, in_array($val,$options['selected']),$attributes=['id'=>$name.'_'.$val,'name'=>'dependencies[]','data-dependencies'=> '['.implode(',',$permisson['dependencies']).']'])!!}
				{!!Form::label($name.'_'.$val, $permisson['name'],$attributes=['class'=>'label-normal'])!!}
				</li>
				@else
				<li><kbd>{{$permisson['name']}}</kbd></li>
				@endif
			@endforeach
			</ul>
		</div>
		@endforeach
		<div class="col-md-12">有依赖的权限以<mark>D</mark>标注</div>
</div>