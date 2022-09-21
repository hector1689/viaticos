@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
  Recibo de Viáticos
</h3>
<div class="card-toolbar">
            <div class="dropdown dropdown-inline" data-toggle="" title="" data-placement="left" data-original-title="Quick actions">
                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ki ki-bold-more-ver"></i>
                </a>
                @can('crear recibo')
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="">
                    <!--begin::Navigation-->
                    <ul class="navi navi-hover py-5">

                      <li class="navi-item">
                          <a href="/recibos/create" class="navi-link">
                              <span class="navi-icon"><i class="fas fa-plus"></i></span>
                              <span class="navi-text">Nuevo Recibo</span>
                          </a>
                      </li>

                    </ul>
                    <!--end::Navigation-->
                </div>
                @endcan
            </div>
        </div>
</div>
<div class="card-body">
<table class="table table-bordered table-checkable" id="kt_datatable">
  <thead>
    <tr>
      <th>Folio</th>
      <th>Dependencia</th>
      <th>Comisionado</th>
      <th>N° de Empleado</th>
      <th>Fecha Creación</th>
      <!-- <th>Fecha Fin</th> -->
      <th>Monto Total</th>
      <th>Estatus</th>
      <th>ACCIONES</th>
    </tr>
    </thead>
   <tbody>

   </tbody>
</table>
</div>
</div>



<!--MODAL BAJA-->

<div class="modal fade" id="baja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancelar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                    <label for="inputPassword4" style="font-size:12px;" class="form-label">Estatus: </label>
                    <input type="text" value="Cancelar" disabled class="form-control">
                </div>
                <div class="col-md-12">
                  <input type="hidden" id="id_baja">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Motivo: </label>
                  <textarea name="motivo_cancelar" rows="8" cols="80" class="form-control"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary font-weight-bold" onclick="GuardarCancelar()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!--MODAL BAJA-->


<!--MODAL REUBICAR BIEN -->

<div class="modal fade" id="finiquitar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Finiquitar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                    <label for="inputPassword4" style="font-size:12px;" class="form-label">Estatus: </label>
                    <input type="text" value="Finiquitar" disabled class="form-control">
                </div>
                <div class="col-md-12">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Motivo: </label>
                  <input type="hidden" id="id_finiquitar">
                  <textarea name="motivo_finiquitar" rows="8" cols="80" class="form-control"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary font-weight-bold" onclick="Guardarfiniquitar()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!--MODAL REUBICAR BIEN -->


<!--MODAL REUBICAR BIEN -->

<div class="modal fade" id="finiquitarP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Finiquitar Provicional</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                    <label for="inputPassword4" style="font-size:12px;" class="form-label">Estatus: </label>
                    <input type="text" value="Finiquitar Provicional" disabled class="form-control">
                </div>
                <div class="col-md-12">
                  <label for="inputPassword4" style="font-size:12px;" class="form-label">Motivo: </label>
                  <input type="hidden" id="id_finiquitarP">
                  <textarea name="motivo_finiquitar_provicional" rows="8" cols="80" class="form-control"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary font-weight-bold" onclick="GuardarfiniquitarP()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!--MODAL REUBICAR BIEN -->

<!--MODAL TURNAR -->

<div class="modal fade" id="turnarorg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Turnar Organo de Control</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                    <label for="inputPassword4" style="font-size:12px;" class="form-label">turnar: </label>
                    <input type="hidden" name="id_turnar" id="id_turnar" >
                    <select class="form form-control" name="">
                      <option value="0">seleccionar</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary font-weight-bold" onclick="turnar()">Guardar</button>
            </div>
        </div>
    </div>
  </div>
</div>

<!--MODAL TURNAR -->


<script type="text/javascript">
$('#finiquitar').modal('hide');
$('#finiquitarP').modal('hide');
$('#baja').modal('hide');
$('#turnarorg').modal('hide');

function baja(id){
  $('#baja').modal('show');
  $('#id_baja').val(id);
}
function finiquitar(id){
  $('#finiquitar').modal('show');
  $('#id_finiquitar').val(id);
}
function finiquitarP(id){
  $('#finiquitarP').modal('show');
  $('#id_finiquitarP').val(id);
}

