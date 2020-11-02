@extends('layouts.template_dashbord')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Saisie heure supplémentaire</h1>
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
            <div class="card  card-dark">
            <div class="card-header card-outline-dark">

                <button  name="collab" class=" btn btn-lg btn-dark">Saisir heures</button>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form  class="form-horizontal" method="POST" action="{{ route('Saisiestore') }}">
                @csrf
                <div class="card-body">
            <div class="form-group row">


            <label for="example-datetime-local-input" class="col-sm-3 col-form-label">Date</label>
            <div class="col-sm-9">
            <input class="form-control  @error ('Date_debut') @enderror" type="date" name="Date_Heure"  value="" id="example-date-input">
            </div>
            @error('Date_debut')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
            <div class="form-group row">
             <label for="example-date-input" class="col-3 col-form-label">Heure de début</label>
                <div class="col-sm-9">
                     <input class="form-control @error ('Date_fin') @enderror" type="time"  name="heure_debut"  value="" id="example-date-input">
                </div>
            @error('Date_fin')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror

            </div>
            <div class="form-group row">
            <label for="example-week-input" class="col-3 col-form-label">Heure de fin </label>
            <div class="col-sm-9">
            <input class="form-control @error ('nbr_heure') @enderror" type="time" name="heure_fin"  value="2011-W33" id="example-week-input">
            </div>
            @error('nbr_heure')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>

            <div class="form-group row" >
            <label for="example-text-input" class="col-3 col-form-label">Travaux réalisés</label>
            <div class="col-sm-9">
            <input class="form-control" type="text"  name="travaux_effectuer" value="" id="example-text-input">
            </div>
            </div>
            <div class="form-group row" >
            <label for="example-text-input"  name="Observations" class="col-3 col-form-label">Observations</label>
            <div class="col-sm-9">
            <input class="form-control  @error ('Observations')"@enderror" name="Observations" type="text" value="" id="example-text-input">
            </div>
            @error('Observations')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
            <input type="hidden" name="Date_debut"  value="{{old('Date_debut',$Date_debut)}}">
            <input type="hidden" name="Date_fin"  value=" {{old('Date_fin',$Date_fin)}}">

            <input class="form-control"  name="collaborateur"  type="hidden" value="{{old('collaborateur',$collab)}}"  id="example-text-input">
            <input class="form-control"  name="nbr_heure"  type="hidden" value="{{old('nbr_heure',$nbr_heure)}}"  id="example-text-input">
            <input class="form-control"  name="id_heure"  type="hidden" value="{{old('id_heure',$id_heure)}}"  id="example-text-input">
            <input class="form-control"  name="servicedr" type="hidden" value="{{old('servicedr',$servicedr)}}" id="example-text-input">


                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <center>  <center> <button class="btn btn-lg  btn-outline-dark">Valider</button></center>
                </div>
                <!-- /.card-footer -->
            </form>
            </div>
            </center>
            @endsection
