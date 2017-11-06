<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'Teams';

    /**
     * Overrides the default primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'team_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_organisation',
        'name',
    ];

    // Return an organisation that owns this team.
    public function organisation() {
        return $this->hasOne('App\Organisation', 'organisation_id', 'parent_organisation');
    }
}
