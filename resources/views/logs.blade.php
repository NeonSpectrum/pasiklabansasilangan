@php ($active = "logs")

@include('header')
@include('navbar')
<div class="col s12" style="margin: 30px 50px 0 50px">
  <div class="card material-table">
    <div class="table-header">
      <span class="table-title">Activity Logs</span>
      <div class="actions">
        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
      </div>
    </div>
    <table class="datatable" data-sort="desc">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Action</th>
          <th>Date Created</th>
        </tr>
      </thead>
      <tbody>
        @foreach($logs as $id => $log)
          <tr>
            <td>{{ $id + 1 }}</td>
            <td>{{ $log->username }}</td>
            <td>{{ $log->action }}</td>
            <td>{{ date("F d, Y g:i:s A", strtotime($log->created_at)) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@include('footer')
