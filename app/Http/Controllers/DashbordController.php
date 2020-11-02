<?php

namespace App\Http\Controllers;
use App\Charts\UserChart;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;
class DashbordController extends Controller
{
    public function index(Request $request)
    {

        $users=User::all();
        if (null != request('mois')){

            $mois=request('mois');
            $etablissement_janvier=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
            ->where('Etablissement', '=',  $mois)->whereMonth('Date_Heure', '=', 1)->sum('total_heures_saisie');
            $etablissement_fevrier=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
            ->where('Etablissement', '=',  $mois)->whereMonth('Date_Heure', '=', 2)->sum('total_heures_saisie');
            $etablissement_mars=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
            ->where('Etablissement', '=',  $mois)->whereMonth('Date_Heure', '=', 3)->sum('total_heures_saisie');
            $etablissement_avril=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
            ->where('Etablissement', '=',  $mois)->whereMonth('Date_Heure', '=', 4)->sum('total_heures_saisie');
            $etablissement_mai=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
            ->where('Etablissement', '=',  $mois)->whereMonth('Date_Heure', '=', 5)->sum('total_heures_saisie');
            $etablissement_juin=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
            ->where('Etablissement', '=',  $mois)->whereMonth('Date_Heure', '=', 6)->sum('total_heures_saisie');
            $etablissement_juillet=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
            ->where('Etablissement', '=',  $mois)->whereMonth('Date_Heure', '=', 7)->sum('total_heures_saisie');
            $etablissement_aout=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
            ->where('Etablissement', '=',  $mois)->whereMonth('Date_Heure', '=', 8)->sum('total_heures_saisie');
            $etablissement_septembre=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
            ->where('Etablissement', '=',  $mois)->whereMonth('Date_Heure', '=', 9)->sum('total_heures_saisie');
            $etablissement_octobre=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
            ->where('Etablissement', '=',  $mois)->whereMonth('Date_Heure', '=', 10)->sum('total_heures_saisie');
            $etablissement_novembre=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
            ->where('Etablissement', '=',  $mois)->whereMonth('Date_Heure', '=', 11)->sum('total_heures_saisie');
            $etablissement_decembre=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
            ->where('Etablissement', '=',  $mois)->whereMonth('Date_Heure', '=', 12)->sum('total_heures_saisie');
        }else {
            $mois=0;
            $etablissement=0;
            $etablissement_janvier=0;
            $etablissement_fevrier=0;
            $etablissement_mars=0;
            $etablissement_avril=0;
            $etablissement_mai=0;
            $etablissement_juin=0;
            $etablissement_juillet=0;
            $etablissement_aout=0;
            $etablissement_septembre=0;
            $etablissement_octobre=0;
            $etablissement_novembre=0;
            $etablissement_decembre=0;
            $total_taux_15_month=0;
            $total_taux_40_month=0;
            $total_taux_60_month=0;
            $total_taux_100_month=0;
        }

        $users=User::all();
        $user=auth()->user()->id;
       $current_month = date('m');
       $current_year = date("Y");

        $data = DB::table('heures_supp')
        ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',4]])
        ->select
            (
            DB::raw('SUM(total_taux_15) as sum15'),
            DB::raw('SUM(Mont_15) as sumMont_15'),
            DB::raw('SUM(Mont_40) as sumMont_40'),
            DB::raw('SUM(Mont_60) as sumMont_60'),
            DB::raw('SUM(Mont_100) as sumMont_100'),
            DB::raw('(SUM(Mont_100)+ SUM(Mont_60) + SUM(Mont_40) + SUM(Mont_15) ) as Mont_total'),
            DB::raw('SUM(total_taux_40) as sum40'),
            DB::raw('SUM(total_taux_60) as sum60'),
            DB::raw('SUM(total_taux_100) as sum100'),
            DB::raw('SUM(total_heures_saisie) as total'),
            DB::raw('Etablissement as Etablissements'),
            )
            ->groupBy('Etablissement')
            ->get();


            $data_drh= DB::table('heures_supp')
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
                DB::raw('(Agent_Matricule_Agent) as agent'),
                DB::raw('(heures_supp.Statut) as statut'))
               ->groupBy('year','month','agent','statut')
               ->get();

        $user=auth()->user()->id;
        $current_month = date('m');
        $current_year = date("Y");

