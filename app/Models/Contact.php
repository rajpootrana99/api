<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'emp_id',
        'site_id',
        'user_id',
        'employer',
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
            1 => 'y',
            0 => 'n',
        ];
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
