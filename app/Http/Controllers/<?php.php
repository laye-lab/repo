<?php


namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Charts\UserChart;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;
class ValidationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()

    {

        $user=auth()->user()->id;
        $current_month = date('m');
        $current_year = date("Y");
        $etablissement_dr =DB::table('agent')->where('Matricule_Agent', '=', $user)->first();



        $total_current_month =DB::table('heures_supp')->select('total_heures_saisie')
        ->whereMonth('Date_Heure', '=',$current_month)->sum('total_heures_saisie');

        $total_current_month_n_plus_3 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')->select('total_heures_saisie')
        ->whereMonth('Date_Heure', '=',$current_month)->where('Direction', '=',$etablissement_dr->Direction)->sum('total_heures_saisie');

        $total_current_month_dr=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
        ->where('Etablissement', '=',$etablissement_dr->Etablissement)->whereMonth('Date_Heure', '=',$current_month)->sum('total_heures_saisie');


        $total_current_year =DB::table('heures_supp')->select('total_heures_saisie')
        ->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $total_current_year_dr =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
        ->where('Etablissement', '=',$etablissement_dr->Etablissement)->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $total_current_year_n_plus_3 =DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
        ->where('Direction', '=',$etablissement_dr->Direction)->whereYear('Date_Heure', '=',$current_year)->sum('total_heures_saisie');

        $service=DB::table('affectation')
            ->join('agent','agent.Matricule_Agent','=','affectation.agentMatricule_Agent')
            ->select('Matricule_agent','Nom_Agent','Fonction','Statut','Libelle_Affectation','Direction','Etablissemt_nom')
            ->distinct('Matricule_agent')
            ->get();
            $etablissement_dr = DB::table('agent')
            ->where('Matricule_agent', '=', $user)
            ->select('etablissement')
            ->first();



            $role_account=DB::table('Role_Account')
            ->join('users','users.id' ,'=', 'Role_Account.AccountID')
            ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
            ->join('agent','agent.Matricule_Agent' ,'=','users.id')
            ->select('Matricule_agent','Fonction','Statut','Direction','Role.Nom','Nom_Agent','etablissement')
            ->get();

            $agent_attribut=DB::table('agent_Heures_supp_a_faire')
            ->join('agent','agent.Matricule_Agent','=','agent_Heures_supp_a_faire.agentMatricule_Agent')
            ->join('heures_supp','heures_supp.id_heure_a_faire','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
            ->join('Heures_supp_a_faire','Heures_supp_a_faire.ID','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
            ->where('heures_supp.id_heure_a_faire', '=',116)
            ->get();


            $equipe=DB::table('equipe')
            ->get();

            $heure_supp=DB::table('heures_supp')
            ->get();
            $nbr_heure=DB::table('Heures_supp_a_faire')
            ->join('agent_Heures_supp_a_faire','agent_Heures_supp_a_faire.Heures_supp_a_faireID','=','Heures_supp_a_faire.ID')
            ->join('heures_supp','heures_supp.id_heure_a_faire','=','Heures_supp_a_faire.ID')
            ->get();

            $Affectation =DB::table('agent')->select('affectation')->distinct('affectation')->get();

            $etablissement_dr =DB::table('agent')->where('Matricule_Agent', '=', $user)->first();


            $data_dto = DB::table('heures_supp')
            ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
            ->where('Direction', '=',$etablissement_dr->Direction)
            ->select
            (
            DB::raw('SUM(total_heures_saisie) as total'),
            DB::raw('AVG(total) as moy'),
            DB::raw('Etablissement as Etablissements'),
            )
            ->groupBy('Etablissements')
            ->get();
dd($data_dto);
                $data_dto_count= $data_dto->count();


                $data_dcm = DB::table('heures_supp')
                ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
                ->whereMonth('Date_Heure', '=',  now()->month)
                ->whereYear('Date_Heure', '=',$current_year)
                ->where([
                    ['heures_supp.statut', '=',3],
                    ['agent.Direction', '=','DCM'],
                    ])
                ->select
                    (
                    DB::raw('SUM(total_heures_saisie) as total'),
                    DB::raw('AVG(total) as moy'),
                    DB::raw('Etablissement as Etablissements'),
                    )
                    ->groupBy('Etablissements')
                    ->get();

                    $data_dcm_count= $data_dcm->count();

                    $data_dq = DB::table('heures_supp')
                    ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
                    ->whereMonth('Date_Heure', '=',  now()->month)
                    ->whereYear('Date_Heure', '=',$current_year)
                    ->where([
                        ['heures_supp.statut', '=',3],
                        ['agent.Direction', '=','DPD'],
                        ])
                    ->select
                        (
                        DB::raw('SUM(total_heures_saisie) as total'),
                        DB::raw('AVG(total) as moy'),
                        DB::raw('Etablissement as Etablissements'),
                        )
                        ->groupBy('Etablissements')
                        ->get();

                        $data_dq_count= $data_dq->count();

                $data_n_plus_2 = DB::table('agent_Heures_supp_a_faire')
                ->join('agent','agent.Matricule_Agent','=','agent_Heures_supp_a_faire.agentMatricule_Agent')
                ->join('heures_supp','heures_supp.id_heure_a_faire','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
                ->whereMonth('Date_Heure', '=',  now()->month)
                ->whereYear('Date_Heure', '=',$current_year)
                ->where([
                    ['agent.etablissement', '=',$etablissement_dr->Etablissement],
                    ['heures_supp.statut', '=',2]
                    ])
                 ->get();

                $data_n_plus_2_count =  $data_n_plus_2->count();

            $heurre_a_faire=DB::table('agent_Heures_supp_a_faire')
            ->join('agent','agent.Matricule_Agent','=','agent_Heures_supp_a_faire.agentMatricule_Agent')
            ->join('heures_supp','heures_supp.id_heure_a_faire','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
            ->select('agent.Matricule_agent','Nom_Agent','Etablissement','Date_Heure','heure_debut'
            ,'heure_fin','travaux_effectuer','observations','heures_supp.id','heures_supp.Statut','id_heure_a_faire','total_heures_saisie')
            ->get();

            $heurre_somme=DB::table('heures_supp')
            ->join('agent','agent.Matricule_Agent','=','heures_supp.Agent_Matricule_Agent')
            ->whereMonth('Date_Heure', '=',  now()->month)
            ->whereYear('Date_Heure', '=',$current_year)
            ->where([
                ['agent.etablissement', '=',$etablissement_dr->Etablissement],
                ['heures_supp.statut', '=',2]
                ])
                ->select
                (
                DB::raw('SUM(total_heures_saisie) as total'),
                DB::raw('id_heure_a_faire as id_heure'),
                DB::raw('Matricule_Agent as Matricule_Agent'),
                DB::raw('Nom_Agent as Nom_Agent'),
                )->groupBy('id_heure','Matricule_Agent')
                ->get();

                $heurre_somme_n_plus_un=DB::  table('agent_Heures_supp_a_faire')
                ->join('agent','agent.Matricule_Agent','=','agent_Heures_supp_a_faire.agentMatricule_Agent')
                ->join('heures_supp','heures_supp.id_heure_a_faire','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
                ->join('Heures_supp_a_faire','Heures_supp_a_faire.ID','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
                ->whereMonth('Date_Heure', '=',  now()->month)
                ->whereYear('Date_Heure', '=',$current_year)
                ->where([
                    ['Heures_supp_a_faire.responsable', '=', $user ],
                    ['heures_supp.statut', '=',1]
                    ])
                    ->select
                    (
                    DB::raw('SUM(total_heures_saisie) as total'),
                    DB::raw('id_heure_a_faire as id_heure'),
                    DB::raw('Matricule_Agent as Matricule_Agent'),
                    DB::raw('Nom_Agent as Nom_Agent'),
                    )->groupBy('id_heure','Matricule_Agent')
                    ->get();

                    $data_n_plus_1_count = $heurre_somme_n_plus_un->count();

            $NGN=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"NGN"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $NGN_moins_1=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonth()->month)
            ->where([['Etablissement', '=',"NGN"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $NGN_moins_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(2)->month)
            ->where([['Etablissement', '=',"NGN"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $NGN_moins_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(3)->month)
            ->where([['Etablissement', '=',"NGN"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $DBL=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"DBL"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $DBL_moins_1=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonth()->month)
            ->where([['Etablissement', '=',"DBL"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $DBL_moins_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(2)->month)
            ->where([['Etablissement', '=',"DBL"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $DBL_moins_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(3)->month)
            ->where([['Etablissement', '=',"DBL"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $TBA=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"TBA"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $TBA_moins_1=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonth()->month)
            ->where([['Etablissement', '=',"TBA"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $TBA_moins_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(2)->month)
            ->where([['Etablissement', '=',"TBA"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $TBA_moins_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(3)->month)
            ->where([['Etablissement', '=',"TBA"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $KLK=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"KLK"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $KLK_moins_1=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonth()->month)
            ->where([['Etablissement', '=',"KLK"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $KLK_moins_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(2)->month)
            ->where([['Etablissement', '=',"KLK"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $KLK_moins_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(3)->month)
            ->where([['Etablissement', '=',"KLK"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $DK1=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"DK1"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $DK1_moins_1=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonth()->month)
            ->where([['Etablissement', '=',"DK1"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $DK1_moins_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(2)->month)
            ->where([['Etablissement', '=',"DK1"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $DK1_moins_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(3)->month)
            ->where([['Etablissement', '=',"DK1"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $DK2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"DK2"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $DK2_moins_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonth()->month)
            ->where([['Etablissement', '=',"DK2"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $DK2_moins_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(2)->month)
            ->where([['Etablissement', '=',"DK2"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $DK2_moins_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(3)->month)
            ->where([['Etablissement', '=',"DK2"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');


            $LGA=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"LGA"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $LGA_moins_1=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonth()->month)
            ->where([['Etablissement', '=',"LGA"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $LGA_moins_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(2)->month)
            ->where([['Etablissement', '=',"LGA"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $LGA_moins_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(3)->month)
            ->where([['Etablissement', '=',"LGA"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $ZIG=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"ZIG"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $ZIG_moins_1=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonth()->month)
            ->where([['Etablissement', '=',"ZIG"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $ZIG_moins_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(2)->month)
            ->where([['Etablissement', '=',"ZIG"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $ZIG_moins_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(3)->month)
            ->where([['Etablissement', '=',"ZIG"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $RUF=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"RUF"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $RUF_moins_1=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonth()->month)
            ->where([['Etablissement', '=',"RUF"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $RUF_moins_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(2)->month)
            ->where([['Etablissement', '=',"RUF"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $RUF_moins_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(3)->month)
            ->where([['Etablissement', '=',"RUF"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $THS=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"THS"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $THS_moins_1=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonth()->month)
            ->where([['Etablissement', '=',"THS"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $THS_moins_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(2)->month)
            ->where([['Etablissement', '=',"THS"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $THS_moins_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(3)->month)
            ->where([['Etablissement', '=',"THS"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $Hann=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"Centre de Hann"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $Hann_moins_1=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonth()->month)
            ->where([['Etablissement', '=',"Centre de Hann"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $Hann_moins_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(2)->month)
            ->where([['Etablissement', '=',"Centre de Hann"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $Hann_moins_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(3)->month)
            ->where([['Etablissement', '=',"Centre de Hann"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');


            $STL=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->month)
            ->where([['Etablissement', '=',"STL"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $STL_moins_1=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonth()->month)
            ->where([['Etablissement', '=',"STL"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $STL_moins_2=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(2)->month)
            ->where([['Etablissement', '=',"STL"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');

            $STL_moins_3=DB::table('heures_supp')->join('agent','agent.Matricule_Agent' ,
            '=','heures_supp.Agent_Matricule_Agent')->whereMonth('Date_Heure', '=',  now()->subMonths(3)->month)
            ->where([['Etablissement', '=',"STL"],
            ['heures_supp.statut', '>=',3]])->whereYear('Date_Heure', '=',$current_year)
            ->sum('total_heures_saisie');


            $usersChartDBL = new UserChart;
            $usersChartDBL->labels([now()->subMonths(3)->month, now()->subMonths(2)->month,now()->subMonth()->month, $current_month]);
            $usersChartDBL->dataset('Evolution  sur les trois derniers mois  ', 'line', [$DBL_moins_3,$DBL_moins_2, $DBL_moins_1,$DBL])
            ->color( "rgb(15, 50,192)" )
            ->backgroundcolor("rgb(94, 219, 23)");;

            $usersChartTBA = new UserChart;
            $usersChartTBA->labels([now()->subMonths(3)->month, now()->subMonths(2)->month,now()->subMonth()->month, $current_month]);
            $usersChartTBA->dataset('Evolution  sur les trois derniers mois  ', 'line', [$TBA_moins_3,$TBA_moins_2, $TBA_moins_1,$TBA])
            ->color( "rgb(15, 50,192)" )
            ->backgroundcolor("rgb(94, 219, 23)");;

            $usersChartNGN = new UserChart;
            $usersChartNGN->labels([now()->subMonths(3)->month, now()->subMonths(2)->month,now()->subMonth()->month, $current_month]);
            $usersChartNGN->dataset('Evolution  sur les trois derniers mois  ', 'line', [$NGN_moins_3,$NGN_moins_2, $NGN_moins_1,$NGN])
            ->color( "rgb(15, 50,192)" )
            ->backgroundcolor("rgb(94, 219, 23)");;

            $usersChartRUF = new UserChart;
            $usersChartRUF->labels([now()->subMonths(3)->month, now()->subMonths(2)->month,now()->subMonth()->month, $current_month]);
            $usersChartRUF->dataset('Evolution  sur les trois derniers mois  ', 'line', [$RUF_moins_3,$RUF_moins_2, $RUF_moins_1,$RUF])
            ->color( "rgb(15, 50,192)" )
            ->backgroundcolor("rgb(94, 219, 23)");;

            $usersChartSTL = new UserChart;
            $usersChartSTL->labels([now()->subMonths(3)->month, now()->subMonths(2)->month,now()->subMonth()->month, $current_month]);
            $usersChartSTL->dataset('Evolution  sur les trois derniers mois  ', 'line', [$STL_moins_3,$STL_moins_2, $STL_moins_1,$STL])
            ->color( "rgb(15, 50,192)" )
            ->backgroundcolor("rgb(94, 219, 23)");;

            $usersChartTHS = new UserChart;
            $usersChartTHS->labels([now()->subMonths(3)->month, now()->subMonths(2)->month,now()->subMonth()->month, $current_month]);
            $usersChartTHS->dataset('Evolution  sur les trois derniers mois  ', 'line', [$THS_moins_3,$THS_moins_2, $THS_moins_1,$THS])
            ->color( "rgb(15, 50,192)" )
            ->backgroundcolor("rgb(94, 219, 23)");;

            $usersChartHann = new UserChart;
            $usersChartHann->labels([now()->subMonths(3)->month, now()->subMonths(2)->month,now()->subMonth()->month, $current_month]);
            $usersChartHann->dataset('Evolution  sur les trois derniers mois  ', 'line', [$Hann_moins_3,$Hann_moins_2, $Hann_moins_1,$Hann])
            ->color( "rgb(15, 50,192)" )
            ->backgroundcolor("rgb(94, 219, 23)");;

            $usersChartKLK = new UserChart;
            $usersChartKLK->labels([now()->subMonths(3)->month, now()->subMonths(2)->month,now()->subMonth()->month, $current_month]);
            $usersChartKLK->dataset('Evolution  sur les trois derniers mois  ', 'line', [$KLK_moins_3,$KLK_moins_2, $KLK_moins_1,$KLK])
            ->color( "rgb(15, 50,192)" )
            ->backgroundcolor("rgb(94, 219, 23)");;


            $usersChartDK1 = new UserChart;
            $usersChartDK1->labels([now()->subMonths(3)->month, now()->subMonths(2)->month,now()->subMonth()->month, $current_month]);
            $usersChartDK1->dataset('Evolution  sur les trois derniers mois  ', 'line', [$DK1_moins_3,$DK1_moins_2, $DK1_moins_1,$DK1])
            ->color( "rgb(15, 50,192)" )
            ->backgroundcolor("rgb(94, 219, 23)");;

            $usersChartDK2 = new UserChart;
            $usersChartDK2->labels([now()->subMonths(3)->month, now()->subMonths(2)->month,now()->subMonth()->month, $current_month]);
            $usersChartDK2->dataset('Evolution  sur les trois derniers mois  ', 'line', [$DK2_moins_3,$DK2_moins_2, $DK2_moins_2,$DK2])
            ->color( "rgb(15, 50,192)" )
            ->backgroundcolor("rgb(94, 219, 23)");;

            $usersChartLGA = new UserChart;
            $usersChartLGA->labels([now()->subMonths(3)->month, now()->subMonths(2)->month,now()->subMonth()->month, $current_month]);
            $usersChartLGA->dataset('Evolution  sur les trois derniers mois  ', 'line', [$LGA_moins_3,$LGA_moins_2, $LGA_moins_1,$LGA])
            ->color( "rgb(15, 50,192)" )
            ->backgroundcolor("rgb(94, 219, 23)");;

            $usersChartZIG = new UserChart;
            $usersChartZIG->labels([now()->subMonths(3)->month, now()->subMonths(2)->month,now()->subMonth()->month, $current_month]);
            $usersChartZIG->dataset('Evolution  sur les trois derniers mois  ', 'line', [$ZIG_moins_3,$ZIG_moins_2, $ZIG_moins_1,$ZIG])
            ->color( "rgb(15, 50,192)" )
            ->backgroundcolor("rgb(94, 219, 23)");;

                    return view('Validation')->with([
                        'role_account'=> $role_account,
                        'agent_attribut'=> $agent_attribut,
                        'nbr_heure'=> $nbr_heure,
                        'usersChartDBL' => $usersChartDBL,
                        'usersChartKLK' => $usersChartKLK,
                        'usersChartDK1' => $usersChartDK1,
                        'heurre_somme' => $heurre_somme,
                        'heurre_somme_n_plus_un' => $heurre_somme_n_plus_un,
                        'data_n_plus_2' => $data_n_plus_2,
                        'data_n_plus_1_count' => $data_n_plus_1_count,
                        'data_n_plus_2_count' => $data_n_plus_2_count,
                        'usersChartDK2' => $usersChartDK2,
                        'total_current_month_dr' => $total_current_month_dr,
                        'total_current_year_dr' => $total_current_year_dr,
                        'usersChartTHS' => $usersChartTHS,
                        'usersChartNGN' => $usersChartNGN,
                        'usersChartTBA' => $usersChartTBA,
                        'usersChartRUF' => $usersChartRUF,
                        'usersChartHann' => $usersChartHann,
                        'usersChartSTL' => $usersChartSTL,
                        'usersChartLGA' => $usersChartLGA,
                        'usersChartZIG' => $usersChartZIG,
                        'heure_supp'=> $heure_supp,
                        'heurre_a_faire'=>$heurre_a_faire,
                        'equipe'=>$equipe,
                        'data_dto'=>$data_dto,
                        'data_dto_count'=>$data_dto_count,
                        'data_dcm'=>$data_dcm,
                        'total_current_month_n_plus_3'=>$total_current_month_n_plus_3,
                        'total_current_year_n_plus_3'=>$total_current_year_n_plus_3,
                        'data_dcm_count,'=>$data_dcm_count,
                        'data_dq'=>$data_dq,
                        'data_dq_count'=>$data_dq_count,
                        'Affectation'=>$Affectation,
                        'service'=>$service
                    ]);


    }
    public function store(Request $request)
    {
        $role=request('role');
        $id=request('id');
        switch ($role){
            case 'n+1':

           $Step=DB::table('agent_Heures_supp_a_faire')
            ->join('agent','agent.Matricule_Agent','=','agent_Heures_supp_a_faire.agentMatricule_Agent')
            ->join('heures_supp','heures_supp.id_heure_a_faire','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
            ->join('Heures_supp_a_faire','Heures_supp_a_faire.ID','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
            ->join('Step','Step.Heures_supp_a_faireID','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
            ->where([
                ['Heures_supp_a_faire.responsable', '=', $id ],
                ['heures_supp.Statut', '=', 1  ],
                ])
            ->update(['etape' => 2]);

            $Heures_supp=DB::table('agent_Heures_supp_a_faire')
            ->join('agent','agent.Matricule_Agent','=','agent_Heures_supp_a_faire.agentMatricule_Agent')
            ->join('heures_supp','heures_supp.id_heure_a_faire','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
            ->join('Heures_supp_a_faire','Heures_supp_a_faire.ID','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
            ->where([
                ['Heures_supp_a_faire.responsable', '=', $id ],
                ['heures_supp.Statut', '=', 1  ],
                ])
            ->update(['heures_supp.Statut' => 2]);

        return back();
          break;
        case 'n+2':
            $etablissement=request('etablissement');
            if ($etablissement == 'HAN') {
                $Heures_supp=DB::table('heures_supp')
                ->where([
                    ['commandeur', '=', $id ],
                    ['Statut', '=', 2],
                    ])
                ->update(['Statut' => 4]);

                $Step=DB::table('Step')
                ->where('Demandeur', '=',$id)
                ->update(['etape' => 2]);
            }
            else {
                $Heures_supp=DB::table('heures_supp')
                ->where([
                    ['commandeur', '=', $id ],
                    ['Statut', '=', 2  ],
                    ])
                ->update(['Statut' => 3]);

                $Step=DB::table('Step')
                ->where('Heures_supp_a_faireID', '=',$id)
                ->update(['etape' => 2]);

            }

        return back()->with('success','Toutes les heure Supplémentaire sont maintenant validées ');
              break;
        case 'dto' :
            $Heures_supp=DB::table('agent_Heures_supp_a_faire')
            ->join('agent','agent.Matricule_Agent','=','agent_Heures_supp_a_faire.agentMatricule_Agent')
            ->join('heures_supp','heures_supp.id_heure_a_faire','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
            ->join('Heures_supp_a_faire','Heures_supp_a_faire.ID','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
            ->where([
                ['agent.Direction', '=', 'DTO' ],
                ['heures_supp.Statut', '=', 3  ],
                ])
            ->update(['heures_supp.Statut' => 4]);

            return back();
              break;

        }

    }
    public function Invalideur(Request $request)
    {
        $role=request('role');
        $id=request('id');
        switch ($role){

        case 'n+2':
                $Heures_supp=DB::table('heures_supp')
                ->where('id_heure_a_faire', '=', $id )
                ->update(['Statut' => 1]);

                $Step=DB::table('Step')
                    ->where('Heures_supp_a_faireID', '=',$id)
                    ->update(['etape' => 1]);
                    return back()->with('success','heures supplémentaire invalidées ');
              break;
        }

    }
    public function details(Request $request)
    {
        $role=request('role');
        $id=request('id');
        $Nom=request('nom');

        $role_account=DB::table('Role_Account')
        ->join('users','users.id' ,'=', 'Role_Account.AccountID')
        ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
        ->join('agent','agent.Matricule_Agent' ,'=','users.id')
        ->select('Matricule_agent','Fonction','Statut','Direction','Role.Nom','Nom_Agent','etablissement')
        ->get();

        $heurre_a_faire=DB::table('agent_Heures_supp_a_faire')
        ->join('agent','agent.Matricule_Agent','=','agent_Heures_supp_a_faire.agentMatricule_Agent')
        ->join('heures_supp','heures_supp.id_heure_a_faire','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
        ->select('agent.Matricule_agent','Nom_Agent','Etablissement','Date_Heure','heure_debut'
        ,'heure_fin','travaux_effectuer','observations','heures_supp.id','heures_supp.Statut','id_heure_a_faire','total_heures_saisie')
        ->where('id_heure_a_faire', '=',$id)
        ->get();

        return view('Details')->with([
            'role_account'=> $role_account,
            'heurre_a_faire'=> $heurre_a_faire,
            'id'=> $id,
            'Nom'=>$Nom
        ]);
    }

    public function InvalideurPerRegion(Request $request)
    {

        $Etablissement=request('Etablissement');

                $Heures_supp=DB::table('heures_supp')
                ->join('agent','agent.Matricule_Agent' ,'=','heures_supp.Agent_Matricule_Agent')
                ->where('etablissement', '=',$Etablissement)
                ->update(['heures_supp.statut' => 2]);
                    return back()->with('success','heures supplémentaire invalidées ');



    }
}
