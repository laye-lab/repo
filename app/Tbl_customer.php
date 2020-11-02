<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $CustomerID
 * @property string $CustomerName
 * @property string $Gender
 * @property string $Address
 * @property string $City
 * @property string $PostalCode
 * @property string $Country
 */
class Tbl_customer extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_customer';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'CustomerID';

    /**
     * @var array
     */
    protected $fillable = ['CustomerName', 'Gender', 'Address', 'City', 'PostalCode', 'Country'];

}
