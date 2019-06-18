<?php
namespace app\admin\validate;
use think\Validate;

class Links extends Validate
{
	//书写验证规则   验证字段=>规则
	//require为必填字段
	protected $rule = [
		'title'=>'require|max:25|unique:links',
		'url'=>'require|unique:links',
	];

	//错误提示
	protected $message = [
		'title.require' => '链接名称必须填写',
		'title.max' => '链接名称长度不得大于25位',
		'title.unique' => '链接已存在',
		'url.require' => '链接地址必须填写',
		'url.unique' => '链接已存在',
	];

	//验证场景
	//注意：场景需要应用才能生效
	protected $scene = [
		//进行添加时只验证title
		//'title'=>'require' 添加操作title只验证require
		'add' => ['title'=>'require|unique:links','url|unique:links'],
		//编辑操作不需要验证密码
		'edit' => ['title|unique:links','url|unique:links'],
	];
}
