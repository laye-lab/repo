<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\User;
use App\Heures_supp;
use App\Step;
use DateTime;
use StdClass;
use Carbon\Carbon;
use App\Http\Requests\StoreSaisieRequest;
use App\Http\Requests\UpdateSaisie;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Facades\Validator;


class SaisieController extends Controller
{ public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {

        $user=auth()->user()->id;
        $Date_debut=request('Date_debut');

        $Date_fin=request('Date_fin');

        $collab=request('id');

        $nbr_heure=request('nbr_heure');

        $id_heure=request('id_heure');

        $nom=request('nom');

        $servicedr=request('servicedr');

        $role_account=DB::table('Role_Account')
        ->join('users','users.id' ,'=', 'Role_Account.AccountID')
        ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
        ->join('agent','agent.Matricule_Agent' ,'=','users.id')
        ->select('Matricule_agent','Fonction','Statut','Direction','Role.Nom','Nom_Agent','etablissement')
        ->get();
        $agent_etablissement=DB::table('agent')
        ->select('agent.Matricule_agent','Nom_Agent','Fonction','agent.Statut'
        ,'Direction','Etablissement','Affectation')
        ->get();
        $equipe=DB::table('equipe')
        ->get();

       return view('Saisie')->with([
                'role_account'=>$role_account,
                'collab'=>$collab,
                'nom'=>$nom,
                'agent_etablissement'=>$agent_etablissement,
                'servicedr'=>$servicedr,
                'Date_debut'=>$Date_debut,
                'Date_fin'=>$Date_fin,
                'equipe'=>$equipe,
                'nbr_heure'=>$nbr_heure,
                'id_heure'=>$id_heure,

                ] );
    }

    public function Updateindex(Request $request)
    {

        $role_account=DB::table('Role_Account')
        ->join('users','users.id' ,'=', 'Role_Account.AccountID')
        ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
        ->join('agent','agent.Matricule_Agent' ,'=','users.id')
        ->select('Matricule_agent','Fonction','Statut','Direction','Role.Nom','Nom_Agent','etablissement')
        ->get();
        $id=request('id');
        $heure=DB::table('Heures_supp_a_faire')
        ->get();

        $data =DB::table('heures_supp')
        ->join('Heures_supp_a_faire','Heures_supp_a_faire.ID' ,'=','heures_supp.id')
        ->where('heures_supp.id', '=',$id)
        ->get();

        return view('ModifSaisie')->with([
            'id' =>  $id,
            'data'=> $data,
            'role_account' =>$role_account,
            'heure' =>$heure
            ]);

    }

