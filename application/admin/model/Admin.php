<?php
// 为分页提供无需填写内容
namespace app\admin\model;
use think\Model;
use think\Db;
class Admin extends Model
{
	public function login($data)
	{
		$user=Db::name('admin')->where('username',"=",$data['username'])->find();
		if($user){
			if($user['password'] == md5($data['password'])){
				session('username',$user['username']);
				session('id',$user['id']);
				return 3;
			}else{
				return 2;
			}
		}else{
			return 1;
		}
	}
}