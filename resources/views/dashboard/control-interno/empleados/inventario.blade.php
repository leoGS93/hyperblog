
@extends('dashboard.control-interno.empleados.show')


@section('menu-empleado')

  <li class="nav-item">
    <a class="nav-link " href="{{ route("empleados.show",$empleado->id_empleado) }}"><i class="fas fa-id-card-alt"></i> Perfil Empleado</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{ route("inventario.empleado",$empleado->id_empleado) }}"><i class="fas fa-dolly-flatbed"></i> Inventario Empleado</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route("inventario.empleado.history",$empleado->id_empleado) }}"></li><i class="fas fa-history"></i> History Inventario</a>
  </li>

@endsection

@section('content-empleado')

<style>
  .cajaCantidad{
    display: flex
  }

  .cajaCantidad p{
    border-radius: 25px;
    padding-top: 5px;
    margin: 0px;
    width: 208px;
    background-color: #1c355e;
    margin-right: 5px;
    color: white
  }

</style>


<div class="card content_d">
  <div class="card-body">

      <div style="display: flex;">
        <a class="btn btn-success mt-3 mb-3" id="btnModalEmpleado" data-toggle="modal" data-target="#staticBackdrop">
          Asignar elemento
        </a>
      </div>


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


<!-- Modal asignacion de elemento al empleado -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Asignar elemento al empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route("dotaciones.store") }}" method="POST" onsubmit="return registrarDotacion()">
          @csrf
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="empleado">Cliente</label>
              <input type="text" class="form-control" id="id_empleado" name="id_empleado" value="{{$empleado->id_empleado}}" style="display: none">
              <input type="text" class="form-control" id="empleado" name="empleado" value="{{$empleado->priNom}} {{$empleado->segNom}} {{$empleado->priApe}}" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="producto">Elemento</label>
              <select id="producto" name="producto" class="form-control">
                
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="cantidad">Cantidad</label>
              <div class="cajaCantidad" style="display: none">
                <p>En bodega: <strong class="disponibles"></strong></p>
                <input type="number" class="form-control" id="cantidad" name="cantidad" min="1">
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="observacion">Observacion</label>
              <textarea class="form-control" id="observacion" name="observacion" rows="3"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary btnGuardarAsig">Guardar</button>
        </div>
      </form>  
    </div>
  </div>
</div>


<!-- Modal devolucion elemento empleado -->
<div class="modal fade" id="devolucionModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="staticBackdropLabel">Devolucion de elemento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
          <p class="shadow p-3 mb-5 bg-white rounded font-weight-bold" style="font-size: 17px;">Esta seguro que desea hacer devolucion de este articulo: <span class="nombreDevolucion" style="text-transform: uppercase"></span>?</p>
       

        <form action="{{ route("dotaciones.update") }}" method="POST" onsubmit="return actualizarDotacion()">
          @csrf
          @method('PUT')
          <input type="hidden" name="id_dotacion" id="id_dotacion">
          <input type="hidden" name="id_empleado" id="id_empleado" value="{{$empleado->id_empleado}}">
          <div class="form-group col-md-12">
            <label for="observacionEdit">Observacion</label>
            <textarea class="form-control" id="observacionEdit" name="observacionEdit" rows="3"></textarea>
            <small id="passwordHelpBlock" class="form-text text-muted">
                Por favor complete la observacion de devolucion.
            </small>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary btnGuardarAsig">Guardar</button>
        </div>
      </form>  
    </div>
  </div>
</div>

<script type="text/javascript">

  $("input").focus(function(){

  $(".alert").remove();
  })

  $("select").focus(function(){

  $(".alert").remove();
  })

  $("textarea").focus(function(){

  $(".alert").remove();
  })

 


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
        url: "/dashboard/empleados/inventario/"+empleado,
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
  .order( [ 4, 'asc' ])
  .draw();




  /// ==Enviar informacion de fila modal devolucion de elemento==///
  $('.data-table tbody').on('click', '#entrega', function () {
    var id = $(this).attr('data-id');    
    var nombre = $(this).attr('data-nombre'); 
    var detalle = $(this).attr('data-observacion'); 

   
    $("#id_dotacion").val(id);
    $(".nombreDevolucion").text(nombre)
    $("#observacionEdit").val(detalle)
  });
  /// =====================end=============================///

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


         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         $('#btnModalEmpleado').click(function(){
            //we will send data and recive data fom our AjaxController
            //alert("im just clicked click me");
            $.ajax({
               url:'/dashboard/productosAjax',
               type:'get',
               success:  function (response) {
              
                  var select = document.getElementById("producto"); //Seleccionamos el select
                  for (let i = select.options.length; i >= 0; i--) {
                    select.remove(i);
                  }     

                      var optionP = document.createElement("option"); //Creamos la opcion
                      optionP.value='';
                      optionP.innerHTML = 'Seleccione un elemento'; //Metemos el texto en la opción
                      select.appendChild(optionP);

                  for(var i=0; i < response.length; i++){ 
                      var option = document.createElement("option"); //Creamos la opcion
                      option.value=response[i]['id_producto'];
                      option.innerHTML = response[i]['nombre']; //Metemos el texto en la opción
                      select.appendChild(option); //Metemos la opción en el select
                  }
               },
               statusCode: {
                  404: function() {
                     alert('web not found');
                  }
               },
               error:function(x,xs,xt){
                  window.open(JSON.stringify(x));
               }
            });
    
          });
          
          var articulosDisponibles=0;

       
   

          $('#producto').on('change', function() {
            $('.btnGuardarAsig').attr('disabled','disabled');
              var produc=this.value;

              $("#cantidad").val('');

              if(produc !== ''){
              

                  $.ajax({
                    url:`/dashboard/asignadosAjax/${produc}`,
                    type:'get',
                    success:  function (response) {
                     
                     
                      articulosDisponibles= (response['total']['stock'] - response['asignados'])
                      
                      $(".cajaCantidad").css("display","flex");   
                      $(".disponibles").text(articulosDisponibles)
                      $('.btnGuardarAsig').removeAttr('disabled');   
                    }
                  });

              }else{
                   $(".cajaCantidad").css("display","none");  
              }

                        
          })

       

    function registrarDotacion(){
      /*=============================================
      VALIDAR CAMPO EMPLEADO
      =============================================*/

      var producto = $("#producto").val();

      if(producto == ""){
        $("#producto").before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>')
        return false;
      }
      /*=============================================
      VALIDAR CAMPO EMPLEADO
      =============================================*/
      var cantidad = $("#cantidad").val();

      if(cantidad <= 0){
        $("#cantidad").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> La cantidad tiene que ser mayor a cero</div>')
        return false;
      }
      if(articulosDisponibles > 0){
         if (cantidad <= articulosDisponibles) {
           
         }else{
          $("#cantidad").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong>La cantidad es mayor a la disponible</div>')
          return false;
         }
      }else{
        $("#cantidad").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong>Este producto no tiene unidades en bodega para asignar</div>')
        return false;
      }

      /*=============================================
      VALIDAR DETALLES
      =============================================*/

      var detalles = $("#observacion").val();

   
      var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;

      if(!expresion.test(detalles)){

        $("#observacion").before('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten números ni caracteres especiales</div>')

        return false;

      }

      


    }


    function actualizarDotacion(){
      var obser = $("#observacionEdit").val();

      if(obser == ""){
        $("#observacionEdit").before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>')
        return false;
      }
    }
   

</script>

@endsection








