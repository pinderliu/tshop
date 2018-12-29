<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;

class UserController extends Controller{

    //后台首页渲染
    public function index(){
        return $this->fetch();
    }

    //后台用户列表页面的用户添加功能：ajax添加和状态反馈，ajax一定要返回json数据
    public function ajaxAddUser(){
        //四步
        //1、判断ajax请求
        if(request()->isAjax()){
            //2、接收参数
            $_data = input('post.');
            $data = array();
            foreach ($_data as $k => $v) {
                $data[$k]=trim($v);
            }
            //3、验证器验证：
            $result = $this->validate($data,"User.ajaxAddUser",[],true);
            if(true !== $result){
                $msg = $this->error(implode(',',$result));//用","号炸开
                return json(['error'=>2,'msg'=>"$msg"]);
                // dump ($msg);//只有这个dump可以看到反馈的数据，console.log和var_dump都不行，估计echo也一样，会报错：Array to string conversion（大概意思是你的数据是一个数组，展示用的那个函数展示不出来）
            }
            //4、入库
            $addModel = new User;
            if($addModel->save($data)){
                return json(['error'=>0,'msg'=>'添加成功！']);
            }else{
                return json(['error'=>1,'msg'=>'添加失败！please again!']);
            }   
        }
    }
    
}