    public function  Update(request $request)
    {
        $id=request('id');
        $id_from_dr=request('id_from_dr');

        if ($id != null) {
            $Heures_supp=DB::table('heures_supp')
            ->where('id', '=', $id )
            ->delete();
           return back()->with('success','heure supplémentaire supprimée ');
            }
        if ($id_from_dr != null) {

            $commande=DB::table('agent_Heures_supp_a_faire')
            ->join('Step','Step.Heures_supp_a_faireID','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
            ->join('agent','agent.Matricule_Agent','=','agent_Heures_supp_a_faire.agentMatricule_Agent')
            ->join('Heures_supp_a_faire','Heures_supp_a_faire.ID','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
            ->where('Heures_supp_a_faire.id', '=', $id_from_dr )
            ->delete();

            return back()->with('success','heure supplémentaire supprimée ');
            }

    }



    public function store(StoreSaisieRequest $request)
    {



    $date1=strtotime(request('Date_Heure'));
    $date=date('Y-m-d',$date1);
    $semaine=date('W',$date1);
    $jours_semaine=date('w',$date1);

    $heure_debut1 =strtotime(request('heure_debut'));
    $heure_debut=date('H',$heure_debut1);
    $heure_fin1 =strtotime(request('heure_fin'));
    $heure_fin=date('H',$heure_fin1);
    $collaborateur=request('collaborateur');
    $id_heure=request('id_heure');

    $nbr_heure=request('nbr_heure');

    $servicedr=request('servicedr');
    $heuresaisie = DB::table('heures_supp')
    ->sum('total_heures_saisie');

    $Taux_string= DB::table('agent')
    ->select('Taux')
    ->where('Matricule_Agent','=',$collaborateur)
    ->first();

    $Taux =(float)str_replace(',', '.', $Taux_string->Taux);

    $role_account=DB::table('Role_Account')
    ->join('users','users.id' ,'=', 'Role_Account.AccountID')
    ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
    ->join('agent','agent.Matricule_Agent' ,'=','users.id')
    ->select('Matricule_agent','Fonction','Statut','Direction','Role.Nom','Nom_Agent','etablissement')
    ->get();

    $verif_doublon=DB::table('heures_supp')
    ->where([
        ['id_heure_a_faire','=',$id_heure],
        ['Date_Heure','=',$date]])
    ->get();

    $Isempty_doublon=$verif_doublon->isEmpty();



    ///////////////////////////////////////////////////////////////verification existance doublons //////////////////////////////////////////////////////////////////////////////////////

    $verif_doublon=DB::table('heures_supp')
    ->where([
        ['id_heure_a_faire','=',$id_heure],
        ['Date_Heure','=',$date]])
    ->get();

    $Isempty_doublon=$verif_doublon->isEmpty();

    if($Isempty_doublon != 'true'){
     return back()->with('notif','vous avez déja saisie des heures pour cette date');
      }

    ///////////////////////////////////////////////////////////////verification la saisie est faite sur le meme jour  ///////////////////////////////////////////////////////////////////

   if ($heure_fin == 00){
    $heure_fin =24;
        }
   if ( $heure_debut >=  $heure_fin) {
    return back()->with('notif','l l\'heure de début  est supérieur à \'heure de fin');
}


   ////////////////////////////////////////////////////////////////verification jour ferie /////////////////////////////////////////////////////////////////////////////////////////////
   $jours_ferie = array(
    'Jour de l\'an'=>'2019-01-01',
    'Fête Nationale'=>'2019-04-04',
    'Lundi Paques'=>'2019-04-22',
    'Fête du Travail'=>'2019-05-01',
    'Ascension'=>'2019-05-30',
    'Korite'=>'2019-11-09',
    'Pentecote'=>'2019-06-05',
    'Tabaski'=>'2019-08-12',
    'Assomption'=>'2019-08-15',
    'Tamkharit'=>'2019-11-09',
    'Magal de Touba'=>'2019-10-18',
    'Toussaint'=>'2019-11-01',
    'Maouloud'=>'2019-11-09',
    'Noël'=>'2019-12-25',
    'Noël'=>'2020-08-16'
);
if (in_array($date, $jours_ferie) or $jours_semaine==00) {
    $isFerie=true;
}else {
    $isFerie=false;
}


    ///////////////////////////////////////////////////////////////verification saisie totalement dans le jour   ///////////////////////////////////////////////////////////////////
  if ( $heure_fin>=5 && $heure_debut>=5 && $heure_fin<=22 && $heure_debut<=22  ) {
    $isMatin=true;
}else {
    $isMatin=false;
}

     ///////////////////////////////////////////////////////////////verification saisie totalement dans la nuit   ///////////////////////////////////////////////////////////////////
     if(($heure_fin<=24 && $heure_debut>=22 && $heure_debut<=24 && $heure_fin>=22) || ($heure_fin<=5 && $heure_debut>=00 && $heure_debut<=5 && $heure_fin>=00)){

        $isSoir=true;
    }else {
        $isSoir=false;
    }

     ///////////////////////////////////////////////////////////////verification chevauchement periode   ///////////////////////////////////////////////////////////////////

     /// nuit vers jours : date de debut dans la nuit et date de fin dans le jour
     if ( $heure_fin>=5 && $heure_fin<=22 && $heure_debut>=00 && $heure_debut<=5 ) {
        $nuit_vers_jour=true;
    }else {
        $nuit_vers_jour=false;

    }

      /// jours vers nuit : date de debut dans le jour  et date de fin dans la nuit
      if ( $heure_debut>=5 && $heure_debut<=22 && $heure_fin<=24 && $heure_fin>=22 ) {
        $jour_vers_nuit =true;
    }else {
        $jour_vers_nuit=false;
    }


    ///////////////////////////////////////////////////////////////verification la saisie est faite sur le meme jour  ///////////////////////////////////////////////////////////////////

    $service=DB::table('affectation')
        ->select('Libelle_Affectation','Etablissemt_nom','agentMatricule_Agent')
        ->distinct('Libelle_Affectation')
        ->select('Libelle_Affectation','Etablissemt_nom')
        ->get();
        $affectation=DB::table('affectation')
        ->select('Libelle_Affectation','Etablissemt_nom','agentMatricule_Agent')
        ->get();



    $total_heure_latest=DB::table('heures_supp')
    ->select('total_heures_saisie')
    ->where([
        ['semaine','=',$semaine],
        ['id_heure_a_faire','=',$id_heure]
    ])
    ->sum('total_heures_saisie');


    $total_heure_latest_total=DB::table('heures_supp')
    ->select('total_heures_saisie')
    ->where([
        ['Agent_Matricule_Agent','=',$collaborateur],
        ['id_heure_a_faire','=',$id_heure]

    ])
    ->sum('total_heures_saisie');
if ($heure_debut>$heure_fin) {
    if (($total_heure_latest_total + ($heure_debut - $heure_fin ))>=  $nbr_heure) {

        return back()->with('erreur','Vous avez depassé le total d\'heure commandé ');
    }
}
else{
    if (($total_heure_latest_total + ($heure_fin - $heure_debut))>=  $nbr_heure) {

        return back()->with('erreur','Vous avez depassé le total d\'heure commandé ');
    }

}





        $Demadeur_heure=DB::table('Heures_supp_a_faire')
        ->select('Demandeur')
        ->where('ID','=',$id_heure)
        ->first();


		Carbon::setWeekStartsAt(Carbon::SUNDAY);
        $Heures_supp = new Heures_supp;

        $Heures_supp->Date_Heure =$date;
        $Heures_supp->heure_debut =$heure_debut;
        $Heures_supp->heure_fin =$heure_fin;
        $Heures_supp->Agent_Matricule_Agent =$collaborateur;
        $Heures_supp->travaux_effectuer =request('travaux_effectuer');
        $Heures_supp->Observations =request('Observations');
        $Heures_supp->Statut =1;
		$Heures_supp->commandeur =$Demadeur_heure->Demandeur;
        $Heures_supp->semaine =$semaine;
        $Heures_supp->id_step =1;
		$Heures_supp->id_heure_a_faire = $id_heure;

				$total_taux_15=0;
				$total_taux_40=0;
				$total_taux_60=0;
				$total_taux_100=0;
				$Total=0;
    /////////////////////////////////////////////////////////////////////////////////jour ferie ///////////////////////////////////////////////////////////////////////////////////

                if($isFerie==true){
                                        if($isMatin==true)/// si on est  le matin
                                                             {
                                                                $diff_heure =$heure_fin-$heure_debut;

                                                                        $nbre_taux_15   =0;
                                                                        $total_taux_15  = $total_taux_15 + $nbre_taux_15;

                                                                        $nbre_taux_40   = 0;
                                                                        $total_taux_40  = $total_taux_40 + $nbre_taux_40;

                                                                        $nbre_taux_60   = $diff_heure;
                                                                        $total_taux_60  = $total_taux_60 + $nbre_taux_60;

                                                                        $nbre_taux_100  = 0;
                                                                        $total_taux_100 = $total_taux_100 + $nbre_taux_100;

                                                                        $total_heures_saisie = $nbre_taux_15 + $nbre_taux_40 + $nbre_taux_60 + $nbre_taux_100;
                                                                        $Total  +=$total_heure_latest+$diff_heure;

                                                                        $Heures_supp->total_taux_15 =$total_taux_15;
                                                                        $Heures_supp->total_taux_40 =$total_taux_40;
                                                                        $Heures_supp->total_heures_saisie =$total_heures_saisie;
                                                                        $Heures_supp->total_taux_60 =$total_taux_60;
                                                                        $Heures_supp->total_taux_100 =$total_taux_100;

                                                                        $Heures_supp->Mont_15 =$total_taux_15 * $Taux * 1.15 ;
                                                                        $Heures_supp->Mont_40 =$total_taux_40 * $Taux * 1.40 ;
                                                                        $Heures_supp->Mont_60 =$total_taux_60 * $Taux * 1.60 ;
                                                                        $Heures_supp->Mont_100 =$total_taux_100 * $Taux * 2 ;

                                                                        $Heures_supp->Total =$Total;
                                                                        $Heures_supp->save();
                                                             }




                                          if($isSoir== true)/// si  on est le soir
                                        {

                                                                        $diff_heure =$heure_fin-$heure_debut;


                                                                        $diff_heure =$heure_fin-$heure_debut;

                                                                        $nbre_taux_15   =0;
                                                                        $total_taux_15  = $total_taux_15 + $nbre_taux_15;

                                                                        $nbre_taux_40   = 0;
                                                                        $total_taux_40  = $total_taux_40 + $nbre_taux_40;

                                                                        $nbre_taux_60   = 0;
                                                                        $total_taux_60  = $total_taux_60 + $nbre_taux_60;

                                                                        $nbre_taux_100  = $diff_heure;
                                                                        $total_taux_100 = $total_taux_100 + $nbre_taux_100;

                                                                        $total_heures_saisie = $nbre_taux_15 + $nbre_taux_40 + $nbre_taux_60 + $nbre_taux_100;
                                                                        $Total  +=$total_heure_latest+$diff_heure;

                                                                        $Heures_supp->total_taux_15 =$total_taux_15;
                                                                        $Heures_supp->total_taux_40 =$total_taux_40;
                                                                        $Heures_supp->total_heures_saisie =$total_heures_saisie;
                                                                        $Heures_supp->total_taux_60 =$total_taux_60;
                                                                        $Heures_supp->total_taux_100 =$total_taux_100;

                                                                        $Heures_supp->Mont_15 =$total_taux_15 * $Taux * 1.15 ;
                                                                        $Heures_supp->Mont_40 =$total_taux_40 * $Taux * 1.40 ;
                                                                        $Heures_supp->Mont_60 =$total_taux_60 * $Taux * 1.60 ;
                                                                        $Heures_supp->Mont_100 =$total_taux_100 * $Taux * 2 ;
                                                                        $Heures_supp->Total =$Total;
                                                                        $Heures_supp->save();
                                                              }



                                        if($jour_vers_nuit==true)/// si on est dans le matin et le soir  et on est le soir
                                        {

                                            $diff_heure =$heure_fin-$heure_debut;

                                            $heure_in_jour= 22- $heure_debut;
                                            $heure_in_nuit= $diff_heure -  $heure_in_jour;


                                            $nbre_taux_15   =0;
                                            $total_taux_15  = $total_taux_15 + $nbre_taux_15;

                                            $nbre_taux_40   =0 ;
                                            $total_taux_40  = $total_taux_40 + $nbre_taux_40;

                                            $nbre_taux_100  =  $heure_in_nuit;
                                            $total_taux_100 = $total_taux_100 + $nbre_taux_100;


                                            $nbre_taux_60   =  $heure_in_jour;
                                            $total_taux_60  = $total_taux_60 + $nbre_taux_60;

                                                        $total_heures_saisie = $total_taux_100+$nbre_taux_60+ $nbre_taux_40+ $nbre_taux_15 ;
                                                                        $Total  = $diff_heure;
                                                                        $Heures_supp->total_taux_15 =$total_taux_15;
                                                                        $Heures_supp->total_taux_40 =$total_taux_40;

                                                                        $Heures_supp->total_taux_60 =$total_taux_60;
                                                                        $Heures_supp->total_taux_100 =$total_taux_100;
                                                                        $Heures_supp->total_heures_saisie =$total_heures_saisie ;

                                                                        $Heures_supp->Mont_15 =$total_taux_15 * $Taux * 1.15 ;
                                                                        $Heures_supp->Mont_40 =$total_taux_40 * $Taux * 1.40 ;
                                                                        $Heures_supp->Mont_60 =$total_taux_60 * $Taux * 1.60 ;
                                                                        $Heures_supp->Mont_100 =$total_taux_100 * $Taux * 2 ;

                                                                        $Heures_supp->Total = $diff_heure;
                                                                        $Heures_supp->save();

                                                    }
                                            if($nuit_vers_jour==true)/// debut dans le matin et fin dans le soir avec soir date de debut
                                            {
                                                $diff_heure =$heure_fin-$heure_debut;
                                                $heure_in_nuit= 5-$heure_debut;
                                                $heure_in_jour=  $diff_heure -  $heure_in_nuit;


                                                            $nbre_taux_15   =0;
                                                            $total_taux_15  = $total_taux_15 + $nbre_taux_15;

                                                            $nbre_taux_40   =0 ;
                                                            $total_taux_40  = $total_taux_40 + $nbre_taux_40;

                                                            $nbre_taux_100  =  $heure_in_nuit;
                                                            $total_taux_100 = $total_taux_100 + $nbre_taux_100;


                                                            $nbre_taux_60   =  $heure_in_jour;
                                                            $total_taux_60  = $total_taux_60 + $nbre_taux_60;



                                                            $total_heures_saisie = $total_taux_100+$nbre_taux_60+ $nbre_taux_40+ $nbre_taux_15 ;
                                                                            $Total  = $diff_heure;
                                                                            $Heures_supp->total_taux_15 =$total_taux_15;
                                                                            $Heures_supp->total_taux_40 =$total_taux_40;

                                                                            $Heures_supp->total_taux_60 =$total_taux_60;
                                                                            $Heures_supp->total_taux_100 =$total_taux_100;

                                                                        $Heures_supp->Mont_15 =$total_taux_15 * $Taux * 1.15 ;
                                                                        $Heures_supp->Mont_40 =$total_taux_40 * $Taux * 1.40 ;
                                                                        $Heures_supp->Mont_60 =$total_taux_60 * $Taux * 1.60 ;
                                                                        $Heures_supp->Mont_100 =$total_taux_100 * $Taux * 2 ;
                                                                            $Heures_supp->total_heures_saisie =$total_heures_saisie ;

                                                                            $Heures_supp->Total = $diff_heure;
                                                                            $Heures_supp->save();

                                        }



                                 }
/////////////////////////////////////////////////////////////////////////////// jour  ouvrable /////////////////////////////////////////////////////////////////////////////////////////


            if($isFerie==false){
                                            if($isSoir== true)/// si on est dans un jour ourable et on est le soir
                                            {

                                                $diff_heure =$heure_fin-$heure_debut;
                                                if(!isset($total_heure_latest)){
                                                $total_heure_latest =new StdClass;
                                                $total_heure_latest=0;
                                                    }
                                                                $diff_heure =$heure_fin-$heure_debut;

                                                                $nbre_taux_15   = 0;
                                                                $total_taux_15  = $total_taux_15 + $nbre_taux_15;

                                                                $nbre_taux_40   = 0;
                                                                $total_taux_40  = $total_taux_40 + $nbre_taux_40;

                                                                $nbre_taux_60   = $diff_heure;
                                                                $total_taux_60  = $total_taux_60 + $nbre_taux_60;

                                                                $nbre_taux_100  = 0;
                                                                $total_taux_100 = $total_taux_100 + $nbre_taux_100;

                                                                $total_heures_saisie = $nbre_taux_15 + $nbre_taux_40 + $nbre_taux_60 + $nbre_taux_100;
                                                                $Total  =$total_heure_latest+$diff_heure;
                                                                $Heures_supp->total_taux_15 =$total_taux_15;
                                                                $Heures_supp->total_taux_40 =$total_taux_40;

                                                                $Heures_supp->total_taux_60 =$total_taux_60;
                                                                $Heures_supp->total_taux_100 =$total_taux_100;
                                                                $Heures_supp->total_heures_saisie =$total_heures_saisie ;


                                                                $Heures_supp->Mont_15 =$total_taux_15 * $Taux * 1.15 ;
                                                                $Heures_supp->Mont_40 =$total_taux_40 * $Taux * 1.40 ;
                                                                $Heures_supp->Mont_60 =$total_taux_60 * $Taux * 1.60 ;
                                                                $Heures_supp->Mont_100 =$total_taux_100 * $Taux * 2 ;

                                                                $Heures_supp->Total =$Total;
                                                                $Heures_supp->save();

                                              }



                                                if($isMatin==true)/// si on est  le matin
                                                        {
                                                                    $diff_heure =$heure_fin-$heure_debut;
                                                                    if(!isset($total_heure_latest)){
                                                                    $total_heure_latest =new StdClass;
                                                                    $total_heure_latest=0;
                                                                        }

                                                                        if($total_heure_latest<=8)
                                                                        {
                                                                                if (8-$total_heure_latest>= $diff_heure) {
                                                                                    # code...
                                                                                    $nbre_taux_15   = $diff_heure;
                                                                                    $total_taux_15  = $total_taux_15 + $nbre_taux_15;

                                                                                    $nbre_taux_40   = 0;
                                                                                    $total_taux_40  = $total_taux_40 + $nbre_taux_40;

                                                                                }
                                                                                else {
                                                                                    $nbre_taux_15   = 8-$total_heure_latest;
                                                                                $total_taux_15  = $total_taux_15 + $nbre_taux_15;

                                                                                $nbre_taux_40   = $diff_heure - $nbre_taux_15 ;
                                                                                $total_taux_40  = $total_taux_40 + $nbre_taux_40;
                                                                                }
                                                                                    $nbre_taux_60   = 0;
                                                                                    $total_taux_60  = $total_taux_60 + $nbre_taux_60;

                                                                                    $nbre_taux_100  = 0;
                                                                                    $total_taux_100 = $total_taux_100 + $nbre_taux_100;

                                                                                    $total_heures_saisie = $nbre_taux_15 + $nbre_taux_40 + $nbre_taux_60 + $nbre_taux_100;
                                                                                    $Total  +=$total_heure_latest+$diff_heure;

                                                                                    $Heures_supp->total_taux_15 =$total_taux_15;
                                                                                    $Heures_supp->total_taux_40 =$total_taux_40;
                                                                                    $Heures_supp->total_heures_saisie =$total_heures_saisie;
                                                                                    $Heures_supp->total_taux_60 =$total_taux_60;
                                                                                    $Heures_supp->total_taux_100 =$total_taux_100;


                                                                                    $Heures_supp->Mont_15 =$total_taux_15 * $Taux * 1.15 ;
                                                                                    $Heures_supp->Mont_40 =$total_taux_40 * $Taux * 1.40 ;
                                                                                    $Heures_supp->Mont_60 =$total_taux_60 * $Taux * 1.60 ;
                                                                                    $Heures_supp->Mont_100 =$total_taux_100 * $Taux * 2 ;

                                                                                    $Heures_supp->Total =$Total;
                                                                                    $Heures_supp->save();
                                                                        }


                                                                    if($total_heure_latest>8)
                                                                    {


                                                                                $nbre_taux_15   = 0;
                                                                                    $total_taux_15  = $total_taux_15 + $nbre_taux_15;

                                                                                    $nbre_taux_40   = $diff_heure;
                                                                                    $total_taux_40  = $total_taux_40 + $nbre_taux_40;

                                                                                    $nbre_taux_60   = 0;
                                                                                    $total_taux_60  = $total_taux_60 + $nbre_taux_60;

                                                                                    $nbre_taux_100  = 0;
                                                                                    $total_taux_100 = $total_taux_100 + $nbre_taux_100;
                                                                                    $total_heures_saisie = $nbre_taux_15 + $nbre_taux_40 + $nbre_taux_60 + $nbre_taux_100;
                                                                                    $Total  =$total_heure_latest+$diff_heure;
                                                                                    $Heures_supp->total_taux_15 =$total_taux_15;
                                                                                    $Heures_supp->total_taux_40 =$total_taux_40;

                                                                                    $Heures_supp->total_taux_60 =$total_taux_60;
                                                                                    $Heures_supp->total_taux_100 =$total_taux_100;
                                                                                    $Heures_supp->total_heures_saisie =$total_heures_saisie ;


                                                                                    $Heures_supp->Mont_15 =$total_taux_15 * $Taux * 1.15 ;
                                                                                    $Heures_supp->Mont_40 =$total_taux_40 * $Taux * 1.40 ;
                                                                                    $Heures_supp->Mont_60 =$total_taux_60 * $Taux * 1.60 ;
                                                                                    $Heures_supp->Mont_100 =$total_taux_100 * $Taux * 2 ;

                                                                                    $Heures_supp->Total =$Total;
                                                                                    $Heures_supp->save();



                                                            }

                                                        }

                            if($jour_vers_nuit==true)/// si on est dans le matin et le soir  et on est le soir
                                                            {

                                                                $diff_heure =$heure_fin-$heure_debut;
                                                                $heure_in_jour= 22- $heure_debut;
                                                                $heure_in_nuit= $diff_heure -  $heure_in_jour;
                                                                    if(!isset($total_heure_latest)){
                                                                    $total_heure_latest =new StdClass;
                                                                    $total_heure_latest=0;
                                                                        }
                                                                        if($total_heure_latest<=8)
                                                                        {
                                                                            $reste_8 =8-$total_heure_latest;

                                                                            if ($reste_8 >=  $heure_in_jour) {
                                                                                # code...
                                                                                $nbre_taux_15   = $heure_in_jour;
                                                                                $total_taux_15  = $total_taux_15 + $nbre_taux_15;

                                                                                $nbre_taux_40   = 0;
                                                                                $total_taux_40  = $total_taux_40 + $nbre_taux_40;

                                                                            }
                                                                            else {

                                                                                $nbre_taux_15   = $reste_8;
                                                                            $total_taux_15  = $total_taux_15 + $nbre_taux_15;

                                                                            $nbre_taux_40   =  $heure_in_jour - $nbre_taux_15 ;
                                                                            $total_taux_40  = $total_taux_40 + $nbre_taux_40;
                                                                            }

                                                                                $nbre_taux_60   = $heure_in_nuit;
                                                                                $total_taux_60  = $total_taux_60 + $nbre_taux_60;

                                                                                $nbre_taux_100  = 0;
                                                                                $total_taux_100 = $total_taux_100 + $nbre_taux_100;

                                                                                $total_heures_saisie = $total_taux_100+$nbre_taux_60+ $nbre_taux_40+ $nbre_taux_15 ;
                                                                                                $Total  = $diff_heure;
                                                                                                $Heures_supp->total_taux_15 =$total_taux_15;
                                                                                                $Heures_supp->total_taux_40 =$total_taux_40;

                                                                                                $Heures_supp->total_taux_60 =$total_taux_60;
                                                                                                $Heures_supp->total_taux_100 =$total_taux_100;
                                                                                                $Heures_supp->total_heures_saisie =$total_heures_saisie ;


                                                                                                $Heures_supp->Mont_15 =$total_taux_15 * $Taux * 1.15 ;
                                                                                                $Heures_supp->Mont_40 =$total_taux_40 * $Taux * 1.40 ;
                                                                                                $Heures_supp->Mont_60 =$total_taux_60 * $Taux * 1.60 ;
                                                                                                $Heures_supp->Mont_100 =$total_taux_100 * $Taux * 2 ;

                                                                                                $Heures_supp->Total = $diff_heure;
                                                                                                $Heures_supp->save();
                                                                            }
                                                                            if($total_heure_latest>8)
                                                                            {
                                                                                    $nbre_taux_15   = 0;
                                                                                    $total_taux_15  = $total_taux_15 + $nbre_taux_15;

                                                                                    $nbre_taux_40   = $heure_in_jour ;
                                                                                    $total_taux_40  = $total_taux_40 + $nbre_taux_40;

                                                                                    $nbre_taux_60   = $heure_in_nuit ;
                                                                                    $total_taux_60  = $total_taux_60 + $nbre_taux_60;

                                                                                    $nbre_taux_100  = 0;
                                                                                    $total_taux_100 = $total_taux_100 + $nbre_taux_100;

                                                                                    $total_heures_saisie = $nbre_taux_15 + $nbre_taux_40 + $nbre_taux_60 + $nbre_taux_100;
                                                                                    $Total  =$total_heure_latest+$diff_heure;
                                                                                    $Heures_supp->total_taux_15 =$total_taux_15;
                                                                                    $Heures_supp->total_taux_40 =$total_taux_40;

                                                                                    $Heures_supp->total_taux_60 =$total_taux_60;
                                                                                    $Heures_supp->total_taux_100 =$total_taux_100;
                                                                                    $Heures_supp->total_heures_saisie =$total_heures_saisie ;


                                                                                    $Heures_supp->Mont_15 =$total_taux_15 * $Taux * 1.15 ;
                                                                                    $Heures_supp->Mont_40 =$total_taux_40 * $Taux * 1.40 ;
                                                                                    $Heures_supp->Mont_60 =$total_taux_60 * $Taux * 1.60 ;
                                                                                    $Heures_supp->Mont_100 =$total_taux_100 * $Taux * 2 ;

                                                                                    $Heures_supp->Total =$Total;
                                                                                    $Heures_supp->save();
                                                                                }
                                                                }
                                        if($nuit_vers_jour==true)/// debut dans le matin et fin dans le soir avec soir date de debut
                                        {

                                                                        $diff_heure =$heure_fin-$heure_debut;
                                                                        $heure_in_nuit= 5-$heure_debut;
                                                                        $heure_in_jour=  $diff_heure -  $heure_in_nuit;

                                                                        if(!isset($total_heure_latest)){
                                                                        $total_heure_latest =new StdClass;
                                                                        $total_heure_latest=0;
                                                                            }
                                                                            if($total_heure_latest<=8)
                                                                            {
                                                                                $reste_8 =8-$total_heure_latest;

                                                                                if ($reste_8 >=  $heure_in_jour) {
                                                                                    # code...
                                                                                    $nbre_taux_15   = $heure_in_jour;
                                                                                    $total_taux_15  = $total_taux_15 + $nbre_taux_15;

                                                                                    $nbre_taux_40   = 0;
                                                                                    $total_taux_40  = $total_taux_40 + $nbre_taux_40;

                                                                                }
                                                                                else {

                                                                                    $nbre_taux_15   =$reste_8;
                                                                                $total_taux_15  = $total_taux_15 + $nbre_taux_15;

                                                                                $nbre_taux_40   =  $heure_in_jour - $nbre_taux_15 ;
                                                                                $total_taux_40  = $total_taux_40 + $nbre_taux_40;
                                                                                }

                                                                                $nbre_taux_60   = $heure_in_nuit;
                                                                                $total_taux_60  = $total_taux_60 + $nbre_taux_60;

                                                                                $nbre_taux_100  = 0;
                                                                                $total_taux_100 = $total_taux_100 + $nbre_taux_100;
                                                                                    $total_heures_saisie = $total_taux_100+$nbre_taux_60+ $nbre_taux_40+ $nbre_taux_15 ;
                                                                                                    $Total  = $diff_heure;
                                                                                                    $Heures_supp->total_taux_15 =$total_taux_15;
                                                                                                    $Heures_supp->total_taux_40 =$total_taux_40;

                                                                                                    $Heures_supp->total_taux_60 =$total_taux_60;
                                                                                                    $Heures_supp->total_taux_100 =$total_taux_100;
                                                                                                    $Heures_supp->total_heures_saisie =$total_heures_saisie ;

                                                                                                    $Heures_supp->Mont_15 =$total_taux_15 * $Taux * 1.15 ;
                                                                                                    $Heures_supp->Mont_40 =$total_taux_40 * $Taux * 1.40 ;
                                                                                                    $Heures_supp->Mont_60 =$total_taux_60 * $Taux * 1.60 ;
                                                                                                    $Heures_supp->Mont_100 =$total_taux_100 * $Taux * 2 ;

                                                                                                    $Heures_supp->Total = $diff_heure;
                                                                                                    $Heures_supp->save();
                                                                                }
                                                                                if($total_heure_latest>8)
                                                                            {
                                                                                    $nbre_taux_15   = 0;
                                                                                    $total_taux_15  = $total_taux_15 + $nbre_taux_15;

                                                                                    $nbre_taux_40   = $heure_in_jour ;
                                                                                    $total_taux_40  = $total_taux_40 + $nbre_taux_40;

                                                                                    $nbre_taux_60   = $heure_in_nuit ;
                                                                                    $total_taux_60  = $total_taux_60 + $nbre_taux_60;

                                                                                    $nbre_taux_100  = 0;
                                                                                    $total_taux_100 = $total_taux_100 + $nbre_taux_100;

                                                                                    $total_heures_saisie = $nbre_taux_15 + $nbre_taux_40 + $nbre_taux_60 + $nbre_taux_100;
                                                                                    $Total  =$total_heure_latest+$diff_heure;
                                                                                    $Heures_supp->total_taux_15 =$total_taux_15;
                                                                                    $Heures_supp->total_taux_40 =$total_taux_40;

                                                                                    $Heures_supp->total_taux_60 =$total_taux_60;
                                                                                    $Heures_supp->total_taux_100 =$total_taux_100;
                                                                                    $Heures_supp->total_heures_saisie =$total_heures_saisie ;


                                                                                    $Heures_supp->Mont_15 =$total_taux_15 * $Taux * 1.15 ;
                                                                                    $Heures_supp->Mont_40 =$total_taux_40 * $Taux * 1.40 ;
                                                                                    $Heures_supp->Mont_60 =$total_taux_60 * $Taux * 1.60 ;
                                                                                    $Heures_supp->Mont_100 =$total_taux_100 * $Taux * 2 ;

                                                                                    $Heures_supp->Total =$Total;
                                                                                    $Heures_supp->save();
                                                                                }
                                                                }

        }



            return back()
            ->with('success','Heure supplémentaire enregistrée!')
            ->withInput();

        }
}
