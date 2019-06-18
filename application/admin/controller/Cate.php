<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Cate as CateModel;
// use think\Db;
class Cate extends Controller
{
	public function lst()
	{
		// 分页呈现 每页显示3条数据
		$list=CateModel::paginate(3);
		//分配到Admin模板中
		$this->assign('list',$list);


		return $this->fetch();
	}

	//接收add中表单请求
	public function add()
	{
		if (request()->isPost()) {
			
			$data=[
				'catename'=>input('catename'),
			];
			$validate = \think\Loader::validate('Cate');
			//应用验证场景
			if (!$validate->scene('add')->check($data)) {
				return $this->error($validate->getError());
				die;
			}

			if (db('cate')->insert($data)) {
				return $this->success('添加成功','lst');
			}else
			{
				return $this->error('添加失败');
			}
			return;
		}
		return $this->fetch();
	}

//编辑栏目
	public function edit(){
		$id=input('id');
		//获取一条数据
		$cate=db('cate')->find($id);
		if(request()->isPost()){
			$data=[
				'id'=>input('id'),
				'catename'=>input('catename'),
			];

				$validate = \think\Loader::validate('Cate');
				//应用验证场景
				if (!$validate->scene('edit')->check($data)) {
					return $this->error($validate->getError());
					die;
				}
			if(db('cate')->update($data)){
				$this->success('修改栏目信息成功','lst');
			}else{
				$this->error('修改栏目失败');
			}
			//加一个return就不会往下执行
			return;
		}
		
		//必须分配到模板之中
		$this->assign('cate',$cate);
		return $this->fetch();
	}

//删除栏目操作
	public function del()
	{
		$id=input('id');
		
		if(db('cate')->delete(input('id')))
		{
			$this->success('删除栏目成功','lst');
		}else{
			$this->error('删除栏目失败');
		}

	}
}