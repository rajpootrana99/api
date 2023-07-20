<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'entity_id',
        'user_id',
        'is_enquiry',
        'is_job',
        'is_quote',
        'title',
        'status',
        'requested_completion',
    ];

    public function getStatusAttribute($attribute)
    {
        return $this->statusOptions()[$attribute] ?? 0;
    }

    public function statusOptions()
    {
        return [
            9 => 'Complete',
            8 => 'In Progress',
            7 => 'Scheduled',
            6 => 'Lost',
            5 => 'Won',
            4 => 'Submitted',
            3 => 'Quoting',
            2 => 'Cancelled',
            1 => 'Approved',
            0 => 'Pending',
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

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
