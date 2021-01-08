
@extends('dashboard.control-interno.empleados.show')

@section('menu-empleado')

  <li class="nav-item">
    <a class="nav-link " href="{{ route("empleados.show",$empleado->id_empleado) }}"><i class="fas fa-id-card-alt"></i> Perfil Empleado</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{ route("inventario.empleado",$empleado->id_empleado) }}"><i class="fas fa-dolly-flatbed"></i> Inventario Empleado</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{ route("inventario.empleado.history",$empleado->id_empleado) }}"><i class="fas fa-history"></i> History Inventario</a>
  </li>

@endsection

@section('content-empleado')


<div class="card content_d">
  <div class="card-body">


      <div class="table-responsive-xl">
          <table class="table table-bordered data-table" >
          <thead>
          <th>Nº dotacion</th>
          <th>Nombre</th>
          <th>Cantidad</th>
          <th>Observacion</th>
          <th>Fecha Registro</th>
          <th>Imagen</th>
          <th>Estado</th>
          <th></th>
          </tr>
          </thead>
          <tbody>
          </tbody>
          </table>
      </div>
      
  </div>
</div>

<script type="text/javascript">

  $(document).ready(function () {
    var empleado={{$empleado->id_empleado}};
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
  responsive: true,
  ajax:  {
        url: "/dashboard/empleados/inventario/history/"+empleado,
       },
  columns: [
  {data: 'id_dotEmpleado', name: 'id_dotEmpleado'},
  {data: 'nombre', name: 'nombre'},
  {data: 'cantidad', name: 'cantidad'},
  {data: 'observacion', name: 'observacion',orderable: false,},
  {data: 'fecha', name: 'fecha'},
  {data: 'imagen', name: 'imagen', orderable: false, searchable: false},
  {data: 'estado', name: 'estado', orderable: false, searchable: false},
  {data: 'action', name: 'action', orderable: false, searchable: false},
  ]
  });

  table
  .order( [ 4, 'asc' ] )
  .draw();

});


// ===script  para aceptar modal eliminar noticia
window.onload = function () {
      $('#deleteCliente').on('show.bs.modal', function (event) {
                  
          var button = $(event.relatedTarget) // Button that triggered the modal
          var id = button.data('id') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

          action = $('#formDelete').attr('data-action').slice(0,-1)
          action += id
          console.log(action)

          $('#formDelete').attr('action',action)

          var modal = $(this)
          modal.find('.modal-title').text('Cliente: ' + button.data('nombre'))
      })
  }
</script>

@endsection

