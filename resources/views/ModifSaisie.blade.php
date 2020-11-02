@extends('layouts.template_dashbord')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
            <h1>Saisir heure</h1>
              <center>
                            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($message = Session::get('erreur'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
            @endif
                    @if ($errors->any())


                    @foreach ($errors->all() as $error)

                        <div class="alert alert-danger  col-6 " role="alert">
                        {{ $error }}
                        </div>
                    @endforeach

                @if ($errors->has('email'))
                @endif

            @endif

                        </center>
                    </div>

                    </div>
                </div><!-- /.container-fluid -->
                </section>
      <!-- Main content -->

            <center>

            <div class="col-md-8">
            <div class="card card-dark">
            <div class="card-header">
              Modification Saisie heure supplémentaire
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @foreach ($data as $datas)
            <form  class="form-horizontal" method="POST" action="{{ route('Saisiestore') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="example-datetime-local-input" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                        <input class="form-control" type="date" name="Date_Heure"  value="{{$datas->Date_Heure}}" id="example-date-input">
                        </div>

            </div>


                <div class="form-group row">
                    <label for="example-date-input" class="col-3 col-form-label">De</label>
                    <div class="col-sm-9">
                        @if($datas->heure_debut>9)
                        <input class="form-control" type="time" name="heure_debut"  value="{{$datas->heure_debut}}:00" id="example-week-input">
                        @else
                        <input class="form-control" type="time" name="heure_debut"  value="0{{$datas->heure_debut}}:00" id="example-week-input">
                        @endif

                    </div>
            </div>


                <div class="form-group row">
                    <label for="example-week-input" class="col-3 col-form-label">À </label>
                    <div class="col-sm-9">
                        @if($datas->heure_fin>9)
                        <input class="form-control" type="time" name="heure_fin"  value="{{$datas->heure_fin}}:00" id="example-week-input">
                        @else
                        <input class="form-control" type="time" name="heure_fin"  value="0{{$datas->heure_fin}}:00" id="example-week-input">
                        @endif
            </div>
        </div>


                    <div class="form-group row" >
                        <label for="example-text-input" class="col-3 col-form-label">Travaux réalisés</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text"  name="travaux_effectuer" value="{{$datas->travaux_effectuer}}" id="example-text-input">
                        </div>
                    </div>

             <div class="form-group row" >
                        <label for="example-text-input"  name="Observations" class="col-3 col-form-label">Observations</label>
                        <div class="col-sm-9">
                            <input class="form-control " name="Observations" type="text" value="{{$datas->Observations}}" id="example-text-input">
                        </div>
                </div>

            <input type="hidden" name="Date_debut"  value="{{old('Date_debut', $datas->Date_debut)}}">
            <input type="hidden" name="Date_fin"  value=" {{old('Date_fin', $datas->Date_fin)}}">
            <input class="form-control"  name="collaborateur"  type="hidden" value="{{old('collaborateur',$datas->Agent_Matricule_Agent)}}"  id="example-text-input">
            <input class="form-control"  name="nbr_heure"  type="hidden" value="{{old('nbr_heure',$datas->nbr_heure)}}"  id="example-text-input">
            <input class="form-control"  name="id_heure"  type="hidden" value="{{old('id_heure',$datas->id_heure_a_faire)}}"  id="example-text-input">



                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <center>  <center> <button class=" btn btn-lg btn-dark">Valider</button></center>
                </div>
                <!-- /.card-footer -->
            </form>
            </div>
            @endforeach
            </center>
            @endsection
