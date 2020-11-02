@extends('layouts.template_dashbord')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Saisie commande</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Saisie</a></li>
            <li class="breadcrumb-item"><a href="#">Choix</a></li>
            <li class="breadcrumb-item active">senadmin</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
            <center>
            @if ($errors->any())


        @foreach ($errors->all() as $error)

           <div class="alert alert-danger  col-6 " role="alert">
            {{ $error }}
           </div>
        @endforeach

     @if ($errors->has('email'))
     @endif

@endif
@if ($message = Session::get('notif'))
<div class="alert alert-danger alert-block col-md-8"style="position:relative;">
    <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif
</center>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
      <!-- Main content -->

  <center>
    <div class="col-md-8">
    <div class="card card-info">
      <div class="card-header">
        @foreach($agent_etablissement as $agent_etablissements)

            @if($agent_etablissements->Matricule_agent  ==  $collab)
            <button class=" btn btn-lg btn-info" name="collab">{{$agent_etablissements->Nom_Agent}}</button>
            @break
            @endif
        @endforeach
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form  class="form-horizontal" method="POST" action="{{ route('Commandestore') }}">
        @csrf
        <div class="card-body">


    <div class="form-group row">


      <label for="example-datetime-local-input" class="col-3 col-form-label">Date de début</label>
      <div class="col-8">
          <input class="form-control"  type="date" name="Date_debut"  value="{{ old('Date_debut') }}" id="example-date-input">
      </div>

            </div>
                  <div class="form-group row">
                    <label for="example-datetime-local-input" class="col-3 col-form-label">Date de fin</label>
                    <div class="col-8">
                        <input class="form-control"  type="date" name="Date_fin"  value="{{ old('Date_fin') }}" id="example-date-input">
                    </div>
            </div>
            <div class="form-group row">
              <label for="example-datetime-local-input" class="col-3 col-form-label">Nombre d'heure</label>
              <div class="col-8">
                  <input class="form-control " type="number" name="nbr_heure"  value="{{ old('nbr_heure') }}" id="example-date-input">
              </div>

            </div>

            <div class="form-group row" >
              <label for="example-datetime-local-input" class="col-3 col-form-label">Travaux à éffectuer </label>
              <div class="col-8">
                  <input class="form-control"  type="text" name="travaux_effectuer"  value="{{ old('travaux_effectuer') }}" id="example-date-input">
              </div>
            </div>
            <div class="form-group row" >
              <label for="example-datetime-local-input" class="col-3 col-form-label">Observations</label>
              <div class="col-8">
                  <input class="form-control"  type="text" name="Observations"  value="{{ old('Observations') }}" id="example-date-input">
              </div>

            </div>

            <div class="form-group row" >
                <label for="example-datetime-local-input" class="col-3 col-form-label">Responsable</label>
                <div class="col-8">
                    <div class="form-group">
                        <select class="form-control" name="responsable" id="">
                          @foreach($responsable as $responsables)

                              <option value=" {{$responsables->Matricule_Agent}}">
                                {{$responsables->Nom_Agent}}
                              </option>

                          @endforeach
                            </select>
                </div>

              </div>

            <input class="form-control"  type="hidden"   name="commandeur" value="{{old('commandeur', Auth::user()->id) }}"  id="example-text-input">
            <input class="form-control"  type="hidden"   name="collaborateur" value="{{old('collaborateur', $collab) }}"  id="example-text-input">
            <input class="form-control" type="hidden"   name="servicedr" value="{{old('servicedr', $servicedr) }}"id="example-text-input">
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <center>  <center> <button class=" btn btn-lg  btn-outline-info">Valider</button></center>
                </div>
                <!-- /.card-footer -->
              </form>
    </div>
    </center>

@endsection
