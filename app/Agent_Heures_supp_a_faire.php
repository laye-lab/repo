<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $agentMatricule_Agent
 * @property int $Heures_supp_a_faireID
 * @property HeuresSuppAFaire $heuresSuppAFaire
 */
class Agent_Heures_supp_a_faire extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'agent_Heures_supp_a_faire';

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function heuresSuppAFaire()
    {
        return $this->belongsTo('App\HeuresSuppAFaire', 'Heures_supp_a_faireID', 'ID');
    }
}
