<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    //执行用户添加操作
    public function store(Request $request){
        //1.获取客户端提交的表单数据
        $input = $request->except('_token');
        //dd($input);
        //给密码加密
        $input['password'] = md5($input['password']);
        //2.表单验证

        //3.添加操作
        $result = User::create(['nickname'=>$input['nickname'],'email'=>$input['email'],'password'=>$input['password']]);
        if ($result){
            //或者可以直接跳转到用户主界面，不用跳转到登录界面了
            //……………………………………………………
            return redirect ('/user/login');
        }else{
            return back();
        }
    }


    //用户登录
    public function doLogin(Request $request){
        
        //1 接收登录提交的表单数据
        $input = $request->except('_token');

        //后台进行表单验证
        $rule=[
            'nickname' => 'required',
            'password' => 'required'
        ];
        
        $validator = Validator::make($input,$rule);

        if($validator->fails()){
            return redirect('user/login')
                         ->withErrors($validator)
                         ->withInput();
        }

        //验证数据库中是否有此用户
        $user = User::where('nickname',$input['nickname'])->first();

        if(!$user){
            return redirect('user/login')->with('errors','The entered nickname does not exist');
        }
        if(md5($input['password']) != $user->password){
            return redirect('user/login')->with('errors',"Incorrect password entry");
        }

        //保存用户
        session()->put('user',$user);
        

        //跳转到用户个人主页
        return redirect('list/index');
    }

    //用户登出
    public function logout(){
        //清空session中的用户信息
        session()->flush();
        //跳转到登陆页面
        return redirect('user/login');
    }
}
