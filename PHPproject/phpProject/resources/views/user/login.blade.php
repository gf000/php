<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"> 
        <title>landing Page</title>
        <link rel="stylesheet" type="text/css" href="{{asset('/layui/css/layui.css')}}">
        <script type="text/javascript" src="{{asset('layui/layui.js')}}"></script>
    </head>
    <style type="text/css">
        #left{
            float:left;
        }
        #right{
            float:right;
        }
        #logo{
            position:absolute;
            left:400px;
            top:150px;
        }
        #picture{
            position:absolute;
            left:1000px;
            top:70px;
        }
        input[type=text],input[type=password]{
            width:100%;
            padding:12px 20px;
            margin:8px 0;
            display:inline-block;
            border:1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit]{
            width:100%;
            background-color:rgb(10, 67, 104);;
            color: white;
            padding: 14px 20px;
            margin:30px 0;
            border:none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 20px;
        }
        input[type=submit]:hover {
            
            background-color:rgb(8, 47, 73);
        }
        #form{
            position:absolute;
            left:280px;
            top:300px;
            width: 300px;
            border-radius: 5px;
            /*background-color: blanchedalmond;*/
            padding:20px;
        }
        #saying{
            position:absolute;
            top:100px;
            left:1000px;
            width:500px;
            height:50px;
            background-color: rgb(134, 85, 49);
            color: white;
        }
        p{
            font-size:20px;
            font-weight: bold;
            position:relative;
            left:100px;
        }
        #errors{
            position:absolute;
            top:270px;
            left:300px;
            color:red;
            font:200px;
        }
        
        
    </style>
    <body>
        <div id="left">
            <img id="logo" src="{{URL::asset('/images/logo.jpg')}}" alt="logo" width="100" height="100">
            
                <!--错误信息显示-->
                <div id="errors">
                    <ul>
                        @if (is_object($errors))
                            @if (count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            @endif
                        @else
                            <li>{{$errors}}</li>
                        @endif
                    </ul>
                </div>        
                
            
            <div id=form >
                <form action="/user/doLogin" method="post" class="layui-form">
                    {{csrf_field()}}
                    <label for="nickname">Nickname</label>
                    <input class="layui-input" type="text" name="nickname" lay-verify="required">
                    <label for="password">Password</label>
                    <input type="password" name="password" lay-verify="required">
                    <input type="submit" lay-submit value="Log In">
                </form>
            </div>
        </div>
        <div id="right">
            <img id="picture" src="{{'/images/picture.jpg'}}" alt="picture" width="500" height="700">
            <div id="saying">
                <p>Truth never fears investigation</p>
            </div>
        </div>
    </body>
    <script>
layui.use('form', function(){
  var form = layui.form;
  
  //各种基于事件的操作，下面会有进一步介绍
});
</script>
</html>
<!--<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
    </head>
    <body>
        <form action="" method="post">
            nickname:<input type="text" name="nickname"><br>
            password:<input type="password" name="password"><br>
            <input type="submit" value="Login"><br>
        </form>
        <button type="button" onclick="location.href='/user/register'">Register</button>
    </body>
</html>-->

<?php
    /*
      <!--有后台表单验证的写法 -->
            <!--@if (count($errors) > 0)
                <div>
                    <ul>
                        @if (is_object($errors))
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        @else
                            <li>{{$error}}</li>
                        @endif
                    </ul>
                </div>        
            @endif-->
    */
?>