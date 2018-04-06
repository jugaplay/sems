@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
    <div class="content">
        <div id="content-hero" class="content-hero">
            <img class="content-hero-embed" src="{{URL::to('images/dummy/people4.jpg')}}" alt="cover">
            <div class="content-hero-overlay bg-grd-blue"></div>
            <div class="content-hero-body">
                <!-- /.content-bar -->
                <h1 style="color: white;">INFRACCIONES</h1>
            </div>
            <!-- /.content-hero-body -->
        </div>
        <!-- /.content-hero -->
        <div class="content-body">
            <div class="row">
                <div class="col-xs-12">
                    <h2><i>{{ count($infringements) }} </i>Resultados</i></h2>
                    @foreach ($infringements as $infringement)
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="search-result-item">
                                    <div class="media">
                                        <div class="media-left">
                                            <a class="kit-avatar kit-avatar-128 kit-avatar-square" href="{{ route('infringements.index') }}/{{ $infringement->id }}">
                                                <img class="media-object" src="{{ $infringement->img() }}">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="pull-right">
                                              @switch($infringement->situation)
                                                  @case("saved")
                                                      <span class="label label-warning">Vencida</span>
                                                      @break
                                                  @case("voluntary")
                                                      <span class="label label-primary">Pago voluntario</span>
                                                      @break
                                                  @case("close")
                                                      <span class="label label-default">Cerrada</span>
                                                      @break
                                                  @default
                                                      <!-- Un estado no contemplado, ojo con el estado judge -->
                                              @endswitch
                                            </div>
                                            <p class="media-heading"><a href="{{ route('infringements.index') }}/{{ $infringement->id }}">{{ $infringement->plate }} -- {{ $infringement->cause->name }}</a></p>
                                            <p class="text-muted"><small>{{ parseDateString($infringement->date) }} <b>Costo: ${{ $infringement->cost }}</b></small></p>
                                              <p><b>Detalle:</b> {{ $infringement->details->first()->detail }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.search-result-item -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    @endforeach
                    <!-- /.panel -->
                </div>
                <!-- /.col-md-6 col-md-offset-3 col-xs-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.content-body -->
    </div>
    <!-- /.content -->
</section>
@endsection

@push('scripts')
<link rel="stylesheet" href="{{URL::to('styles/components.css')}}">
<script src="{{URL::to('scripts/moment.js')}}"></script>
<script src="{{URL::to('scripts/daterangepicker.js')}}"></script>
<!-- END COMPONENTS -->

@endpush
