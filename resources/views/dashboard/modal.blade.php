<div id="verifyPasswordModal" class="modal">
  <form name="frmVerifyPassword" data-type="with-companions">
    <input type="hidden" name="type">
    <input type="hidden" name="code">
    <div class="modal-content">
      <h4>Verify Password</h4>
      <div class="input-field">
        <input id="verify_password" name="password" type="password" class="validate">
        <label for="verify_password">Password</label>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="modal-close waves-effect waves-green btn-flat">Cancel</button>
      <button type="submit" class=" waves-effect waves-green btn-flat">Send</button>
    </div>
  </form>
</div>
<div id="viewGuestInfoModal" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4>View Guest Info</h4>
    <div class="row">
      <div class="input-field col m12">
        <input id="reference_number" name="reference_number" type="text" class="validate" disabled>
        <label for="reference_number">Reference Number</label>
      </div>
      <div class="input-field col m5">
        <input id="first_name" name="first_name" type="text" class="validate" disabled>
        <label for="first_name">First Name</label>
      </div>
      <div class="input-field col m2">
        <input id="middle_initial" name="middle_initial" type="text" class="validate" disabled>
        <label for="middle_initial">Middle Initial</label>
      </div>
      <div class="input-field col m5">
        <input id="last_name" name="last_name" type="text" class="validate" disabled>
        <label for="last_name">Last Name</label>
      </div>
      <div class="input-field col m6">
        <input id="nickname" name="nickname" type="text" class="validate" disabled>
        <label for="nickname">Nickname</label>
      </div>
      <div class="input-field col m6">
        <input id="batch" name="batch" type="text" class="validate" disabled>
        <label for="batch">Batch (Year)</label>
      </div>
      <div class="input-field col m6">
        <input id="email_address" name="email_address" type="email" class="validate" disabled>
        <label for="email_address">Email Address</label>
      </div>
      <div class="input-field col m6">
        <input id="contact_number" name="contact_number" type="text" class="validate" disabled>
        <label for="contact_number">Contact #</label>
      </div>
      <div class="input-field col m6">
        <input id="company" name="company" type="text" class="validate" disabled>
        <label for="company">Company</label>
      </div>
      <div class="input-field col m6">
        <input id="job_title" name="job_title" type="text" class="validate" disabled>
        <label for="job_title">Job Title</label>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="modal-close waves-effect waves-green btn-flat">Close</button>
  </div>
</div>

<div class='template' style="display:none">
  <div class="row">
    <div class="input-field col m12">
      <input id="companion_reference_number_{id}" name="companion_reference_number[]" type="text" class="validate" disabled>
      <label for="companion_reference_number_{id}">Reference Number</label>
    </div>
    <div class="input-field col m5">
      <input id="companion_first_name_{id}" name="companion_first_name[]" type="text" class="validate" disabled>
      <label for="companion_first_name_{id}">Last Name</label>
    </div>
    <div class="input-field col m5">
      <input id="companion_last_name_{id}" name="companion_last_name[]" type="text" class="validate" disabled>
      <label for="companion_last_name_{id}">First Name</label>
    </div>
    <div class="input-field col m2">
      <input id="companion_middle_initial_{id}" name="companion_middle_initial[]" type="text" class="validate" disabled>
      <label for="companion_middle_initial_{id}">Middle Initial</label>
    </div>
    <div class="input-field col m6">
      <input id="companion_nickname_{id}" name="companion_nickname[]" type="text" class="validate" disabled>
      <label for="companion_nickname_{id}">Nickname</label>
    </div>
    <div class="input-field col m6">
      <input id="companion_email_address_{id}" name="companion_email_address[]" type="email" class="validate" disabled>
      <label for="companion_email_address_{id}">Email Address <i>(Ticket will be sent here)</i></label>
    </div>
    <p class="caption">If alumnus, </p>
    <div class="input-field col m6">
      <input id="companion_company_{id}" name="companion_company[]" type="text" class="validate" disabled>
      <label for="companion_company_{id}">Company</label>
    </div>
    <div class="input-field col m6">
      <input id="companion_job_title_{id}" name="companion_job_title[]" type="text" class="validate" disabled>
      <label for="companion_job_title_{id}">Job Title</label>
    </div>
    <div class="input-field col m6">
      <input type="text" id="companion_batch_{id}" name="companion_batch[]" class="validate" disabled>
      <label for="companion_batch_{id}">Batch (Year)</label>
    </div>
  </div>
</div>
