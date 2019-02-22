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
      <th width="5%">ID</th>
      <th width="15%">Name</th>
      <th width="15%">Email Address/Reference Number</th>
      <th width="10%">Strand</th>
      <th width="15%">Preferred School</th>
      <th width="15%">Preferred Program/Course</th>
      <th width="15%">Parent's Contact Number</th>
      <th width="10%">Date Registered</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $id => $row)
      <tr>
        <td width="5%">{{ $id + 1 }}</td>
        <td width="15%">{{ $row->name }}</td>
        <td width="15%">{{ $row->email_address }}<br/>{{ $row->reference_number }}</td>
        <td width="10%">{{ $row->strand }}</td>
        <td width="15%">{{ $row->preferred_school }}</td>
        <td width="15%">{{ $row->preferred_program }}</td>
        <td width="15%">{{ $row->parents_contact_number }}</td>
        <td width="10%">{{ $row->created_at->format('F d, Y') }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
<div style="position:absolute;bottom:0;width:100%;text-align:center">CCSS Research and Development Unit</div>
