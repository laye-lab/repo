@extends('../../layouts.template_dashbord')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Liste des utilisateurs</h1>
          </div>
        
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users</h3>
              </div>
              <!-- /.card-header
             select('agent.Matricule_agent','users.name','Fonction.Libelle_Fonction','agent.Statut','Direction.Direction')-->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead  class="table-success">
                  <tr>
                    <th>Matricule</th>
                    <th>Prenom et Nom</th>
                    <th>Fonction</th>
                    <th>Statut</th>
                    <th>Direction</th>
                    <th>Affectation</th>
                    <th>Secteur</th>
                    <th>Etablissement</th>
                    <th>Role</th>
                  </tr>
                  </thead>
                  <tbody>
                    {{ Auth::user()->id  }}
                    @foreach($role_account as $role)
                    @if(Auth::user()->id == $role->Matricule_agent)
                  <tr>
                    <td>
                      {{$role->Matricule_agent}}
                    </td>
                    <td>
                      {{$role->name}}
                    </td>
                    <td>
                      {{$role->Libelle_Fonction}}
                    </td>
                    <td>
                      {{$role->Statut}}
                    </td>
                    <td>
                      {{$role->Direction}}
                    </td>
                


                    <td>
                      <a href=""> <button class="btn btn-primary">Editer</button></a>
                      <a href=""> <button class="btn btn-warning">Supprimer</button></a>

                    </td>
                  </tr>
                  @endif
                  @endforeach
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
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
