<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'site',
        'site_address',
        'suburb',
        'state',
        'post_code',
        'owner',
        'owner_id',
        'active',
    ];

    public function getActiveAttribute($attribute)
    {
        return $this->activeOptions()[$attribute] ?? 0;
    }

    public function activeOptions()
    {
        return [
            1 => 'y',
            0 => 'n',
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

    public function contact()
    {
        return $this->hasMany(Contact::class);
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
