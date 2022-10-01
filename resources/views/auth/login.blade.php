@extends('layouts.login')
@section('content')
<div class="d-flex flex-column flex-root">
  <!--begin::Login-->
<div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
<div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('/admin/assets/media/bg/bg-3.jpg');">
  <div class="login-form text-center p-7 position-relative overflow-hidden">
    <!--begin::Login Header-->
    <div class="d-flex flex-center mb-15">
      <a href="#">
        <img src="/admin/assets/media/bg/escudo2.png"  width="300" height="100" alt=""/>
      </a>
    </div>
    <!--end::Login Header-->

    <!--begin::Login Sign in form-->
    <div class="login-signin">
      <div class="mb-20">
        <h3>Iniciar sesión para administrar</h3>
        <div class="text-muted font-weight-bold">Ingrese sus datos para iniciar sesión en su cuenta:</div>
      </div>
      <form class="form text-left"  method="POST" action="{{ route('login') }}">
            @csrf
        <div class="form-group py-2 m-0">
          <input class="form-control h-auto border-0 px-0 placeholder-dark-75"type="email"  id="email" placeholder="Email" name="email" :value="old('email')" required autofocus  autocomplete="off" />
        </div>
        <div class="form-group py-2 border-top m-0">
          <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Password" id="password" placeholder="Password"  name="password" required autocomplete="current-password" autocomplete="off" />
        </div>

        <div class="text-center mt-15">
          <button id="kt_login_signin_submit" class="btn btn-primary btn-pill shadow-sm py-4 px-9 font-weight-bold">Iniciar Sesión</button>
        </div>
      </form>
      <div class="mt-10">

      </div>
    </div>

  </div>
</div>
</div>
<!--end::Login-->
</div>
<!--end::Main-->
@endsection
