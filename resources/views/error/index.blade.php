@extends('layouts.app')

@section('content')
<section class="content-wrapper bg-grd-dark" role="main" data-init-content="true">
  <div class="content-body">
    <div class="row error-wrapper">
        <div class="error-brand">
          <span class="fa-stack">
            <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
            <i class="fa fa-exclamation-triangle fa-stack-1x text-danger"></i>
          </span>
        </div><!-- /.error-brand -->

        <div class="error-messages">
          <p><strong>Oopps!</strong> Algo salió mal y la página que estás buscando <br> no pudo ser encontrada, no existe o no tienes permiso para acceder a ella!</p>
        </div>

        <div class="error-control">
          <a href="{{ route('home') }}" class="btn btn-default btn-icon btn-lg"><i class="icon-direction fa-2x"></i> <br> Volver al inicio </a>
        </div>

      </div>
    </div>
</section>
@endsection
