<?php

namespace App\Http\Controllers;
use App\Charts\UserChart;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;
class AcceuilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {



        $users=User::all();
         $user=auth()->user()->id;
        $current_month = date('m');
        $current_year = date("Y");
        $etablissement_dr =DB::table('agent')->where('Matricule_Agent', '=', $user)->first();

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
        $Affectation =DB::table('agent')->select('affectation')->distinct('affectation')->get();


        $data = DB::table('heures_supp')
        ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
        ->whereMonth('Date_Heure', '=',  now()->month)
        ->whereYear('Date_Heure', '=',$current_year)
        ->where('heures_supp.statut', '>=',3)
        ->select
            (
            DB::raw('SUM(total_heures_saisie) as total'),
            DB::raw('AVG(total) as moy'),
            DB::raw('Etablissement as Etablissements'),
            )
            ->groupBy('Etablissements')
            ->get();

            $data_dcm = DB::table('heures_supp')
            ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
            ->where('Direction', '=','DCM')
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



                $data_dto = DB::table('heures_supp')
                ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
                ->where('Direction', '=',$etablissement_dr->Direction)
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




        $total_current_month =DB::table('heures_supp')->select('total_heures_saisie')
        ->whereMonth('Date_Heure', '=',$current_month)->where('heures_supp.Statut', '=',4)->sum('total_heures_saisie');

