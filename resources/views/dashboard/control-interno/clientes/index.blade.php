@extends('dashboard.master')

@section('content')
<div class="row">

    <div class="col-12">
        <ol class="breadcrumb-arrow">
            <li><a href=""><i class="fa fa-fw fa-home"></i></a></li>
            <li class="active"><span>Clientes</span></li>
        </ol>
    </div>
</div>
<div class="card content_d">
    <div class="card-body">

        <a class="btn btn-success mt-3 mb-3" href="{{ route('clientes.create') }}">
            Nuevo cliente
        </a>

        <div class="table-responsive-xl">
            <table class="table table-bordered data-table" >
            <thead>
            <th>Id</th>
            <th>Cargo</th>
            <th>Empresa</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Foto</th>
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
<div class="modal fade" id="deleteCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <p>¿Seguro que desea borrar el cliente seleccionado?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                <form id="formDelete" method="POST" action="{{ route('clientes.destroy',0) }}" 
                    data-action="{{ route('clientes.destroy',0) }}">
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
    ajax: "{{ route('clientes.index') }}",
    columns: [
    {data: 'id_cliente', name: 'id_cliente'},
    {data: 'cargo', name: 'cargo'},
    {data: 'empresa', name: 'empresa'},
    {data: 'priNombre', name: 'priNombre'},
    {data: 'priApellido', name: 'priApellido'},
    {data: 'email', name: 'email'},
    {data: 'numTelefono', name: 'numTelefono'},
    {data: 'imagen', name: 'imagen'},
    {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
    });


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

