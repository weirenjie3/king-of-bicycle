<?php
namespace app\common\validate;

use think\Validate;

class AddNews extends Validate
{
	protected $rule = [
		'title' => 'require|max:25',
		'small_title' => 'require|max:10',
		'catid' => 'require|max:10',
		'description' => 'require|max:200',
		'is_allowcomments' => 'accepted',
		'is_head_figure' => 'accepted',
		'is_position' => 'accepted',
		'image' => 'image',
		'content' => 'require',
	];
}