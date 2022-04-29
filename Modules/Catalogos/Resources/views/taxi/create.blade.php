@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   @isset($taxi)Editar @else Nuevo @endisset Taxi
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
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Descripción: </label>
              <input type="text" class="form-control" id="descripcion" value="@isset($taxi) {{ $taxi->descripcion }} @endisset" placeholder="Descripción" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Tarifa por Evento: </label>
              <input type="text" class="form-control" id="tarifa_evento" value="@isset($taxi) {{ $taxi->tarifa_evento }} @endisset" placeholder="Tarifa por Evento" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Tarifa por Dia Adicional: </label>
              <input type="text" class="form-control" id="tarifa_adicional" value="@isset($taxi) {{ $taxi->tarifa_adicional }} @endisset" placeholder="Tarifa por Dia Adicional" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Vigencia Inicia: </label>
              @isset($taxi)
              <?php

              list($dia,$mes,$anio) = explode('-',$taxi->vigencia_inicial);
              $fecha = $anio.'/'.$mes.'/'.$dia;


               ?>
               @endisset
              <input type="text" class="form-control" name="vigencia_inicial" id="kt_datepicker" value="@isset($taxi){{ $fecha }} @endisset" placeholder="Vigencia Inicia" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Vigencia Termina: </label>
              @isset($taxi)
              <?php

              list($dia,$mes,$anio) = explode('-',$taxi->vigencia_final);
              $fecha2 = $anio.'/'.$mes.'/'.$dia;


               ?>
               @endisset
              <input type="text" class="form-control" name="vigencia_final" id="kt_datepicker2" value="@isset($taxi){{ $fecha2 }} @endisset" placeholder="Vigencia Termina" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
        </div>





</div>
<div class="card-footer">

  <a href="/catalogos/taxi" class="btn btn-default">Regresar</a>

  <a class="btn btn-primary " onclick="guardar()">Guardar</a>
</div>
</form>
</div>

<script src="/admin/assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js?v=7.0.6"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<script type="text/javascript">
$(function () {
  var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes();
    var dateTime = date+' '+time;

    $("#kt_datepicker").datepicker({
        language: 'es',
        format: 'dd/mm/yyyy',
    });

    $("#kt_datepicker2").datepicker({
        language: 'es',
        // startDate: dateTime,
        format: 'dd/mm/yyyy',
    });
});

function guardar(){

  var descripcion = $('#descripcion').val();
  var tarifa_evento = $('#tarifa_evento').val();
  var tarifa_adicional = $('#tarifa_adicional').val();

  var vigencia_inicial = $('input[name=vigencia_inicial]').val();
  var vigencia_final = $('input[name=vigencia_final]').val();

    var formData = new FormData();
     //formData.append('photo', $avatarInput[0].files[0]);

    @isset($taxi)
    formData.append('id',{{ $taxi->id }});
    @endisset
    formData.append('descripcion', descripcion);
    formData.append('tarifa_evento', tarifa_evento);
    formData.append('tarifa_adicional', tarifa_adicional);
    formData.append('vigencia_inicial', vigencia_inicial);
    formData.append('vigencia_final', vigencia_final);

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

                   url:"{{ ( isset($taxi) ) ? '/catalogos/taxi/update' : '/catalogos/taxi/create' }}", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
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
                          location.href ="/catalogos/taxi";
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
                                location.href ="/catalogos/taxi"; //esta es la ruta del modulo
                              }
                          })

                      }else if(data.success == 'Ha sido editado con éxito'){

                        Swal.fire("", data.success, "success").then(function(){
                          location.href ="/catalogos/taxi";
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
                                location.href ="/catalogos/taxi";
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
