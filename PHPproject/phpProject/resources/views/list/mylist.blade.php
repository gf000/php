@extends('list.public')
@section('content')

<!--点击加号，弹出添加页面-->
<script type="text/javascript">
    
    function createwin(){
        window.open("/list/myList/create","newwindow", "height=500, width=500, top=300, left=300,toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, status=no");
    }

    function editwin($id){
        console.log($id);
        window.open("/list/myList/"+$id+"/edit","newwindow", "height=500, width=500, top=300, left=300,toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, status=no");
    }

    //layui.use(['form','layer'], function(){

    function listDel($id){
        layui.use(['layer'], function(){
        $=layui.jquery,
        layer=layui.layer,
        layer.confirm('Are you sure you want to delete it?',function(index){
            $.post('/list/myList/'+$id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){
                //console.log(data);
                if(data.status == 0){
                    location.reload();
                    layer.msg(data.message,{icon:6,time:8000});
                }else{
                    layer.msg(data.message,{icon:5,time:8000});
                }
            })
        });
        });
    }
</script>

<div>
    <!--添加待办列表部分-->
    <div style="margin-top:50px;margin-left:50px;margin-bottom:50px;margin-right:50px;width:350px;float:left;">
        <div class="layui-card" >
            <div class="layui-card-header" style="text-align:center;height:50px;font-size:large">
                Add a New TODO List
            </div>
            <div class="layui-card-body" style="text-align:center ;height:200px;" onclick="createwin()">
                <i class="layui-icon layui-icon-addition" style="font-size: 150px; color:#009688;position:relative;top:80px"></i>
            </div>
        </div>  
    </div>
  
    <!--显示已有待办清单列表-->
    @foreach ($mylists as $mylist)
    <div style="margin-top:50px;margin-left:50px;margin-bottom:50px;margin-right:50px;width:350px;float:left;">
        <div class="layui-card" >
            <div class="layui-card-header" style="text-align:center;height:50px;font-size:large">
                {{$mylist->title}}
            </div>
            <div class="layui-card-body" style="text-align:center;height:200px">
                <!--备注部分-->
                <div style="text-align:center;height:70px;font-size:15px;">
                    {{$mylist->comment}}
                </div>

                <!--进度条-->
                <div class="layui-progress layui-progress-big" lay-showPercent="yes" >
                    <div class="layui-progress-bar layui-bg-cyan" lay-percent="50%"></div>
                </div>
                <div style="margin-bottom:10px;">degree of completion</div>
                
                <!--查看按钮-->
                <button type="button" class="layui-btn" onclick="location.href='/list/task/'+{{$mylist->list_id}}">
                    <i class="layui-icon">&#xe705;</i>View
                </button>

                <!--修改按钮-->
                
                <button type="button" class="layui-btn" onclick="editwin({{$mylist->list_id}})" >
                    <i class="layui-icon">&#xe642;</i>Edit
                </button>
                

                <!--删除按钮-->
                <button type="button" class="layui-btn" onclick="listDel({{$mylist->list_id}})">
                    <i class="layui-icon">&#xe640;</i>Delete
                </button>
            </div>
        </div>  
    </div>
    <!--<p>{{$mylist->title}}</p>-->

    
    @endforeach

</div>

<script>
//注意进度条依赖 element 模块，否则无法进行正常渲染和功能性操作
layui.use('element', function(){
  var element = layui.element;
});
</script>



    
        
    
@endsection