<?php 
namespace Admin\Controller;
use Think\Controller;

class UserController extends Controller
{
    // 后台首页
    public function index()
    {
        $data = M('adminusers')->select();
        $this->assign('data',$data);
        $this->assign('title','后台用户管理');
        $this->display();
    }

    // 执行添加操作
    public function insert()
    {
        if(empty($_POST)){
            $this->redirect('User/index');
            die;
        }
        $str = $this->check_verify(md5($_POST['verifyImg']));
        var_dump($_SESSION);var_dump($_POST['verifyImg']);var_dump($str); die;
        // 自动生成数据
        M('adminusers')->create();

        if( M('adminusers')->add() > 0) {
            $this->success('添加成功!',U('User/index'),3);
        } else{
            $this->error('添加失败!');
        }
    }

    public function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
}





