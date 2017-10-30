<?php

/**
 * 独自のヘルパー
 * よく使うメソッドをまとめただけ
 */

use Carbon\Carbon;

/**
 * 現在のURLがアクティブかどうかを判定して、アクティブの場合にCSSのクラスを返すメソッド
 *
 * @param type $url
 * @param type $string
 * @return type
 */
function isActiveUrl($url, $string = 'active')
{
    return \Illuminate\Support\Facades\Request::is($url) ? $string : '';
}

/**
 * 今日の日付を返すメソッド
 * 引数がtrueだったらカーボンのオブジェクトを返す。引数なし、またはfalseだったら日付 'Y-m-d' を返す
 *
 * @param type $bool
 * @return type
 */
function getTodayDate($bool = true)
{
    $today = Carbon::now();
    if ($bool == false) {
        $today = Carbon::now()->toDateString();
    }
    return $today;
}

/**
 * 'Y年m月d日'の形式のデータを'Y-m-d'に変換するメソッド
 *
 * @param $date
 * @return string
 */
function getStdDateFromJa($date)
{
    return Carbon::createFromFormat('Y年m月d日', $date)->toDateString();
}

/**
 * 'Y/m/d'の形式のデータを'Y-m-d'に変換するメソッド
 *
 * @param $date
 * @return string
 */
function getStdDate($date)
{
    return Carbon::createFromFormat('Y/m/d', $date)->toDateString();
}

/**
 * 'Y/m/d H:i'の形式のデータを'Y-m-d H:i'に変換するメソッド
 *
 * @param $date
 * @return string
 */
function getStdDateTimeFromNormal($date)
{
    return Carbon::createFromFormat('Y/m/d H:i', $date)->toDateTimeString();
}

/**
 * 'Y-m-d'の形式のデータを'Y年m月d日'に変換するメソッド
 *
 * @param $date
 * @return string
 */
function getJaDate($date)
{
    return date('Y年m月d日', strtotime($date));
}