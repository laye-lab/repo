<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property string $Date_debut
 * @property int $Heure_debut
 * @property int $Heure_fin
 * @property string $Demandeur
 * @property string $Date_fin
 * @property int $nbr_heure
 * @property string $travaux_effectuer
 * @property string $Observations
 * @property JourFery[] $jourFeries
 * @property Step[] $steps
 * @property AgentHeuresSuppAFaire[] $agentHeuresSuppAFaires
 * @property JourFeriesFixe[] $jourFeriesFixes
 */
class Heures_supp_a_faire extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Heures_supp_a_faire';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['Date_debut', 'Heure_debut', 'Heure_fin', 'Demandeur', 'Date_fin', 'nbr_heure', 'travaux_effectuer', 'Observations'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jourFeries()
    {
        return $this->hasMany('App\JourFery', 'Heures_supp_a_faireID', 'ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function steps()
    {
        return $this->hasMany('App\Step', 'Heures_supp_a_faireID', 'ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agentHeuresSuppAFaires()
    {
        return $this->hasMany('App\AgentHeuresSuppAFaire', 'Heures_supp_a_faireID', 'ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jourFeriesFixes()
    {
        return $this->hasMany('App\JourFeriesFixe', 'Heures_supp_a_faireID', 'ID');
    }
}
