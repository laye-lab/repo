<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $Numero
 * @property string $Date_Heure
 * @property int $heure_debut
 * @property int $heure_fin
 * @property string $Agent_Matricule_Agent
 * @property string $travaux_effectuer
 * @property string $observations
 * @property string $created_at
 * @property string $updated_at
 * @property int $Statut
 */
class Heures_supp extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'heures_supp';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'Numero';

    /**
     * @var array
     */
    protected $fillable = ['Date_Heure', 'heure_debut', 'heure_fin', 'Agent_Matricule_Agent', 'travaux_effectuer', 'observations', 'created_at', 'updated_at', 'Statut'];

}
