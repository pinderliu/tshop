<?php
namespace app\admin\model;
use think\Model;

class User extends Model{
    protected $pk = 'user_id';
    protected $autoWriteTimestamp = true;

    //所谓钩子事件
    protected static function init(){
		//在这里可以定义一个增删改查的前后数据
		//语法： 类名::event('事件名',function($user){});
		//入库的前事件
		User::event("before_insert",function($user){
			//参数$user：是即将要入库的当前模型的数据对象（相当于要入库的一条记录）
			//入库前，可以对此对象中表的字段进行篡改，如对密码进行md5加密
			/*dump($user['password']);
			dump($user->password);*/
			$user['password'] = md5($user['password'].config('password_salt'));
			//dump($user);
			//return false;
			//当前事件return false，不会真正写入数据库，相当于save返回false
		});

	}
}