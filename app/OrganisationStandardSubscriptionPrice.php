<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganisationStandardSubscriptionPrice extends Model
{
    protected $table = 'Organisation_standard_subscription_prices';

    /**
     * Overrides the default primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'organisation_standard_subscription_price_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'stripe_plan_id'
    ];
}
