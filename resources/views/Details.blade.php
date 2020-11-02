@extends('../../layouts.template_dashbord_acceuil ')

@section('content')
 <!-- Content Wrapper. Contains page content -->

    <!-- Main content -->
    @foreach($role_account as $role)
    @if(Auth::user()->id == $role->Matricule_agent)
    @switch($role->Nom)
                      @case('n+1')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Validation</h1>


          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Validation</li>
            </ol>
          </div>

        </div>
        @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block col-md-8"style="position:relative; bottom:15px; left:15%;">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
    </div>
    @endif
      </div><!-- /.container-fluid -->
    </section>

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>



                                        <section class="content" >
                                          <div class="card col-12"   >

                                            <div class="card-body">
                                              <div class="row">

                                    <div class="col-12">
                                    <button type="submit" class="btn btn-info"> {{$Nom}}</button>
                                    <button type="submit" class="btn btn-outline-info">Heure nº{{$id}}</button>
                                  <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                      <thead>
                                        <tr>
                                          <th>Date</th>
                                          <th>De</th>
                                          <th>A</th>
                                          <th>Travaux réalisés</th>
                                          <th>Observations</td>
                                           <th>Nombre d'heures</td>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($heurre_a_faire as $heure)


                                        <tr>
                                          <td>
                                            {{$heure->Date_Heure}}
                                          </td>
                                          <td>
                                            {{$heure->heure_debut}} :00
                                          </td>
                                          <td>
                                            {{$heure->heure_fin}} :00
                                          </td>
                                          <td>
                                            {{$heure->travaux_effectuer}}
                                          </td>
                                          <td>
                                            {{$heure->observations}}
                                          </td>
                                          <td>
                                            <button type="submit" class="btn  btn-info ">{{$heure->total_heures_saisie}}</button>
                                          </td>
                                          <td>
                                              <form method="POST" action="{{'ModifSaisie'}}">
                                                @csrf

                                              <input type="hidden" name="id"  value="{{$heure->id}}">
                                                <button type="submit" class="btn  btn-outline-danger ">Supprimer</button>
                                              </form>

                                            </td>

                                      </tr>

                              @endforeach

                            </tbody>
                          </table>
                        </div>

                    </div>
                  </div>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
@break
          @case('n+2')
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>Validation</h1>


                  </div>

                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item"><a href="#">Layout</a></li>
                      <li class="breadcrumb-item active">Validation</li>
                    </ol>
                  </div>

                </div>
                @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block col-md-8"style="position:relative; bottom:15px; left:15%;">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
            @endif
              </div><!-- /.container-fluid -->
            </section>

            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">

                  </div>

                </div>
              </div><!-- /.container-fluid -->
            </section>



                                                <section class="content" >
                                                  <div class="card col-12"   >

                                                    <div class="card-body">
                                                      <div class="row">

                                            <div class="col-12">
                                            <button type="submit" class="btn btn-info"> {{$Nom}}</button>
                                            <button type="submit" class="btn btn-outline-info">Heure nº{{$id}}</button>
                                          <div class="card-body table-responsive p-0">
                                            <table class="table table-hover text-nowrap">
                                              <thead>
                                                <tr>
                                                  <th>Date</th>
                                                  <th>De</th>
                                                  <th>A</th>
                                                  <th>Travaux réalisés</th>
                                                  <th>Observations</td>
                                                   <th>Nombre d'heures</td>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($heurre_a_faire as $heure)


                                                <tr>
                                                  <td>
                                                    {{$heure->Date_Heure}}
                                                  </td>
                                                  <td>
                                                    {{$heure->heure_debut}} :00
                                                  </td>
                                                  <td>
                                                    {{$heure->heure_fin}} :00
                                                  </td>
                                                  <td>
                                                    {{$heure->travaux_effectuer}}
                                                  </td>
                                                  <td>
                                                    {{$heure->observations}}
                                                  </td>
                                                  <td>
                                                    <button type="submit" class="btn  btn-info ">{{$heure->total_heures_saisie}}</button>
                                                  </td>
                                              </tr>

                                      @endforeach

                                    </tbody>
                                  </table>
                                </div>

                            </div>
                          </div>


                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                  </section>

          @break


      @endswitch
      @break
        @endif
          @endforeach

@endsection
