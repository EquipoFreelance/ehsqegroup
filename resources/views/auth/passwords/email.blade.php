@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="">
  <a class="hiddenanchor" id="toregister"></a>
  <a class="hiddenanchor" id="tologin"></a>
  <div id="wrapper">
    <div id="register" class="animate form">
      <section class="login_content">
        <form id="form_reset" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ url('/password/email') }}#toregister">
          {!! csrf_field() !!}
          <h2><img src="{{ URL::asset('assets/images/logos/cabe.png')}}"></h2>
          <div class="form-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
            <input type="email" class="form-control customemail" placeholder="Correo electrónico" aria-describedby="basic-addon1" name="email" value=" {{ old('email') }}"/>
            @if ($errors->has('email'))
            <label for="email" generated="true" class="error">{{ $errors->first('email') }}</label>
            @endif
          </div>
          <button class="btn btn-primary col-md-12" type="submit">Recuperar</button>
          <p class="change_link"><a href="{{ url('/login') }}#tologin" class="to_register link_action">Inciar sesión</a></p>
        </form>
        <!-- form -->
      </section>
      <!-- content -->

      @if (session('status'))
      <div id="alerta" class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>{{ session('status') }}</strong>
      </div>
      @endif

    </div>
  </div>
</div>


@endsection
