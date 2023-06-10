<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'site',
        'entity_id',
        'site_address',
        'suburb',
        'state',
        'post_code',
        'active',
    ];

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

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('user_id');
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }
}
