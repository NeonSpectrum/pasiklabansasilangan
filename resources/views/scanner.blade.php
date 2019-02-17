@php($active = 'logged')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
  <title>Alumni Registration Scanner</title>
  @if(!isset($logged))
  <style>
    body {overflow:hidden !important;}
  </style>
  @endif
</head>
<body>
@includeWhen(isset($logged), 'navbar')
@if(!isset($logged))
<div class="row scanner">
  <div class="col m12" align="center" style="padding-top:110px">
    <div style="height:500px;width:500px;overflow:hidden">
      <video id="preview" height="500px" width="500px" style="object-fit:cover"></video>
    </div>
    <h1 style="color:white">Please scan your e-ticket QR code.</h1>
  </div>
</div>
@else
<div class="col s12" style="margin: 30px 50px 0 50px">
  <div class="card material-table">
    <div class="table-header">
      <span class="table-title">List of Logged Users</span>
      <div class="actions">
        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
      </div>
    </div>
    <table class="datatable">
      <thead>
        <tr>
          <th width="5%">ID</th>
          <th>Name</th>
          <th>Nickname</th>
          <th>Reference Number</th>
          <th>QR Code</th>
          <th>Picture</th>
          <th>Logged In Time</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
@endif
<center><img class="materialboxed" src=""></center>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/materialize.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/instascan.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{ asset('js/datatable-custom.js') }}"></script>
<script src="{{ asset('js/underscore-min.js') }}"></script>
<script src="{{ asset('js/scanner.js') }}?v={{ filemtime(public_path('js/scanner.js')) }}"></script>
</body>
</html>
