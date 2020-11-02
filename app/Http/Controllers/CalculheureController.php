<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\User;
use App\Heures_supp;
use App\Step;
use DateTime;
use StdClass;
use Carbon\Carbon;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CalculheuremoisExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Facades\Validator;

class CalculheureController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

    public function index(){
      $role_account=DB::table('Role_Account')
      ->join('users','users.id' ,'=', 'Role_Account.AccountID')
      ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
      ->join('agent','agent.Matricule_Agent' ,'=','users.id')
      ->select('Matricule_agent','Fonction','Statut','Direction','Role.Nom','Nom_Agent','etablissement')
      ->get();

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

         $anne=DB::table('heures_supp')
         ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
         ->select(
             DB::raw('YEAR(Date_Heure) as year')
            )->groupBy('year')
         ->get();
         $etablissement=DB::table('agent')
         ->select('Etablissement')
         ->distinct('Etablissement')
         ->get();

        $array=DB::table('heures_supp')
        ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
        ->get();

        $array_agent=DB::table('heures_supp')
        ->select('Agent_Matricule_Agent','semaine')
        ->distinct('Agent_Matricule_Agent')
        ->get();
        $agent = json_decode(json_encode($array_agent), true);//transformer le stdclass en array
        $heure_supp = json_decode(json_encode($array), true);//transformer le stdclass en array
            return view('Calculheure')->with([
                'heure_supp'=>$heure_supp,
                'role_account'=>$role_account,
                'agent'=>$agent,
                'data'=>$data,
                'anne'=>$anne,
                'etablissement'=>$etablissement
            ]);


       //foreach ($agent as $agents) {
       // foreach ($semaine as  $semaines) {
         //   foreach ($heures_supp as $heures_supps) {
           //  if ($semaines->semaine == $heures_supps->semaine  and date('Y',$heures_supps->Date_Heure== $anne)){
             //   print_r($heures_supps->Date_Heure);
               // print_r($heures_supps->heure_debut);
               // print_r($heures_supps->heure_fin);
               // print_r($heures_supps->Agent_Matricule_Agent);
             //}
           // }
       // }
   // }
    }
    public function export()
    {
        $type='xls';
        return Excel::download(new CalculheuremoisExport, 'heuresupp.' . $type);
    }

    public function Showpermonth(Request $request){
    if (null !=request('month')){

$mois=request('month');
      $role_account=DB::table('Role_Account')
            ->join('users','users.id' ,'=', 'Role_Account.AccountID')
            ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
            ->join('agent','agent.Matricule_Agent' ,'=','users.id')
            ->select('Matricule_agent','Fonction','Statut','Direction','Role.Nom','Nom_Agent','etablissement')
            ->get();
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
            ->whereMonth('Date_Heure', '=', $mois)
            ->groupBy('year','month','agent')
           ->get();

      $anne=DB::table('heures_supp')
      ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
      ->select(
          DB::raw('YEAR(Date_Heure) as year')
         )->groupBy('year')
      ->get();
       $etablissement=DB::table('agent')
         ->select('Etablissement')
         ->distinct('Etablissement')
         ->get();

      $array=DB::table('heures_supp')
      ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
      ->get();
      $array_agent=DB::table('heures_supp')
      ->select('Agent_Matricule_Agent','semaine')
      ->distinct('Agent_Matricule_Agent')
      ->get();
      $mois=request('month');
      $newCollection = collect([$mois,$data]);

      $agent = json_decode(json_encode($array_agent), true);//transformer le stdclass en array
      $heure_supp = json_decode(json_encode($array), true);//transformer le stdclass en array
          return view('CalculheureMois')->with([
              'heure_supp'=>$heure_supp,
              'role_account'=>$role_account,
              'agent'=>$agent,
              'data'=>$data,
              'anne'=>$anne,
              'mois'=>$mois,
              'etablissement'=>$etablissement



          ]);

        }
        else {
          return back()->withInput();
        }
     //foreach ($agent as $agents) {
     // foreach ($semaine as  $semaines) {
       //   foreach ($heures_supp as $heures_supps) {
         //  if ($semaines->semaine == $heures_supps->semaine  and date('Y',$heures_supps->Date_Heure== $anne)){
           //   print_r($heures_supps->Date_Heure);
             // print_r($heures_supps->heure_debut);
             // print_r($heures_supps->heure_fin);
             // print_r($heures_supps->Agent_Matricule_Agent);
           //}
         // }
     // }
 // }
  }
  public function Printpermonth(Request $request){
    $mois=request('month');
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
        DB::raw('(Agent_Matricule_Agent) as agent')
        )->where('heures_supp.Statut', '=', 4)
       ->groupBy('year','month','agent')
       ->get();

//$datas = json_decode(json_encode($array), true);transformer le stdclass en array

