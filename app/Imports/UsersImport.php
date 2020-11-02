<?php

namespace App\Imports;

use App\Tbl_customer;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Tbl_customer([
            'CustomerName' => $row[0],
            'Gender'    => $row[1],
            'Address' => $row[3],

            //
        ]);
    }
}
