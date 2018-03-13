@extends('layouts.login')

@section('content')
<main class="signin-wrapper">
  <div class="tab-content">
    <p class="text-center p-4x">
      <img src="/images/logo/brand-text-color.png" alt="wrapkit" height="28px">
    </p>
    <div class="tab-pane fade in active" id="signin">
      <form id="signinForm"  method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <p class="lead">Entra a tu cuenta</p>
        <div class="form-group">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="icon-user"></i></span>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Mail">
          </div>
        </div><!-- /.form-group -->
        <div class="form-group">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="icon-lock"></i></span>
            <input type="password" name="password"  id="password" class="form-control" placeholder="Contraseña">
          </div>
        </div><!-- /.form-group -->
        <div class="form-group clearfix">
          <div class="animated-hue pull-right">
            <button id="btnSignin" type="submit" class="btn btn-primary">Ingresar</button>
          </div>
          <div class="nice-checkbox nice-checkbox-inline">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="keepSignin">Recordar</label>
          </div>
        </div><!-- /.form-group -->
        <hr>
        <p><a href="#recoverAccount" data-toggle="modal">¿No recordas tu contraseña?</a></p>
        <hr>
        <p>¿No tenes una cuenta? <a href="#signup" data-toggle="tab">Crea una</a></p>
      </form><!-- /#signinForm -->
    </div><!-- /.tab-pane -->

    <div class="tab-pane fade" id="signup">
      <form id="signupForm" action="main.html" role="form">
        <p class="lead">Crear una cuenta</p>
        <p class="text-muted"><strong>Ingresa tus datos</strong></p>
        <div class="form-group has-feedback">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="icon-tag"></i></span>
            <input name="fullName" id="fullName" class="form-control" placeholder="Full Name">
            <span class="form-control-feedback"></span>
          </div>
        </div><!-- /.form-group -->
        <div class="form-group has-feedback">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
            <input type="emailSignUp" name="emailSignUp" id="emailSignUp" class="form-control" placeholder="Email">
            <span class="form-control-feedback"></span>
          </div>
        </div><!-- /.form-group -->
        <div class="form-group has-feedback">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="icon-direction"></i></span>
            <input name="address" id="address" class="form-control" placeholder="Address">
            <span class="form-control-feedback"></span>
          </div>
        </div><!-- /.form-group -->
        <div class="form-group has-feedback">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="icon-location-pin"></i></span>
            <input name="city" id="city" class="form-control" placeholder="City">
            <span class="form-control-feedback"></span>
          </div>
        </div><!-- /.form-group -->
        <div class="form-group has-feedback">
          <div class="input-group input-group-in">
            <span class="input-group-addon" title="unable to find any Country that match the current query!"><i class="icon-map"></i></span>
            <input name="country" id="country" class="form-control" placeholder="Countries">
            <span class="form-control-feedback"></span>
          </div><!-- /input-group-in -->
        </div><!-- /.form-group -->
        <div class="form-group">
          <label class="control-label" style="margin-right:15px">Gender</label>
          <div class="nice-radio nice-radio-inline">
            <input type="radio" name="gender" id="genderMale" value="male" checked="checked">
            <label for="genderMale">Male</label>
          </div><!-- /.radio -->
          <div class="nice-radio nice-radio-inline">
            <input type="radio" name="gender" id="genderFemale" value="female">
            <label for="genderFemale">Female</label>
          </div><!-- /.radio -->
        </div><!-- /.form-group -->

        <hr>

        <p class="text-muted"><strong>Enter your account data</strong></p>
        <div class="form-group has-feedback">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="icon-user"></i></span>
            <input name="usrName" id="usrName" class="form-control" placeholder="Username">
            <span class="form-control-feedback"></span>
          </div>
        </div><!-- /.form-group -->
        <div class="form-group has-feedback">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="icon-key"></i></span>
            <input type="password" name="passwordSignUp" id="passwordSignUp" class="form-control" placeholder="Password">
            <span class="form-control-feedback"></span>
          </div>
        </div><!-- /.form-group -->
        <div class="form-group has-feedback">
          <div class="input-group input-group-in">
            <span class="input-group-addon"><i class="icon-check"></i></span>
            <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Enter Password Again">
            <span class="form-control-feedback"></span>
          </div>
        </div><!-- /.form-group -->
        <div class="form-group animated-hue clearfix">
          <div class="pull-right">
            <button type="submit" class="btn btn-primary">Create account</button>
          </div>
          <div class="pull-left">
            <a href="/#signin" class="btn btn-default" data-toggle="tab">Signin</a>
          </div>
        </div><!-- /.form-group -->
      </form><!-- /#signupForm -->

      <hr>

      <p>By creating an account you agree to the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a></p>
    </div><!-- /.tab-pane -->
  </div><!-- /.tab-content -->
</main><!--/#wrapper-->
<p class="signin-cr text-light">&copy; 2018 SEMS.</p>


<!-- Modal Recover -->
<div class="modal fade" id="recoverAccount" tabindex="-1" role="dialog" aria-labelledby="recoverAccountLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="recoverForm" action="main.html">
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
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Enviar mail</button>
        </div>
      </form><!-- /#recoverForm -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /#recoverAccount -->
@endsection
