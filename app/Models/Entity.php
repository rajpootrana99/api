<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'type',
        'address',
        'mobile',
        'abn',
        'entity',
        'primary_phone',
        'fax',
        'director',
        'trade',
        'inc',
        'abbrev',
        'pl_expirey',
        'wc_expirey',
        'item_type',
        'path',
        'payment_terms',
        'contract_signed',
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

    public function getTypeAttribute($attribute)
    {
        return $this->typeOptions()[$attribute] ?? 0;
    }

    public function typeOptions()
    {
        return [
            1 => 'Supplier',
            0 => 'Client',
        ];
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    public function purchaseOrders(){
        return $this->hasMany(PurchaseOrder::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