        $total_current_month_n_plus_3 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('total_heures_saisie')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['Direction', '=',$etablissement_dr->Direction],['heures_supp.Statut', '>=',3]])->sum('total_heures_saisie');

        $sum15 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_15')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',4]])->sum('Mont_15');
        $sum40 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_40')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',4]])->sum('Mont_40');
        $sum60 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_60')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',4]])->sum('Mont_60');
        $sum100 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_60')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',4]])->sum('Mont_100');

        $sum15_n_plus_3 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_15')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',3],['Direction', '=',$etablissement_dr->Direction]])->sum('Mont_15');
        $sum40_n_plus_3 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_40')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',3],['Direction', '=',$etablissement_dr->Direction]])->sum('Mont_40');
        $sum60_n_plus_3 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_60')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',3],['Direction', '=',$etablissement_dr->Direction]])->sum('Mont_60');
        $sum100_n_plus_3 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_60')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',3],['Direction', '=',$etablissement_dr->Direction]])->sum('Mont_100');

        $sum15_n_plus_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_15')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',2],['Etablissement', '=',$etablissement_dr->Etablissement]])->sum('Mont_15');
        $sum40_n_plus_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_40')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',2],['Etablissement', '=',$etablissement_dr->Etablissement]])->sum('Mont_40');
        $sum60_n_plus_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_60')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',2],['Etablissement', '=',$etablissement_dr->Etablissement]])->sum('Mont_60');
        $sum100_n_plus_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('Mont_60')
        ->whereMonth('Date_Heure', '=',$current_month)->where([['heures_supp.Statut', '>=',2],['Etablissement', '=',$etablissement_dr->Etablissement]])->sum('Mont_100');

        $SUM_MONTANT=(int)( $sum15 +  $sum40 + $sum60 + $sum100);
        $SUM_MONTANT_n_plus_3=(int)( $sum15_n_plus_3 +  $sum40_n_plus_3 + $sum60_n_plus_3 + $sum100_n_plus_3);
        $SUM_MONTANT_n_plus_2=(int)( $sum15_n_plus_2 +  $sum40_n_plus_2 + $sum60_n_plus_2 + $sum100_n_plus_2);


        $total_current_month_dr=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
        ->where([['Etablissement', '=',$etablissement_dr->Etablissement], ['heures_supp.Statut', '>=',2]])->whereMonth('Date_Heure', '=',$current_month)->sum('total_heures_saisie');

        $total_current_year_n_plus_3 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
        ->where([['Direction', '=',$etablissement_dr->Direction],['heures_supp.Statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $service=DB::table('affectation');

        $total_current_year =DB::table('heures_supp')->select('total_heures_saisie')
        ->whereYear('Date_Heure', '=',$current_year)->where('heures_supp.Statut', '=',4)->sum('total_heures_saisie');

        $total_current_year_dr =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
        ->where([['Etablissement', '=',$etablissement_dr->Etablissement],['heures_supp.Statut', '>=',2]])->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');




        $zig_n_plus_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where(
            [['Etablissement', '=',"zig"],
            ['heures_supp.statut', '>=',3],
            ['Direction', '=',$etablissement_dr->Direction]]
        )->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $DBL_n_plus_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"DBL"],
        ['heures_supp.statut', '>=',3],
        ['Direction', '=',$etablissement_dr->Direction]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $NGN_n_plus_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"NGN"],
        ['heures_supp.statut', '>=',3],
        ['Direction', '=',$etablissement_dr->Direction]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $KLK_n_plus_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"KLK"],
        ['heures_supp.statut', '>=',3],
        ['Direction', '=',$etablissement_dr->Direction]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $TBA_n_plus_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"TBA"],
        ['heures_supp.statut', '>=',3],
        ['Direction', '=',$etablissement_dr->Direction]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $DK1_n_plus_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"DK1"],
        ['heures_supp.statut', '>=',3],
        ['Direction', '=',$etablissement_dr->Direction]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $DK2_n_plus_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"DK2"],
        ['heures_supp.statut', '>=',3],
        ['Direction', '=',$etablissement_dr->Direction]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $LGA_n_plus_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"LGA"],
        ['heures_supp.statut', '>=',3],
        ['Direction', '=',$etablissement_dr->Direction]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $RUF_n_plus_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"RUF"],
        ['heures_supp.statut', '>=',3],
        ['Direction', '=',$etablissement_dr->Direction]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $THS_n_plus_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"THS"],
        ['heures_supp.statut', '>=',3],
        ['Direction', '=',$etablissement_dr->Direction]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');


        $STL_n_plus_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"STL"],
        ['heures_supp.statut', '>=',3],
        ['Direction', '=',$etablissement_dr->Direction]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');




        $zig=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where(
            [['Etablissement', '=',"zig"],
            ['heures_supp.statut', '>=',4]]
        )->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $DBL=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"DBL"],
        ['heures_supp.statut', '>=',4]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $NGN=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"NGN"],
        ['heures_supp.statut', '>=',4]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $KLK=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"KLK"],
        ['heures_supp.statut', '>=',4]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $TBA=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"TBA"],
        ['heures_supp.statut', '>=',4]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $DK1=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"DK1"],
        ['heures_supp.statut', '>=',4]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $DK2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"DK2"],
        ['heures_supp.statut', '>=',4]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $LGA=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"LGA"],
        ['heures_supp.statut', '>=',4]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $RUF=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"RUF"],
        ['heures_supp.statut', '>=',4]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $THS=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"THS"],
        ['heures_supp.statut', '>=',4]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $HAN=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"HAN"],
        ['heures_supp.statut', '>=',4]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');

        $STL=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
        '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
        ->where([['Etablissement', '=',"STL"],
        ['heures_supp.statut', '>=',4]])->whereYear('Date_Heure', '=',$current_year)
        ->sum('total_heures_saisie');




        $usersChartKLK = new UserChart;
        $usersChartKLK->labels(['KLK', 'zig', 'NGN','DBL','TBA','DK1','DK2','LGA','RUF','THS','HAN','STL']);
        $usersChartKLK->dataset('', 'bar', [ $KLK, $zig, $NGN,$DBL,$TBA,$DK1,$DK2,$LGA,$RUF,$THS,$HAN,$STL])
        ->color($borderColors)
        ->backgroundcolor($fillColors);

        $usersChartKLK2 = new UserChart;
        $usersChartKLK2->labels(['KLK', 'zig', 'NGN','DBL','TBA','DK1','DK2','LGA','RUF','THS','STL']);
        $usersChartKLK2->dataset('', 'bar', [ $KLK_n_plus_3, $zig_n_plus_3, $NGN_n_plus_3,$DBL_n_plus_3,$TBA_n_plus_3
        ,$DK1_n_plus_3,$DK2_n_plus_3,$LGA_n_plus_3,$RUF_n_plus_3,$THS_n_plus_3,$STL_n_plus_3])
        ->color($borderColors)
        ->backgroundcolor($fillColors);

        $role_account=DB::table('Role_Account')
        ->join('users','users.id' ,'=', 'Role_Account.AccountID')
        ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
        ->join('agent','agent.Matricule_Agent' ,'=','users.id')
        ->select('Matricule_agent','Role.Nom','Nom_Agent','fonction')
        ->get();


        return view('Acceuil')->with([
                'users'=>$users,
                'usersChartKLK' =>$usersChartKLK,
                'data' => $data,
                'data_dto' => $data_dto,
                'data_drh' => $data_drh,
                'total_current_month_n_plus_3'=>$total_current_month_n_plus_3,
                'total_current_year_n_plus_3'=>$total_current_year_n_plus_3,
                'total_current_month' =>  $total_current_month,
                'total_current_month_dr' =>  $total_current_month_dr,
                'total_current_year' =>  $total_current_year,
                'SUM_MONTANT' =>  $SUM_MONTANT,
                'usersChartKLK2' =>  $usersChartKLK2,
                'SUM_MONTANT_n_plus_3' =>  $SUM_MONTANT_n_plus_3,
                'SUM_MONTANT_n_plus_2' =>  $SUM_MONTANT_n_plus_2,
                'total_current_year_dr' =>  $total_current_year_dr,
                'role_account'=>$role_account]);
}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users $users)
    {
        //
    }
}
