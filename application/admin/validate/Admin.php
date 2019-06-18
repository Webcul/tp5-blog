<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate
{
	//书写验证规则   验证字段=>规则
	//require为必填字段
	protected $rule = [
		'username'=>'require|max:25|unique:admin',
		'password'=>'require',
	];

	//错误提示
	protected $message = [
		'username.require' => '管理员名称必须填写',
		'username.unique' => '管理员已存在',
		'username.max' => '管理员名称长度不得大于25位',
		'password.require' => '管理员密码必须填写',
	];

	//验证场景
	//注意：场景需要应用才能生效
	protected $scene = [
		//进行添加时只验证username
		//'username'=>'require' 添加操作username只验证require
		'add' => ['username'=>'require|unique:admin','password'],
		//编辑操作不需要验证密码
		'edit' => ['username'=>'require|unique:admin'],
	];
}
