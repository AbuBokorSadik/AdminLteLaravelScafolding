<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskStatusActivity extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function taskStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }

    public static function createActivity($taskId, $statusId)
    {
        $task = Task::find($taskId);

        TaskStatusActivity::create([
            'task_id' => $task->id,
            'created_by_id' => $task->created_by_id,
            'status_id' => $statusId,
        ]);
    }
}
