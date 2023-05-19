<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_id',
        'user_id',
        'description',
        'priority',
        'status',
        'progress'
    ];

    public function getPriorityAttribute($attribute)
    {
        return $this->priorityOptions()[$attribute] ?? 0;
    }

    public function priorityOptions()
    {
        return [
            3 => 'Urgent',
            2 => 'High',
            1 => 'Medium',
            0 => 'Low',
        ];
    }

    public function getStatusAttribute($attribute)
    {
        return $this->statusOptions()[$attribute] ?? 0;
    }

    public function statusOptions()
    {
        return [
            3 => 'Cancelled',
            2 => 'Invoiced',
            1 => 'Complete',
            0 => 'Scheduled',
            2 => 'Awaiting Approval',
            1 => 'Quoting',
            0 => 'Pending',
        ];
    }

    public function getProgressAttribute($attribute)
    {
        return $this->progressOptions()[$attribute] ?? 0;
    }

    public function progressOptions()
    {
        return [
            1 => 'Order',
            0 => 'Quote',
        ];
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function itemGalleries()
    {
        return $this->hasMany(ItemGallery::class);
    }
}
