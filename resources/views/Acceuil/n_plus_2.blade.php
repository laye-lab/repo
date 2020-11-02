<section class="content">
    <div class="container-fluid" >
        <div class="row">

<div class="col-md-10 ">
    <div class="row " style="position:relative; left:10%;">
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
                            {{$SUM_MONTANT_n_plus_2}}
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

            <!-- /.col -->

            <!-- fix for small devices only -->


            <!-- /.col -->
          </div>
        <!-- Small boxes (Stat box) -->
        <div class="container">
            <div class="card-deck mb-3 text-center">
                <div class="card mb-3 box-shadow">

                    <div class="card-body"  style="background-color:white;height:220px;
                     background-size: 310px 200px;
                    background-repeat: no-repeat;
                    background-image: url({{asset('../../dist/img/commandes.png')}});" >

                    <a href="{{route('homeCommandeindex')}}" class="small-box-footer">
                      <button type="button" style="position:relative;top:150px;" class="btn btn-lg btn-success">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                    </a>
                    </div>
                </div>
                <div class="card mb-3 box-shadow">

                    <div class="card-body"  style="background-color:white;height:220px;
                    background-size: 310px 200px;
                    background-repeat: no-repeat;
                    background-image: url({{asset('../../dist/img/saisir.png')}});" >

                        <a href="{{route('homeSaisie')}}" class="small-box-footer">
                      <button type="button" style="position:relative;top:150px;" class="btn btn-lg btn-success">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                        </a>
                    </div>
                </div>
              <div class="card mb-3 box-shadow">

                <div class="card-body"  style="background-color:white;height:100px;
                  background-size: 310px 200px;
                    background-repeat: no-repeat;
                background-image: url({{asset('../../dist/img/valid.png')}});" >

                <a href="{{route('Validation')}}" class="small-box-footer">
                  <button type="button" style="position:relative;top:150px;" class="btn btn-lg btn-success">

                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>
                    </a>
                </div>
              </div>


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


    </div></section>
