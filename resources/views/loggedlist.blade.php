@php ($active = "dashboard")

@include('header')
@include('navbar')
<div class="col s12" style="margin: 30px 20px 0">
  <div class="card material-table">
    <div class="table-header">
      <span class="table-title">List of Logged Guests (Total: {{ $data->count() }})</span>
      <div class="actions">
        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
      </div>
    </div>
    <table class="datatable">
      <thead>
        <tr>
          <th width="5%">ID</th>
          <th>Name</th>
          <th>Email Address</th>
          <th>Reference Number</th>
          <th>Time Logged</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $id => $row)
          <tr>
            <td>{{ $id + 1 }}</td>
            <td>{{ $row["data"]->name }}</td>
            <td>{{ $row["data"]->email_address }}</td>
            <td>{{ $row["data"]->reference_number }}</td>
            <td>{{ $row["data"]->logged_at->format("F d, Y") }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@include('dashboard.modal')
@include('footer')
