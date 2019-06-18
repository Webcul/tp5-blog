<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Article as ArticleModel;
// use think\Db;
class Article extends Controller
{
	public function lst()
	{
		// 分页呈现 每页显示3条数据
		// $list=ArticleModel::paginate(3);
		$list=db('article')->alias('a')->join('cate c','c.id=a.cateid')->field('a.id,a.title,a.author,a.state,c.catename')->paginate(3);
		//分配到Article模板中
		$this->assign('list',$list);


		return $this->fetch();
	}

	//接收add中表单请求
	public function add()
	{
		if (request()->isPost()) {
			// dump($_POST);die;
			$data=[
				'title'=>input('title'),
				'author'=>input('author'),
				'desc'=>input('desc'),
				'keywords'=>str_replace('，', ',', input('keywords')),
				'content'=>input('content'),
				'cateid'=>input('cateid'),
				'time'=>time(),
			];
			if(input('state')=='on')
			{
				$data['state']=1;
			}

			$validate = \think\Loader::validate('Article');
			//应用验证场景
			if (!$validate->scene('add')->check($data)) {
				return $this->error($validate->getError());
				die;
			}

			if (db('article')->insert($data)) {
				return $this->success('添加文章成功','lst');
			}else
			{
				return $this->error('添加失文章败');
			}
			return;
		}
		$cateres=db('cate')->select();
		$this->assign('cateres',$cateres);
		return $this->fetch();
	}

//编辑文章
	public function edit(){
		$id=input('id');
		//获取一条数据
		$Articles=db('article')->find($id);
		if(request()->isPost()){
			$data=[
				'id'=>input('id'),
				'title'=>input('title'),
				'author'=>input('author'),
				'desc'=>input('desc'),
				'keywords'=>str_replace('，', ',', input('keywords')),
				'content'=>input('content'),
				'cateid'=>input('cateid'),
			];

			if(input('state')=='on')
			{
				$data['state']=1;
			}else{
				$data['state']=0;
			}

			

			if(db('article')->update($data)){
				$this->success('修改文章信息成功','lst');
			}else{
				$this->error('修改文章失败');
			}
			//加一个return就不会往下执行
			return;
		}
		
		//必须分配到模板之中
		$this->assign('Articles',$Articles);
		$cateres=db('cate')->select();
		$this->assign('cateres',$cateres);
		return $this->fetch();
	}

//删除文章操作
	public function del()
	{
		$id=input('id');
	
		if(db('article')->delete(input('id')))
		{
			$this->success('删除文章成功','lst');
		}else{
			$this->error('删除文章失败');
		}

}	
}