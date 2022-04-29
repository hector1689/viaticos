@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
  Alimentación
</h3>
<div class="card-toolbar">
            <div class="dropdown dropdown-inline" data-toggle="" title="" data-placement="left" data-original-title="Quick actions">
                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ki ki-bold-more-ver"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="">
                    <!--begin::Navigation-->
                    <ul class="navi navi-hover py-5">

                      <li class="navi-item">
                          <a href="/catalogos/alimentacion/create" class="navi-link">
                              <span class="navi-icon"><i class="fas fa-plus"></i></span>
                              <span class="navi-text">Agregar</span>
                          </a>
                      </li>

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
      <th>Rango Inicial</th>
      <th>Rango Final</th>
      <!-- <th>Zona</th> -->
      <th>Desayuno</th>
      <th>Comida</th>
      <th>Cena</th>
      <!-- <th>Total</th> -->
      <!-- <th>Descripción Zona</th> -->
      <th>Inicio Vigencia</th>
      <th>Termina Vigencia</th>
      <th>ACCIONES</th>
    </tr>
    </thead>
   <tbody>
   </tbody>
</table>
</div>
</div>

<script type="text/javascript">
var tabla;
$(function() {
tabla = $('#kt_datatable').DataTable({
  processing: true,
  serverSide: true,
  order: [[0, 'desc']],
  ajax: {
    url: "/catalogos/alimentacion/tabla",
  },
  columns: [
    { data: 'rango_inicia', name : 'rango_inicia'},
    { data: 'rango_final', name : 'rango_final'},
    { data: 'importe_desayuno', name : 'importe_desayuno'},
    { data: 'importe_comida', name : 'importe_comida'},
    { data: 'importe_cena', name : 'importe_cena'},
    { data: 'vigencia_inicia', name : 'vigencia_inicia'},
    { data: 'vigencia_final', name : 'vigencia_final'},
    { data: 'acciones', name: 'acciones', searchable: false, orderable:false, width: '60px', class: 'acciones' }
  ],
  createdRow: function ( row, data, index ) {
    $(row).find('.ui.dropdown.acciones').dropdown();
  },
  language: { url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
});
});
function eliminar(id){
//console.log(id);
Swal.fire({
      title: "¿Esta seguro de eliminar el registro?",
      text: "No se podrá recuperar la información",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Aceptar",
      cancelButtonText: "Cancelar"
  }).then(function(result) {
      if (result.value) {

        $.ajax({

           type:"Delete",

           url:"/catalogos/alimentacion/borrar",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{
              id:id,
           },

            success:function(data){
              Swal.fire("", data.success, "success").then(function(){ tabla.ajax.reload(); });

            }


        });


      }
  })
}

</script>
@endsection
