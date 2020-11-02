



    <section class="content-header">
        <div class="container-fluid">

        </div><!-- /.container-fluid -->
      </section>
<center>
            <section class="content">
                <div class="container-fluid">
                <!-- Info boxes -->



                <div class="col-md-10 ">
                    <div class="row " style="position:relative;bottom:35px;">
                        <div class="col-xl-4 col-lg-6">
                            <div class="card l-bg-orange ">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-clock"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">Total heure du mois</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                              {{$total_current_month}}
                                            </h2>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                            <div class="card l-bg-cyan">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-clock"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">Total heure année</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                {{$total_current_year}}
                                            </h2>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    <div class="col-xl-4 col-lg-4">
                        <div class="card l-bg-green">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-money-bill-alt	"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0">Total Montant pour le mois </h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                            {{$SUM_MONTANT}}
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>FCFA</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <center>

                    </center>
                    </div>
                    <div class="row">
                    <div class="col-12">
                        <div class="card" style="position:relative; bottom:40px;">
                            <div class="card-header">
                                <h3 class="card-title" style=" font-family: 'Lato', sans-serif; font-size: 20px; font-weight: 300;" >
                                    <i class="fas fa-chart-bar"></i>
                              Heures supplémentaires par etablissement et par taux

                                </h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">`
                            <div class="row" style="background-color:white; position:relative; bottom:40px;" >
                                <div class="col-12">

                                        <div class="card-body py-3 px-3">
                                            {!! $usersChartKLK->container() !!}
                                        </div>

                                </div>


                             </div>

                            </div>

                        </div>

                    </section>
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

