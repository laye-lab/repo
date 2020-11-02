                                                            <center>   <h2>Heures supplémentaires en cours de traitement</center>

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
