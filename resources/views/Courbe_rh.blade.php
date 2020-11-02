

@extends('layouts.template_dashbord_acceuil')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Acceuil</h1>
            </div>

          </div>
        </div><!-- /.container-fluid -->
      </section>
<center>
            <section class="content">
                <div class="container-fluid">
                <!-- Info boxes -->

                <!-- /.row -->
                <center>
                    <div class="container">
                                <div class="row">


                    <form method="POST" action="{{route('Chartsrh')}}" style="position:relative; left:20%;">
                        @csrf
                    <!-- general form elements disabled -->
                    <div class="card card-info">
                        <div class="card-header btn btn-success active ol-md-12">
                        <h3 class="card-title "> Courbe par établissement </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <form role="form">
                            <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">

                                <select class="form-control" name="mois" id="">

                                   @foreach ($Affectation as $Affectations)
                                   <option value={{$Affectations->affectation }}>{{$Affectations->affectation}}</option>
                                   @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">

                                <button class="btn btn-lg btn-outline-success"> Generer </button>
                                </div>
                            </div>
                            </div>

                        </form>
                        </div></div>

                    </center>
                    </div>



                                <section class="content" >



                                    <div class="row" style="background-color:white">
                                        <div class="col-12">

                                                <div class="card-body py-3 px-3">
                                                    {!! $usersChartKaolack->container() !!}
                                                </div>

                                        </div>


                                     </div>

                                    </div>

                                </div>

                            </section>


            @endsection
