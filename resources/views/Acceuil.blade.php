@extends('layouts.template_dashbord_acceuil')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Accueil</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">senadmin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


     @foreach($role_account as $role)
     @if(Auth::user()->id == $role->Matricule_agent)
     @switch($role->Nom)
                       @case('n+2')
                             @include('Acceuil.n_plus_2')
                             @break

                         @case('n+1')
                                @include('Acceuil.n_plus_1')
                                @break

                         @case( 'drh')
                                @include('Acceuil.drh')
                                @break

                        @case( 'dto' or 'dcm' or 'dpd')
                        @include('Acceuil.dto_dcm')
                        @break
                    @break


       @endswitch
             @break
               @endif
                 @endforeach
 @endsection
