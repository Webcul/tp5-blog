<?php
namespace app\admin\validate;
use think\Validate;

class Tags extends Validate
{
	//书写验证规则   验证字段=>规则
	//require为必填字段
	protected $rule = [
		'tagname'=>'require|max:25|unique:tags',
	];

	//错误提示
	protected $message = [
		'tagname.require' => '标签名称必须填写',
		'tagname.max' => '标签名称长度不得大于25位',
		'tagname.unique' => '标签已存在',
	];

	//验证场景
	//注意：场景需要应用才能生效
	protected $scene = [
		//进行添加时只验证tagname
		//'tagname'=>'require' 添加操作tagname只验证require
		'add' => ['tagname'=>'require|unique:tags'],
		//编辑操作不需要验证密码
		'edit' => ['tagname'=>'require|unique:tags'],
	];
}
