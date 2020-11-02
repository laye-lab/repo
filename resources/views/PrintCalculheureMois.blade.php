@extends('../../layouts.template_dashbord_collapsed')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
        
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <center>
   
    
    <section class="content" style="position:relative;left:300px;">
      <div class="container-fluid">
      
        <div class="row" >
            
            <div class="col-5">
                <button class=" btn btn-lg btn-danger" style="position:relative;bottom:20px;">Télécharger</button>
                <div class="card">
                    @foreach ($data as  $datas)         
                         @if ($datas->month == $mois)
                             
                       @if ($datas->sum15>9)
                       {{$datas->agent}}HS1000000{{$datas->sum15}}<br>
                       @else  {{$datas->agent}}HS10000000{{$datas->sum15}}<br>
                       @endif
                       @if ($datas->sum40>9)
                       {{$datas->agent}}HS2000000{{$datas->sum40}}<br>
                       @else  {{$datas->agent}}HS20000000{{$datas->sum40}}<br>
                       @endif
                       @if ($datas->sum60>9)
                       {{$datas->agent}}HS3000000{{$datas->sum60}}<br>
                       @else  {{$datas->agent}}HS30000000{{$datas->sum60}}<br>
                       @endif
                       @if ($datas->sum100>9)
                       {{$datas->agent}}HS4000000{{$datas->sum100}}<br>
                       @else  {{$datas->agent}}HS40000000{{$datas->sum100}}<br>
                       @endif
                                    
                           @endif
                     @endforeach
                    
 @endsection

