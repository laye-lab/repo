@extends('../../layouts.template_dashbord_collapsed')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 @foreach($role_account as $role)
    @if(Auth::user()->id == $role->Matricule_agent)
        @switch($role->Nom)
            @case('n+1')
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Liste des agents</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Choix collaborateur</a></li>
                            <li class="breadcrumb-item active">senadmin</li>
                        </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>

                    </div>
                </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                <div class="container-fluid">
                    @if ($agent_n_plus_un_count >0)
                    <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                            <button type="submit" class="btn btn-primary">Choisissez un agent et affectez lui des heures supplémentaires </button>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>Nº commande</th>
                                <th>Matricule</th>
                                <th>Prenom et Nom</th>
                                <th>Fonction</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                <th>Travaux a éffectuer </th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>

                                        @foreach($agent_n_plus_1 as $agent_attributs)

                                                <td>
                                                    {{$agent_attributs->ID}}
                                                </td>

                                                <td>
                                                    {{$agent_attributs->Matricule_agent}}
                                                </td>

                                                <td>
                                                    {{$agent_attributs->Nom_Agent}}
                                                </td>
                                                <td>
                                                    {{$agent_attributs->fonction}}
                                                </td>
                                                <td>
                                                    {{$agent_attributs->Date_debut}}
                                                </td>
                                                <td>
                                                    {{$agent_attributs->Date_fin}}
                                                </td>
                                                <td>
                                                    {{$agent_attributs->travaux_effectuer}}
                                                </td>




                                                <td>
                                                <form method="POST" action="{{'Saisie'}}">
                                                    @csrf
                                                    <input type="hidden" name="Date_debut"  value="{{$agent_attributs->Date_debut}}">
                                                    <input type="hidden" name="Date_fin"  value=" {{$agent_attributs->Date_fin}}">
                                                    <input type="hidden" name="nbr_heure"  value=" {{$agent_attributs->nbr_heure}}">
                                                <input type="hidden" name="id"  value="{{$agent_attributs->Matricule_agent}}">
                                                <input type="hidden" name="nom"  value=" {{$agent_attributs->Nom_Agent}}">
                                                <input type="hidden" name="id_heure"  value=" {{$agent_attributs->ID}}">

                                                <input type="hidden" name="servicedr"  value="{{$agent_attributs->Affectation}}">
                                                    <button type="submit" class=" btn  btn-outline-primary">Saisir</button>
                                                </form>

                                                </td>

                                            </tr>



                                        @endforeach

                            </table>
                        </div>
                        <!-- /.card-body
                        <tfoot>
                            <tr>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th>Engine version</th>
                                <th>CSS grade</th>
                            </tr>
                            </tfoot> -->
                        </div>

                    </div>
                    <!-- /.col -->
                    @else
                    <center>
                        <div class="card card-primary card-outline col-md-7">
                            <div class="card-header">
                              <h5 class="m-0">Saisie</h5>
                            </div>
                            <div class="card-body">
                              <h6 class="card-title">Pas de commande  d'heures supplémentaires  pour le moment</h6>
                              <p class="card-text"></p>
                              <a  href="{{route('Acceuil')}}" class="btn btn-primary">Acceuil<i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
                            </div>
                          </div>
                        </div>
                    </center>
                    @endif
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            @break
            @case('n+2' or'sec' )
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Liste des agents</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Choix collaborateur</a></li>
                            <li class="breadcrumb-item active">senadmin</li>
                        </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>

                    </div>
                </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                <div class="container-fluid">
            <center>
                <div class="card card-primary card-outline col-md-7">
                    <div class="card-header">
                      <h5 class="m-0">Saisie</h5>
                    </div>
                    <div class="card-body">
                      <h6 class="card-title">Pas de commande  d'heures supplémentaires  pour le moment</h6>
                      <p class="card-text"></p>
                      <a  href="{{route('Acceuil')}}" class="btn btn-primary">Acceuil<i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
                    </div>
                  </div>
                </div>
            </center>
        </div>
         @break
        @endswitch
        @endif
@endforeach
@endsection
