<?php

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
