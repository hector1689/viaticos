@extends('layouts.inicio')

@section('content')
<style media="screen">
.card-title.collapsed {
  font-size: 10pt !important;
  padding: 10px 15px !important;
}
div#collapseusuarios .col-lg-6 {
  margin: 3px 0px;
}
.checkbox-list .checkbox {
  margin-bottom: 5px !important;
}
.card-body .form-group {
  margin: 0;
}
.todosNinguno{
  margin-bottom: 10px !important;
}
.todos, .ninguno{
  margin-left: 15px;
}
</style>
<div class="card card-custom">
  <div class="card-header">
    <div class="card-title">
      <span class="card-icon"><i class="flaticon-users-1 text-primary"></i></span>
        <h3 class="card-label">@isset($permisos) Editar Permiso @else Nuevo Permiso @endif</h3>
    </div>
  </div>
  <form class=" needs-validation" novalidate>
  <div class="card-body">

      <div class="card-body" style="padding-top: 0; padding-bottom: 20px;">
        <div class="form-group row">
          <div class="col-lg-6">
            <label>Nombre:</label>
              <input type="text" name="nombre" id="name" onchange="verificarPermiso()" class="form-control" placeholder="Escribe nombre del permiso" value="@isset($permisos) {{ $permisos->name }} @endisset" required/>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre del permiso
              </div>
          </div>
          <div class="col-lg-6">
            <label>Nombre del Modulo:</label>
              <input type="text" name="modulo" id="modulo" class="form-control" placeholder="Escribe el nombre del modulo" value="@isset($permisos) {{ $permisos->modulo }} @endisset" required/>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre del modulo
              </div>
          </div>

        </div>



      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-lg-6">
            <a href="/usuarios/permisos" class="btn btn-secondary">
              <i class="flaticon2-back"></i> Cancelar
            </a>
          </div>
          <div class="col-lg-6 text-right">
            <a class="btn btn-primary mr-2" onclick="agregarPermisos()">
              <i class="flaticon2-user"></i>
              Guardar
            </a>
          </div>
        </div>
      </div>
    <!-- </form> -->
  </div>
  </form>
</div>
<script>

function verificarPermiso(){
  var name = $('#name').val();
  $.ajax({

 type:"POST",
   url:"/usuarios/permisos/virificarpermiso",
 headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 },
 data:{
  name : name,
 },

  success:function(data){
    //console.log(data);

    if (data == '') {

    }else{
      Swal.fire("Lo Sentimos", "Este permiso ya fue creado", "warning").then(function() { $('#name').val(''); });
    }
  }
});
}


function agregarPermisos(){

  var name = $('#name').val();
var modulo = $('#modulo').val();
@isset($permisos)
var id = {{$permisos->id}};
@else
var id = 0;
@endisset


var form = document.querySelectorAll('.needs-validation')
Array.prototype.slice.call(form)
  .forEach(function (form) {
    form.addEventListener('click', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }else{
        ///////////////////////////////////////////////////////7
        $.ajax({

               type:"POST",

               url:"{{ ( isset($permisos) ) ? '/usuarios/permisos/update': '/usuarios/permisos/create' }}", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//esto siempre debe ir en los ajax
               },
               data:{
                 id: id,
                 name: name,
                 modulo:modulo,

               },
                success:function(data){
                  if (data.success == 'Se Agrego Satisfactoriamente') {
                    Swal.fire({
                              title: "",
                              text: data.success,
                              icon: "success",
                              timer: 1500,
                              showConfirmButton: false,
                          }).then(function(result) {
                              if (result.value == true) {
                                   $('#nombre').val('');

                              }else{
                                location.href ="/usuarios/permisos"; //esta es la ruta del modulo
                              }
                          })

                  }else if(data.success == 'Ha sido editado con éxito'){
                    Swal.fire({
                              title: "",
                              text: data.success,
                              icon: "success",
                              timer: 1500,
                              showConfirmButton: false,
                          }).then(function(result) {
                              if (result.value == true) {
                                   $('#nombre').val('');

                              }else{
                                location.href ="/usuarios/permisos"; //esta es la ruta del modulo
                              }
                          })
                  }else{

                  }



                }
          });

        /////////////////////////////////////////////////////////
      }

      form.classList.add('was-validated')
    }, false)
  });




}
</script>
@endsection
