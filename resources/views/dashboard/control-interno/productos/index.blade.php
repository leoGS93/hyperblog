@extends('dashboard.master')

@section('content')
<div class="row">

    <div class="col-12">
        <ol class="breadcrumb-arrow">
            <li><a href=""><i class="fa fa-fw fa-home"></i></a></li>
            <li class="active"><span>inventario</span></li>
        </ol>
    </div>
</div>
<div class="card content_d">
    <div class="card-body">

        <a class="btn btn-success mt-3 mb-3" href="{{ route('productos.create') }}">
            Nuevo producto
        </a>

        <div class="table-responsive-xl">
            <table class="table table-bordered data-table" >
            <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>stock</th>
            <th>Imagen</th>
            <th></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            </table>
        </div>
        
    </div>
</div>




{{-- modal eliminar cliente --}}
<div class="modal fade" id="deleteProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Seguro que desea borrar el producto seleccionado?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                <form id="formDelete" method="POST" action="{{ route('productos.destroy',0) }}" 
                    data-action="{{ route('productos.destroy',0) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    $(document).ready(function () {
    
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
    ajax: "{{ route('productos.index') }}",
    columns: [
    {data: 'id_producto', name: 'id_producto'},
    {data: 'nombre', name: 'nombre'},
    {data: 'stock', name: 'stock'},
    {data: 'imagen', name: 'imagen'},
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

