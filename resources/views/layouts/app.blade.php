<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>


  <!-- favicon.ico and apple-touch-icon.png -->
  <link rel="apple-touch-icon" sizes="57x57" href="/images/favicons/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/images/favicons/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/images/favicons/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/images/favicons/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/images/favicons/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/images/favicons/apple-touch-icon-152x152.png">
  <link rel="icon" type="image/png" href="/images/favicons/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="/images/favicons/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="/images/favicons/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="/images/favicons/manifest.json">
  <meta name="msapplication-TileColor" content="#2d89ef">
  <meta name="msapplication-TileImage" content="/images/favicons/mstile-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <link href="/styles/fonts.css" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="/styles/bootstrap.css">

  <link rel="stylesheet" href="/styles/dependencies.css">

  <link rel="stylesheet" href="/styles/wrapkit.css">

  <link rel="stylesheet" href="/styles/pages.css">

  <link rel="stylesheet" href="/styles/sems.css">
</head>
<body>

    <main class="wrapkit-wrapper" id="wrapper">

    <!-- ============================================
    HEADER SECTION
    =============================================== -->
    <!-- navigation -->
    @include('nav.index')



    <!-- ============================================
    SIDEBAR SECTION
    =============================================== -->
    @include('sidebar.index')




    <!-- ============================================
    MAIN CONTENT SECTION
    =============================================== -->
    @yield('content')
    <!-- /MAIN -->



    <!-- ============================================
    FOOTER SECTION
    =============================================== -->
    <footer class="footer-wrapper" role="contentinfo">
      <div class="footer">
        <div class="pull-right text-muted"><small>v1.0</small></div>
        <div>SEMS  &copy; 2018</div>
      </div>
    </footer><!-- /.FOOTER -->

  </main><!-- /#MAIN -->


  <!-- VENDORS : jQuery & Bootstrap -->
  <script src="/scripts/vendor.js"></script>
  <!-- END VENDORS -->

  <!-- DEPENDENCIES : Required plugins -->
  <script src="/scripts/dependencies.js"></script>
  <!-- END DEPENDENCIES -->

  <!-- WRAPKIT -->
  <script src="/scripts/wrapkit.js"></script>
  <!-- END WRAPKIT -->

  <!-- WRAPKIT SETUPS -->
  <script src="/scripts/wrapkit-setup.js"></script>
  <!-- end WRAPKIT SETUPS -->

  <!-- PLUGIN SETUPS: vendors & dependencies setups -->
  <script src="/scripts/plugin-setups.js"></script>
  <!-- END PLUGIN SETUPS -->

  <!-- COMPONENTS -->
  <script src="/scripts/bootbox.js"></script>

  <script src="/scripts/toastr.js"></script>
  <!-- END COMPONENTS -->
  <script src="/scripts/sems/general.js"></script>
  @stack('scripts')

  </script>

  <!-- Google Analytics: change UA-71722129-1 to be your site's ID.
  <script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='../../../../../www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-71722129-1');ga('send','pageview');
  </script>  -->
</body>

<!-- Mirrored from stilearning.com/items/preview/wrapkit/1.2/page-timeline.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Dec 2017 13:33:35 GMT -->
</html>
