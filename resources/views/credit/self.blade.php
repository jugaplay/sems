@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
    <div class="content">
        <div id="content-hero" class="content-hero">
            <img class="content-hero-embed" src="../images/dummy/people4.jpg" alt="cover">
            <div class="content-hero-overlay bg-grd-blue"></div>
            <div class="content-hero-body">
                <!-- /.content-bar -->
                <h1 style="color: white;">CARGAR SALDO</h1>
            </div>
            <!-- /.content-hero-body -->
        </div>
        <!-- /.content-hero -->

        <div class="content-body">

            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-xs-12">
                    <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-download fa-fw" aria-hidden="true"></i> Cargar saldo</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" id="creditFormContainer">
                              <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-datetime">Mi saldo</label>
                                <div class="input-group input-group-in cost
                                  @if (Auth::user()->wallet->balance < 0)
                                      no-credit
                                  @endif
                                ">
                                  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                  <input type="text" class="form-control input-lg" id="inputPass" value="{{Auth::user()->wallet->balance}}"  disabled="disabled">
                                </div><!-- /input-group-in -->
                              </div><!--/form-group-->
                                <div class="form-group form-group-lg">
                                    <label class="control-label" for="mask-datetime">Saldo a cargar</label>
                                    <div class="input-group input-group-in">
                                        <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                        <input type="text" class="form-control input-lg" name="creditAmount" id="creditAmount" placeholder="200" required="">
                                    </div>
                                    <!-- /input-group-in -->
                                </div>
                                <!--/form-group-->
                                <div class="form-group form-group-lg">
                                  <input type="hidden" name="creditPayment" id="creditPayment" value="ON" >
                                  <input type="hidden" name="creditType" id="creditType" value="load" >
                                  {{csrf_field()}}
                                  <button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Procesando" class="btn btn-primary btn-lg">
                                    Enviar
                                  </button>
                                </div>
                            </form>
                            <!--/form-->
                        </div>

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
  <script src="scripts/sems/credits.js"></script>
@endpush
