@php ($active = "dashboard")

@include('header')
@include('navbar')
<div class="col s12" style="margin: 30px 50px 0 50px">
  <div class="card material-table">
    <div class="table-header">
      <span class="table-title">List of Registered Guests (Total: {{ $total }})</span>
      <div class="actions">
        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
      </div>
    </div>
    <table class="datatable">
      <thead>
        <tr>
          <th width="5%">ID</th>
          <th width="35%">Name</th>
          <th width="15%">Picture</th>
          <th width="15%">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $id => $row)
          <tr>
            <td>{{ $id + 1 }}</td>
            <td>
              <a href="#" onclick="showGuestInfo({{ $row['data']->id }})">
                {{ $row["data"]->first_name . " " . $row["data"]->last_name }} | {{ $row["data"]->email_address }} | {{ $row["data"]->reference_number }}
              </a>
            </td>
            <td>
              @if($row["data"]->reference_file_name)
                <img class="materialboxed" src="{{ asset('references/' . $row['data']->reference_file_name) }}" height="100px" style="object-fit:cover">
              @else
                <span style="color:red;font-style:italic">N/A</span>
              @endif
            </td>
            <td style="padding: 5px">
              <button class="waves-effect waves-light btn btnUploadPicture" data-code="{{ $row['code'] }}" style="width:100%">
                UPLOAD
                <i class="material-icons left">file_upload</i>
              </button>
              <button class="waves-effect waves-light btn btnMarkAsPaid" data-code="{{ $row['code'] }}" style="width:100%;margin-top:5px">
                MARK AS PAID
                <i class="material-icons left">check</i>
              </button>
              <button class="waves-effect waves-light btn btnResendPayment" data-code="{{ $row['code'] }}" style="width:100%;margin-top:5px">
                RESEND INST.
                <i class="material-icons left">send</i>
              </button>
              <button class="waves-effect waves-light btn btnDelete red" data-code="{{ $row['code'] }}" style="width:100%;margin-top:5px">
                DELETE
                <i class="material-icons left">delete</i>
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <input type="file" name="image_upload" style="display:none">
  </div>
</div>
@include('dashboard.modal')
@include('footer')
