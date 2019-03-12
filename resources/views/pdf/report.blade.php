<style>
  th {
    text-align: center;
  }
  th, td {
    padding: 10px;
    border: 1px solid black;
    word-wrap: break-word;
  }
  tfoot>tr>th{
    border:none;
  }
</style>
<center>
  <h1 style="margin-bottom:5px">Pasiklaban sa Silangan Registration List</h1>
  <small>As of {{ date("F d, Y h:i:s A") }}</small>
</center>
<br>
<div>
  <table width="100%" cellspacing="0" style="table-layout: fixed;">
    <thead>
      <tr>
        <th style="width: 5%">ID</th>
        <th style="width: 15%">Name</th>
        <th style="width: 15%">Email Address/Reference Number</th>
        <th style="width: 10%">Strand</th>
        <th style="width: 15%">Preferred School</th>
        <th style="width: 15%">Preferred Program/Course</th>
        <th style="width: 15%">Parent's Contact Number</th>
        <th style="width: 10%">Date Registered</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $id => $row)
        <tr>
          <td style="width: 5%">{{ $id + 1 }}</td>
          <td style="width: 15%">{{ $row->name }}</td>
          <td style="width: 15%">{{ $row->email_address }}<br/>{{ $row->reference_number }}</td>
          <td style="width: 10%">{{ $row->strand }}</td>
          <td style="width: 15%">{{ $row->preferred_school }}</td>
          <td style="width: 15%">{{ $row->preferred_program }}</td>
          <td style="width: 15%">{{ $row->parents_contact_number }}</td>
          <td style="width: 10%">{{ $row->created_at->format('F d, Y') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div style="position:absolute;bottom:0;width:100%;text-align:center">CCSS Research and Development Unit</div>
