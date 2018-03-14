@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
    <div class="content">
        <div id="content-hero" class="content-hero">
            <img class="content-hero-embed" src="../images/dummy/people4.jpg" alt="cover">
            <div class="content-hero-overlay bg-grd-blue"></div>
            <div class="content-hero-body">
                <!-- /.content-bar -->
                <h1 style="color: white;">CHEQUEAR ESTACIONAMIENTOS</h1>
            </div>
            <!-- /.content-hero-body -->
        </div>
        <!-- /.content-hero -->

        <div class="content-body">

            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-xs-12">
                    <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-ticket fa-fw" aria-hidden="true"></i> Datos a chequear</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" class="my-form"  id="ticketFormControl">
                                <p>
                                    <i class="fa fa-map-marker fa-fw"></i> Gps Activo</p>
                                <div class="form-group form-group-lg">
                                    <label class="control-label" for="mask-date">Patente</label>
                                    <div class="input-group input-group-in">
                                        <span class="input-group-addon">
                                            <i class="fa fa-car"></i>
                                        </span>
                                        <input type="text" class="form-control input-lg" name="controlPlate" id="controlPlate" placeholder="Patente" required="">
                                    </div>
                                    <!-- /input-group-in -->
                                </div>
                                <!--/form-group-->
                                <div class="form-group form-group-lg">
                                    <input type="submit" class="btn btn-primary btn-lg" value="Verificar" />
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
            <!-- /.row -->
        </div>
        <!-- /.content-body -->
    </div>
    <!-- /.content -->
</section>
<script type="text/javascript">
    window.ajax_token = '{{ csrf_token() }}';
</script>
@endsection

@push('scripts')
<!-- COMPONENTS -->
  <script src="scripts/sems/check-tickets.js"></script>
  <script src="scripts/jic.min.js"></script>
  <script src="scripts/image_tool.js"></script>

@endpush
