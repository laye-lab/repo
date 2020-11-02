


@extends('../../layouts.template_dashbord_collapsed')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Détails</h1>


          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Détails</li>
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
                <div class="row">
                    <div class="col-12"  style="position:relative; top:10px; ">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style=" font-family: 'Lato', sans-serif; font-size: 20px; font-weight: 300;" >
                                    <i class="fas fa-chart-bar"></i>
                              Heures supplémentaires par affectation et par taux
                            </div>
                            <div class="card-header" style="background-color:white;">



                                <ul class="nav nav-pills card-header-pills breadcrumb float-sm-right" style="background-color:white; height:10px;">
                                  <li class="nav-item" style="background-color:white;">
                                    <button style=" background-color:white;border: none;color: white;">
                                        <div class="info-box bg-info" style="width:100%;position:relative; bottom:30px; ">
                                          <div class="info-box-content">
                                            <span class="info-box-text text-center ">Montant</span>
                                            <span class="info-box-number text-center mb-0">  @php
                                                echo(int)($Montant);
                                               @endphp FCFA</span>
                                          </div>
                                        </div>
                                      </button>

                                  </li>

                                </ul>
                              </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6">
                                </div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                              <thead>
                                <tr>
                                    <th>Matricule</th>
                                    <th>Nom Agent</th>
                                    <th> Nbr heures HS1</th>
                                    <th> Nbr heures HS2</th>
                                    <th> Nbr heurss HS3</th>
                                    <th> Nbr heures HS4</th>
                                    <th>Montant HS1</th>
                                    <th>Montant HS2</th>
                                    <th>Montant HS3</th>
                                    <th>Montant HS4</th>
                                    <th>Total heures </th>
                                    <th>Total montants</th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $datas)
                                    <tr>
                                        <td>

                                            {{$datas->Matricule_Agent}}
                                          </td>
                                          <td>
                                            {{$datas->Nom_Agents}}
                                          </td>
                                          <td>
                                            {{$datas->sum15}}
                                          </td>
                                          <td>
                                            {{$datas->sum40}}
                                          </td><td>
                                            {{$datas->sum60}}
                                          </td><td>
                                            {{$datas->sum100}}
                                          </td>
                                      <td>
                                        <button type="submit" class="btn  btn-outline-info ">
                                        @php
                                        echo(int)($datas->sumMont_15);
                                       @endphp </button>

                                      </td>
                                      <td>
                                        <button type="submit" class="btn  btn-outline-info ">
                                        @php
                                        echo (int)($datas->sumMont_40);
                                       @endphp
                                             </button>
                                      </td>
                                      <td>
                                        <button type="submit" class="btn  btn-outline-info ">
                                        @php
                                        echo (int)($datas->sumMont_60);
                                       @endphp
                                        </button>
                                      </td>
                                      <td>
                                        <button type="submit" class="btn  btn-outline-info ">
                                            @php
                                            echo (int)($datas->sumMont_100);
                                           @endphp
                                           </button>
                                      </td>
                                      <td>
                                        <button type="submit" class="btn  btn-info ">
                                          {{$datas->total_heures}}
                                           </button>
                                      </td>

                                      <td>
                                        <button type="submit" class="btn  btn-info ">
                                            @php
                                            echo (int)($datas->Mont_total);
                                           @endphp
                                           </button>
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




                    </section>



@endsection
