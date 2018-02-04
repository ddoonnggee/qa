<?php
use Illuminate\Support\Facades\Redis;

if (! function_exists('strbool')) {
    /**
     * 转换boolen成字符串
     *
     * @param  boolen  $value
     * @return string
     */
    function strbool($value)
    {
        return $value ? 'true' : 'false';
    }
}

if (! function_exists('remRank')) {
    /**
     * 删除排名
     */
    function remRank($value)
    {
        Redis::zRem("member_rank", $value);
    }
}

if (! function_exists('addRank')) {
    /**
     * 添加
     */
    function addRank($value, $score)
    {
        Redis::zAdd("member_rank", $score, $value);
    }
}