        $borderColors = [
            "rgba(255, 99, 132, 1.0)",
            "rgba(22,160,133, 1.0)",
            "rgba(255, 205, 86, 1.0)",
            "rgba(51,105,232, 1.0)",
            "rgba(244,67,54, 1.0)",
            "rgba(34,198,246, 1.0)",
            "rgba(153, 102, 255, 1.0)",
            "rgba(255, 159, 64, 1.0)",
            "rgba(233,30,99, 1.0)",
            "rgba(205,220,57, 1.0)"
        ];
        $fillColors = [
            "rgba(255, 99, 132, 0.2)",
            "rgba(22,160,133, 0.2)",
            "rgba(255, 205, 86, 0.2)",
            "rgba(51,105,232, 0.2)",
            "rgba(244,67,54, 0.2)",
            "rgba(34,198,246, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
            "rgba(233,30,99, 0.2)",
            "rgba(205,220,57, 0.2)"

        ];

        $etablissement_dr =DB::table('agent')->where('Matricule_Agent', '=', $user)->first();


        $total_current_month =DB::table('heures_supp')->select('total_heures_saisie')
        ->whereMonth('Date_Heure', '=',$current_month)->sum('total_heures_saisie');

        $total_current_month_dr=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
        ->where('Etablissement', '=',$etablissement_dr->Etablissement)->whereMonth('Date_Heure', '=',$current_month)->sum('total_heures_saisie');


        $total_current_year =DB::table('heures_supp')->select('total_heures_saisie')
        ->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $total_current_year_dr =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
        ->where('Etablissement', '=',$etablissement_dr->Etablissement)->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $sum15 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_15')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',4]])->sum('Mont_15');
        $sum40 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_40')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',4]])->sum('Mont_40');
        $sum60 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_60')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',4]])->sum('Mont_60');
        $sum100 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_60')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',4]])->sum('Mont_100');


        $SUM_MONTANT=(int) ($sum15 +  $sum40 + $sum60 + $sum100);



        $total_taux_15_year =DB::table('heures_supp')->select('total_taux_15')->whereYear('Date_Heure', '=',$current_year)->sum('total_taux_15');
        $total_taux_40_year =DB::table('heures_supp')->select('total_taux_40')->whereYear('Date_Heure', '=',$current_year)->sum('total_taux_40');
        $total_taux_60_year =DB::table('heures_supp')->select('total_taux_60')->whereYear('Date_Heure', '=',$current_year)->sum('total_taux_60');
        $total_taux_100_year =DB::table('heures_supp')->select('total_taux_100')->whereYear('Date_Heure', '=',$current_year)->sum('total_taux_100');

        $total_taux_15_month =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->where('Etablissement', '=',  $mois)->whereYear('Date_Heure', '=',$current_year)->sum('total_taux_15');
        $total_taux_40_month =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->where('Etablissement', '=',  $mois)->whereYear('Date_Heure', '=',$current_year)->sum('total_taux_40');
        $total_taux_60_month =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->where('Etablissement', '=',  $mois)->whereYear('Date_Heure', '=',$current_year)->sum('total_taux_60');
        $total_taux_100_month =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->where('Etablissement', '=',  $mois)->whereYear('Date_Heure', '=',$current_year)->sum('total_taux_100');





        $Janvier=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=', 1)->where('Etablissement', '<>',"Centre de Hann")->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $Fevrier=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=', 2)->where('Etablissement', '<>',"Centre de Hann")->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');


        $Mars=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=', 3)->where('Etablissement', '<>',"Centre de Hann")->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $Avril=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=', 4)->where('Etablissement', '<>',"Centre de Hann")->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $Mai=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=', 5)->where('Etablissement', '<>',"Centre de Hann")->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $Juin=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=', 6)->where('Etablissement', '<>',"Centre de Hann")->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $Juillet=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=', 7)->where('Etablissement', '<>',"Centre de Hann")->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $Aout=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=', 8)->where('Etablissement', '<>',"Centre de Hann")->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $Septembre=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=', 9)->where('Etablissement', '<>',"Centre de Hann")->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $Octobre=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=', 10)->where('Etablissement', '<>',"Centre de Hann")->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $Novembre=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=', 11)->where('Etablissement', '<>',"Centre de Hann")->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $Decembre=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=', 12)->where('Etablissement', '<>',"Centre de Hann")->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');



        $usersChartMois = new UserChart;
        $usersChartMois->labels(['15%', '40%', '60%','100%']);
        $usersChartMois->dataset('', 'bar', [$total_taux_15_year,$total_taux_40_year,$total_taux_60_year,$total_taux_100_year])
            ->color($borderColors)
            ->backgroundcolor($fillColors);

            $usersChartbandetablissement = new UserChart;
            $usersChartbandetablissement ->labels(['taux 15%', 'taux 40%', 'taux 60%','taux 100%']);
            $usersChartbandetablissement ->dataset('', 'bar', [$total_taux_15_month,$total_taux_40_month,$total_taux_60_month,$total_taux_100_month])
                ->color($borderColors)
                ->backgroundcolor($fillColors);



        $usersChart = new UserChart;
        $usersChart->labels(['Janvier', 'Fevrier', 'Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre']);
        $usersChart->dataset('Total heure Supplémentaire par mois', 'line', [ $Janvier, $Fevrier, $Mars,$Avril,$Mai,$Juin,$Juillet,$Aout,$Septembre,$Octobre,$Novembre,$Decembre])
        ->color("rgb(15, 50,192)")
        ->backgroundcolor("rgb(94, 219, 23)");;

        $usersChartband = new UserChart;
        $usersChartband->labels(['Janvier', 'Fevrier', 'Mars']);
        $usersChartband
        ->dataset('Total', 'line', [21222122,220000000,220003000])
        ->color( "rgb(53,96,94) " )
        ->backgroundcolor("rgb(255, 255, 255 )");;

        $role_account=DB::table('Role_Account')
        ->join('users','users.id' ,'=', 'Role_Account.AccountID')
        ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
        ->join('agent','agent.Matricule_Agent' ,'=','users.id')
        ->select('Matricule_agent','Role.Nom','Nom_Agent','fonction')
        ->get();


        return view('Dashbord')->with([
                'users'=>$users,
                'usersChart' => $usersChart,
                'usersChartMois' => $usersChartMois,
                'usersChartband' =>$usersChartband,
                'usersChartbandetablissement' => $usersChartbandetablissement,
                'mois' => $mois,
                'data' => $data,
                'SUM_MONTANT' => $SUM_MONTANT,
                'data_drh' => $data_drh,
                'total_current_month' =>  $total_current_month,
                'total_current_month_dr' =>  $total_current_month_dr,
                'total_current_year' =>  $total_current_year,
                'total_current_year_dr' =>  $total_current_year_dr,
                'role_account'=>$role_account]);
}


