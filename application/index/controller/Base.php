<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Base extends Controller
{
	public function _initialize()
	{
		$this->right();
		$this->links();
		$cateres=Db::name('cate')->order('id desc')->select();
		$tagres=Db::name('tags')->order('id desc')->select();
    	$this->assign(array(
    		'cateres'=>$cateres,
    		'tagres'=>$tagres,
    	));
	}

	public function right()
	{
		$clickres=db('article')->order('click desc')->limit(8)->select();
		$tjres=db('article')->where('state','=',1)->order('click desc')->limit(8)->select();
		$this->assign(array(
			'clickres'=>$clickres,
			'tjres'=>$tjres,
		));
	}

	public function links()
	{
		$links=db('links')->order('id')->limit(8)->select();
		if($links){
			$this->assign(array(
			'links'=>$links,
		));
		}else{
			$this->assign(array(
			'links'=>'',
		));
		
	}
	}
}

