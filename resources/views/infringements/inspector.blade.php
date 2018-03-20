@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
    <div class="content">
        <div id="content-hero" class="content-hero">
            <img class="content-hero-embed" src="../images/dummy/people4.jpg" alt="cover">
            <div class="content-hero-overlay bg-grd-blue"></div>
            <div class="content-hero-body">
                <!-- /.content-bar -->
                <h1 style="color: white;">INFRACCIONES</h1>
            </div>
            <!-- /.content-hero-body -->
        </div>
        <!-- /.content-hero -->
        <div id="main-content-insp">
          <div class="content-body">'
              <div class="row">'
                  <div class="col-md-6 col-md-offset-3 col-xs-12 text-center">
                    <p><i class="fa fa-spin fa-spin-2x fa-4x fa-refresh fa-fw text-primary"></i></p>
                    </div>
              </div>
          </div>
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
  <script src="scripts/sems/inspector-infringements.js"></script>
  <script src="scripts/sems/infringements-images.js"></script>
  <script src="scripts/jic.min.js"></script>
  <script src="scripts/image_tool.js"></script>
@endpush