public function charts(Request $request)
{


    $users=User::all();



    $data = DB::table('heures_supp')
    ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
    ->select
        (
        DB::raw('SUM(total_taux_15) as sum15'),
        DB::raw('SUM(total_taux_40) as sum40'),
        DB::raw('SUM(total_taux_60) as sum60'),
        DB::raw('SUM(total_taux_100) as sum100'),
        DB::raw('SUM(total_heures_saisie) as total'),
        DB::raw('Affectation as Affectations'),
        )
        ->groupBy('Affectations')
        ->get();
        $data_drh= DB::table('heures_supp')
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
            DB::raw('(Agent_Matricule_Agent) as agent'),
            DB::raw('(heures_supp.Statut) as statut'))
           ->groupBy('year','month','agent','statut')
           ->get();

    $user=auth()->user()->id;
    $current_month = date('m');
    $current_year = date("Y");

    $borderColors = [
        "rgba(255, 99, 132, 1.0)",
        "rgba(22,160,133, 1.0)",
        "rgba(255, 205, 86, 1.0)",
        "rgba(51,105,232, 1.0)",
        "rgba(244,67,54, 1.0)",
        "rgba(34,198,246, 1.0)",
        "rgba(153, 102, 255, 1.0)",
        "rgba(255, 159, 64, 1.0)",
        "rgba(233,30,99, 1.0)",
        "rgba(205,220,57, 1.0)"
    ];
    $fillColors = [
        "#003f5c",
        "#2f4b7c",
        "#665191",
        "#a05195",
        "#d45087",
        "#f95d6a",
        "#ff7c43",
        "#ffa600",
        "rgba(233,30,99, 0.2)",
        "rgba(205,220,57, 0.2)"

    ];

    $Affectation =DB::table('agent')->select('affectation')->distinct('affectation')->get();
    $Affectation =DB::table('agent')->select('affectation')->distinct('affectation')->get();



            $Ziguinchor=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"Ziguinchor"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $Diourbel=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"Diourbel"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $Ngnith=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"Ngnith"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $Kaolack=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"Kaolack"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $Tambacounda=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"Tambacounda"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $Dakar1=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"Dakar 1"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $Dakar2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"Dakar 2"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $Louga=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"Louga"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $Rufisque=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"Rufisque"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $Thies=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"Thiés"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $Hann=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"Centre de Hann"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $Saint_Louis=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"Saint-Louis"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

    $usersChartKaolack = new UserChart;
    $usersChartKaolack->labels(['Kaolack', 'Ziguinchor', 'Ngnith','Diourbel','Tambacounda','Dakar1','Dakar2','Louga','Rufisque','Thies','Hann','Saint_Louis']);
    $usersChartKaolack->dataset('', 'bar', [ $Kaolack, $Ziguinchor, $Ngnith,$Diourbel,$Tambacounda,$Dakar1,$Dakar2,$Louga,$Rufisque,$Thies,$Hann,$Saint_Louis])
    ->color($borderColors)
    ->backgroundcolor($fillColors);


    $role_account=DB::table('Role_Account')
    ->join('users','users.id' ,'=', 'Role_Account.AccountID')
    ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
    ->join('agent','agent.Matricule_Agent' ,'=','users.id')
    ->select('Matricule_agent','Role.Nom','Nom_Agent')
    ->get();


    return view('Courbe_rh')->with([
            'usersChartKaolack' => $usersChartKaolack,
            'data' => $data,
            'data_drh' => $data_drh,
            'Affectation' =>$Affectation,
            'role_account'=>$role_account]);
}



