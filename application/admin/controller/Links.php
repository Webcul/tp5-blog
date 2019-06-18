<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Links as LinksModel;
// use think\Db;
class Links extends Controller
{
	public function lst()
	{
		// 分页呈现 每页显示3条数据
		$list=LinksModel::paginate(3);
		//分配到Links模板中
		$this->assign('list',$list);


		return $this->fetch();
	}

	//接收add中表单请求
	public function add()
	{
		if (request()->isPost()) {
			
			$data=[
				'title'=>input('title'),
				'url'=>input('url'),
				'desc'=>input('desc'),
			];
			$validate = \think\Loader::validate('Links');
			//应用验证场景
			if (!$validate->scene('add')->check($data)) {
				return $this->error($validate->getError());
				die;
			}

			if (db('links')->insert($data)) {
				return $this->success('添加链接成功','lst');
			}else
			{
				return $this->error('添加失链接败');
			}
			return;
		}
		return $this->fetch();
	}

//编辑链接
	public function edit(){
		$id=input('id');
		//获取一条数据
		$Linkss=db('links')->find($id);
		if(request()->isPost()){
			$data=[
				'id'=>input('id'),
				'title'=>input('title'),
				'url'=>input('url'),
				'desc'=>input('desc'),
			];

				$validate = \think\Loader::validate('Links');
				//应用验证场景
				if (!$validate->scene('edit')->check($data)) {
					return $this->error($validate->getError());
					die;
				}

			if(db('links')->update($data)){
				$this->success('修改链接信息成功','lst');
			}else{
				$this->error('修改链接失败');
			}
			//加一个return就不会往下执行
			return;
		}
		
		//必须分配到模板之中
		$this->assign('Linkss',$Linkss);
		return $this->fetch();
	}

//删除链接操作
	public function del()
	{
		$id=input('id');
	
		if(db('links')->delete(input('id')))
		{
			$this->success('删除链接成功','lst');
		}else{
			$this->error('删除链接失败');
		}

}	
}