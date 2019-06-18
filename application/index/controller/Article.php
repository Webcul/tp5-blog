<?php
namespace app\index\controller;
use app\index\controller\Base;
class Article extends Base
{
	public function index()
	{
		$arid=input('arid');
		$articles=db('article')->find($arid);
		$ralateres=$this->ralat($articles['keywords'],$articles['id']);
		//自增  数据库
		db('article')->where('id','=',$arid)->setInc('click');
		$cates=db('cate')->find($articles['cateid']);
		$recres=db('article')->where(array('cateid'=>$cates['id'],'state'=>1))->order('click desc')->limit(8)->select();
		$this->assign(array(
			'articles'=>$articles,
			'cates'=>$cates,
			'recres'=>$recres,
			'ralateres'=>$ralateres,
		));
		
		return $this->fetch('article');
	}

	//关键字匹配
	public function ralat($keywords,$id)
	{
		$arr=explode(',', $keywords);
		//定义一个静态数组
		static $ralateres=array();
		foreach ($arr as $k => $v) {
			//查询与keywords字段相匹配的
			$map['keywords']=['like','%'.$v.'%'];
			$map['id']=['neq',$id];
			//得到一个二维数组
			$artres=db('article')->where($map)->order('id desc')->limit(8)->select();
			//将信息合并到数组中
			$ralateres=array_merge($ralateres,$artres);
		}
		//去重   唯一性
		if($ralateres)
		{
			$ralateres=arr_unique($ralateres);
			return $ralateres;
		}
		
	}






}