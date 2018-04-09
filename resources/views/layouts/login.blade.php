<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="no-js">
  <head>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

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
  <meta name="msapplication-TileImage" content="images/favicons/mstile-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <link href="/styles/fonts.css" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="/styles/bootstrap.css">

  <link rel="stylesheet" href="/styles/dependencies.css">

  <link rel="stylesheet" href="/styles/wrapkit.css">

  <link rel="stylesheet" href="/styles/pages.css">
</head>
<body class="bg-grd-blue">
  <!--[if lt IE 9]>
  <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="/http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  @yield('content')


  <!-- VENDORS : jQuery & Bootstrap -->
  <script src="/scripts/vendor.js"></script>
  <!-- END VENDORS -->
  <!-- DEPENDENCIES : Required plugins -->
  <script src="/scripts/dependencies.js"></script>
  <!-- END DEPENDENCIES -->
  <!-- PLUGIN SETUPS: vendors & dependencies setups -->
  <script src="/scripts/plugin-setups.js"></script>
  <!-- END PLUGIN SETUPS -->
  <!-- COMPONENTS -->
  <script src="/scripts/bootbox.js"></script>
  <script src="/scripts/toastr.js"></script>
  <script src="/scripts/sems/general.js"></script>
  @stack('scripts')


</body>

</html>
