<?php

namespace App\Exports;

use App\Heures_supp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB ;

class CalculheuremoisExport implements FromView
{

    public function view() : View
    {
        $data = DB::table('heures_supp')
        ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
        ->select(
            DB::raw('YEAR(Date_Heure) as year'),
            DB::raw('MONTH(Date_Heure) as month'),
            DB::raw('SUM(total_taux_15) as sum15'),
            DB::raw('SUM(total_taux_40) as sum40'),
            DB::raw('SUM(total_taux_60) as sum60'),
            DB::raw('SUM(total_taux_100) as sum100'),
            DB::raw('Nom_Agent as Nom'),
            DB::raw('SUM(total_heures_saisie) as total'),
            DB::raw('(Agent_Matricule_Agent) as agent'))
            ->where('heures_supp.Statut', '=', 4)
           ->groupBy('year','month','agent')
           ->get();

        return view('Calculheuremoistable', [
            'data' =>$data
        ]);
    }
}
