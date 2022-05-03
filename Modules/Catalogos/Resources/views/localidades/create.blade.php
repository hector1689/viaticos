@extends('layouts.inicio')

@section('content')
<div class="card card-custom example example-compact">
<div class="card-header">
<h3 class="card-title">
  @isset($localidad) Editar @else Nueva @endisset Localidad
</h3>
<div class="card-toolbar">
<div class="example-tools justify-content-center">

</div>
</div>
</div>
<form class=" needs-validation" novalidate>
<div class="card-body">


        <div class="row">
          <div class="col-md-3">
              <label for="inputPassword4"  style="font-size:12px;"class="form-label">Pais: </label>
              <select class="form-control " id="pais" data-nivel="1" name="pais" required>
                @isset($localidad)
                <option value="{{ $localidad->cve_pais }}">{{ $localidad->obtenePais->nombre }}</option>
                @else
                <option value="">seleccionar</option>
                @endisset

                @foreach($paises as $pais)
                <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Nombre
              </div>
          </div>
          <div class="col-md-3">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Estado: </label>
              <select class="form-control" id="estado"  data-nivel="2" name="estado" required>
                @isset($localidad)
                @else
                <option value="">seleccionar</option>
                @endisset
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>

          <div class="col-md-3">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Municipio: </label>
              <select class="form-control" id="municipio" data-nivel="3" name="municipio" required>
                @isset($localidad)
                @else
                <option value="">seleccionar</option>
                @endisset
              </select>
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>

          <div class="col-md-3">
              <label for="inputPassword4" style="font-size:12px;" class="form-label">Localidad: </label>
              <input type="text" class="form-control" id="localidad" value="@isset($localidad) {{ $localidad->localidad }} @endisset">
              <div class="invalid-feedback">
                Por Favor Ingrese Apellido Paterno
              </div>
          </div>
        </div>



</div>
<div class="card-footer">

  <a href="/catalogos/localidades" class="btn btn-default">Regresar</a>

  <a class="btn btn-primary " onclick="guardar()">Guardar</a>
</div>
</form>
</div>

<script type="text/javascript">
$('#pais').select2({
width: '100%',
});
$('#estado').select2({
width: '100%',
});
$('#municipio').select2({
width: '100%',
});


$("#pais").change(function(){

  var pais = $("#pais").val();

  //console.log(estado);
  //$('#municipios').prop('selectedIndex',0);
  nivel = parseInt($(this).attr('data-nivel'));
    $.ajax({

       type:"POST",

       url:"/catalogos/localidades/Estado",
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       data:{
         pais:pais,
       },

        success:function(data){
          if (data) {
            for(i = nivel + 1; i <= 3; i++){
              $('#estado').empty();

            }data.forEach((x) => {
              $('#estado').append('<option value="'+x.id+'">'+x.nombre+'</option>');

            });
          }
        }
  });

});


$("#estado").change(function(){

  var estado = $("#estado").val();

  //console.log(municipio);
  //$('#municipios').prop('selectedIndex',0);
  nivel = parseInt($(this).attr('data-nivel'));
    $.ajax({

       type:"POST",

       url:"/catalogos/localidades/Municipio",
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       data:{
         estado:estado,
       },

        success:function(data){
          if (data) {
            for(i = nivel + 1; i <= 3; i++){
              $('#municipio').empty();

            }data.forEach((x) => {
              $('#municipio').append('<option value="'+x.id+'">'+x.nombre+'</option>');
              /*$('#codigoPostal').val(x.e_Codigo);*/

            });
          }
        }
  });

});


@isset($localidad)
var estado = {{ $localidad->cve_estado }};
nivel = 1;
  $.ajax({

     type:"POST",

     url:"/catalogos/localidades/Estadoedit",
     headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     data:{
       estado:estado,
     },

      success:function(data){
        //console.log(data)
        if (data) {
          $('#estado').append('<option value="'+data.id+'">'+data.nombre+'</option>');
          // for(i = nivel + 1; i <= 3; i++){
          //   $('#municipio').empty();
          //
          // }data.forEach((x) => {
          //   $('#municipio').append('<option value="'+x.e_Id+'">'+x.c_Municipios+'</option>');
          //
          // });
        }
      }
});

var municipio = {{ $localidad->cve_municipio }};

nivel = 2;
  $.ajax({

     type:"POST",

     url:"/catalogos/localidades/Municipioedit",
     headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     data:{
       municipio:municipio,
     },

      success:function(data){
        if (data) {
          $('#municipio').append('<option value="'+data.id+'">'+data.nombre+'</option>');
          // for(i = nivel + 1; i <= 3; i++){
          //   $('#colonia').empty();
          //
          // }data.forEach((x) => {
          //
          //   /*$('#codigoPostal').val(x.e_Codigo);*/
          //
          // });
        }
      }
});

@endisset

function guardar(){




  var pais = $('select[name=pais]').val();
  var estado = $('select[name=estado]').val();
  var municipio = $('select[name=municipio]').val();
  var localidad = $('#localidad').val();

    var formData = new FormData();
     //formData.append('photo', $avatarInput[0].files[0]);

    @isset($localidad)
    formData.append('id',{{ $localidad->id }});
    @endisset
    formData.append('pais', pais);
    formData.append('estado', estado);
    formData.append('municipio', municipio);
    formData.append('localidad', localidad);

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

                   url:"{{ ( isset($localidad) ) ? '/catalogos/localidades/update' : '/catalogos/localidades/create' }}", //si existe usuarios manda la ruta de usuarios el id del usario sino va mandar usuarios crear
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
                          location.href ="/catalogos/localidades";
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
                                location.href ="/catalogos/localidades"; //esta es la ruta del modulo
                              }
                          })

                      }else if(data.success == 'Ha sido editado con éxito'){

                        Swal.fire("", data.success, "success").then(function(){
                          location.href ="/catalogos/localidad";
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
                                location.href ="/catalogos/localidades";
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
