<?php
namespace app\admin\validate;
use think\Validate;

class Article extends Validate
{
	//书写验证规则   验证字段=>规则
	//require为必填字段
	protected $rule = [
		'title'=>'require|max:25|unique:article',
		'cateid'=>'require',
	];

	//错误提示
	protected $message = [
		'title.require' => '文章名称必须填写',
		'title.max' => '文章名称长度不得大于25位',
		'title.unique' => '文章名重复',
		'cateid.require' => '请选择文章所属栏目',
	];

	//验证场景
	//注意：场景需要应用才能生效
	protected $scene = [
		//进行添加时只验证title
		//'title'=>'require' 添加操作title只验证require
		'add' => ['title'=>'require|unique:article','cateid'],
		//编辑操作不需要验证密码
		'edit' => ['title'=>'require|unique:article','cateid'],
	];
}
