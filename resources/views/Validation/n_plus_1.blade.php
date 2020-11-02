
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

<center>
            <section class="content">
                <div class="container-fluid">
                <!-- Info boxes -->
                @if ($data_n_plus_1_count >0)
                    <div class="row">
                    <div class="col-12"  style="position:relative; top:10px; ">
                        <div class="card card-success">
                            <div class="card-header col-md-5 " >
                              <h3 class="card-title">Heure supplémentaire du mois </h3>

                            </div>
                            <div class="card-header" style="background-color:white;">
                                <form method="POST" action="{{'Validationstore'}}" >
                                    @csrf

                                    <input type="hidden" name="id"  value="{{$role->Matricule_agent}}">
                                    <input type="hidden" name="role"  value="{{$role->Nom}}">
                                <ul class="nav nav-pills card-header-pills breadcrumb float-sm-right" style="background-color:white; height:10px;">
                                  <li class="nav-item" style="background-color:white;">
                                    <button style=" background-color:white;border: none;color: white;">
                                        <div class="info-box bg-success" style="width:100%;position:relative; bottom:30px; ">
                                          <div class="info-box-content">
                                            <span class="info-box-text text-center ">Valider</span>
                                            <span class="info-box-number text-center mb-0">Heure supplémentaire</span>
                                          </div>
                                        </div>
                                      </button>
                                    </form>
                                  </li>

                                </ul>
                              </div>

                        <!-- /.card-header -->

                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Heure nº</th>
                                    <th>Matricule  </th>
                                    <th>Nom  </th>
                                    <th>Nombre d'heure </th>
                                    <th>Actions </th>



                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($heurre_somme_n_plus_un as $heure)
                                    <tr>
                                      <td>
                                        {{$heure->id_heure}}
                                      </td>
                                      <td>
                                        {{$heure->Matricule_Agent}}
                                      </td>
                                      <td>
                                        {{$heure->Nom_Agent}}
                                      </td>
                                      <td>
                                        <button type="submit" class="btn  btn-success "> {{$heure->total}}</button>
                                      </td>
                                      <td>
                                        <form method="POST" action="{{'Validationdetails'}}" class="col-12 col-sm-4"  >
                                            @csrf
                                          <input type="hidden" name="id"  value="{{$heure->id_heure}}">
                                          <input type="hidden" name="nom"  value="{{$heure->Nom_Agent}}">
                                          <button class="btn  btn-warning">
                                        Details
                                          </button>
                                        </form>

                                      </td>


                                  </tr>

                          @endforeach
                                </tbody>

                            </table>


                        </div>
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
                        </div>
                        @else
                        <div class="card card-danger card-outline col-md-7">
                            <div class="card-header">
                              <h5 class="m-0">Validation</h5>
                            </div>
                            <div class="card-body">
                              <h6 class="card-title">Pas d'heures supplémentaires  à valider pour le moment</h6>

                              <p class="card-text"></p>
                              <a  href="{{route('Acceuil')}}" class="btn btn-danger">Acceuil<i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
                            </div>
                          </div>
                        </div>
                        @endif
                    </div>
                    </div>




                    </section>





