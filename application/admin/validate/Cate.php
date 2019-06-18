<?php
namespace app\admin\validate;
use think\Validate;

class Cate extends Validate
{
	//书写验证规则   验证字段=>规则
	//require为必填字段
	protected $rule = [
		'catename'=>'require|max:25|unique:cate',
	];

	//错误提示
	protected $message = [
		'catename.require' => '栏目名称必须填写',
		'catename.max' => '栏目名称长度不得大于25位',
		'catename.unique' => '栏目已存在',
	];

	//验证场景
	//注意：场景需要应用才能生效
	protected $scene = [
		//进行添加时只验证catename
		//'catename'=>'require' 添加操作catename只验证require
		'add' => ['catename'=>'require|unique:cate'],
		//编辑操作不需要验证密码
		'edit' => ['catename'=>'require|unique:cate'],
	];
}
