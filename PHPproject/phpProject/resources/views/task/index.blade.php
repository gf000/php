@extends('list.public')
@section('content')

<script type="text/javascript">
    
    function addTask($list_id){
        window.open("/list/task/create/"+$list_id,"newwindow", "height=500, width=500, top=300, left=300,toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, status=no");
    }

    function editTask($task_id){
        window.open("/list/task/edit/"+$task_id,"newwindow", "height=500, width=500, top=300, left=300,toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, status=no");
    }

    function taskDel($task_id){
        layui.use(['layer'], function(){
        $=layui.jquery,
        layer=layui.layer,
        layer.confirm('Are you sure you want to delete it?',function(index){
            $.post('/list/task/delete/'+$task_id,{"_token":"{{csrf_token()}}"},function(data){
                //console.log(data);
                if(data.status == 0){
                    //location.reload();
                    //$(obj).parent.remove();
                    //obj.parentNode.parentNode.remove();
                    document.getElementById($task_id).remove();
                    //document.getElementById("task"+$task_id).remove();
                    //item.remove();
                    layer.msg(data.message,{icon:6,time:5000});
                }else{
                    layer.msg(data.message,{icon:5,time:5000});
                }
            })
        });
        });
    }

    function delAll(){
        layui.use(['layer'], function(){
        $=layui.jquery,
        layer=layui.layer,
        layer.confirm('Are you sure you want to delete them all?',function(index){
            $.post('/list/task/deleteAll',{"_token":"{{csrf_token()}}"},function(data){
                //console.log("jinlaile");
                if(data.status == 0){
                    
                    $.each(data.task,function(index,value){                        
                        document.getElementById(value["task_id"]).remove();
                        document.getElementById(value["task_id"]).remove();
                    })
                    //document.getElementById(data.task).remove();
                    //location.reload();
                    //$(obj).parent.remove();
                    //obj.parentNode.parentNode.remove();
                    //document.getElementById("uncomplete").remove();
                    //document.getElementById("task"+$task_id).remove();
                    //item.remove();
                    layer.msg(data.message,{icon:6,time:5000});
                }else{
                    layer.msg(data.message,{icon:5,time:5000});
                }
            })
        });
        });
    }
    

    function complete($task_id){
        layui.use(['layer'], function(){
        $=layui.jquery,
        layer=layui.layer,
        
            $.post('/list/task/complete/'+$task_id,{"_token":"{{csrf_token()}}"},function(data){
                //console.log("jinlaile");
                if(data.status == 0){ //变成了未完成，删除打勾图标
                   
                    document.getElementById("icon"+$task_id).replaceChild("<i class='layui-icon' style='font-size: 30px; color: #1E9FFF;position:relative;left:-200px;width:100px;'> </i>");
                    //document.getElementById(data.task).remove();
                    //location.reload();
                    //$(obj).parent.remove();
                    //obj.parentNode.parentNode.remove();
                    //document.getElementById("uncomplete").remove();
                    //document.getElementById("task"+$task_id).remove();
                    //item.remove();
                    //.msg(data.message,{icon:6,time:5000});
                }else{
                    //layer.msg(data.message,{icon:5,time:5000});
                }
            })
        });
        
    }
    
</script>

