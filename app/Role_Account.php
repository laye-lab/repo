<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $RoleID
 * @property int $AccountID
 */
class Role_Account extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Role_Account';

    /**
     * @var array
     */
    protected $fillable = ['RoleID','AccountID'];

}
