
@extends('dashboard.master')

@section('content')

<div class="row">

    <div class="col-12">
        <ol class="breadcrumb-arrow">
            <li><a href="{{ route("home") }}"><i class="fa fa-fw fa-home"></i></a></li>
            <li class=""><a href="{{ route("clientes.index") }}">Clientes</a></li>
            <li class="active"><span>{{$cliente->id_cliente}}</span></li>
        </ol>
    </div>
</div>
<div class="card content_d">
    <div class="card-body">
        <div class="container">
            <div class="row tituloAccion">
                <h2>Actualizar Cliente</h2>
            </div>

            @include('dashboard.partials.validation-error')

            <form action="{{ route("clientes.update",$cliente->id_cliente) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mt-2">
                    <div class="col-md-6 mt-3">
                        <label for="cargo" class="label--required">Cargo</label>
                        <input type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo" value="{{old('cargo',$cliente->cargo)}}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="empresa" class="label--required">Empresa</label>
                        <input type="text" class="form-control" name="empresa" id="empresa" placeholder="Empresa" value="{{old('empresa',$cliente->empresa)}}">
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-6 mt-3">
                        <label for="priNombre" class="label--required">Primer Nombre</label>
                        <input type="text" class="form-control" name="priNombre" id="priNombre" placeholder="Primer nombre" value="{{old('priNombre',$cliente->priNombre)}}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="segNombre" >Segundo Nombre</label>
                        <input type="text" class="form-control" name="segNombre" id="segNombre" placeholder="Segundo nombre" value="{{old('segNombre',$cliente->segNombre)}}">
                    </div>
                </div>

                <div class="row ">
                    <div class="col-md-6 mt-3">
                        <label for="priApellido" class="label--required">Primer Apellido</label>
                        <input type="text" class="form-control" name="priApellido" id="priApellido" placeholder="Primer Apellido" value="{{old('priApellido',$cliente->priApellido)}}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="segApellido">Segundo Apellido</label>
                        <input type="text" class="form-control" name="segApellido" id="segApellido" placeholder="Segundo Apellido" value="{{old('segApellido',$cliente->segApellido)}}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div>
                            <label for="email" class="label--required">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{old('email',$cliente->email)}}">
                        </div>
                        <div class="mt-3">
                            <label for="direccion" class="label--required">Dirección</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" value="{{old('direccion',$cliente->direccion)}}">
                        </div>
                        <div class="mt-3">
                            <label for="numTelefono" class="label--required">Telefono</label>
                            <input type="text" class="form-control" name="numTelefono" id="numTelefono" placeholder="Telefono" value="{{old('numTelefono',$cliente->numTelefono)}}">
                        </div>
                        
                    </div>
                    <div class="col-md-6 mt-3">

                        <div class="form-group">
                            <label for="catalogoM">Foto</label>
                            <div class="file-loading">
                                <label>Preview File Icon</label>
                            <input id="file" name="portada" type="file"  data-initial-preview={{ ($cliente->avatar == "" )? "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=foto+cliente" : "https://recursosbarritan.s3.us-east-2.amazonaws.com".$cliente->avatar }}">
                            </div>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">   Tamaño de la imagen </small>
    
                    </div>
                </div>

                <br>
                <button type="submit" class="btn backColor">Guardar</button>
                <a href="{{ url()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
            </form>
        </div>
        
    </div>
</div>

<script src="{{ asset("js/dashboard/preguntarform.js") }}" type="text/javascript"></script>
@endsection

