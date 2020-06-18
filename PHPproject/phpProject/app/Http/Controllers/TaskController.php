<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    //
    public function index($list_id)
    {
        
        $user=session()->get('user'); 
        //$mylists = User::find($user['id'])->contacts();
        //$mylists = User::find(1)->contacts();
        $tasks = DB::table('task')
                      ->select('task.*')
                      ->where('list_id',$list_id)
                      ->get();
        return view('task.index',['tasks'=>$tasks,'list_id'=>$list_id]);
        
    }

    public function create($list_id)
    {
        //
        return view('task.create',['list_id'=>$list_id]);
    }

    public function store(Request $request)
    {
        //
        
        
        $input = $request->except('_token');
        $result = Task::create(['content'=>$input['content'],'complete'=>'0','list_id'=>$input['list_id']]);
        if ($result){
            $data=[
                'status'=>0,
                'message'=>'Add successfully!'
            ];    
        }else{
            $data=[
                'status'=>1,
                'message'=>'Add failed!'
            ];
        }
        return $data;
    }

    public function edit($id)
    {
        //
        $task = Task::find($id);
        //return $list->comment;
        return view('task.edit',['task'=>$task]);
    }

    public function update(Request $request, $id)
    {
        //根据id获取要修改的记录
        //return $id;
        $task = Task::find($id);
        //获取要修改的title和comment
        $content = $request->input('content');

        $task->content = $content;

        $result = $task->save();

        if($result){
            $data=[
                'status'=>0,
                'message'=>'Modify successfully!'
            ];
        }else{
            $data=[
                'status'=>1,
                'message'=>'Modify failed!'
            ];
        }
        return $data;

    }

    public function destroy($id)
    {
        //
        $task = Task::find($id);
        $result = $task->delete();
        if($result){
            $data=[
                'status'=>0,
                'message'=>'Delete successfully!'
            ];
        }else{
            $data=[
                'status'=>1,
                'message'=>'Delete failed!'
            ];
        }
        return $data;
    }

    public function destroyAll()
    {
        //
        //return 111;
        
        $task = DB::table('task')
                   ->select('task_id')
                   ->where('complete','=','1')
                   ->get();

        $result = DB::table('task')
                  ->where('complete','=',1)
                  ->delete();

        if($result){
            $data=[
                'status'=>0,
                'message'=>'Delete successfully!',
                'task'=>$task
            ];
        }else{
            $data=[
                'status'=>1,
                'message'=>'Delete failed!'
            ];
        }
        return $data;
    }

    public function complete($id){
        //根据id获取要修改的记录
        $task = Task::find($id);
        
        //如果是未完成的task，变成完成
        if($task->complete == 0){
            $task->complete = 1;
            $result = $task->save();
            if($result){
                $data=[
                    'status'=>1
                ];
            }
        }else{ //如果是完成的task,变成未完成
            $task->complete = 0;
            $result = $task->save();
            if($result){
                $data=[
                    'status'=>0
                ];
            }
        }
        return $data;
    }
    
}
