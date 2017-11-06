<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $table = 'Organisations';

    /**
     * Overrides the default primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'organisation_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pre_paid',
        'standard_subscription_price',
        'discounted_subscription_price',
        'name',
    ];

    // Return a standard subscription price that this organisation set up.
    public function standardPrice() {
        return $this->hasOne('App\OrganisationStandardSubscriptionPrice', 'organisation_standard_subscription_price_id', 'standard_subscription_price');
    }

    // Return a discounted subscription price that this organisation set up.
    public function discountedPrice() {
        return $this->hasOne('App\OrganisationDiscountedSubscriptionPrice', 'organisation_discounted_subscription_price_id', 'discounted_subscription_price');
    }
}
