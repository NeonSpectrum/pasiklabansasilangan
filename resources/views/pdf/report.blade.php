<style>
  th {
    text-align: center;
  }
  th, td {
    padding: 10px;
    border: 1px solid black;
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
<table width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email Address/Reference Number</th>
      <th>Strand</th>
      <th>Preferred School</th>
      <th>Preferred Program/Course</th>
      <th>Parent's Contact Number</th>
      <th>Date Registered</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $id => $row)
      <tr>
        <td>{{ $id + 1 }}</td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->email_address }}<br>{{ $row->reference_number }}</td>
        <td>{{ $row->strand }}</td>
        <td>{{ $row->preferred_school }}</td>
        <td>{{ $row->preferred_program }}</td>
        <td>{{ $row->parents_contact_number }}</td>
        <td>{{ $row->created_at->format('F d, Y') }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
<div style="position:absolute;bottom:0;width:100%;text-align:center">CCSS Research and Development Unit</div>
