@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
    <div class="content">
        <div id="content-hero" class="content-hero">
            <img class="content-hero-embed" src="../images/dummy/people4.jpg" alt="cover">
            <div class="content-hero-overlay bg-grd-blue"></div>
            <div class="content-hero-body">
                <!-- /.content-bar -->
                <h1 style="color: white;">CONFIGURACIÓN</h1>
            </div>
            <!-- /.content-hero-body -->
        </div>

        <!-- /.content-hero -->

        <div class="content-body">
            <div class="col-md-6 col-xs-12 col-md-offset-3 ">
                <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i> Datos</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" class="form-bordered" action="users/edit" method="post" id="configurationForm" name="configurationForm">
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-datetime">Nombre completo</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control input-lg" id="configurationName" name="configurationName" value="{{Auth::user()->name}}" placeholder="Nombre completo">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-datetime">Mail</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                    <input type="text" class="form-control input-lg" id="configurationMail" name="configurationMail" value="{{Auth::user()->email}}" placeholder="Mail">
                                    <input type="hidden" class="form-control input-lg" id="configurationMail_old" name="configurationMail_old" value="{{Auth::user()->email}}">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-datetime">Celular</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control input-lg" id="configurationPhone" name="configurationPhone" value="{{Auth::user()->phone}}" placeholder="Celular">
                                    <input type="hidden" class="form-control input-lg" id="configurationPhone_old" name="configurationPhone_old" value="{{Auth::user()->phone}}">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-datetime">Contraseña</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon"><i class="fa fa-expeditedssl"></i></span>
                                    <input type="password" class="form-control input-lg" id="configurationPassword" name="configurationPassword" placeholder="Contraseña">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            <!--/form-group-->
                            <div class="form-group">
                                <label><i class="fa fa fa-bell-o fa-fw" aria-hidden="true"></i> Alertas</label>
                                <p> Habilita las opciones que consideres necesarias para que te contacten para evitar una multa</p>
                                @foreach ($notifications as $notification)
                                  <div class="nice-checkbox">
                                      <input type="checkbox" name="notification{{$notification->id}}" id="niceCheck{{$notification->id}}" @if($notification->active) checked="checked" @endif>
                                      <label for="niceCheck{{$notification->id}}">{{$notification->name}}</label>
                                  </div>
                                @endforeach
                                <!--/nice-checkbox-->
                            </div>
                            <!--/form-group-->
                            <div class="form-group">
                                <label class="control-label" for="domain-input"><i class="fa fa fa-car fa-fw" aria-hidden="true"></i> Vehículos</label>
                                <p>Guarda tus vehículos para recibir notificaciones de los mismas</p>
                                <input id="domain-input" name="domain-input" data-input="tags" class="form-control" value="@foreach (Auth::user()->vehicles as $vehicle) @if(!$loop->first),@endif{{$vehicle->plate}}@endforeach" placeholder="Dominio">
                            </div>
                            <!--/form-group -->
                            <div class="form-group form-group-lg">
                                {{csrf_field()}}
                                <input type="submit" class="btn btn-primary btn-lg" value="Guardar" />
                            </div>
                        </form>
                        <!--/form-->
                    </div>
                    <!-- /panel-body -->
                </div>
                <!-- /.col-md-6 col-md-offset-3 col-xs-12 -->

            </div>
            <!-- /.col-md-6 col-md-offset-3 col-xs-12 -->
        </div>
        <!-- /.content-body -->
    </div>
    <!-- /.content -->
</section>
@endsection

@push('scripts')
<link rel="stylesheet" href="styles/components.css">
<script src="scripts/jquery.tagsinput.js"></script>
<script src="scripts/sems/users-drivers-ul-vehicles.js"></script>
<script src="scripts/sems/drivers-profile.js"></script>
@endpush
