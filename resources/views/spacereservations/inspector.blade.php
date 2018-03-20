@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
    <div class="content">
        <div id="content-hero" class="content-hero">
            <img class="content-hero-embed" src="../images/dummy/people4.jpg" alt="cover">
            <div class="content-hero-overlay bg-grd-blue"></div>
            <div class="content-hero-body">
                <!-- /.content-bar -->
                <h1 style="color: white;">ESPECIALES</h1>
            </div>
            <!-- /.content-hero-body -->
        </div>
        <!-- /.content-hero -->
        <div class="content-body">
            <div id="map" style="height: 80vh; width:100%;z-index: 0;"></div>
            <!-- /.row -->
        </div>
        <!-- /.content-body -->
    </div>
    <!-- /.content -->
</section>

@endsection

@push('scripts')
  <link rel="stylesheet" href="styles/leaflet.css">
  <script src="scripts/sems/leaflet.js"></script>
  <script src="scripts/sems/adm-containers-maps.js"></script>
@endpush
