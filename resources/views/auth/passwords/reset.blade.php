@extends('layouts.app')

@section('content')
<div class="">
  <a class="hiddenanchor" id="toregisterx"></a>
  <a class="hiddenanchor" id="tologinx"></a>
  <div id="wrapper">
    <div id="registerx" class="animate form">
      <section class="login_content">
        <form id="form_reset" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ url('/password/reset') }}">
          {!! csrf_field() !!}
          <input type="hidden" name="token" value="{{ $token }}">
          <h2><img src="{{ URL::asset('assets/images/logos/cabe.png')}}"></h2>
          <div class="form-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
            <input type="email" class="form-control customemail @if ($errors->has('email')) error @endif " placeholder="Contraseña" aria-describedby="basic-addon1" name="email" value="{{ $email or old('email') }}"/>
            @if ($errors->has('email'))
              <label for="email" generated="true" class="error">{{ $errors->first('email') }}</label>
            @endif
          </div>

          <div class="form-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-key"></i></span>
            <input type="password" class="form-control @if ($errors->has('password')) error @endif" placeholder="Contraseña" name="password"/>
            @if ($errors->has('password'))
              <label for="password" generated="true" class="error">{{ $errors->first('password') }}</label>
            @endif
          </div>

          <div class="form-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-key"></i></span>
            <input type="password" class="form-control @if ($errors->has('password_confirmation')) error @endif" placeholder="Confirmar tu contraseña" name="password_confirmation"/>
            @if ($errors->has('password_confirmation'))
              <label for="password_confirmation" generated="true" class="error">{{ $errors->first('password_confirmation') }}</label>
            @endif
          </div>

          <button class="btn btn-primary col-md-12" type="submit">Restablecer</button>

        </form>
        <!-- form -->
      </section>
      <!-- content -->

    </div>
  </div>
</div>

@endsection