public function Details(Request $request)
{


    $users=User::all();
    $user=auth()->user()->id;
    $current_month = date('m');
    $current_year = date("Y");

    $Montant=request('montant');
    $Affectation= request('affectation');
    if ( $Affectation== null || $Montant== null) {
        return back();
      }
    $role_account=DB::table('Role_Account')
    ->join('users','users.id' ,'=', 'Role_Account.AccountID')
    ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
    ->join('agent','agent.Matricule_Agent' ,'=','users.id')
    ->select('Matricule_agent','Role.Nom','Nom_Agent','fonction')
    ->get();

    $data = DB::table('heures_supp')
    ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
    ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',4],['agent.Affectation', '=',$Affectation]])
    ->select
        (
        DB::raw('SUM(total_taux_15) as sum15'),
        DB::raw('SUM(Mont_15) as sumMont_15'),
        DB::raw('SUM(Mont_40) as sumMont_40'),
        DB::raw('SUM(Mont_60) as sumMont_60'),
        DB::raw('SUM(Mont_100) as sumMont_100'),
        DB::raw('(SUM(Mont_100)+ SUM(Mont_60) + SUM(Mont_40) + SUM(Mont_15) ) as Mont_total'),
        DB::raw('SUM(total_taux_40) as sum40'),
        DB::raw('SUM(total_heures_saisie) as total_heures'),
        DB::raw('SUM(total_taux_15) as sum15'),
        DB::raw('SUM(total_taux_60) as sum60'),
        DB::raw('SUM(total_taux_100) as sum100'),
        DB::raw('SUM(total_heures_saisie) as total'),
        DB::raw('Matricule_Agent as Matricule_Agent'),
        DB::raw('Nom_Agent as Nom_Agents'),
        )
        ->groupBy('Matricule_Agent')
        ->get();


    return view('details_montant')->with([
            'role_account'=>$role_account,
            'data'=>$data,
            'Montant'=>$Montant
             ]);
    }




public function DetailsAffectation(Request $request)
{


    $users=User::all();
    $user=auth()->user()->id;
    $current_month = date('m');
    $current_year = date("Y");

    $Montant= number_format(request('montant'),2);
    $role=DB::table('Role_Account')
    ->join('users','users.id' ,'=', 'Role_Account.AccountID')
    ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
    ->join('agent','agent.Matricule_Agent' ,'=','users.id')
    ->select('Matricule_agent','Role.Nom','Nom_Agent','fonction','Etablissement')
    ->where('agent.Matricule_agent', '=', $user)
    ->first();
    $etablissement= request('etablissement');

    if ( $role->Nom == 'n+2') {
        $etablissement=$role->Etablissement;
    }

    if ( $etablissement== null || $Montant== null) {
        return back();
      }
    $role_account=DB::table('Role_Account')
    ->join('users','users.id' ,'=', 'Role_Account.AccountID')
    ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
    ->join('agent','agent.Matricule_Agent' ,'=','users.id')
    ->select('Matricule_agent','Role.Nom','Nom_Agent','fonction')
    ->get();


    $data = DB::table('heures_supp')
    ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
    ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',4],['agent.Etablissement', '=',$etablissement]])
    ->select
        (
        DB::raw('SUM(total_taux_15) as sum15'),
        DB::raw('SUM(Mont_15) as sumMont_15'),
        DB::raw('SUM(Mont_40) as sumMont_40'),
        DB::raw('SUM(Mont_60) as sumMont_60'),
        DB::raw('SUM(Mont_100) as sumMont_100'),
        DB::raw('(SUM(Mont_100)+ SUM(Mont_60) + SUM(Mont_40) + SUM(Mont_15) ) as Mont_total'),
        DB::raw('SUM(total_taux_40) as sum40'),
        DB::raw('SUM(total_heures_saisie) as total_heures'),
        DB::raw('SUM(total_taux_15) as sum15'),
        DB::raw('SUM(total_taux_60) as sum60'),
        DB::raw('SUM(total_taux_100) as sum100'),
        DB::raw('SUM(total_heures_saisie) as total'),
        DB::raw('Affectation as Affectations')
        )
        ->groupBy('Affectation')
        ->get();


    return view('details_montant_affectation')->with([
            'role_account'=>$role_account,
            'data'=>$data,
            'Montant'=>$Montant
             ]);
    }

}
