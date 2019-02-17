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
  <h1 style="margin-bottom:5px">CCSS 30th Alumni Homecoming Ticket Sales</h1>
  <small>As of {{ date("F d, Y h:i:s A") }}</small>
</center>
<br>
<table width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>Description</th>
      <th>Price</th>
      <th>Count</th>
      <th>Persons</th>
      <th>Referrer</th>
      <th>Date Sent</th>
    </tr>
  </thead>
  <tbody>
    @php ($id = 1)
    @php ($total = 0)
    @foreach($data as $row)
      <tr>
        <td>Ticket Sales ({{ $row->companions['count'] + 1 }})</td>
        <td style="text-align:right">{{ number_format(($row->companions['count'] + 1) * 1000, 2, '.', ',') }}</td>
        <td style="text-align:center">{{ $row->companions['count'] == 0 ? $id : $id . '-' . ($id + $row->companions['count']) }}</td>
        <td>{!! $row->first_name . ' ' . $row->last_name . '<br>' . $row->companions['names'] !!}</td>
        <td>{{ $row->referrer }}</td>
        <td>{{ date('F d, Y', strtotime($row->date_sent)) }}</td>
      </tr>
      @php ($id += $row->companions['count'] + 1)
      @php ($total += ($row->companions['count'] + 1) * 1000)
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th style="text-align:right">Total:</th>
      <th style="text-align:right">{{ number_format($total, 2, ".", ",") }}</th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </tfoot>
</table>
<div style="position:absolute;bottom:0;width:100%;text-align:center">CCSS Research and Development Unit</div>
