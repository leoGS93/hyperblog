
@extends('dashboard.master')

@section('content')

<div class="row">

    <div class="col-12">
        <ol class="breadcrumb-arrow">
            <li><a href="{{ route("home") }}"><i class="fa fa-fw fa-home"></i></a></li>
            <li class=""><a href="{{ route("productos.index") }}">inventario</a></li>
            <li class="active"><span>Nuevo producto</span></li>
        </ol>
    </div>
</div>
<div class="card content_d">
    <div class="card-body">
        <div class="container">
            <div class="row tituloAccion">
                <h2>Registro de nuevo producto</h2>
            </div>

            @include('dashboard.partials.validation-error')

            <form action="{{ route("productos.store") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mt-2">
                    <div class="col-md-6 mt-3">
                        <label for="nombre" class="label--required">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{old('nombre')}}">
                        <br>
                        <label for="descripcion" class="label--required">Descripcion</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" class="form-control"  rows="4">{{old('descripcion')}}</textarea>
                        <br>
                        <label for="stock" class="label--required">Stock</label>
                        <input type="number"  class="form-control" name="stock" id="stock" placeholder="Stock" value="{{old('stock')}}">
                    </div>
                    <div class="col-md-6 mt-3">

                        <div class="form-group">
                            <label for="catalogoM">Imagen</label>
                            <div class="file-loading">
                                <label>Preview File Icon</label>
                                <input id="file" name="img" type="file"  data-initial-preview="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=imagen+producto">
                            </div>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">   Tamaño de la imagen</small>
    
                    </div>
                </div>
        
             
                <br>
                <button type="submit" class="btn backColor">Guardar</button>
            </form>
        </div>
        
    </div>
</div>

<script src="{{ asset("js/dashboard/preguntarform.js") }}" type="text/javascript"></script>
@endsection


