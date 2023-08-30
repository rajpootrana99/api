<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'user_id',
        'entity_id',
        'role',
        'active'
    ];

    use HasFactory;

    public function getActiveAttribute($attribute)
    {
        return $this->activeOptions()[$attribute] ?? 0;
    }

    public function activeOptions()
    {
        return [
            1 => 'Yes',
            0 => 'No',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
