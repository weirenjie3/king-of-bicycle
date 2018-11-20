<?php
namespace app\admin\controller;
use think\Controller;
use app\common\lib\IAuth;

class Login extends Base
{
	public function _initialize() {
	}	
	
	public function index()
	{
		$isLogin = $this->isLogin();
		if($isLogin){
			return $this->redirect('index/index');
		}else{
			return $this->fetch();
		}
	}

	public function check()
	{
		if(request()->isPost()){
			$data = input('post.');
			$validate = validate('AdminUser');
			if(!$validate->check($data)){
				$this->error($validate->getError());
			}

			if(!captcha_check($data['code'])){
				$this->error('验证码不正确');
			}
			try{
				$user = model('AdminUser')->get(['username' => $data['username']]);
			}catch(\Exception $e){
				$this->error($e->getMessage());
			}
			if(!$user || $user->status != config('code.status_normal')){
				$this->error('该用户不存在');
			}

			if(IAuth::setPassword($data['password']) != $user['password']){
				$this->error('密码不正确');
			}

			$udata = [
				'last_login_time' => time(),
				'last_login_ip' => request()->ip(),
			];

			try{
				model('AdminUser')->save($udata, ['id' => $user->id]);
			}catch(\Exception $e){
				$this->error($e->getMessage());
			}

			session(config('admin.session_user'),$user,config('admin.session_user_scope'));
            $this->success('登录成功', 'index/index');
		}
		else{
			$this->error('请求不合法');
		}
	}


    public function logout()
    {
    	session(null,config('admin.session_user_scope'));
    	$this->redirect('login/index');
    }
}