function GuardarCancelar(){
  var id = $('#id_baja').val();
  var motivo = $('textarea[name=motivo_cancelar]').val();

  Swal.fire({
        title: "¿Esta seguro de cancelar el registro?",
        text: "No se podrá revertir",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar"
    }).then(function(result) {
        if (result.value) {
          $.ajax({
             type:"POST",
             url:"/recibos/cancelar",
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data:{
               id:id,
               motivo:motivo,
             },
              success:function(data){
                Swal.fire("", data.success, "success").then(function(){
                  tabla.ajax.reload();
                  $('#id_baja').val('');
                  $('textarea[name=motivo_cancelar]').val('');
                  $('#baja').modal('hide');
                 });
              }
          });
        }
    })
  // console.log(id,motivo)

}

function Guardarfiniquitar(){
  var id = $('#id_finiquitar').val();
  var motivo = $('textarea[name=motivo_finiquitar]').val();

  Swal.fire({
        title: "¿Esta seguro de finiquitar el registro?",
        text: "No se podrá revertir",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar"
    }).then(function(result) {
        if (result.value) {
          $.ajax({
             type:"POST",
             url:"/recibos/finiquitar",
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data:{
               id:id,
               motivo:motivo,
             },
              success:function(data){
                Swal.fire("", data.success, "success").then(function(){
                  tabla.ajax.reload();
                  $('#id_finiquitar').val('');
                  $('textarea[name=motivo_finiquitar]').val('');
                  $('#finiquitar').modal('hide');
                });
              }
          });
        }
    })
  // console.log(id,motivo)
}

function GuardarfiniquitarP(){
  var id = $('#id_finiquitarP').val();
  var motivo = $('textarea[name=motivo_finiquitar_provicional]').val();

  Swal.fire({
        title: "¿Esta seguro de finiquitar provivionalmente el registro?",
        text: "No se podrá revertir",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar"
    }).then(function(result) {
        if (result.value) {
          $.ajax({
             type:"POST",
             url:"/recibos/finiquitarP",
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data:{
               id:id,
               motivo:motivo,
             },
              success:function(data){
                Swal.fire("", data.success, "success").then(function(){
                  tabla.ajax.reload();
                  $('#id_finiquitarP').val('');
                  $('textarea[name=motivo_finiquitar_provicional]').val('');
                  $('#finiquitarP').modal('hide');
                });
              }
          });
        }
    })

}


var tabla;
$(function() {
tabla = $('#kt_datatable').DataTable({
  processing: true,
  serverSide: true,
  order: [[0, 'DESC']],
  ajax: {
    url: "/recibos/tabla",
  },
  columns: [
    { data: 'folio', name : 'folio'},
    { data: 'dependencia', name : 'dependencia'},
    { data: 'nombre', name : 'nombre'},
    { data: 'num_empleado', name : 'num_empleado'},
    { data: 'created_at', name : 'created_at'},
    // { data: 'fecha_hora_recibio', name : 'fecha_hora_recibio'},
    { data: 'num_dias', name : 'num_dias'},
    { data: 'cve_estatus', name : 'cve_estatus'},
    { data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
  ],
  createdRow: function ( row, data, index ) {
    $(row).find('.ui.dropdown.acciones').dropdown();
  },
  language: { url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
});
});
function turnar(id){

  Swal.fire({
        title: "¿Esta seguro de Turnar el registro?",
        text: "No se podrá revertir",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar"
    }).then(function(result) {
        if (result.value) {
          $.ajax({
             type:"POST",
             url:"/recibos/Turnar",
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data:{
               id:id,
             },
              success:function(data){
                Swal.fire("", data.success, "success").then(function(){
                  tabla.ajax.reload();
                });
              }
          });
        }
    })


}

function eliminar(id){

  Swal.fire({
        title: "¿Esta seguro de Eliminar el registro?",
        text: "No se podrá revertir",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar"
    }).then(function(result) {
        if (result.value) {
          $.ajax({
             type:"POST",
             url:"/recibos/borrar",
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data:{
               id:id,
             },
              success:function(data){
                Swal.fire("", data.success, "success").then(function(){
                  tabla.ajax.reload();
                });
              }
          });
        }
    })


}

function autorizar(id){
  Swal.fire({
        title: "¿Esta seguro de Autorizar el registro?",
        text: "No se podrá revertir",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar"
    }).then(function(result) {
        if (result.value) {
          $.ajax({
             type:"POST",
             url:"/recibos/autorizar",
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data:{
               id:id,
             },
              success:function(data){
                Swal.fire("", data.success, "success").then(function(){
                  tabla.ajax.reload();
                });
              }
          });
        }
    })
}

</script>
@endsection
