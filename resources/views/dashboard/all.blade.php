@php ($active = "dashboard")

@include('header')
@include('navbar')
<div class="col s12" style="margin: 30px 20px 0">
  <div class="card material-table">
    <div class="table-header">
      <span class="table-title">List of All Guests (Total: {{ $total }})</span>
      <div class="actions">
        <a href="{{ url('report') }}" class="waves-effect btn-flat nopadding"><i class="material-icons">file_download</i></a>
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
          <th>Strand</th>
          <th>Parent's Contact Number</th>
          <th>School</th>
          <th>Program</th>
          <th>Date Registered</th>
          <th width="8%">Disqualified</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $id => $row)
          <tr>
            <td>{{ $id + 1 }}</td>
            <td>{{ $row["data"]->name }}</td>
            <td>{{ $row["data"]->email_address }}</td>
            <td>{{ $row["data"]->reference_number }}</td>
            <td>{{ $row["data"]->strand }}</td>
            <td>{{ $row["data"]->parents_contact_number }}</td>
            <td>{{ $row["data"]->preferred_school }}</td>
            <td>{{ $row["data"]->preferred_program }}</td>
            <td>{{ $row["data"]->created_at->format("F d, Y") }}</td>
            <td style="text-align:center">
              <label>
                <input type="checkbox" class="filled-in" data-id="{{ $row["data"]->id }}" name="disqualified" {{ $row["data"]->disqualified == 1 ? "checked" : "" }}>
                <span></span>
              </label>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@include('dashboard.modal')
@include('footer')
