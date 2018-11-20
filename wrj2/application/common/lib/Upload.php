<?php

namespace app\common\lib;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class Upload{
	public static function image() 
	{
		if(empty($_FILES['file']['tmp_name'])){
			exception('您提交的数据不合法',404);
		}
		// $filePath = $__FILES['file']['tmp'];
		// $ext = explode('.',$__FILES['file']['name']);
		// $ext = $ext[1];

		$pathinfo = pathinfo($__FILES['file']['tmp']);
		$ext = $pathinfo['extension'];

		$config = config('qiniu');

		$auth = new Auth($config['ak'],$config['sk']);

		$token = $auth->uploadToken($config['bucket']);

		$key = date('Y').'/'.date('m').'/'.substr(md5($file),0,5).date('YmdHis').rand(0,9999).'.'.$ext;

		$uploadMgr = new UploadManager();

		list($ret, $err) = $uploadMgr->putFile($token, $key, $file);

		if($err !== null) {
			return null;
		}else{
			return $key;
		}
	}


}