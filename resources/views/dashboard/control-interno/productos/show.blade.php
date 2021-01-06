
@extends('dashboard.master')

@section('content')

<style>
  .bodegaProducto{
    width: 5%;
    background-color: #1c355e;
  }
  .bodegaProducto h5{
    text-align: center;
    color: white;
    padding-top: 5px;
    padding-bottom: 5px;
    font-weight: bold;
    font-size: 26px;
  }
</style>
<div class="row">

    <div class="col-12">
        <ol class="breadcrumb-arrow">
            <li><a href="{{ route("home") }}"><i class="fa fa-fw fa-home"></i></a></li>
            <li class=""><a href="{{ route("productos.index") }}">Inventario</a></li>
            <li class="active"><span>{{$productos->nombre}}</span></li>
        </ol>
    </div>
</div>
<div class="card content_d">
    <div class="card-body">

      <div class="card">
        <div class="row no-gutters">
          <div class="col-md-3">
            <img src="https://recursosbarritan.s3.us-east-2.amazonaws.com{{$productos->img}}" class="card-img-top" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">{{$productos->nombre}}</h5>
              <p class="card-text">{{$productos->descripcion}}</p>
            <p><strong>Cantidad de articulo: </strong> {{$productos->stock}}</p>
            </div>
          </div>
        </div>
      </div>

      <div class="card mt-5">
        <h5 class="card-header">En bodega</h5>
        <div class="card-body">
          <p class="card-text">Cantidad en bodega</p>
          <div class="bodegaProducto">
            <h5 class="card-title">{{$productos->stock - $asignados}}</h5>
          </div>
        </div>
      </div>


      <div class="card mt-5">
        <h5 class="card-header">Asignados</h5>
        <div class="card-body">
          <div class="table-responsive-xl">
              <table class="table table-bordered data-table" >
              <thead>
              <th>Empleado</th>
              <th>Cantidad</th>
              <th>Fecha de asignacion</th>
            
              <th></th>
              </tr>
              </thead>
              <tbody>
              </tbody>
              </table>
          </div>
        
        </div>
      </div>
        
    </div>
</div>


<script type="text/javascript">

  $(document).ready(function () {
    var id={{$productos->id_producto}};
  var table = $('.data-table').DataTable({
  language: {
      "decimal": "",
      "emptyTable": "No hay información",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
      "infoFiltered": "(Filtrado de _MAX_ total entradas)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Mostrar _MENU_ Entradas",
      "loadingRecords": "Cargando...",
      "processing": "Procesando...",
      "search": "Buscar:",
      "zeroRecords": "Sin resultados encontrados",
      "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
      }
  },
  stateSave: true,
  processing: true,
  serverSide: true,
  ajax:  {
        url: "/dashboard/productos/"+id+"/asignados",
       },
  columns: [
    {data: 'nombre', name: 'nombre'},
    {data: 'cantidad', name: 'cantidad'},
    {data: 'fecha', name: 'fecha'},
  {data: 'action', name: 'action', orderable: false, searchable: false},
  ]
  });

  table
  .order( [ 1, 'asc' ] )
  .draw();

});


// ===script  para aceptar modal eliminar noticia
window.onload = function () {
      $('#deleteProducto').on('show.bs.modal', function (event) {
                  
          var button = $(event.relatedTarget) // Button that triggered the modal
          var id = button.data('id') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

          action = $('#formDelete').attr('data-action').slice(0,-1)
          action += id
          console.log(action)

          $('#formDelete').attr('action',action)

          var modal = $(this)
          modal.find('.modal-title').text('PRODUCTO: ' + button.data('nombre'))
      })
  }
</script>

@endsection

