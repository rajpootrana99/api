<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'user_id',
        'title',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function site(){
        return $this->belongsTo(Site::class);
    }

    public function items(){
        return $this->hasMany(Item::class);
    }
}
