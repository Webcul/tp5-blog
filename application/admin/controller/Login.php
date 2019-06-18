<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller
{
	public function index()
	{
		if(request()->isPost()){
			$admin=new Admin();
			$data=input('post.');
			$num=$admin->login($data);
			if($num==3){
				$this->success('信息正确,正在跳转……','index/index');
			}else{
				$this->error('信息错误');
			}

		}
		return $this->fetch('login');
	}

}