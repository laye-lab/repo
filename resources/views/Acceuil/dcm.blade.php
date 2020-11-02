

    <section class="content-header">
        <div class="container-fluid">

        </div><!-- /.container-fluid -->
      </section>
<center>
            <section class="content">
                <div class="container-fluid">
                <!-- Info boxes -->

                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3" style="position:relative; left:20%;">
                    <div class="info-box">
                        <span class="info-box-icon btn btn-lg btn-outline-info elevation-1"><i class="fas fa-clock"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Total heure <br> mois en cours </span>
                        <span class="info-box-number">
                            {{$total_current_month}}
                            <small>heures</small>
                        </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3"  style="position:relative; left:35%;">
                    <div class="info-box mb-3">
                        <span class="info-box-icon  btn btn-lg btn-outline-danger elevation-1"><i class="fas fa-clock"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">total des  heures <br> de l'année</span>
                        <span class="info-box-number">
                            {{$total_current_year}}
                            <small>heures</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->


                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <center>

                    </center>
                    </div>
                    <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header">

                     <center> <button class=" btn btn-lg btn-outline-success">Suivi des heures supplémentaire du mois</button></center>

                        </div>
                        <!-- /.card-header -->


                        <section class="content" >



                            <div class="row" style="background-color:white">
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
                        </div>

                    </div>
                    </div>


