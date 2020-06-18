<?php

namespace App\Http\Controllers;

use App\TodoList;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user=session()->get('user'); 
        //$mylists = User::find($user['id'])->contacts();
        //$mylists = User::find(1)->contacts();
        $mylists = DB::table('list')
                      ->select('list.*')
                      ->where('user_id',$user['id'])
                      ->get();
        return view('list.mylist',['mylists'=>$mylists]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = session()->get('user');
        $input = $request->except('_token');
        $result = TodoList::create(['title'=>$input['title'],'comment'=>$input['comment'],'shared'=>'0','user_id'=>$user['id']]);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $list = TodoList::find($id);
        //return $list->comment;
        return view('list.edit',['list'=>$list]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //根据id获取要修改的记录
        //return $id;
        $list = TodoList::find($id);
        //获取要修改的title和comment
        $title = $request->input('title');
        $comment = $request->input('comment');

        $list->title = $title;
        $list->comment = $comment;

        $result = $list->save();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $list = TodoList::find($id);
        $result = $list->delete();
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

}
