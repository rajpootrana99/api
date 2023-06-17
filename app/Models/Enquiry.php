<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Ramsey\Uuid\v1;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'status',
        'type',
        'quote_type',
        'priority',
    ];

    public function getStatusAttribute($attribute)
    {
        return $this->statusOptions()[$attribute] ?? 0;
    }

    public function statusOptions()
    {
        return [
            6 => 'Cancelled',
            5 => 'Lost',
            4 => 'Won',
            3 => 'Submitted',
            2 => 'Draft',
            1 => 'In Progress',
            0 => 'Pending',
        ];
    }

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

    public function getQuoteTypeAttribute($attribute)
    {
        return $this->quoteTypeOptions()[$attribute] ?? 0;
    }

    public function quoteTypeOptions()
    {
        return [
            2 => 'Charge',
            1 => 'Do',
            0 => 'Fixed',
        ];
    }

    public function getTypeAttribute($attribute)
    {
        return $this->typeOptions()[$attribute] ?? 0;
    }

    public function typeOptions()
    {
        return [
            2 => 'type 2',
            1 => 'type 1',
            0 => 'None',
        ];
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