$content = "";
      foreach($data as $datas){
        if($datas->month ==  $mois){
            if ($datas->sum15 != 0){
        if ($datas->sum15 >9){
          $content .= $datas->agent.'HS100000'.$datas->sum15;
          $content  .= "\n";

        }
        else
        { $content .=  $datas->agent.'HS1000000'.$datas->sum15;
          $content  .= "\n";
        }
    }
    if ($datas->sum40 != 0){
        if ($datas->sum40>9)
        {
          $content .=  $datas->agent.'HS200000'.$datas->sum40;
          $content  .= "\n";
      }
        else  {
          $content .= $datas->agent.'HS2000000'.$datas->sum40;
          $content  .= "\n";}
        }

        if ($datas->sum60 != 0){
        if ($datas->sum60>9)
        { $content .= $datas->agent.'HS300000'.$datas->sum60;
          $content  .= "\n";
        }
        else {  $content .= $datas->agent.'HS3000000'.$datas->sum60;
          $content  .= "\n";}}
          if ($datas->sum100 != 0){
        if ($datas->sum100>9)
        { $content .= $datas->agent.'HS400000'.$datas->sum100;   $content  .= "\n";}
        else {  $content .= $datas->agent.'HS4000000'.$datas->sum100;   $content  .= "\n";}

          }}

      }
     // file name that will be used in the download
     $fileName = "ZY90_IN";

     // use headers in order to generate the download
     $headers = [
       'Content-type' => 'text/plain',
       'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
       'Content-Length' => strlen($content)
     ];

     // make a response, with the content, a 200 response code and the headers
     return \Response::make($content, 200, $headers);
    }


  public function Showperyear(Request $request){
    if (null !=request('month')){


      $role_account=DB::table('Role_Account')
            ->join('users','users.id' ,'=', 'Role_Account.AccountID')
            ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
            ->join('agent','agent.Matricule_Agent' ,'=','users.id')
            ->select('Matricule_agent','Fonction','Statut','Direction','Role.Nom','Nom_Agent','etablissement')
            ->get();

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
            DB::raw('(Agent_Matricule_Agent) as agent')
            )->where('Statut', '=', 4)
           ->groupBy('year','month','agent')
           ->get();

      $anne=DB::table('heures_supp')
      ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
      ->select(
          DB::raw('YEAR(Date_Heure) as year')
         )->groupBy('year')
      ->get();
      $etablissement=DB::table('agent')
      ->select('Etablissement')
      ->distinct('Etablissement')
      ->get();
      $array=DB::table('heures_supp')
      ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
      ->get();
      $array_agent=DB::table('heures_supp')
      ->select('Agent_Matricule_Agent','semaine')
      ->distinct('Agent_Matricule_Agent')
      ->get();
      $mois=request('month');
      $agent = json_decode(json_encode($array_agent), true);//transformer le stdclass en array
      $heure_supp = json_decode(json_encode($array), true);//transformer le stdclass en array
          return view('CalculheureMois')->with([
              'heure_supp'=>$heure_supp,
              'role_account'=>$role_account,
              'agent'=>$agent,
              'data'=>$data,
              'anne'=>$anne,
              'mois'=>$mois,
              'etablissement'=>$etablissement



          ]);

        }
        else {
          return back()->withInput();
        }
     //foreach ($agent as $agents) {
     // foreach ($semaine as  $semaines) {
       //   foreach ($heures_supp as $heures_supps) {
         //  if ($semaines->semaine == $heures_supps->semaine  and date('Y',$heures_supps->Date_Heure== $anne)){
           //   print_r($heures_supps->Date_Heure);
             // print_r($heures_supps->heure_debut);
             // print_r($heures_supps->heure_fin);
             // print_r($heures_supps->Agent_Matricule_Agent);
           //}
         // }
     // }
 // }
  }
  public function Showpersecteur(Request $request){
    if (null !=request('year')){


      $role_account=DB::table('Role_Account')
            ->join('users','users.id' ,'=', 'Role_Account.AccountID')
            ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
            ->join('agent','agent.Matricule_Agent' ,'=','users.id')
            ->select('Matricule_agent','Fonction','Statut','Direction','Role.Nom','Nom_Agent','etablissement')
            ->get();
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

      $anne=DB::table('heures_supp')
      ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
      ->select(
          DB::raw('YEAR(Date_Heure) as year')
         )->groupBy('year')
      ->get();
      $etablissement=DB::table('agent')
      ->select('Etablissement')
      ->distinct('Etablissement')
      ->get();

      $array=DB::table('heures_supp')
      ->join('agent','agent.Matricule_Agent' ,'=','Agent_Matricule_Agent')
      ->get();
      $array_agent=DB::table('heures_supp')
      ->select('Agent_Matricule_Agent','semaine')
      ->distinct('Agent_Matricule_Agent')
      ->get();
      $mois=request('month');
      $agent = json_decode(json_encode($array_agent), true);//transformer le stdclass en array
      $heure_supp = json_decode(json_encode($array), true);//transformer le stdclass en array
          return view('CalculheureSecteur')->with([
              'heure_supp'=>$heure_supp,
              'role_account'=>$role_account,
              'agent'=>$agent,
              'data'=>$data,
              'anne'=>$anne,
              'mois'=>$mois,
              'etablissement'=>$etablissement



          ]);

        }
        else {
          return back()->withInput();
        }
     //foreach ($agent as $agents) {
     // foreach ($semaine as  $semaines) {
       //   foreach ($heures_supp as $heures_supps) {
         //  if ($semaines->semaine == $heures_supps->semaine  and date('Y',$heures_supps->Date_Heure== $anne)){
           //   print_r($heures_supps->Date_Heure);
             // print_r($heures_supps->heure_debut);
             // print_r($heures_supps->heure_fin);
             // print_r($heures_supps->Agent_Matricule_Agent);
           //}
         // }
     // }
 // }
  }
    }

