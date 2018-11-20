<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\lib\Upload;

class Image extends Base
{
	public function upload0() {
		$file = Request::instance()->file('file');
		$info = $file->move('upload');

		if($info && $info->getPathname()) {
			$changPathSprit = str_replace('\\','/',$info->getPathname()); //把\转化成/
			$data = [
				'status' => 1,
				'message' => 'OK',
				'data' =>'../../../'.$changPathSprit,
			];
			echo json_encode($data);exit;
		}

		echo json_encode (['status' => 0,'message' => '上传失败']);
	}

	public function upload() 
	{
		try{
			$image = Upload::image();
		}catch(\Execption $e){
			echo json_encode(['status' => 0, 'message' => $e->getMessage()]);
		}

		if($image) {
			$data = [
				'status' => 1,
				'message' => 'OK',
				'data' => config('qiniu.image_url').'/'.$image,
			];
			echo json_encode($data);exit;
		}else{
			echo json_encode (['status' => 0,'message' => '上传失败']);
		}
	}
}