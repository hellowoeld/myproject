<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

//后台登录
Route::get('/admin_login','loginController@admin');
Route::get('/admin_login/code','loginController@code');
Route::post('/admin_login/dologin','loginController@doalogin');

//前台登录
Route::get('/home_login','loginController@home');
//执行登录
Route::post('/home_login/dologin','loginController@dohlogin');
//注销
Route::get('/home_login/delete','loginController@delete');
//忘记密码
Route::get('/home/forgot','loginController@forgot');


//后台路由

Route::group(['prefix'=>'admin','namespace'=>'admin','middleware'=>'admin_login'],function(){

	//后台主页
	Route::get('/index','adminController@index');
	//注销
	Route::get('/exit','adminController@exit');


	//用户管理
	Route::resource('/user','userController');

	//修改管理员密码
	Route::get('/center/password','centerController@password');
	Route::post('/center/dopassword','centerController@dopassword');
	//修改头像
	Route::get('/center/profile','centerController@profile');
	Route::post('/center/up','centerController@up');
	Route::post('/center/doprofile','centerController@doprofile');


	//管理员
	Route::resource('/admin_user','admin_userController');


	//子分区管理
	Route::resource('/typeSon','typeSonController');
	//分区管理
	Route::resource('/type','typeController');



	//用户上传
		//待审核
	Route::resource('/userup','UserUpController');
		//已通过
	Route::resource('/userguo','UserGuoController');
		//播放
	Route::get('/play/{id}','PlayController@index');

	//网站配置
	Route::resource('/config','configController');

	//友情链接
	Route::resource('/friendlink','friendlinkController');

	//后台视频管理
	Route::get('/videoa','VideoaController@index');
	Route::get('/videos','VideoaController@shan');
	Route::resource('/videochuan','VideoaController');
	Route::get('/video/huishou','VideoaController@huishou');
	Route::get('/video/del/{id}','VideoaController@delete');
	Route::get('/video/upload/{id}','VideoaController@upload');
	Route::resource('/video','VideoController');

});

//前台主页
Route::get('/','homeController@index');
	
//前台路由
Route::group(['prefix'=>'home','namespace'=>'home'],function(){

	//视频遍历
	Route::get('/video/{id}','videoController@video');
	Route::get('/type/{id}','videoController@type');


	//视频播放
	Route::get('/play/{id}','videoController@play');

	//用户评论
	Route::post('/discuss','videoController@discuss');
	Route::post('/user_discuss','videoController@user_discuss');

	//用户视频播放
	Route::get('/user_play/{id}','videoController@user_play');


	//用户注册
		//发送验证码
	Route::get('/register','registerController@register');
		//用户注册,存入数据库
	Route::post('/regis','registerController@store');
		//验证手机号是否已经注册
	Route::get('/regs','registerController@tell');
		//验证输入的验证码和发送的是否一致
	Route::get('/reg','registerController@code');
	//验证码
	Route::get('/center/yzm','centerController@yzm');

	//执行忘记密码
	Route::post('/forgot','centerController@forgot');
	//执行更改密码
	Route::post('/center/repass','centerController@repass');

	//搜索
	Route::get('/search','searchController@index');
 });

//前台路由
Route::group(['prefix'=>'home','namespace'=>'home','middleware'=>'home_login'],function(){


//前台个人中心
Route::get('/center','centerController@index');
//修改手机号
Route::get('/center/tel','centerController@tel');
//联系我们
Route::get('/center/service','centerController@service');
//关于我们
Route::get('/center/about','centerController@about');
//修改密码
Route::get('/center/password','centerController@password');
//历史记录
Route::get('/center/history','centerController@history');
//删除历史记录
Route::get('/center/delete/{id}','centerController@delete');
//修改个人中心
Route::post('/center/update','centerController@update');
//执行更换手机号
Route::post('/center/yzmUpdate','centerController@yzmUpdate');
//执行更改密码
Route::post('/center/repass','centerController@repass');
//用户上传
Route::get('/center/up','centerController@up');
//vip开通
Route::get('/center/vip','centerController@vip');
//执行vip开通
Route::get('/center/doVip','centerController@doVip');
//购买视频页面
Route::get('/center/money/{id}','centerController@money');
//执行购买
Route::get('/center/buy','centerController@buy');

//用户上传视频
Route::resource('/up','UpController');
//上传到七牛云
Route::resource('/picchuan','VideoaController');
//用户提交上传到数据库
Route::resource('/videos','ShangController');
});



