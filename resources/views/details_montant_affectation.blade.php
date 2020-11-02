@extends('layouts.template_dashbord')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Dashbord</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="#">Tableau de bord </a></li>
                    <li class="breadcrumb-item active">senadmin</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>

    <section class="content-header">
        <div class="container-fluid">

        </div><!-- /.container-fluid -->
      </section>
<center>
            <section class="content">
                <div class="container-fluid">
                <!-- Info boxes -->

                <!-- /.row -->
                <center>

                    </center>
                    </div>
                    <div class="row">
                        <div class="col-12"  style="position:relative; top:10px; ">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style=" font-family: 'Lato', sans-serif; font-size: 20px; font-weight: 300;" >
                                    <i class="fas fa-chart-bar"></i>
                              Heures supplémentaires par affectation et par taux
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6">
                                  </div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                                      <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                                <thead>
                                    <th >Affectations</th>
                                    <th >Taux à 15%</th>
                                    <th >Taux à 40%</th>
                                    <th>Taux à 60%</th>
                                    <th>Taux à 100%</th>
                                    <th>Montant total FCFA</th>

                                    <th >Total heures</th>
                                    <th>Details </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as  $datass)


                                    <tr role="row" class="odd">
                                            <td tabindex="0" class="sorting_1">{{$datass->Affectations}}</td>
                                            <td tabindex="0" class="sorting_1">{{$datass->sum15}}</td>
                                            <td tabindex="0" class="sorting_1">{{$datass->sum40}}</td>
                                            <td tabindex="0" class="sorting_1">{{$datass->sum60}}</td>
                                            <td tabindex="0" class="sorting_1">{{$datass->sum100}}</td>
                                            <td tabindex="0" class="sorting_1"><button  class=" btn btn-outline-dark">
                                             @php
                                             echo (int)($datass->Mont_total);
                                            @endphp  </button></td>
                                            <td tabindex="0" class="sorting_1"><button  class=" btn  btn-outline-dark">{{$datass->total}}</button></td>
                                            <td tabindex="0" class="sorting_1">
                                                <form method="POST" action="{{'Details_montant'}}" class="col-12 col-sm-4"  >
                                                    @csrf
                                                  <input type="hidden" name="affectation"  value="{{$datass->Affectations}}">
                                                  <input type="hidden" name="montant"  value="{{$datass->Mont_total}}">
                                                  <button class="btn  btn-warning">
                                                    <i class="fas fa-info-circle"></i>                                                  </button>
                                                </form>

                                              </td>
                                    </tr>

                            @endforeach

                                </tbody>

                              </table></div></div>
                            </div>
                            <!-- /.card-body -->
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

                    </div>
                    </div>


                  @endsection
