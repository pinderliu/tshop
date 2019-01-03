<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;

class UserController extends Controller{

    //后台用户页面渲染
    public function index(){
        $usersData = User::order('create_time','desc')->select();//原本是$usersData = User::select();其中，order('create_time','desc')->是按照创建时间倒序排列，原来Db操作的可以直接丢在这里，牛逼了

        return $this->fetch('',[
            'usersData' => $usersData
        ]);
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
            // $data['password'] = md5($data['password'].config('password_salt'));//入库前md5加密，再拼接一个系统文件app.php中预设的字段，现在注释了，因为把它放在前钩子里面
            if($addModel->allowField(true)->save($data)){//allowField(true)这句是TP5.1里面的过滤数据表中不存在的字段，之前不加也行，我自己都忘了是怎么操作的。印象中是有出现过数据表repassword不存在的错误，怎么解决的我想不起来了。。。
                $info = User::order('create_time','desc')->limit(1)->select();//这一行是搜索数据库表里面的数据，然后倒序的一条limit(1)，如果两条就是limit(2)，找到之后也放在json返回的数据里面，就是下面的'info'=>"$info"

                return json(['error'=>0,'msg'=>'添加成功！','info'=>"$info"]);
            }else{
                return json(['error'=>1,'msg'=>'添加失败！please again!']);
            }
        }
    }
										
    
    
}