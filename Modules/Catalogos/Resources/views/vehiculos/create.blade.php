@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   @isset($vehiculos) Editar @else Nuevo @endisset Vehiculo
</h3>
<div class="card-toolbar">
<div class="example-tools justify-content-center">

</div>
</div>
</div>
<form class=" needs-validation" novalidate>
<div class="card-body">


        <div class="row">
          <div class="col-md-4">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">N° Oficial: </label>
              <input type="text" class="form-control" id="num_oficial" onchange="verificarNumero()" value="@isset($vehiculos) {{ $vehiculos->num_oficial }} @endisset" onkeypress='return validaNumericos(event)' placeholder="N° Oficial" required>
              <div class="invalid-feedback">
                Por Favor Ingrese N° Oficial
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Marca: </label>
              <input type="text" class="form-control" id="marca"  value="@isset($vehiculos) {{ $vehiculos->marca }} @endisset" placeholder="Marca" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Marca
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Modelo: </label>
              <input type="text" class="form-control" id="modelo"  value="@isset($vehiculos) {{ $vehiculos->modelo }} @endisset" placeholder="Modelo" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Modelo
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Tipo: </label>
              <input type="text" class="form-control" id="tipo"  value="@isset($vehiculos) {{ $vehiculos->tipo }} @endisset" placeholder="Tipo" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Tipo
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Placas: </label>
              <input type="text" class="form-control" id="placas"  value="@isset($vehiculos) {{ $vehiculos->placas }} @endisset" placeholder="Placas" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Placas
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Cilindraje: </label>
              <input type="text" class="form-control" id="cilindraje"  value="@isset($vehiculos) {{ $vehiculos->cilindraje }} @endisset" placeholder="Cilindraje" onkeypress='return validaNumericos(event)' required>
              <div class="invalid-feedback">
                Por Favor Ingrese Cilindraje
              </div>
          </div>
        </div>



</div>
<div class="card-footer">

  <a href="/catalogos/vehiculos" class="btn btn-default">Regresar</a>

  <a class="btn btn-primary " onclick="guardar()">Guardar</a>
</div>
</form>
</div>
<script type="text/javascript">
$(function () {

    $("#kt_datepicker").datepicker({
        language: 'es',
        format: 'dd/mm/yyyy',
    });

});

function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;
}

function verificarNumero(){
  var numero = $('#num_oficial').val();
  $.ajax({
         type:"POST",
         url:"/catalogos/vehiculos/ExisteVehiculo",
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data:{
             numero:numero,
           },
          success:function(data){
            //console.log(data)

            if(data == ''){

            }else{
              Swal.fire("Lo Sentimos", 'Ya Existe N° Oficial', "warning").then(function(){
                $('#num_oficial').val('');
              });
            }
          }
    });
}

function guardar(){
  var num_oficial = $('#num_oficial').val();
  var marca = $('#marca').val();
  var modelo = $('#modelo').val();
  var tipo = $('#tipo').val();
  var placas = $('#placas').val();
  var cilindraje = $('#cilindraje').val();


    var formData = new FormData();
     //formData.append('photo', $avatarInput[0].files[0]);

    @isset($vehiculos)
    formData.append('id',{{ $vehiculos->id }});
    @endisset
    formData.append('num_oficial', num_oficial);
    formData.append('marca', marca);
    formData.append('modelo', modelo);
    formData.append('tipo', tipo);
    formData.append('placas', placas);
    formData.append('cilindraje', cilindraje);

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var form = document.querySelectorAll('.needs-validation')
    //console.log(form)
    // Loop over them and prevent submission
    Array.prototype.slice.call(form)
      .forEach(function (form) {
        form.addEventListener('click', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }else{
            ///////////////////////////////////////////////////////7
            $.ajax({

                   type:"POST", //si existe esta variable usuarios se va mandar put sino se manda post

                   url:"{{ ( isset($vehiculos) ) ? '/catalogos/vehiculos/update' : '/catalogos/vehiculos/create' }}", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
                   headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//esto siempre debe ir en los ajax
                   },
                   data: formData,
                   processData: false,
                   contentType: false,
                   cache:false,
                    success:function(data){
                      if (data.success == 'Registro agregado satisfactoriamente') {
                        Swal.fire("", data.success, "success").then(function(){
                          location.href ="/catalogos/vehiculos";
                        });

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
                                location.href ="/catalogos/vehiculos"; //esta es la ruta del modulo
                              }
                          })

                      }else if(data.success == 'Ha sido editado con éxito'){

                        Swal.fire("", data.success, "success").then(function(){
                          location.href ="/catalogos/vehiculos";
                        });

                        Swal.fire({
                              title: "",
                              text: data.success,
                              icon: "success",
                              timer: 1500,
                              showConfirmButton: false,
                          }).then(function(result) {

                              if (result.value == true) {

                              }else{
                                location.href ="/catalogos/vehiculos";
                              }
                          })
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
