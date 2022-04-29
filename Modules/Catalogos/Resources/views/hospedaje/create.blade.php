@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   @isset($hospedaje)Editar @else Nuevo @endisset Hospedaje
</h3>
<div class="card-toolbar">
<div class="example-tools justify-content-center">

</div>
</div>
</div>
<form class=" needs-validation" novalidate>
<div class="card-body">

        <span>Rango de nivel del Servidor Público</span>
        <div class="row">
          <div class="col-md-6">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Inicial: </label>
              <input type="text" class="form-control" id="rango_inicia" value="@isset($hospedaje) {{ $hospedaje->rango_inicial }} @endisset" placeholder="Inicial" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Inicial
              </div>
          </div>
          <div class="col-md-6">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Final: </label>
              <input type="text" class="form-control" id="rango_final" value="@isset($hospedaje) {{ $hospedaje->rango_final }} @endisset" placeholder="Final" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Final
              </div>
          </div>
        </div>
        <span>Importes por zona</span>
        <div class="row">
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Zona: </label>
              <select class="form-control" id="zona">
                @isset($hospedaje)
                <option value="{{ $hospedaje->id }}">{{ $hospedaje->obtenerZona->nombre }}</option>
                @else
                <option value="">Selecciona</option>
                @endisset
                @foreach($zonas as $zona)
                <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Importe: </label>
              <input type="text" class="form-control" id="importe" placeholder="Importe" value="@isset($hospedaje) {{ $hospedaje->importe }} @endisset" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Materno
              </div>
          </div>
        </div>
        <span>Vigencia</span>
        <div class="row">

          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha Inicia: </label>
              @isset($hospedaje)
              <?php

              list($dia,$mes,$anio) = explode('-',$hospedaje->vigencia_inicial);
              $fecha = $anio.'/'.$mes.'/'.$dia;


               ?>
               @endisset
              <input type="text" name="inicia" class="form-control" id="kt_datepicker" value="@isset($hospedaje){{ $fecha }} @endisset" placeholder="Fecha Inicia" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Fecha Inicia
              </div>
          </div>

          <div class="col-md-4">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Fecha Fin: </label>
              @isset($hospedaje)
              <?php

              list($dia,$mes,$anio) = explode('-',$hospedaje->vigencia_final);
              $fecha2 = $anio.'/'.$mes.'/'.$dia;


               ?>
               @endisset
              <input type="text" name="final" class="form-control" id="kt_datepicker2" value="@isset($hospedaje){{ $fecha2 }} @endisset" placeholder="Fecha Fin" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Fecha Fin
              </div>
          </div>
        </div>



</div>
<div class="card-footer">

  <a href="/catalogos/hospedaje" class="btn btn-default">Regresar</a>

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

  var rango_inicia = $('#rango_inicia').val();
  var rango_final = $('#rango_final').val();
  var zona = $('#zona').val();
  var importe = $('#importe').val();
  var inicia = $('input[name=inicia]').val();
  var final = $('input[name=final]').val();

    var formData = new FormData();
     //formData.append('photo', $avatarInput[0].files[0]);

    @isset($hospedaje)
    formData.append('id',{{ $hospedaje->id }});
    @endisset
    formData.append('rango_inicia', rango_inicia);
    formData.append('rango_final', rango_final);
    formData.append('zona', zona);
    formData.append('importe', importe);
    formData.append('inicia', inicia);
    formData.append('final', final);

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

                   url:"{{ ( isset($hospedaje) ) ? '/catalogos/hospedaje/update' : '/catalogos/hospedaje/create' }}", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
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
                          location.href ="/catalogos/hospedaje";
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
                                location.href ="/catalogos/hospedaje"; //esta es la ruta del modulo
                              }
                          })

                      }else if(data.success == 'Ha sido editado con éxito'){

                        Swal.fire("", data.success, "success").then(function(){
                          location.href ="/catalogos/hospedaje";
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
                                location.href ="/catalogos/hospedaje";
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
