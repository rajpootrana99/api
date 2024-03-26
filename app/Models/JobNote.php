<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id', 'description', 'image_url',
    ];

    public function task(){
        return $this->belongsTo(Task::class);
    }
}
