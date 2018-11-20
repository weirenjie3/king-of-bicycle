<?php

namespace app\admin\controller;

use think\Controller;

class News extends Base
{
	public function index(){
		$news = model('News')->getNews();
		
		return $this->fetch('',[
			'news' => $news,
			'cats' => config('cat.lists')
		]);
	}

	public function add(){
		if(request()->isPost()){
			$data = input('post.');
			$validate = validate('AddNews');
			if(!$validate->check($data)){
				$this->error($validate->getError());
			}
			try{
				$id = model('News')->add($data);
			}catch(\Exception $e){
				return $this->result('',0,'新增失败');
			}
			if($id){
				return $this->result(['jump_url' => url('news/index')], 1, 'OK');
			}else{
				return $this->result('',0,'新增失败');
			}
		}
		else{
			return $this->fetch('',[
				'cats' => config('cat.lists')
			]);
		}
	}
}