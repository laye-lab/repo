<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\User;
use App\Heures_supp_a_faire;
use App\Agent_Heures_supp_a_faire;
use App\Step;
use App\Http\Requests\StoreCommandeRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Facades\Validator;



class CommandeController extends Controller
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
        $collab=request('id');
        $user=auth()->user()->id;
        $servicedr=request('servicedr');
        $role_account=DB::table('Role_Account')
        ->join('users','users.id' ,'=', 'Role_Account.AccountID')
        ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
        ->join('agent','agent.Matricule_Agent' ,'=','users.id')
        ->select('Matricule_agent','Fonction','Statut','Direction','Role.Nom','Nom_Agent','etablissement')
        ->get();

        $etablissement_user=DB::table('agent')
        ->select('etablissement','Direction')
        ->where('agent.Matricule_Agent', '=',$user)
        ->distinct('Matricule_agent')
        ->first();

        $etablissement_direction=DB::table('agent')
        ->select('Direction')
        ->where('agent.Matricule_Agent', '=',$user)
        ->distinct('Matricule_agent')
        ->first();

        if ($etablissement_user->etablissement === "HAN"){
            $responsable=DB::table('agent')
            ->where([
                ['agent.Statut', '=', 'CAD'],
                ['agent.Direction', '=',  $etablissement_user->Direction]
                ])
            ->distinct('Affectation')
            ->get();
           }
           else{

        $responsable=DB::table('agent')
        ->where([
            ['agent.Statut', '=', 'CAD'],
            ['agent.etablissement', '=',  $etablissement_user->etablissement]
            ])
        ->orWhere([
            ['agent.fonction','=','Responsable admini' ],
            ['agent.etablissement', '=',  $etablissement_user->etablissement]
            ])
            ->orWhere([
                ['agent.fonction','=','Responsable admin' ],
                ['agent.etablissement', '=',  $etablissement_user->etablissement]
                ])
            ->orWhere([
            ['agent.fonction','=','R.T.' ],
            ['agent.etablissement', '=',  $etablissement_user->etablissement]
            ])
            ->orWhere([
                ['agent.fonction','=','Responsable commer' ],
                ['agent.etablissement', '=',  $etablissement_user->etablissement]
                ])
            ->orWhere([
                ['agent.fonction','=','R.T.' ],
                ['agent.etablissement', '=',  $etablissement_user->etablissement]
                ])
                ->orWhere([
                    ['agent.fonction','=','RT' ],
                    ['agent.etablissement', '=',  $etablissement_user->etablissement]
                    ])
        ->distinct('Affectation')
        ->get();
                }
        $agent_attribut=DB::table('agent')
        ->join('equipe','equipe.agentMatricule_Agent','=','agent.Matricule_Agent')
        ->join('agent_Heures_supp_a_faire','agent_Heures_supp_a_faire.agentMatricule_Agent','=','agent.Matricule_Agent')
        ->distinct('Matricule_agent')
        ->select('agent.Matricule_agent','Nom_Agent','n_plus_un','Statut','Direction','etablissement')
        ->get();

        $service=DB::table('affectation')
        ->join('agent','agent.Matricule_Agent','=','affectation.agentMatricule_Agent')
        ->select('Matricule_agent','Nom_Agent','Fonction','Statut','Affectation','Direction','Etablissemt_nom')
        ->distinct('Matricule_agent')
        ->get();

        $agent_etablissement=DB::table('agent')
        ->select('agent.Matricule_agent','Nom_Agent','Fonction','agent.Statut'
        ,'Direction','Etablissement','Affectation')
        ->get();

       return view('Commande')->with([
                'role_account'=>$role_account,
                'collab'=>$collab,
                'servicedr'=>$servicedr,
                'responsable'=>$responsable,
                'agent_etablissement'=>$agent_etablissement]
            );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCommande()
    {
        $user=auth()->user()->id;
        $role_account=DB::table('Role_Account')
        ->join('users','users.id' ,'=', 'Role_Account.AccountID')
        ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
        ->join('agent','agent.Matricule_Agent' ,'=','users.id')
        ->select('Matricule_agent','Fonction','Statut','Direction','Role.Nom','Nom_Agent','etablissement')
        ->get();

        $commande=DB::table('agent_Heures_supp_a_faire')
        ->join('Step','Step.Heures_supp_a_faireID','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
        ->join('agent','agent.Matricule_Agent','=','agent_Heures_supp_a_faire.agentMatricule_Agent')
        ->join('Heures_supp_a_faire','Heures_supp_a_faire.ID','=','agent_Heures_supp_a_faire.Heures_supp_a_faireID')
        ->where([
            ['Heures_supp_a_faire.Demandeur', '=',$user],
            ['etape', '=',1],
            ]
            )
        ->select('agent.Matricule_agent','Nom_Agent','Statut','Direction','etablissement'
        ,'fonction','Affectation','Date_debut','Date_fin','travaux_effectuer','nbr_heure'
        ,'Heures_supp_a_faire.ID','etape','agentMatricule_Agent','responsable','Heures_supp_a_faire.created_at')
        ->get();
        $commande_count= $commande->count();

       return view('Suivi' )->with([
                'commande'=>$commande,
                'commande_count'=>$commande_count,
                'role_account'=>$role_account
               ]
            );

    }

    /**
     * Store a newly created resource  'nbr_heure', 'travaux_effectuer', 'Observations' in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommandeRequest $request)
    {


        $user=auth()->user()->id;
        $servicedr=request('service');
        $role_account=DB::table('Role_Account')
            ->join('users','users.id' ,'=', 'Role_Account.AccountID')
            ->join('Role','Role.ID' ,'=','Role_Account.RoleID')
            ->join('agent','agent.Matricule_Agent' ,'=','users.id')
            ->select('Matricule_agent','Statut','Direction','Role.Nom','Nom_Agent','etablissement')
            ->get();

            $service=DB::table('affectation')
            ->select('Libelle_Affectation','Etablissemt_nom','agentMatricule_Agent')
            ->distinct('Libelle_Affectation')
            ->select('Libelle_Affectation','Etablissemt_nom')
            ->get();


            $etablissement_user=DB::table('agent')
            ->select('etablissement')
            ->where('agent.Matricule_Agent', '=',$user)
            ->distinct('Matricule_agent')
            ->first();

            $etablissement_direction=DB::table('agent')
            ->select('Direction')
            ->where('agent.Matricule_Agent', '=',$user)
            ->distinct('Matricule_agent')
            ->first();

            if ($etablissement_user->etablissement === "Centre de Hann"){

             $Affectation=DB::table('agent')
             ->select('Affectation')
             ->where('agent.Direction', '=',$etablissement_direction->Direction)
             ->distinct('Affectation')
             ->get();
            }
            else{
             $Affectation=DB::table('agent')
             ->select('Affectation')
             ->where('agent.Etablissement', '=',$etablissement_user->etablissement)
             ->distinct('Affectation')
             ->get();
            }


            $agent_etablissement=DB::table('agent')
            ->select('agent.Matricule_agent','Nom_Agent','Fonction','agent.Statut'
            ,'Direction','Etablissement','Affectation')
            ->get();

            $verif_doublon=DB::table('Heures_supp_a_faire')
            ->join('agent_Heures_supp_a_faire','Heures_supp_a_faireID','=','ID' )
            ->where([
                ['agentMatricule_Agent','=',request('collaborateur')],
                ['Date_fin','=',request('Date_fin')],
                ['Demandeur','=', request('commandeur')],
                ['Date_debut','=',request('Date_debut')]
                ])
            ->get();

            $verif_date=DB::table('Heures_supp_a_faire')
            ->join('agent_Heures_supp_a_faire','Heures_supp_a_faireID','=','ID' )
            ->where('agentMatricule_Agent','=',request('collaborateur'))
            ->whereBetween('Date_debut', [request('Date_debut'),request('Date_fin')])
            ->get();


            $Isempty_doublon=$verif_doublon->isEmpty();
            $Isempty_interval=$verif_doublon->isEmpty();


        if($Isempty_doublon == 'true'){

        $Heures_supp_a_faire = new Heures_supp_a_faire;
        $Step = new Step;
        $Agent_Heures_supp_a_faire = new Agent_Heures_supp_a_faire;

        $Heures_supp_a_faire->Date_debut =request('Date_debut');
        $Heures_supp_a_faire->Date_fin =request('Date_fin');
        $Heures_supp_a_faire->Demandeur =request('commandeur');
        $Heures_supp_a_faire->nbr_heure =request('nbr_heure');
        $Heures_supp_a_faire->travaux_effectuer =request('travaux_effectuer');
        $Heures_supp_a_faire->Observations =request('Observations');
        $Heures_supp_a_faire->responsable =request('responsable');
        $Heures_supp_a_faire->save();

        $Heures_supp=DB::table('Heures_supp_a_faire')
        ->select('ID')
        ->where('Demandeur','=', $Heures_supp_a_faire->Demandeur)
        ->latest('ID')->first();



        $Step->Demandeur =request('commandeur');
        $Step->etape =1;
        $Step->Libelle=request('travaux_effectuer');
        $Step->Heures_supp_a_faireID =$Heures_supp->ID;
        $Step->save();

        $Agent_Heures_supp_a_faire->agentMatricule_Agent = request('collaborateur');
        $Agent_Heures_supp_a_faire->Heures_supp_a_faireID =$Heures_supp->ID;

        $Agent_Heures_supp_a_faire->save();
        session()->flash('notif', 'Commande enregistrée!');
        $agent_count=10;
        if (request('collaborateur')==null ||  request('servicedr')==null) {

            session()->flash('erreur', 'Plusieurs erreurs dans le formulaire , veuillez recommencer !');
            return view('homeCommandeindex')->with([
                'role_account'=> $role_account,
                'service'=> $service,
                'Affectation'=> $Affectation,
                'role_account'=> $role_account,
                'servicedr'=> $servicedr,
                'agent_count'=> $agent_count

            ]
            );
        }
        if (null ==request('commandeur') ){

            return view('homeCommandeindex')->with([
                'role_account'=> $role_account,
                'service'=> $service,
                'Affectation'=> $Affectation,
                'role_account'=> $role_account,
                'servicedr'=> $servicedr,
                'agent_count'=> $agent_count

            ]
            );

        }
        return view('homeCommandeindex')->with([
            'role_account'=> $role_account,
            'service'=> $service,
            'Affectation'=> $Affectation,
            'role_account'=> $role_account,
            'servicedr'=> $servicedr,
            'agent_count'=> $agent_count

        ]
        );
    } else {
        return back()->with('notif','les doublons ne sont pas autorisés');
    }
    }

    /**
     * Display   $Heures_supp_a_faire->Heure_fin =request('Heure_fin') $Heures_supp_a_faire->Heure_fin =request('Heure_fin');the specified resource.
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
