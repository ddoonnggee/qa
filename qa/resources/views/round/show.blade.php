@extends('layout.partials.show')

@section('name')
    比赛：第 <b>{{ $object->id }}</b> 轮——{{$object->created_at}}
@stop

@section('show')
	@if($list)
	@foreach($list as $key => $v)
		<table class="table">
		<thead>
			<tr>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th style="width: 50%">第{{$key + 1}}题</th>
				<th style="width: 10%">用户双方</th>
				<th style="width: 20%">答案</th>
				<th style="width: 10%">得分</th>
				<th style="width: 10%">胜利方</th>
			</tr>
			<tr>
			    <td rowspan="2">{{$v->question}}</td>
			    <td>{{$object->memberHome->nickname}}</td>
			    <td>{{$v->home_answer}} @if($v->home_is_right) <i class="fa fa-check btn-success"></i> @else <i class="fa fa-times btn-danger"></i> @endif</td>
			    <td>{{$v->home_score}}</td>
			    <td rowspan="2">{{$object->memberWin->nickname or '平局'}}</td>
			</tr>
			<tr>
			    <td>{{$object->memberAway->nickname}}</td>
			    <td>{{$v->away_answer}} @if($v->away_is_right) <i class="fa fa-check btn-success"></i> @else <i class="fa fa-times btn-danger"></i> @endif</td>
			    <td>{{$v->away_score}}</td>
			</tr>
		</tbody>
		</table>
		<hr>
	@endforeach
	@endif
@stop