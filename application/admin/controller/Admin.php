<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin as AdminModel;
// use think\Db;
class Admin extends Controller
{
	public function lst()
	{
		// 分页呈现 每页显示3条数据
		$list=AdminModel::paginate(3);
		//分配到Admin模板中
		$this->assign('list',$list);


		return $this->fetch();
	}

	//接收add中表单请求
	public function add()
	{
		if (request()->isPost()) {
			
			$data=[
				'username'=>input('username'),
				'password'=>md5(input('password')),
			];
			$validate = \think\Loader::validate('Admin');
			//应用验证场景
			if (!$validate->scene('add')->check($data)) {
				return $this->error($validate->getError());
				die;
			}

			if (db('admin')->insert($data)) {
				return $this->success('添加成功','lst');
			}else
			{
				return $this->error('添加失败');
			}
			return;
		}
		return $this->fetch();
	}

//编辑管理员
	public function edit(){
		$id=input('id');
		//获取一条数据
		$admins=db('admin')->find($id);
		if(request()->isPost()){
			$data=[
				'id'=>input('id'),
				'username'=>input('username'),
			];

			if(input('password')){
					$data['password']=md5(input('password'));
				}else{
					$data['password']=$admins['password'];
				}

				$validate = \think\Loader::validate('Admin');
				//应用验证场景
				if (!$validate->scene('edit')->check($data)) {
					return $this->error($validate->getError());
					die;
				}

			if(db('admin')->update($data)){
				$this->success('修改管理员信息成功','lst');
			}else{
				$this->error('修改管理员失败');
			}
			//加一个return就不会往下执行
			return;
		}
		
		//必须分配到模板之中
		$this->assign('admins',$admins);
		return $this->fetch();
	}

//删除管理员操作
	public function del()
	{
		$id=input('id');
		if ($id !=1)
		{
			if(db('admin')->delete(input('id')))
			{
				$this->success('删除管理员成功','lst');
			}else{
				$this->error('删除管理员失败');
			}

		}else{
			$this->error('初始管理员不能删除');
		}
	}

	public function logout()
	{
		session(null);
		$this->success('已掉线','login/index');
	}
}