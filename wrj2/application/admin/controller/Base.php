<?php

namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
	public function _initialize() {
		$isLogin = $this->isLogin();
		if(!$isLogin){
			return $this->redirect('Login/index');
		}
	}

	public function isLogin() {
		$user = session(config('admin.session_user'),'',config('admin.session_user_scope'));
		if($user && $user->id){
			return true;
		}
		return false;
	}
}