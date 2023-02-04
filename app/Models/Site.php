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
        return $this->belongsToMany(User::class, 'sites_has_users', 'site_id', 'user_id');
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }
}
