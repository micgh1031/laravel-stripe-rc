<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'Players';

    /**
     * Overrides the default primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'player_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_of_team',
        'current_subscription',
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Overrides the token to ignore the remember session.
     */
    public function getRememberToken()
    {
        return null; // not supported
    }

    /**
     * Overrides the token to ignore the remember session.
     */
    public function setRememberToken($value)
    {
        // not supported
    }

    /**
     * Overrides the token to ignore the remember session.
     */
    public function getRememberTokenName()
    {
        return null; // not supported
    }

    /**
     * Overrides the method to ignore the remember token.
     */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute)
        {
            parent::setAttribute($key, $value);
        }
    }

    // Return a team where this user belongs to.
    public function team() {
        return $this->hasOne('App\Team', 'team_id', 'member_of_team');
    }
}
