<table>
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
