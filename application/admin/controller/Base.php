<?php
namespace app\admin\controller;
use think\Controller;
// use think\Db;
class Base extends Controller
{
	//初始化函数：最先执行
	public function _initialize(){
		if(!session('username')){
			$this->error('请登录','login/index');
		}

	}
}