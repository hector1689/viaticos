@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
  Usuarios
</h3>
<div class="card-toolbar">
            <div class="dropdown dropdown-inline" data-toggle="" title="" data-placement="left" data-original-title="Quick actions">
                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ki ki-bold-more-ver"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="">
                    <!--begin::Navigation-->
                    <ul class="navi navi-hover py-5">
                      @can('create usuario')
                      <li class="navi-item">
                          <a href="/usuarios/create" class="navi-link">
                              <span class="navi-icon"><i class="far fa-user"></i></span>
                              <span class="navi-text">Nuevo Usuario</span>
                          </a>
                      </li>
                      @else

                      @endcan
                    </ul>
                    <!--end::Navigation-->
                </div>
            </div>
        </div>
</div>
<div class="card-body">
<table class="table table-bordered table-checkable" id="kt_datatable">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Apellido Paterno</th>
      <th>Apellido Materno</th>
      <th>Rol</th>
      <th>Usuario</th>
      <th>Correo</th>
      <th>Acciones</th>
    </tr>
    </thead>
   <tbody></tbody>
</table>
</div>
</div>

<div class="modal fade" id="asociar_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asociar Dependencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id_usuario_asociar" id="id_usuario_asociar" >
              <div class="row">
                <div class="col-md-12">
                  <select class="form form-control dependencia" name="dependencia" >
                    <option value="0">Seleccionar</option>
                    @foreach($areas as $area)
                    <option value="{{$area->id}}">{{$area->nombre}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary font-weight-bold" onclick="guardar()">Guardar</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('#asociar_modal').modal('hide');

    $('.dependencia').select2({
            width: '100%',
        });

    function guardar(){
      var id = $('#id_usuario_asociar').val();
      var dependencia = $('select[name=dependencia]').val();

      $.ajax({

         type:"POST",

         url:"/usuarios/asociarusuario",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
           id:id,
           dependencia:dependencia,
         },

          success:function(data){
            Swal.fire("Excelente!", data.success, "success").then(function(){ tabla.ajax.reload(); $('#asociar_modal').modal('hide'); $('select[name=dependencia]').prop('selectedIndex',0); });

          }


      });

    }
    var tabla;
    $(function() {
    tabla = $('#kt_datatable').DataTable({
      processing: true,
      serverSide: true,
      order: [[3, 'asc']],
      ajax: {
        url: "/usuarios/tablausuarios",
      },
      columns: [
        { data: 'nombre', name : 'nombre'},
        { data: 'apellido_paterno', name : 'apellido_paterno'},
        { data: 'apellido_materno', name : 'apellido_materno'},
        { data: 'tipo_usuario', name : 'tipo_usuario'},

        { data: 'name', name: 'name' },

        { data: 'email', name: 'email' },
        { data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
      ],
      createdRow: function ( row, data, index ) {
        $(row).find('.ui.dropdown.acciones').dropdown();
      },
      language: { url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
    });
    });

    function as(id) {

    Swal.fire({
          title: "¿Estas seguro?",
          text: "Cambiaras de Usuario!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, Cambiar!"
      }).then(function(result) {
          if (result.value) {

            $.ajax({

               type:"POST",

               url:"/usuarios/as",
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data:{
                 id:id,
               },

                success:function(data){

                  Swal.fire("Excelente!", data.success, "success").then(function(){ location.href ="/dashboard"; });

                }


            });


          }
      })


  }

    function eliminar(id){
//console.log(id);
    var id_user = id;
    Swal.fire({
          title: "¿Estas seguro?",
          text: "No podrás revertir esto!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, bórralo!"
      }).then(function(result) {
          if (result.value) {

            $.ajax({

               type:"Delete",

               url:"/usuarios/borrar",
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data:{
              id_user:id_user,
               },

                success:function(data){
                  Swal.fire("Excelente!", data.success, "success").then(function(){ tabla.ajax.reload(); });

                }


            });


          }
      })
    }

  function asociar(id){
    // console.log(id);
    $('#id_usuario_asociar').val(id);
    $('#asociar_modal').modal('show');
    }


</script>
@endsection
