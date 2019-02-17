<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Nickname</th>
      <th>Email Address</th>
      <th>Reference Number</th>
      <th>Contact Number</th>
      <th>Company</th>
      <th>Job Title</th>
      <th>Batch</th>
      <th>Referrer</th>
      <th>Date Registered</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $id => $row)
      <tr>
        <td style="{{ $row['data']->status ?? "" }}">{{ $id + 1 }}</td>
        <td style="{{ $row['data']->status ?? "" }}">{{ $row["data"]->first_name . " " . $row["data"]->middle_initial . " " . $row["data"]->last_name }}</td>
        <td style="{{ $row['data']->status ?? "" }}">{{ $row["data"]->nickname }} </td>
        <td style="{{ $row['data']->status ?? "" }}">{{ $row["data"]->email_address }}</td>
        <td style="{{ $row['data']->status ?? "" }}">{{ $row["data"]->reference_number }}</td>
        <td style="{{ $row['data']->status ?? "" }}">{{ $row["data"]->contact_number }}</td>
        <td style="{{ $row['data']->status ?? "" }}">{{ $row["data"]->company }}</td>
        <td style="{{ $row['data']->status ?? "" }}">{{ $row["data"]->job_title }}</td>
        <td style="{{ $row['data']->status ?? "" }}">{{ $row["data"]->batch }}</td>
        <td style="{{ $row['data']->status ?? "" }}">{{ $row["data"]->referrer }}</td>
        <td style="{{ $row['data']->status ?? "" }}">{{ date("F d, Y", strtotime($row["data"]->created_at)) }}</td>
      </tr>
      @if(count($row["companions"]) > 0)
        @foreach($row["companions"] as $companion)
          <tr>
            <td style="{{ $row['data']->status ?? "" }}"></td>
            <td style="{{ $row['data']->status ?? "" }}">{{ $companion->first_name . " " . $companion->middle_initial . " " . $companion->last_name }}</td>
            <td style="{{ $row['data']->status ?? "" }}">{{ $companion->nickname }}</td>
            <td style="{{ $row['data']->status ?? "" }}">{{ $companion->email_address }}</td>
            <td style="{{ $row['data']->status ?? "" }}">{{ $companion->reference_number }}</td>
            <td style="{{ $row['data']->status ?? "" }}"></td>
            <td style="{{ $row['data']->status ?? "" }}">{{ $companion->company }}</td>
            <td style="{{ $row['data']->status ?? "" }}">{{ $companion->job_title }}</td>
            <td style="{{ $row['data']->status ?? "" }}">{{ $companion->batch }}</td>
            <td style="{{ $row['data']->status ?? "" }}"></td>
            <td style="{{ $row['data']->status ?? "" }}"></td>
          </tr>
        @endforeach
      @endif
    @endforeach
  </tbody>
</table>
