
@extends('dashboard.control-interno.empleados.show')

@section('menu-empleado')


  <li class="nav-item">
    <a class="nav-link active" href="{{ route("empleados.show",$empleado->id_empleado) }}"><i class="fas fa-id-card-alt"></i> Perfil Empleado</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{ route("inventario.empleado",$empleado->id_empleado) }}"><i class="fas fa-dolly-flatbed"></i> Inventario Empleado</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{ route("inventario.empleado.history",$empleado->id_empleado) }}"></li><i class="fas fa-history"></i> History Inventario</a>
  </li>



@endsection

@section('content-empleado')

<div class="container">
    <div class="card-deck">

        <div class="card col-md-4">
        <img src="https://recursosbarritan.s3.us-east-2.amazonaws.com{{$empleado->avatar}}" class="card-img-top" alt="...">
          <div class="card-body">
            <div class="row textoPerfil">
                <div class="col-6 col-md-5">
                    <h5 class="card-title">Nombre</h5>
                </div>
                <div class="col-6 col-md-7">
                  <p class="card-title">{{$empleado->priNom}} {{$empleado->priApe}}</p>
                </div>
            </div>
            <div class="row textoPerfil">
                <div class="col-6 col-md-5">
                    <h5 class="card-title">RH</h5>
                </div>
                <div class="col-6 col-md-7">
                    <p class="card-title">{{$empleado->tipoSangre->nombre}} </p>
                  </div>
            </div>
            <div class="row textoPerfil">
                <div class="col-6 col-md-5">
                    <h5 class="card-title">Empleado</h5>
                </div>
                <div class="col-6 col-md-7">
                    <p class="card-title">{{$empleado->tipoEmpleado->nomTipo}} </p>
                  </div>
            </div>
          
          </div>
        </div>
        <div class="card">
         
          <div class="card-body datosPerfil">
            <h5 class="card-title datosTitulo">DATOS PERSONALES</h5><hr>
            <div class="row textoPerfil">
                <div class="col-6 col-md-5">
                    <h5 class="card-title">Cedula</h5>
                </div>
                <div class="col-6 col-md-7">
                  <p class="card-title">{{$empleado->cedula}}</p>
                </div>
            </div>
            <div class="row textoPerfil">
                <div class="col-6 col-md-5">
                    <h5 class="card-title">Nombres</h5>
                </div>
                <div class="col-6 col-md-7">
                  <p class="card-title">{{$empleado->priNom}} {{$empleado->segNom}}</p>
                </div>
            </div>
            <div class="row textoPerfil">
                <div class="col-6 col-md-5">
                    <h5 class="card-title">Apellidos</h5>
                </div>
                <div class="col-6 col-md-7">
                  <p class="card-title">{{$empleado->priApe}} {{$empleado->segApe}}</p>
                </div>
            </div>
            <div class="row textoPerfil">
                <div class="col-6 col-md-5">
                    <h5 class="card-title">RH</h5>
                </div>
                <div class="col-6 col-md-7">
                    <p class="card-title">{{$empleado->tipoSangre->nombre}} </p>
                  </div>
            </div>
           
            <h5 class="card-title datosTitulo mt-3">DATOS LABORALES</h5><hr>
                <div class="row textoPerfil">
                    <div class="col-6 col-md-5">
                        <h5 class="card-title">ARL</h5>
                    </div>
                    <div class="col-6 col-md-7">
                    <p class="card-title">{{$empleado->arl}}</p>
                    </div>
                </div>
                <div class="row textoPerfil">
                    <div class="col-6 col-md-5">
                        <h5 class="card-title">EPS</h5>
                    </div>
                    <div class="col-6 col-md-7">
                    <p class="card-title">{{$empleado->eps}}</p>
                    </div>
                </div>
                <div class="row textoPerfil">
                    <div class="col-6 col-md-5">
                        <h5 class="card-title">Cargo</h5>
                    </div>
                    <div class="col-6 col-md-7">
                    <p class="card-title">{{$empleado->tipoEmpleado->nomTipo}} </p>
                    </div>
                </div>
            <h5 class="card-title datosTitulo mt-3">DATOS DE CONTACTO</h5><hr>
                <div class="row textoPerfil">
                    <div class="col-6 col-md-5">
                        <h5 class="card-title">Telefono</h5>
                    </div>
                    <div class="col-6 col-md-7">
                    <p class="card-title">{{$empleado->numTelefono}}</p>
                    </div>
                </div>
                <div class="row textoPerfil">
                    <div class="col-6 col-md-5">
                        <h5 class="card-title">Correo</h5>
                    </div>
                    <div class="col-6 col-md-7">
                    <p class="card-title">{{$empleado->email}}</p>
                    </div>
                </div>
                <div class="row textoPerfil">
                    <div class="col-6 col-md-5">
                        <h5 class="card-title">Direccion</h5>
                    </div>
                    <div class="col-6 col-md-7">
                    <p class="card-title">{{$empleado->direccion}} </p>
                    </div>
                </div>
                <a class="btn  mt-3 mb-3 backColor" href=" {{ route('empleados.edit',$empleado->id_empleado) }}">
                    Actualizar informacion
                </a>

            
                
          </div>
        </div>
    </div>
</div>

@endsection

