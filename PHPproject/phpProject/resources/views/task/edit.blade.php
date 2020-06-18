<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
  <title>Create a new TODO list</title>
  <link rel="stylesheet" type="text/css" href="{{asset('/layui/css/layui.css')}}">
  <script type="text/javascript" src="{{asset('/layui/layui.js')}}"></script>

  <style type="text/css">
      html body{
          background-color: #e2e2e2;
      }
  </style>
</head>
<body>

<form class="layui-form" action="/list/task/update" method="post">
  {{csrf_field()}}
  <input type="hidden" name="task_id" value="{{$task->task_id}}">
  <div class="layui-form-item" style="margin:50px;">
    <label class="layui-form-label">Content</label>
    <div class="layui-input-block">
      <input type="text" name="content" required  lay-verify="required" value="{{$task->content}}" autocomplete="off" class="layui-input">
    </div>
  </div>
  
  <div class="layui-form-item">
    <div class="layui-input-block" style="position:relative;left:15%;">
      <button class="layui-btn" lay-submit="" lay-filter="edit">Save</button>
      <button type="reset" class="layui-btn layui-btn-primary">Reset</button>
    </div>
  </div>
</form>

<script type="text/javascript" scr="ajax.js">
    //var form = document.form;
  layui.use(['form','layer'], function(){
    $=layui.jquery,
    layer=layui.layer,
    form = layui.form,
    
    //各种基于事件的操作，下面会有进一步介绍
    form.on('submit(edit)', function(data){
        var task_id=$("input[name='task_id']").val();
        $.ajax({
        type:'POST',
        url:'/list/task/update/'+task_id,
        dataType:'json',
        data:data.field,
        success:function(data){
            //弹层提示添加成功，并刷新父页面
            if(data.status == 0){
                layer.alert(data.message,{icon:6},function(){
                    window.opener.location.reload();
                    window.close();
                })
            }else{
                layer.alert(data.message,{icon:5});
            }
        },
        error:function(){

        }
    });
    return false;
});
});
</script>
 


</body>
</html>