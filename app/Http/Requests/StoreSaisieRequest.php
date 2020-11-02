<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB ;


class StoreSaisieRequest extends FormRequest
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

        return [

            'Date_Heure' => 'required|date_format:Y-m-d|after_or_equal:Date_debut|before_or_equal:Date_fin',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|',
            'Date_debut' => 'required',
            'Date_fin' => 'required',
            'collaborateur' => 'required',





        ];
    }
}