<div class="layui-tab layui-tab-card" style="margin:100px;margin-top:50px;height:1000px;">
  <ul class="layui-tab-title">
    <li class="layui-this">All Tasks</li>
    <li>Only Current Tasks</li>
    <li>Only Completed Tasks</li>
  </ul>

   <!--显示选项卡内容-->
  <div class="layui-tab-content" style="height: 100px;">

    <!--显示所有task-->
    <div class="layui-tab-item layui-show">
        <div style="margin-top:50px;margin-left:300px">
        <button type="button" class="layui-btn layui-btn-radius" style="width:150px;margin-right:100px" onclick="addTask({{$list_id}})">
            <i class="layui-icon">&#xe608;</i> ADD
        </button>
        </div>

        @foreach ($tasks as $task)
        
        <div class="layui-bg-cyan" id="{{$task->task_id}}" style="position:relative;width:800px;height:50px;margin-left:250px;margin-top:50px;border-radius: 4px;font-size:15px;">
            
        

            <div style="position:relative;top:15px;left:20px;">{{$task->content}}</div>

            <div class="layui-btn-group" style="position:relative;left:650px;top:-15px">
                <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="complete({{$task->task_id}})">
                    <i class="layui-icon">&#xe605;</i>
                </button>

                <!--修改按钮-->
                <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="editTask({{$task->task_id}})">
                    <i class="layui-icon">&#xe642;</i>
                </button>

                <!--删除按钮-->>
                <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="taskDel({{$task->task_id}})">
                    <i class="layui-icon">&#xe640;</i>
                </button>
            </div>
            
            
           @if($task->complete == 1)
           
           <i class="layui-icon" id="icon{{$task->task_id}}" style="font-size: 30px; color: #1E9FFF;position:relative;left:-200px;width:100px;">&#x1005;</i>
     
           @endif

           @if($task->complete == 0)
           
           <i class="layui-icon" id="icon{{$task->task_id}}" style="font-size: 30px; color: #1E9FFF;position:relative;left:-200px;width:100px;"></i>
     
           @endif

        </div>
        @endforeach 
    </div>
    
    <!--显示未完成task-->
    <div class="layui-tab-item">
        <div style="margin-top:50px;margin-left:300px">
            <button type="button" class="layui-btn layui-btn-warm layui-btn-radius" style="width:150px;margin-right:100px">
                <i class="layui-icon">&#xe605;</i> Check Off All
            </button>
        </div>

        @foreach ($tasks as $task)
        @if($task->complete == 0)
        <div class="layui-bg-cyan" id="{{$task->task_id}}" style="position:relative;width:800px;height:50px;margin-left:250px;margin-top:50px;border-radius: 4px;font-size:15px;">
            <div style="position:relative;top:15px;left:20px;">{{$task->content}}</div>
            <div class="layui-btn-group" style="position:relative;left:650px;top:-7px">
                <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" >
                    <i class="layui-icon">&#xe605;</i>
                </button>
                <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="editTask({{$task->task_id}})">
                    <i class="layui-icon">&#xe642;</i>
                </button>
                <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="taskDel({{$task->task_id}})">
                    <i class="layui-icon">&#xe640;</i>
                </button>
            </div>
        </div>
        @endif
        @endforeach
    </div>

    <!--显示已完成task-->
    <div class="layui-tab-item" >
        <div class="layui-tab-item layui-show">
            <div style="margin-top:50px;margin-left:300px">
            <button type="button" class="layui-btn layui-btn-danger layui-btn-radius" style="width:150px;" onclick="delAll()">
                <i class="layui-icon">&#xe640;</i> Delete All
            </button>
        </div>

        @foreach ($tasks as $task)
        @if($task->complete == 1)
        <div class="layui-bg-cyan" id="{{$task->task_id}}" style="position:relative;width:800px;height:50px;margin-left:250px;margin-top:50px;border-radius: 4px;font-size:15px;">
            <div style="position:relative;top:15px;left:20px;">{{$task->content}}</div>
            <div class="layui-btn-group" style="position:relative;left:650px;top:-15px">
                <button type="button" class="layui-btn layui-btn-primary layui-btn-sm">
                    <i class="layui-icon">&#xe605;</i>
                </button>
                <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="editTask({{$task->task_id}})">
                    <i class="layui-icon">&#xe642;</i>
                </button>
                <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" onclick="taskDel({{$task->task_id}})">
                    <i class="layui-icon">&#xe640;</i>
                </button>
            </div>
            <i class="layui-icon" style="font-size: 30px; color: #1E9FFF;position:relative;left:-200px;width:100px;">&#x1005;</i>
        </div>
        @endif
        @endforeach 

    </div>
  </div>
</div>
 
<script>
//注意：选项卡 依赖 element 模块，否则无法进行功能性操作
layui.use('element', function(){
  var element = layui.element;
  
  //…
});
</script>

<!--<div style="margin-top:50px;margin-left:300px">
    <button type="button" class="layui-btn layui-btn-radius" style="width:150px;margin-right:100px">
      <i class="layui-icon">&#xe608;</i> ADD
    </button>

    <button type="button" class="layui-btn layui-btn-warm layui-btn-radius" style="width:150px;margin-right:100px">
      <i class="layui-icon">&#xe605;</i> Check Off All
    </button>

    <button type="button" class="layui-btn layui-btn-danger layui-btn-radius" style="width:150px;">
      <i class="layui-icon">&#xe640;</i> Delete All
    </button>
</div>



@foreach ($tasks as $task)
    <div class="layui-bg-cyan" style="position:relative;width:800px;height:50px;margin-left:250px;margin-top:50px;border-radius: 4px;font-size:15px;">
        <div style="position:relative;top:15px;left:20px;">{{$task->content}}</div>
        <div class="layui-btn-group" style="position:relative;left:650px;top:-7px">
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm">
            <i class="layui-icon">&#xe605;</i>
            </button>
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm">
            <i class="layui-icon">&#xe642;</i>
            </button>
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm">
            <i class="layui-icon">&#xe640;</i>
            </button>
</div>
    </div>


@endforeach

-->

@endsection