<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// Route::get('think', function () {
//     return 'hello,ThinkPHP5!';
// });

// Route::get('hello/:name', 'index/hello');

// return [

// ];



// 以上为tp5.1原本的东西

// use think\Route;
Route::get('/','admin/index/index');
Route::get('admin/index/index','admin/index/index');

//后台路由分组
Route::group('admin',function(){
    Route::rule('/user/index','admin/user/index');
    Route::rule('/user/add','admin/user/add');
    Route::rule('/user/ajaxAddUser','admin/user/ajaxAddUser');
    Route::rule('/user/reg','admin/user/reg');

});


