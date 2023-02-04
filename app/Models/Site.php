<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'site',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }
}
