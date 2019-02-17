@php($batch = 0)
<table width="100%">
  <thead>
    <tr>
      <th>Batch Year</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $row)
      @if($row->batch != 0)
        if($batch)
        <tr>
          <td>{{ $batch !== $row->batch ? $row->batch : '' }}</td>
          <td>{{ $row->first_name . " " . $row->last_name }}</td>
        </tr>
        @php($batch = $row->batch)
      @endif
    @endforeach
  </tbody>
</table>
