@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
   @isset($programas) Editar @else Nuevo @endisset Programa
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
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Nombre: </label>
              <input type="text" class="form-control" id="nombre"  value="@isset($programas) {{ $programas->nombre }} @endisset" placeholder="Nombre" required>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
        </div>



</div>
<div class="card-footer">

  <a href="/catalogos/programa" class="btn btn-default">Regresar</a>

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


function guardar(){
  var nombre = $('#nombre').val();


    var formData = new FormData();
     //formData.append('photo', $avatarInput[0].files[0]);

    @isset($programas)
    formData.append('id',{{ $programas->id }});
    @endisset
    formData.append('nombre', nombre);

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

                   url:"{{ ( isset($programas) ) ? '/catalogos/programa/update' : '/catalogos/programa/create' }}", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
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
                          location.href ="/catalogos/programa";
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
                                location.href ="/catalogos/programa"; //esta es la ruta del modulo
                              }
                          })

                      }else if(data.success == 'Ha sido editado con éxito'){

                        Swal.fire("", data.success, "success").then(function(){
                          location.href ="/catalogos/programa";
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
                                location.href ="/catalogos/programa";
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
