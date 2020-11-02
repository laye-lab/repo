@extends('layouts.template_dashbord_acceuil')

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
                                    <div class="card-icon card-icon-large" style="height:20px; "><i class="fas fa-clock"></i></div>
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

                    </div>
                    <div class="row" style="position:relative; bottom:50px;">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style=" font-family: 'Lato', sans-serif; font-size: 20px; font-weight: 300;" >
                                    <i class="fas fa-chart-bar"></i>
                              Heures supplémentaires par etablissement et par taux

                                </h3>

                                   </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6">
                                </div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                              <thead>
                                <tr>
                                    <th style="font-weight: 600;">Etablissements</th>
                                    <th style="font-weight: 600;">Taux à 15%</th>
                                    <th style="font-weight: 600;">Taux à 40%</th>
                                    <th style="font-weight: 600;">Taux à 60%</th>
                                    <th style="font-weight: 600;">Taux à 100%</th>
                                    <th style="font-weight: 600;">Montant total FCFA</th>

                                    <th style="font-weight: 600;">Total heures</th>
                                    <th style="font-weight: 600;">Details </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($data as  $datass)


                                        <tr>
                                                <td>{{$datass->Etablissements}}</td>
                                                <td>{{$datass->sum15}}</td>
                                                <td>{{$datass->sum40}}</td>
                                                <td>{{$datass->sum60}}</td>
                                                <td>{{$datass->sum100}}</td>
                                                <td>
                                                 @php
                                                 echo (int)($datass->Mont_total);
                                                @endphp </td>
                                                <td>{{$datass->total}}</td>
                                                <td>
                                                    <form method="POST" action="{{'Details_montant_affectation'}}" class="col-12 col-sm-4"  >
                                                        @csrf
                                                      <input type="hidden" name="etablissement"  value="{{$datass->Etablissements}}">
                                                      <input type="hidden" name="montant"  value="{{$datass->Mont_total}}">
                                                      <button class="btn btn-warning" style="font-weight: 400;">
                                                        <i class="fas fa-info-circle"></i>
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

                    </div>
                    </div>
                </div>
                    </div>


                  @endsection
