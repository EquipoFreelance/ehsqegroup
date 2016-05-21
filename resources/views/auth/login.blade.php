@extends('layouts.app')

@section('content')
<div class="">
  <a class="hiddenanchor" id="toreset"></a>
  <a class="hiddenanchor" id="tologin"></a>
  <div id="wrapper">
    <div id="login" class="animate form">
      <section class="login_content">

        <!-- Formulario de Inicio de Sesión  -->
        <form id="form_login" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ url('/login') }}#toregister">
          {!! csrf_field() !!}
          <h2><img src="{{ URL::asset('assets/images/logos/cabe.png')}}"></h2>
          <div class="form-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
            <input type="email" class="form-control customemail @if ($errors->has('email')) error @endif" placeholder="Correo electrónico" aria-describedby="basic-addon1" name="email" value="{{ old('email') }}"/>
            @if ($errors->has('email'))
            <label for="email" generated="true" class="error">{{ $errors->first('email') }}</label>
            @endif
          </div>
          <div class="form-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-key"></i></span>
            <input type="password" class="form-control @if ($errors->has('password')) error @endif" placeholder="Contraseña" aria-describedby="basic-addon1" name="password"/>
            @if ($errors->has('password'))
            <label for="password" generated="true" class="error">{{ $errors->first('password') }}</label>
            @endif
          </div>
          <button class="btn btn-primary col-md-12" type="submit">Ingresar</button>
          <p class="change_link"><a href="{{ url('/password/reset') }}#toregister" class="to_register link_action">¿Se te olvidó tu contraseña?</a></p>
        </form>
        <!-- / Formulario de Inicio de Sesión  -->

      </section>
      <!-- content -->
    </div>

  </div>
</div>

@endsection
