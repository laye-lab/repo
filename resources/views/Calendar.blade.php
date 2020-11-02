@extends('layouts.template_dashbord_calendar')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Calendrier</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
              <li class="breadcrumb-item active">Calendrier</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    @foreach($role_account as $role)
    @if(Auth::user()->id == $role->Matricule_agent)
    @switch($role->Nom)
                      @case('drh')
                      <section class="content">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-md-3">
                              <div class="sticky-top mb-3">
                                <div class="card">
                                  <div class="card-header">
                                    <h4 class="card-title">Evenement</h4>
                                  </div>
                                  <div class="card-body">
                                    <!-- the events -->
                                    <div id="external-events">
                                      <div class="external-event bg-success">Début heure supp</div>
                                      <div class="external-event bg-warning">cloture</div>

                                      <div class="checkbox">
                                        <label for="drop-remove">
                                          <input type="checkbox" id="drop-remove">
                                            Supprimer aprés insertion
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                                <div class="card">
                                  <div class="card-header">
                                    <h3 class="card-title">Creer un événement</h3>
                                  </div>
                                  <div class="card-body">
                                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                      <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                                      <ul class="fc-color-picker" id="color-chooser">
                                        <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                                      </ul>
                                    </div>
                                    <!-- /btn-group -->
                                    <div class="input-group">
                                      <input id="new-event" type="text" class="form-control" placeholder="Titre de l'événement">

                                      <div class="input-group-append">
                                        <button id="add-new-event" type="button" class="btn btn-primary">Ajouter</button>
                                      </div>
                                      <!-- /btn-group -->
                                    </div>
                                    <!-- /input-group -->
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-9">
                              <div class="card card-primary">
                                <div class="card-body p-0">
                                  <!-- THE CALENDAR -->
                                  <div id="calendar"></div>
                                  <button id='Delete'>Delete Events</button></p>
                                </div>
                                <!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </div><!-- /.container-fluid -->
                      </section>
                      <!-- /.content -->
                    </div>
                      @break

                      @case('n+2')
                      <section class="content">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-md-3">
                              <div class="sticky-top mb-3">


                                  <div class="card-body">
                                    <!-- the events -->
                                    <div id="external-events">


                                    </div>
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                                    <!-- /input-group -->
                              </div>
                            </div>
                            <!-- /.col -->

                              <div class="card card-primary">
                                <div class="card-body p-0">
                                  <!-- THE CALENDAR -->
                                  <div id="calendar"></div>

                                </div>
                                <!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </div><!-- /.container-fluid -->
                      </section>
                      <!-- /.content -->
                    </div>

                    @endswitch
                            @break
                            @endif
                                @endforeach

  @endsection
