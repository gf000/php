<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //用户模型关联表
    public $table = 'task';
    //表的主键
    public $primaryKey = 'task_id';

    protected $fillable = [
        'task_id', 'content', 'complete','list_id'
    ];

    public $timestamps = false;
}
