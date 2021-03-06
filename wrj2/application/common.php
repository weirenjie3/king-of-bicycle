<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function pagination($obj) {
	if(!$obj){
		return '';
	}

	$params = request()->param();
	return '<div class="imooc-app">'.$obj->appends($params)->render().'</div>';
}

function getCatName($catId) {
	if(!$catId){
		return '';
	}
	$cats = config('cat.lists');

	return !empty($cats[$catId]) ? $cats[$catId] : '';
}

function isYesNo($str){
	return $str ? '<span style="color:red">是</span>' : '<span>否</span>';
}