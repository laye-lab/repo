<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommandeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
  {

        $today = \Carbon\Carbon::now(); //Current Date and Time

          $lastDayofMonth = \Carbon\Carbon::parse($today)->endOfMonth()->toDateString();


        return [

            'Date_debut' => 'required|date_format:Y-m-d|after:yesterday',
            'Date_fin' => 'required|date_format:Y-m-d||after:Date_debut|before_or_equal:'.$lastDayofMonth,
            'nbr_heure' => 'required|numeric|min:0|max:80',
            'commandeur' => 'required',
            'collaborateur' => 'required',
            'servicedr' => 'required'
        ];
    }
}
