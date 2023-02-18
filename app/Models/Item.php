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

    public function getPriorityAttribute($attribute){
        return $this->priorityOptions()[$attribute] ?? 0;
    }

    public function priorityOptions(){
        return [
            2 => 'High',
            1 => 'Low',
            0 => 'None',
        ];
    }

    public function getStatusAttribute($attribute){
        return $this->statusOptions()[$attribute] ?? 0;
    }

    public function statusOptions(){
        return [
            2 => 'Overdue',
            1 => 'Completed',
            0 => 'Ongoing',
        ];
    }

    public function getProgressAttribute($attribute){
        return $this->progressOptions()[$attribute] ?? 0;
    }

    public function progressOptions(){
        return [
            1 => 'Proceed',
            0 => 'Quote',
        ];
    }

    public function task(){
        return $this->belongsTo(Task::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function itemGalleries(){
        return $this->hasMany(ItemGallery::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
