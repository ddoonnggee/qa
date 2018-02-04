<!DOCTYPE html>
<html lang="en">
<head>
	<title>天梯</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css?family=Amarante');
		html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
		  margin: 0;
		  padding: 0;
		  border: 0;
		  font-size: 100%;
		  font: inherit;
		  vertical-align: baseline;
		  outline: none;
		  -webkit-font-smoothing: antialiased;
		  -webkit-text-size-adjust: 100%;
		  -ms-text-size-adjust: 100%;
		  -webkit-box-sizing: border-box;
		  -moz-box-sizing: border-box;
		  box-sizing: border-box;
		}
		html { overflow-y: scroll; }
		body { 
		  background: #eee url('https://i.imgur.com/eeQeRmk.png'); /* https://subtlepatterns.com/weave/ */
		  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
		  font-size: 62.5%;
		  line-height: 1;
		  color: #585858;
		  padding: 22px 10px;
		  padding-bottom: 55px;
		}

		::selection { background: #5f74a0; color: #fff; }
		::-moz-selection { background: #5f74a0; color: #fff; }
		::-webkit-selection { background: #5f74a0; color: #fff; }

		br { display: block; line-height: 1.6em; } 

		article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section { display: block; }
		ol, ul { list-style: none; }

		input, textarea { 
		  -webkit-font-smoothing: antialiased;
		  -webkit-text-size-adjust: 100%;
		  -ms-text-size-adjust: 100%;
		  -webkit-box-sizing: border-box;
		  -moz-box-sizing: border-box;
		  box-sizing: border-box;
		  outline: none; 
		}

		blockquote, q { quotes: none; }
		blockquote:before, blockquote:after, q:before, q:after { content: ''; content: none; }
		strong, b { font-weight: bold; } 

		table { border-collapse: collapse; border-spacing: 0; }
		img { border: 0; max-width: 100%; }

		h1 { 
		  font-family: 'Amarante', Tahoma, sans-serif;
		  font-weight: bold;
		  font-size: 3.6em;
		  line-height: 1.7em;
		  margin-bottom: 10px;
		  text-align: center;
		}
		a{
			color:#000;
			text-decoration: none;
		}


		/** page structure **/
		#wrapper {
		  display: block;
		  width: 61.8%;
		  background: #fff;
		  margin: 0 auto;
		  padding: 10px 17px;
		  -webkit-box-shadow: 2px 2px 3px -1px rgba(0,0,0,0.35);
		}

		#keywords {
		  margin: 0 auto;
		  font-size: 1.2em;
		  margin-bottom: 15px;
		}


		#keywords thead {
		  cursor: pointer;
		  background: #c9dff0;
		}
		#keywords thead tr th { 
		  font-weight: bold;
		  padding: 12px 30px;
		  padding-left: 42px;
		}
		#keywords thead tr th span { 
		  padding-right: 20px;
		  background-repeat: no-repeat;
		  background-position: 100% 100%;
		}

		#keywords thead tr th.headerSortUp, #keywords thead tr th.headerSortDown {
		  background: #acc8dd;
		}

		#keywords thead tr th.headerSortUp span {
		  background-image: url('https://i.imgur.com/SP99ZPJ.png');
		}
		#keywords thead tr th.headerSortDown span {
		  background-image: url('https://i.imgur.com/RkA9MBo.png');
		}


		#keywords tbody tr { 
		  color: #555;
		}
		#keywords tbody tr td {
		  text-align: center;
		  padding: 15px 10px;
		}
		#keywords tbody tr td.lalign {
		  text-align: left;
		}

		.page { 
			margin-top: 40px; 
			overflow: hidden; 
			padding: 0; 
			text-align: center; 
		}
		.page a { 
			background-color: transparent; 
			border: 1px solid #000; 
			color: #242526; 
		}
		.page a:hover{ 
			background-color: #c9dff0; 
			border: 1px solid #c9dff0; 
			color: #FFFFFF; 
		}
		.page a {
			cursor: pointer;
			display: inline-block;
			transition: all 0.3s ease 0s;
			line-height: 20px;
			border-radius: 0px;
			margin: 0 0px 10px;
			padding: 5px 10px;
			vertical-align: baseline;
			white-space: nowrap;
		}

		.form{
			text-align: right;
            padding:15px;
            border:none;
            border-radius:5px;          
        }
        input{
            height: 42px;
            background-color: #eeeeee;
            border:none;
            border-top-left-radius:5px;
            border-bottom-left-radius:5px;
            font: bold 15px 'lucida sans', 'trebuchet MS', 'Tahoma';
            font-style:italic;
            text-indent: 10px;
        }
        button{
            /*display:inline-block;*/
            width:112px;
            height: 42px;
            background-color:#c9dff0;
            color:#fff;
            border:none;
            border-top-right-radius:5px;
            border-bottom-right-radius:5px;
            position: relative;
            font-size:16px;
            font-weight: bold;
            cursor: pointer;
        }
        /*使用伪类来添加三角符号*/
        button:before{
            content:"";
            border-width:6px;
            border-style:solid;
            border-color: transparent #c9dff0 transparent transparent;
            position: absolute;
            right:100%;
            top:38%;
        }
	</style>
</head>
<body>
 <div id="wrapper">
  	<a href="{{url('/')}}"><h1>用户排行榜</h1></a>
	<div class="search_box">
		<form action="" method="GET">
		<div class="form">      
		    <input type="text" name="keyword" value="{{$keyword or '请输入用户名'}}"><button>SEARCH</button>        
		</div>
		</form>
	</div>
	<table id="keywords" cellspacing="0" cellpadding="0">
	<thead>
	  <tr>
	    <th><span>排名</span></th>
	    <th><span>用户</span></th>
	    <th><span>积分</span></th>
	    <th><span>比赛场次</span></th>
	    <th><span>胜利场次</span></th>
	    <th><span>胜率</span></th>
	    <th><span>失败场次</span></th>
	    <th><span>平局场次</span></th>
	  </tr>
	</thead>
	<tbody>
	@if($list)
	@foreach($list as $key => $v)
	  <tr>
	    <td class="lalign">{{$key + 1}}</td>
	    <td>{{$v['nickname']}}</td>
	    <td>{{$v['score']}}</td>
	    <td>{{$v['count']}}</td>
	    <td>{{$v['win_count']}}</td>
	    <td>{{$v['count'] ? number_format($v['win_count'] / $v['count'] * 100, 2).'%' : '--'}}</td>
	    <td>{{$v['lose_count']}}</td>
	    <td>{{$v['draw_count']}}</td>
	  </tr>
	@endforeach
	@else
	  <tr>
	  	<td colspan="8">{{$keyword ? '暂无相关信息' : '对不起还没有测试数据，请执行 php artisan db:seed --class=MemberTableSeeder'}}</td>
	  </tr>
	@endif
	</tbody>
	<tfoot>
		<tr>
			<td colspan="8" align="right">
				{!!$pagebar!!}
			</td>
		</tr>
	</tfoot>
	</table>
 </div> 
</body>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.28.14/js/jquery.tablesorter.min.js'></script>
<script type="text/javascript">
	$(function(){
	  $('#keywords').tablesorter(); 
	});
</script>
</html>