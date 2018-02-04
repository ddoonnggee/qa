<?php
namespace App\Http\Controllers;
use App\Models\Member;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
	// 首页 天梯
    public function index()
    {
        $page    = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $size    = isset($_GET['size']) ? intval($_GET['size']) : 1000;
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

		$start = ($page - 1) * $size;
		$end   = $page * $size;

        $list    = array();
        $pagebar = '';

        if ($keyword) {
            $k_list = Member::where('nickname', $keyword)->orderBy('score', 'DESC')->orderBy('updated_at', 'DESC')->limit(2000)->get(['id', 'nickname', 'score', 'count', 'win_count', 'lose_count', 'draw_count'])->toArray();
            if ($k_list) {
                foreach ($k_list as $key => $value) {
                    $val    = $value['id'].'_'.$value['nickname'].'_'.$value['score'].'_'.$value['count'].'_'.$value['win_count'].'_'.$value['lose_count'].'_'.$value['draw_count'];
                    $r_list = Redis::zScore('member_rank', $val);
                    if ($r_list) {
                        $rank = Member::where('score', '>', $value['score'])->orderBy('score', 'DESC')->orderBy('updated_at', 'DESC')->count();
                        $list[$rank]['nickname']   = $value['nickname'];
                        $list[$rank]['score']      = $value['score'];
                        $list[$rank]['count']      = $value['count'];
                        $list[$rank]['win_count']  = $value['win_count'];
                        $list[$rank]['lose_count'] = $value['lose_count'];
                        $list[$rank]['draw_count'] = $value['draw_count'];
                    }
                }
            }
        }else{
            $r_list = Redis::zRevRange('member_rank', $start, $end);
            if ($r_list) {
                foreach ($r_list as $key => $value) {
                    $tmp = explode('_', $value);
                    $list[$key+$start]['nickname']   = $tmp[1];
                    $list[$key+$start]['score']      = $tmp[2];
                    $list[$key+$start]['count']      = $tmp[3];
                    $list[$key+$start]['win_count']  = $tmp[4];
                    $list[$key+$start]['lose_count'] = $tmp[5];
                    $list[$key+$start]['draw_count'] = $tmp[6];
                }
            }else{
                $list =  Member::orderBy('score', 'DESC')->orderBy('updated_at', 'DESC')->limit(2000)->get(['id', 'nickname', 'score', 'count', 'win_count', 'lose_count', 'draw_count'])->toArray();
                foreach ($list as $key => $value) {
                    Redis::zAdd('member_rank', $value['score'], $value['id'].'_'.$value['nickname'].'_'.$value['score'].'_'.$value['count'].'_'.$value['win_count'].'_'.$value['lose_count'].'_'.$value['draw_count']);
                }
            }

            $count = Redis::zCard('member_rank');
            $last  = ($count % $size) ? ($count / $size + 1) : ($count / $size);

            if ($count > $size) {
                $pagebar = '<div class="page"><a href = '.url("/?page=1").'>First</a>';
                if ($page > 1) {
                    $pagebar .= '<a href = '.url("/?page=".($page - 1)).'>Prev</a>';
                }
                if ($page < $last) {
                    $pagebar .= '<a href = '.url("/?page=".($page + 1)).'>Next</a>';
                }
                        
                $pagebar .= '<a href = '.url("/?page=".$last).'>Last</a></div>';
            }
        }
    	
    	return view('index', compact('list', 'pagebar', 'keyword'));
    }

    // 用户PK
    public function pk()
    {
    	$member_home = Member::orderBy('score', 'DESC')->first();
    	$member_away = Member::orderBy('score', 'ASC')->first();
    	// PK过程略...
    	// 默认胜方 积分+20，负方不扣分
    	
    	
    	// 假如member_home胜
    	$old_home = $member_home->id.'_'.$member_home->nickname.'_'.$member_home->score.'_'.$member_home->count.'_'.$member_home->win_count.'_'.$member_home->lose_count.'_'.$member_home->draw_count;
        // 删除天梯
        remRank($old_home);

		$member_home->count     += 1;
		$member_home->win_count += 1;
		$member_home->score     += 20;
		$member_home->save();
    	$new_home = $member_home->id.'_'.$member_home->nickname.'_'.$member_home->score.'_'.$member_home->count.'_'.$member_home->win_count.'_'.$member_home->lose_count.'_'.$member_home->draw_count;
    	// 添加天梯
    	addRank($new_home, $member_home->score);

    	$old_away = $member_away->id.'_'.$member_away->nickname.'_'.$member_away->score.'_'.$member_away->count.'_'.$member_away->win_count.'_'.$member_away->lose_count.'_'.$member_away->draw_count;
        // 删除天梯
        remRank($old_away);
		$member_away->count      += 1;
		$member_away->lose_count += 1;
		$member_away->save();
    	$new_away = $member_away->id.'_'.$member_away->nickname.'_'.$member_away->score.'_'.$member_away->count.'_'.$member_away->win_count.'_'.$member_away->lose_count.'_'.$member_away->draw_count;
    	// 添加天梯
    	addRank($new_away, $member_away->score);
    }

    // 测试清除redis
    public function clear()
    {
        // Redis::flushDB();
    }
}
