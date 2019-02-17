<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/raffle.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
  <title>Alumni Registration Scanner</title>
  <style>
    body {
      background: white;
      overflow:hidden !important;
    }
  </style>
</head>
<body>
  <div class='enter-names'></div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/materialize.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui-1.8.23.custom.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/raffle.js') }}?v={{ filemtime(public_path('js/raffle.js')) }}"></script>
<script>
  var imported = @json($data);
  $('.enter-names').hide();
  makeTicketsWithPoints();
</script>
</body>
</html>