<h1>Heures supp en cours </h1>

                    <section class="content" style="position:relative;">
                        <div class="container-fluid">


                        <div class="row" >
                            <!-- left column -->

                            @foreach ($data_drh as  $datas)


                        @if ($datas->statut==3)
                        <div class="col-md-3" >
                        <form method="POST" action="{{route('CalculheureMois')}}">
                            @csrf
                        <!-- general form elements disabled -->
                        <div class="card card-dark">
                            <div class="card-header col-md-10">
                            <h3 class="card-title">{{$datas->Nom}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <form role="form">
                                <div class="row">
                                    <section class="content">
                                        <div class="container-fluid">

                                        <!-- Timelime example  -->
                                        <div class="row">
                                            <div class="col-md-12">
                                            <!-- The time line -->
                                            <div class="timeline">
                                                <!-- timeline time label -->
                                                <div class="time-label">
                                                <span class="bg-red">{{$datas->agent}}</span>
                                                </div>
                                                <!-- /.timeline-label -->
                                                <!-- timeline item -->
                                                <div>
                                                <i class="fas fa-envelope bg-blue"></i>
                                                <div class="timeline-item">
                                                    <div class="timeline-body">
                                                        validation centre   <a href="#" class="btn btn-sm bg-danger">X</a>
                                                    </div>

                                                </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline item -->
                                                <div>
                                                    <i class="fas fa-user bg-green"></i>
                                                    <i class="nav-icon fas fa-check-double bg-grey"></i>
                                                    <div class="timeline-item">
                                                        <div class="timeline-body">
                                                    validation direction<a href="#" class="btn btn-sm bg-success">√</a>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div>
                                                <i class="fas fa-user bg-green"></i>
                                                <i class="nav-icon fas fa-check-double bg-grey"></i>
                                                <div class="timeline-item">
                                                    <div class="timeline-body">
                                                    validation secteur  <a href="#" class="btn btn-sm bg-success">√</a>
                                                    </div>

                                                </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline item -->
                                                <div>

                                                <i class="nav-icon far fa-calendar-check bg-green"" ></i>
                                                <div class="timeline-item">
                                                    <div class="timeline-body">
                                                    Saisie   <a href="#" class="btn btn-sm bg-success">√</a>
                                                    </div>

                                                </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline item -->
                                                <div>
                                                <i class="nav-icon fas fa-user-plus bg-yellow"></i>
                                                <div class="timeline-item">
                                                    <div class="timeline-body">
                                                    Commande  <a href="#" class="btn btn-sm bg-success">√</a>
                                                    </div>

                                                </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline time label -->

                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        </div>
                                        <!-- /.timeline -->

                                    </section>
                                </div>

                            </div>

                        </div>
                        </form>
                        </div>
                        @endif
                        @if ($datas->statut==2)



                        <div class="col-md-3" >
                        <form method="POST" action="{{route('CalculheureMois')}}">
                            @csrf
                        <!-- general form elements disabled -->
                        <div class="card card-dark">
                            <div class="card-header col-md-10">
                            <h3 class="card-title">{{$datas->Nom}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <form role="form">
                                <div class="row">
                                    <section class="content">
                                        <div class="container-fluid">

                                        <!-- Timelime example  -->
                                        <div class="row">
                                            <div class="col-md-12">
                                            <!-- The time line -->
                                            <div class="timeline">
                                                <!-- timeline time label -->
                                                <div class="time-label">
                                                <span class="bg-red">{{$datas->agent}}</span>
                                                </div>
                                                <!-- /.timeline-label -->
                                                <!-- timeline item -->
                                                <div>
                                                <i class="fas fa-envelope bg-blue"></i>
                                                <div class="timeline-item">
                                                    <div class="timeline-body">
                                                        validation centre   <a href="#" class="btn btn-sm bg-danger">X</a>
                                                    </div>

                                                </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline item -->
                                                <div>
                                                    <i class="fas fa-user bg-green"></i>
                                                    <i class="nav-icon fas fa-check-double bg-grey"></i>
                                                    <div class="timeline-item">
                                                        <div class="timeline-body">
                                                    validation direction <a href="#" class="btn btn-sm bg-danger">X</a>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div>
                                                <i class="fas fa-user bg-green"></i>
                                                <i class="nav-icon fas fa-check-double bg-black"></i>
                                                <div class="timeline-item">
                                                    <div class="timeline-body">
                                                    validation secteur <a href="#" class="btn btn-sm bg-success">√</a>
                                                    </div>

                                                </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline item -->
                                                <div>

                                                <i class="nav-icon far fa-calendar-check bg-green"" ></i>
                                                <div class="timeline-item">
                                                    <div class="timeline-body">
                                                    Saisie  <a href="#" class="btn btn-sm bg-success">√</a>
                                                    </div>

                                                </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline item -->
                                                <div>
                                                <i class="nav-icon fas fa-user-plus bg-yellow"></i>
                                                <div class="timeline-item">
                                                    <div class="timeline-body">
                                                    Commande   <a href="#" class="btn btn-sm bg-success">√</a>
                                                    </div>

                                                </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline time label -->

                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        </div>
                                        <!-- /.timeline -->

                                    </section>
                                </div>

                            </div>

                        </div>
                        </form>
                        </div>
                        @endif
                        @if ($datas->statut==1)



                        <div class="col-md-3" >
                        <form method="POST" action="{{route('CalculheureMois')}}">
                            @csrf
                        <!-- general form elements disabled -->
                        <div class="card card-dark">
                            <div class="card-header col-md-10">
                            <h3 class="card-title">{{$datas->Nom}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <form role="form">
                                <div class="row">
                                    <section class="content">
                                        <div class="container-fluid">

                                        <!-- Timelime example  -->
                                        <div class="row">
                                            <div class="col-md-12">
                                            <!-- The time line -->
                                            <div class="timeline">
                                                <!-- timeline time label -->
                                                <div class="time-label">
                                                <span class="bg-red">{{$datas->agent}}</span>
                                                </div>
                                                <!-- /.timeline-label -->
                                                <!-- timeline item -->
                                                <div>
                                                <i class="fas fa-envelope bg-blue"></i>
                                                <div class="timeline-item">
                                                    <div class="timeline-body">
                                                        validation centre  <a href="#" class="btn btn-sm bg-danger">X</a>
                                                    </div>

                                                </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline item -->
                                                <div>
                                                <i class="fas fa-user bg-green"></i>
                                                <i class="nav-icon fas fa-check-double bg-grey"></i>
                                                <div class="timeline-item">
                                                    <div class="timeline-body">
                                                    validation direction      <a href="#" class="btn btn-sm bg-danger">X</a>
                                                    </div>

                                                </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline item -->
                                                <div>
                                                    <i class="fas fa-user bg-green"></i>
                                                    <i class="nav-icon fas fa-check-double bg-grey"></i>
                                                    <div class="timeline-item">
                                                        <div class="timeline-body">
                                                    validation secteur  <a href="#" class="btn btn-sm bg-danger">X</a>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline item -->
                                                <div>

                                                <i class="nav-icon far fa-calendar-check bg-green"" ></i>
                                                <div class="timeline-item">
                                                    <div class="timeline-body">
                                                    Saisie    <a href="#" class="btn btn-sm bg-success">√</a>
                                                    </div>

                                                </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline item -->
                                                <div>
                                                <i class="nav-icon fas fa-user-plus bg-yellow"></i>
                                                <div class="timeline-item">
                                                    <div class="timeline-body">
                                                    Commande   <a href="#" class="btn btn-sm bg-success">√</a>
                                                    </div>

                                                </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline time label -->

                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        </div>
                                        <!-- /.timeline -->

                                    </section>
                                </div>

                            </div>

                        </div>
                        </form>
                        </div>
                        @endif
                            @endforeach
