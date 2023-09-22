<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'task_id',
        'date',
        'site_start',
        'amount_are',
        'note',
        'site_address',
        'sub_total',
        'tax',
        'total',
        'status',
    ];

    public function getStatusAttribute($attribute)
    {
        return $this->statusOptions()[$attribute] ?? 0;
    }

    public function statusOptions()
    {
        return [
            0 => 'Pending',
            1 => 'Completed',
            2 => 'Cancelled',
            
            
        ];
    }

    public function entity(){
        return $this->belongsTo(Entity::class);
    }

    public function task(){
        return $this->belongsTo(Task::class);
    }
    
    public function quotes(){
        return $this->belongsToMany(Quote::class)->withPivot('description', 'qty', 'rate', 'amount', 'tax', 'total');
    }
}
