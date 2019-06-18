<?php
namespace app\admin\controller;
use think\Controller;
// use app\admin\model\Tags as TagsModel;
// use think\Db;
class Tags extends Controller
{
	public function lst()
	{
		// 分页呈现 每页显示3条数据
		$list=db('tags')->paginate(3);
		//分配到Tags模板中
		$this->assign('list',$list);


		return $this->fetch();
	}

	//接收add中表单请求
	public function add()
	{
		if (request()->isPost()) {
			
			$data=[
				'tagname'=>input('tagname'),
			];
			$validate = \think\Loader::validate('Tags');
			//应用验证场景
			if (!$validate->scene('add')->check($data)) {
				return $this->error($validate->getError());
				die;
			}

			if (db('tags')->insert($data)) {
				return $this->success('添加标签成功','lst');
			}else
			{
				return $this->error('添加失标签败');
			}
			return;
		}
		return $this->fetch();
	}

//编辑标签
	public function edit(){
		$id=input('id');
		//获取一条数据
		$Tags=db('tags')->find($id);
		if(request()->isPost()){
			$data=[
				'id'=>input('id'),
				'tagname'=>input('tagname'),
			];

				$validate = \think\Loader::validate('Tags');
				//应用验证场景
				if (!$validate->scene('edit')->check($data)) {
					return $this->error($validate->getError());
					die;
				}

			if(db('tags')->update($data)){
				$this->success('修改标签信息成功','lst');
			}else{
				$this->error('修改标签失败');
			}
			//加一个return就不会往下执行
			return;
		}
		
		//必须分配到模板之中
		$this->assign('Tags',$Tags);
		return $this->fetch();
	}

//删除标签操作
	public function del()
	{
		$id=input('id');
	
		if(db('tags')->delete(input('id')))
		{
			$this->success('删除标签成功','lst');
		}else{
			$this->error('删除标签失败');
		}

}	
}