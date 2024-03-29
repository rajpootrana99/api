<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'entity_id',
        'role',
        'name',
        'email',
        'address',
        'phone',
        'password',
        'is_approved',
        'orders',
        'accounts',
        'image',
    ];

    public function getIsApprovedAttribute($attribute)
    {
        return $this->isApprovedOptions()[$attribute] ?? 0;
    }

    public function isApprovedOptions()
    {
        return [
            1 => 'Approved',
            0 => 'Not Approved',
        ];
    }

    public function getOrdersAttribute($attribute)
    {
        return $this->ordersOptions()[$attribute] ?? 0;
    }

    public function ordersOptions()
    {
        return [
            0 => 'No',
            1 => 'Yes',
        ];
    }

    public function getAccountsAttribute($attribute)
    {
        return $this->accountsOptions()[$attribute] ?? 0;
    }

    public function accountsOptions()
    {
        return [
            0 => 'No',
            1 => 'Yes',
        ];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sites()
    {
        return $this->belongsToMany(Site::class)->withPivot('site_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function token()
    {
        return $this->hasOne(Token::class);
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function contact()
    {
        return $this->hasOne(Contact::class);
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
