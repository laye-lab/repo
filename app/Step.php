<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property string $IdStep
 * @property string $Libelle
 * @property int $Heures_supp_a_faireID
 * @property HeuresSuppAFaire $heuresSuppAFaire
 */
class Step extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Step';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['IdStep', 'Libelle', 'Heures_supp_a_faireID'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function heuresSuppAFaire()
    {
        return $this->belongsTo('App\HeuresSuppAFaire', 'Heures_supp_a_faireID', 'ID');
    }
}
