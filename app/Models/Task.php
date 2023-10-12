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
        'type',
        'enquiry_status',
        'job_status',
        'title',
        'status',
        'is_enquiry',
        'quote_type',
        'requested_completion',
    ];

    public function getTypeAttribute($attribute)
    {
        return $this->typeOptions()[$attribute] ?? 0;
    }

    public function typeOptions()
    {
        return [
            2 => 'Job',
            1 => 'Enquiry',
            0 => 'Task',
        ];
    }

    public function getStatusAttribute($attribute)
    {
        return $this->statusOptions()[$attribute] ?? 0;
    }

    public function statusOptions()
    {
        return [
            2 => 'Cancelled',
            1 => 'Approved',
            0 => 'Pending',
        ];
    }

    public function getEnquiryStatusAttribute($attribute)
    {
        return $this->enquiryStatusOptions()[$attribute] ?? 0;
    }

    public function enquiryStatusOptions()
    {
        return [
            5 => 'Cancelled',
            4 => 'Lost',
            3 => 'Won',
            2 => 'Submitted',
            1 => 'Quoting',
            0 => 'Pending',
        ];
    }

    public function getJobStatusAttribute($attribute)
    {
        return $this->jobStatusOptions()[$attribute] ?? 0;
    }

    public function jobStatusOptions()
    {
        return [
            3 => 'Complete',
            2 => 'In Progress',
            1 => 'Scheduled',
            0 => 'Pending',
        ];
    }

    public function getQuoteTypeAttribute($attribute)
    {
        return $this->quoteTypeOptions()[$attribute] ?? 0;
    }

    public function quoteTypeOptions()
    {
        return [
            1 => 'Do & Charge',
            0 => 'Cost Plus',
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

    public function purchaseOrders(){
        return $this->hasMany(PurchaseOrder::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
