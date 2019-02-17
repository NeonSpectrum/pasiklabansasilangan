<h4 style="color:purple">PAYMENT INSTRUCTIONS</h4>
<div style="text-align:center;padding:0 20px;background:linear-gradient(to bottom, #feccb1 0%,#f17432 100%,#fb955e 100%);color:white">
  Total Due<br>
  <span style="font-size:20px;font-weight:bold">PHP {{ number_format(($data->user->count()) * 1000, 2, ".", ",") }}</span><br>
  Status: PENDING
</div>
<br>
<table width="50%">
  <tr>
    <td width="50%">Bank:</td>
    <td style="font-weight:bold" width="50%">PNB</td>
  </tr>
  <tr>
    <td width="50%">Ref No.</td>
    <td style="font-weight:bold" width="50%">{{ $data->user->reference_number }}</td>
  </tr>
  <tr>
    <td width="50%">Acct No:</td>
    <td style="font-weight:bold" width="50%">166010044084</td>
  </tr>
  <tr>
    <td width="50%">Acct Name:</td>
    <td style="font-weight:bold" width="50%">UE College of Computer Studies & Systems Alumni Association</td>
  </tr>
  <tr>
    <td width="50%">Acct Type:</td>
    <td style="font-weight:bold" width="50%">Savings</td>
  </tr>
  <tr>
    <td width="50%">Amount:</td>
    <td style="font-weight:bold" width="50%">PHP {{ number_format(($data->user->count()) * 1000, 2, ".", ",") }}</td>
  </tr>
  <tr>
    <td width="50%">Description:</td>
    <td style="font-weight:bold" width="50%">UE CCSS Alumni Homecoming</td>
  </tr>
  <tr>
    <td width="50%">Deadline:</td>
    <td style="font-weight:bold;color:red" width="50%">{{ $data->date }}</td>
  </tr>
</table>
<br>
<h2 style="color:purple">Step 1: Pay</h2>
<ol>
  <li>Fill-up a regular deposit slip and pay exact amount in <b>CASH</b>.</li>
  <li>Note that some banks may charge a <i>handling fee</i> for deposits in their provincial branches.</li>
</ol>
<h2 style="color:purple">Step 2: Validate <span style="font-size:22px;color:red">[>> IMPORTANT <<]</span></h2>
<ol>
  <li>When deposit is completed, click on this link ({{ url("/upload?code=" . $data->code) }}) and fill up the details within the same day to validate. Include in the deposit slip the given reference number and your complete name for validation before uploading.</li>
</ol>
<h2 style="color:purple">Step 3: Confirmation</h2>
<ol>
  <li>Payments are processed at end of the day.</li>
  <li>Once processed, we will send your digital ticket on the email provided. If you do not receive one by the next 2 days, you may call us at (02) 735-6975. Look for Mhel Agbulos or MJ Sarmiento.</li>
</ol>
