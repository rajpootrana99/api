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
        'issue_date',
        'promised_date',
        'amount_are',
        'amount_paid',
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

    public function entitiy(){
        return $this->belongsTo(Entity::class);
    }

    public function task(){
        return $this->belongsTo(Task::class);
    }

    public function purchaseItems(){
        return $this->hasMany(PurchaseItem::class);
    }
}
