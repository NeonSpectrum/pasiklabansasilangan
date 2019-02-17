@include('header')
<div class="container">
  <div class="row">
    <div class="col s12 m10 offset-m1" style="margin-top:30px">
      <div class="card">
        <form name="frmRegister">
          <div class="center-align" style="background:lightgreen;overflow:auto">
            <div class="col s3">
              <img src="{{ asset('img/ccss_thumb.png') }}" alt="" height="100px" style="margin-top:5px">
            </div>
            <div class="col s6" style="margin-top:15px">
              <span class="white-text card-title" style="font-weight:bold">
                <span style="font-family:LemonMilk;color:green;font-size:22px">Pasiklaban sa Silangan </span><br>
                <span style="font-family:HighStories">Registration Form</span>
              </span>
            </div>
            <div class="col s3">
              <img src="{{ asset('img/ue_thumb.png') }}" alt="" height="100px" style="margin-top:5px">
            </div>
          </div>
          <div class="card-content">
            <div class="row">
              <div class="input-field col m5">
                <input id="first_name" name="first_name" type="text" class="validate" required>
                <label for="first_name">First Name</label>
              </div>
              <div class="input-field col m2">
                <input id="middle_initial" name="middle_initial" type="text" class="validate">
                <label for="middle_initial">Middle Initial</label>
              </div>
              <div class="input-field col m5">
                <input id="last_name" name="last_name" type="text" class="validate" required>
                <label for="last_name">Last Name</label>
              </div>
              <div class="input-field col m6">
                <input id="strand" name="strand" type="text" class="validate" required>
                <label for="strand">Strand</label>
              </div>
              <div class="input-field col m6">
                <input id="parents_contact_number" name="parents_contact_number" type="text" class="validate" required>
                <label for="parents_contact_number">Parent's Contact Number</label>
              </div>
              <div class="input-field col m6">
                <input id="preferred_school" name="preferred_school" type="text" class="validate" required>
                <label for="preferred_school">Preferred School in College</label>
              </div>
              <div class="input-field col m6">
                <input id="preferred_program" name="preferred_program" type="text" class="validate" required>
                <label for="preferred_program">Preferred Program</label>
              </div>
              <div class="input-field col m12">
                <input id="email_address" name="email_address" type="email" class="validate" required>
                <label for="email_address">Email Address</label>
              </div>
            </div>
          </div>
          <div class="card-action" style="overflow:hidden">
            <h6 align='center' style="font-weight:bold">Privacy Notice</h6>
            <p style='text-align:justify;color:#545454;font-size:14px'>
              &quot;The event organizers are collecting information from you as participants for the purposes of registration and overall event management.   By providing your information, you are giving your consent to us to use your information for the aforementioned purposes.
            </p>
            <p style='text-align: justify;color:#545454;font-size:14px'>
              After conclusion of the event and completion of all necessary reports, your personal data will be saved in secure files for future reference and networking activities. If you do not wish to be contacted further after this event, kindly inform the organizers.&quot;
            </p>
            <label>
              <input type="checkbox" name="terms">
              <span>I understand and agree to these terms.</span>
            </label>
          </div>
          <div class="card-action" style="overflow:hidden">
            <button type="submit" class="btn waves-light waves-effect right">Register</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@include('footer')
