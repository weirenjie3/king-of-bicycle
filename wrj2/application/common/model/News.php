<?php

namespace app\common\model;
use think\Model;

class News extends Base {
	public function getNews($data = []){
			$data['status'] = [
				'neq' , config('code.status_delete')
			];

			$order = ['id' => 'desc'];

			$result = $this->where($data)->order($order)->paginate();

			return $result;
	}
}