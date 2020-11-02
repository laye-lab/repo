<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property string $Nom
 * @property string $Descripttion
 * @property string $Created
 * @property string $Modified
 */
class Role extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Role';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $fillable = ['Nom', 'Descripttion', 'Created', 'Modified'];

    public function users()
    {
        return $this->belongsToMany('App\User','Role_Account', 'RoleID','AccountID');
    }
  
}
