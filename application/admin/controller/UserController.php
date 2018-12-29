<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;
// use think\Db;
class UserController extends Controller{

    // public function add(){
    //     //四步
    //     //1、判断post请求
    //     if(request()->isPost()){
    //         //2、接收参数
    //         $postData = input('post.');
    //         //3、验证器验证
    //         $result = $this->validate($postData,"User.add",[],true);
    //         if($result!==true){
    //             $this->error(implode(',',$result));
    //         }
    //         //4、写入数据库
    //         $userModel = new User();
    //         if($userModel->save($postData)){
    //             $this->success('新增成功');
    //         }else{
    //             $this->error('新增失败');
    //         }
    //     }
    //     return $this->fetch();
    // }
    public function index(){
        return $this->fetch();
    }
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
            $addModel = new User;
            if($addModel->save($data)){
                return json(['error'=>0,'msg'=>'添加成功！']);
            }else{
                return json(['error'=>1,'msg'=>'添加失败！please again!']);
            }
            
            
            
        }
    }
    public function reg($username,$password,$repassword){
        if($username == '123'){
            return json("ajax成功！".$username."---".$password."---".$repassword);
        }else{
            return json("你输出的是其他值：".$username."---".$password."---".$repassword);
        }
    }
}