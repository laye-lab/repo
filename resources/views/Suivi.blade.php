
@extends('layouts.template_dashbord_acceuil')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style="min-height: 1416.81px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Commande </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Commandes</a></li>
              <li class="breadcrumb-item active">Acceuil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block col-md-8"style="position:relative; bottom:15px; left:15%;">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif
      <!-- Default box -->
      @if ($commande_count!=0)


      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Commande du  mois </h3>

          <div class="card-tools">

          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                          Commande Nº
                      </th>
                      <th style="width: 20%">
                        Agent
                    </th>
                      <th style="width: 20%">
                          Responsable
                      </th>

                      <th style="width: 20%">
                          Nombre d'heure
                      </th>
                      <th style="width: 8%" class="text-center">
                          Etape
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($commande as $commandes)


                  <tr>
                      <td>
                          #
                      </td>
                      <td>
                          <a>
                             {{$commandes->ID}}
                          </a>
                          <br>
                          <small>
                              Cree le {{$commandes->created_at}}
                          </small>
                      </td>
                       <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">

                                <a>
                                    {{$commandes->Nom_Agent}}
                              </a>
                              <br>

                            </li>

                        </ul>
                    </td>
                      <td>
                          <ul class="list-inline">
                              <li class="list-inline-item">
                                <img alt="Avatar" class="table-avatar" src="../../dist/img/icone2.png">
                                  <a>
                                    {{$commandes->responsable}}
                                </a>
                                <br>

                              </li>

                          </ul>
                      </td>
                      <td class="project-state">
                        <span class="badge badge-success"> {{$commandes->nbr_heure}}</span>
                    </td>
                      <td class="project-state">
                          <span class="badge badge-success">Saisie </span>
                      </td>
                      <td class="project-actions text-right">


                              <form method="POST"  action="{{'ModifSaisie'}}">
                                @csrf

                              <input type="hidden" name="id_from_dr"  value="{{$commandes->ID}}">
                                <button type="submit" class="btn  btn-outline-danger ">  <i class="fas fa-trash">
                                </i> Supprimer</button>
                              </form>
                      </td>
                  </tr>


                  @endforeach

              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    @else
    <center>
    <div class="card card-danger card-outline col-md-7">
        <div class="card-header">
          <h5 class="m-0">Validation</h5>
        </div>
        <div class="card-body">
          <h6 class="card-title">Vous n'avez aucune commande en attente </h6>

          <p class="card-text"></p>
          <a  href="{{route('Acceuil')}}" class="btn btn-danger">Acceuil<i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
        </div>
      </div>
    </div>
</center>
    @endif    <!-- /.content -->
  </div>
@endsection
