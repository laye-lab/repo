@extends('layouts.template_dashbord_acceuil')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Secteur</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">

                <li class="breadcrumb-item"><a href="#">Choix secteur</a></li>
                <li class="breadcrumb-item active">senadmin</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">


        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content" >
  <div class="container-fluid" >
    @if ($message = Session::get('notif'))
    <div class="alert alert-success alert-block col-md-8"style="position:relative; left:15%; bottom:25px;">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
    </div>
    @endif  @if ($message = Session::get('erreur'))
    <div class="alert alert-danger alert-block col-md-8"style="position:relative; left:15%; bottom:25px;">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="row" style="position:relative; left:15%; bottom:40px;">
      <!-- left column -->
      @if ($agent_count!=1)
      <div class="col-md-8" >
        <form method="POST" action="{{ route('homeCommandepost') }}">
          @csrf
        <!-- general form elements disabled -->
        <div class="card card-info">
          <div class="card-header col-md-5">
            <h3 class="card-title">Choisissez le secteur</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <form role="form">
              <div class="row">
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group">
                    <select class="form-control" name="service" id="">
                      @foreach($Affectation as $Affectations)

                          <option value=" {{$Affectations->Affectation}}">
                            {{$Affectations->Affectation}}
                          </option>

                      @endforeach
                        </select>
                        <input class="form-control"  name="commandeur" type="hidden" value="{{Auth::user()->id }}"" id="example-text-input">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">



                    <button class=" btn  btn-outline-info">Passer commande </button>
                  </div>
                </div>
              </div>

          </div>
        </div>
      </form>
      </div>
      @endif
      <div class="col-md-8"  >
        <form method="POST" action="{{ route('homeCommandesearch') }}">
          @csrf
        <!-- general form elements disabled -->
        <div class="card card-primary">
            <div class="card-header col-md-5">
              <h3 class="card-title">Choisissez l'agent</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form">
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <div class="input-group mb-3 col-md-12">

                                <input type="text" wire:model.lazy="searchmatricule" class="form-control" placeholder="exemple : 12345"
                                aria-label="Recipient's username" aria-describedby="basic-addon2" name="matricule" autocomplete="off">
                                <div class="input-group-append">
                                  <span class="input-group-text" id="basic-addon2"><i class="fas fa-user"></i></span>
                                </div>
                              </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">



                          <button class=" btn  btn-outline-primary">Rechercher</button>
                        </div>
                      </div>
                    </div>

                </div>
              </div>
            </form>
              </div>

              </div>

             @if ($agent_count==1)


             <div class="container-fluid">

                <div class="row"  style="position:relative; left:30%;">
                  <!-- left column -->
                  <div class="col-md-4" >

                  <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                      <h3 class="widget-user-username">{{$agent->Nom_Agent}}</h3>
                      <h5 class="widget-user-desc">{{$agent->fonction}}</h5>
                    </div>
                    <div class="widget-user-image">
                      <img class="img-circle elevation-2" src="../dist/img/icone2.png" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                      <div class="row">

                        <!-- /.col -->
                        <form method="POST" action="{{'Commandeindex'}}">
                            @csrf
                            <input type="hidden" name="id"  value="{{$agent->Matricule_Agent}}">
                            @foreach($role_account as $role)
                            @if(Auth::user()->id == $role->Matricule_agent)
                            <input type="hidden" name="servicedr"  value="{{$role->etablissement}}">

                            @break
                            @endif
                            @endforeach

                        <button class=" btn  btn-lg btn-outline-info form-control">Commmader</button>
                    </form>
                        <!-- /.col -->

                          <!-- /.description-block -->

                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                  </div>
                </div>





              @else
              @if ($agent_count==10)

              @else
              <div class="card border-info mb-8" style="max-width: 18rem; position:relative; left:35% ; bottom:20px;">
                <div class="card-body ">
                  <h5 class="card-title">Agent introuvable </h5>
                  <p class="card-text"><i>(Seul les agents non cadre de cette etablissement sont concernés)</i></p>
                </div>
              </div>

              @endif
              @endif





          </div>

    </div>
  </div>

</section>
</center>
@endsection
