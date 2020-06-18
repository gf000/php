<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    //
    //用户模型关联表
    public $table = 'list';
    //表的主键
    public $primaryKey = 'list_id';

    protected $fillable = [
        'list_id', 'title', 'comment','shared','user_id'
    ];

    public $timestamps = false;
}
