  <script>const main_url="{{ url('/') }}"</script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/jquery.serializejson.min.js') }}"></script>
  <script src="{{ asset('js/materialize.min.js') }}"></script>
  <script src="{{ asset('js/datatables.min.js') }}"></script>
  <script src="{{ asset('js/datatable-custom.js') }}"></script>
  <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('js/script.js') }}?v={{ filemtime(public_path('js/script.js')) }}"></script>
  @yield("extra-scripts")
</body>
</html>
