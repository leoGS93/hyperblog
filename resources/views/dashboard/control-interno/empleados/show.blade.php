
@extends('dashboard.master')

@section('content')
<style>
  
  .menuEmpleado{
    font-weight: bold;
    font-size: 24px;

  }
  .menuEmpleado a{
    color: #1c355e;
  }
  
  .textoPerfil{
    text-align: left;
    font-size: 18px !important;
  }

  .datosPerfil .datosTitulo{
    text-align: left;
    font-weight: bold;
    color: #1c355e;
    font-size: 1.25rem;
  }
  
</style>

<div class="row">

    <div class="col-12">
        <ol class="breadcrumb-arrow">
            <li><a href="{{ route("home") }}"><i class="fa fa-fw fa-home"></i></a></li>
            <li class=""><a href="{{ route("empleados.index") }}">Empleados</a></li>
            <li class="active"><span>{{$empleado->email}}</span></li>
        </ol>
    </div>
</div>
<div class="card content_d">
    <br>
    <div class="card text-center">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs menuEmpleado">
          @yield('menu-empleado')
        </ul>
      </div>
      <div class="card-body">
        @yield('content-empleado')
      </div>
    </div>
 
</div>

@endsection

