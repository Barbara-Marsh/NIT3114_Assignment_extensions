<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable, Billable;

    public function isAdmin() {
        return $this->admin;
    }

    public function isNotBanned() {
        if ($this->is_banned == TRUE) {
            $isNotBanned = FALSE;
        } elseif ($this->is_banned == FALSE) {
            $isNotBanned = TRUE;
        }

        return $isNotBanned;
    }

    /**
 * The attributes that are mass assignable.
 *
 * @var array
 */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function activeSubscription()
    {
        $subscriptions = DB::table('subscriptions')->where('user_id', '=', $this->id)->get();

        foreach ($subscriptions as $subscription) {
            if ($subscription->active == TRUE) {
                $activeSubscription = $subscription;
                return $activeSubscription;
            }
        }
    }
}
