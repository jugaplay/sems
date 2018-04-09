@extends('layouts.login')

@section('content')
<main class="signin-wrapper">
  <div class="tab-content">
    <p class="text-center p-4x">
      <img src="/images/logo/brand-text-color.png" alt="wrapkit" height="28px">
    </p>
    <div class="tab-pane fade in active" id="signin">
      <form id="signinForm"  method="POST">
        {{ csrf_field() }}
        <p class="lead">Entrá a tu cuenta</p>
        <div class="form-group">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="icon-user"></i></span>
            <input id="loginEmail" type="email" name="loginEmail" value="{{ old('loginEmail') }}" class="form-control" placeholder="Mail" required="required">
          </div>
        </div><!-- /.form-group -->
        <div class="form-group">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="icon-lock"></i></span>
            <input type="password" name="loginPassword"  id="loginPassword" class="form-control" placeholder="Contraseña" required="required">
          </div>
        </div><!-- /.form-group -->
        <div class="form-group clearfix">
          <div class="animated-hue pull-right">
            <button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Procesando" class="btn btn-primary">Ingresar</button>
          </div>
          <div class="nice-checkbox nice-checkbox-inline">
              <input type="checkbox" name="loginRemember" id="loginRemember1" checked="checked">
              <label for="loginRemember1">Recordar</label>
          </div>
        </div><!-- /.form-group -->
        <hr>
        <p><a href="#recoverAccount" data-toggle="modal">¿No recordas tu contraseña?</a></p>
        <hr>
        <p>¿No tenes una cuenta? <a href="#signup" data-toggle="tab">Crea una</a></p>
      </form><!-- /#signinForm -->
    </div><!-- /.tab-pane -->

    <div class="tab-pane fade" id="signup">
      <form id="signupForm"  role="form">
        <p class="lead">Crear una cuenta</p>
        <p class="text-muted"><strong>Ingresa tus datos</strong></p>
        <div class="form-group has-feedback">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="icon-user"></i></span>
            <input name="registerName" id="registerName" class="form-control" placeholder="Nombre y apellido" required="required">
            <span class="form-control-feedback"></span>
          </div>
        </div><!-- /.form-group -->
        <div class="form-group has-feedback">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
            <input type="emailSignUp" name="registerEmail" id="registerEmail" class="form-control" placeholder="Email" required="required">
            <span class="form-control-feedback"></span>
          </div>
        </div><!-- /.form-group -->
        <div class="form-group has-feedback">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            <input type="text" name="registerPhone" id="registerPhone" class="form-control" placeholder="Celular">
            <span class="form-control-feedback"></span>
          </div>
        </div>
        <div class="form-group has-feedback">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="icon-key"></i></span>
            <input type="password" name="registerPassword" id="passwordSignUp" class="form-control" placeholder="Contraseña" required="required">
            <span class="form-control-feedback"></span>
          </div>
        </div><!-- /.form-group -->
        <div class="form-group has-feedback">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="icon-check"></i></span>
            <input type="password" name="cpassword" id="passwordSignUpRepeat" class="form-control" placeholder="Repetir contraseña" required="required">
            <span class="form-control-feedback"></span>
          </div>
        </div><!-- /.form-group -->
        <div class="form-group animated-hue clearfix">
          <div class="pull-left">
            <div class="nice-checkbox nice-checkbox-inline">
                <input type="checkbox" name="registerRemember" id="loginRemember2" checked="checked">
                <label for="loginRemember2">Recordar</label>
            </div>
          </div>
          <div class="pull-right">
            {{ csrf_field() }}
            <button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Procesando" class="btn btn-primary">Crear cuenta</button>
          </div>
        </div><!-- /.form-group -->
      </form><!-- /#signupForm -->

      <hr>

      <p>Creando una cuenta aceptas los <a href="#">términos y condiciones</a> y las <a href="#">políticas de privacidad</a></p>
      <hr>
      <p>¿Ya tenes una cuenta? <a href="/#signin" data-toggle="tab">Entra acá</a></p>
    </div><!-- /.tab-pane -->
  </div><!-- /.tab-content -->
</main><!--/#wrapper-->
<p class="signin-cr text-light">&copy; 2018 SEMS.</p>


<!-- Modal Recover -->
<div class="modal fade" id="recoverAccount" tabindex="-1" role="dialog" aria-labelledby="recoverAccountLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="recoverForm">
        <div class="modal-header">
          <h4 class="modal-title" id="recoverAccountLabel">Recuperar contraseña</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="input-group input-group-in">
              <span class="input-group-addon"><i class="fa fa-envelope-o text-muted"></i></span>
              <input type="email" name="recoverEmail" id="recoverEmail" class="form-control" placeholder="Ingresa tu mail">
            </div>
          </div><!-- /.form-group -->
        </div>
        <div class="modal-footer">
          {{ csrf_field() }}
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Procesando" class="btn btn-primary">Enviar mail</button>
        </div>
      </form><!-- /#recoverForm -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /#recoverAccount -->
@endsection

@push('scripts')
<!-- COMPONENTS -->
  <script src="{{URL::to('scripts/sems/login.js')}}"></script>
@endpush
