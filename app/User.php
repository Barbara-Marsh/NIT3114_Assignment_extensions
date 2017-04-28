<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
 * The attributes that are mass assignable.
 *
 * @var array
 */
    protected $fillable = [
        'name', 'email', 'password', 'subscription_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function billing_details()
    {
        return $this->hasOne('App/BillingDetails');
    }

    public function user_settings()
    {
        return $this->hasOne('App/UserSettings');
    }

    public function subscription()
    {
        return $this->belongsTo('App/Subscription');
    }
}
