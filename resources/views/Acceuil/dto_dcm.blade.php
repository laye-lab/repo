

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
                              {{$total_current_month_n_plus_3}}
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
                                {{$total_current_year_n_plus_3}}
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
                            {{$SUM_MONTANT_n_plus_3}}
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
                </div>
                <!-- /.row -->
                <center>

                    </center>
                    </div>
                    <div class="row">
                    <div class="col-12">
                        <div class="card " style="position:relative;bottom:35px;">
                            <div class="card-header col-md-5 " >
                              <h3 class="card-title">Suivi des heures supplémentaire par établissement</h3>

                            </div>
                            <div class="card-header" style="background-color:white;">
                        </div>
                        <!-- /.card-header -->


                        <section class="content" >



                            <div class="row" style="background-color:white">
                                <div class="col-12">

                                        <div class="card-body py-3 px-3">
                                            {!! $usersChartKLK2->container() !!}
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
                        </div>

                    </div>
                    </div>


