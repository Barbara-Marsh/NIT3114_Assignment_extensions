<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->hasMany('App/User');
    }

    public function plan()
    {
        return $this->belongsTo('App/Plan');
    }

    public function invoice()
    {
        return $this->hasMany('invoice');
    }
}
