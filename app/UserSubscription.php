<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    protected $table = 'Player_subscriptions';

    /**
     * Overrides the default primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'player_subscription_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'player_id',
        'customer_id',
        'plan_id',
        'plan_amount',
        'subscription_id',
        'subscription_status',
        'charge_id',
        'charge_amount',
        'charge_currency',
        'charge_status',
        'plan_data',
        'customer_creation_data',
        'subscription_data',
        'charge_data'
    ];

    // Return a user who completed this subscription.
    public function user() {
        return $this->hasOne('App\User', 'player_id', 'player_id');
    }

}
