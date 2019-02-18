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
                <span style="font-family:HighStories">Pre-registration Form</span>
              </span>
            </div>
            <div class="col s3">
              <img src="{{ asset('img/ue_thumb.png') }}" alt="" height="100px" style="margin-top:5px">
            </div>
          </div>
          <div class="card-content" style="overflow:hidden">
            <h6 align='center' style="font-weight:bold">General Instructions</h6>
            <ol>
              <li>Fill up the pre-registration form completely.</li>
              <li>Make sure that your email address is correctly written.</li>
              <li>For unsuccessful registration, please contact CCSS-R&D at 735-5471 loc. 382.</li>
              <li>For successful registration, kindly check your registered email for the pre-registration QR Code.</li>
              <li>Download, keep, and bring the QR Code on the event date.</li>
              <li>QR Code is unique for every student registered in the system. Distribution/Sharing is prohibited.</li>
              <li>QR Code is important in the raffle system.</li>
            </ol>
          </div>
          <div class="card-action">
            <div class="row">
              <div class="input-field col m5 s12">
                <input id="first_name" name="first_name" type="text" class="validate" required>
                <label for="first_name">First Name</label>
              </div>
              <div class="input-field col m2 s12">
                <input id="middle_initial" name="middle_initial" type="text" class="validate">
                <label for="middle_initial">Middle Initial</label>
              </div>
              <div class="input-field col m5 s12">
                <input id="last_name" name="last_name" type="text" class="validate" required>
                <label for="last_name">Last Name</label>
              </div>
              <div class="input-field col m6 s12">
                <select id="strand" name="strand" type="text" class="validate" required>
                  <option>STEM</option>
                  <option>HUMSS</option>
                  <option>ABM</option>
                  <option>TECHVOC-HE</option>
                  <option>GAS</option>
                  <option>TECHVOC-ICT</option>
                  <option>SPORTS</option>
                </select>
                <label for="strand">Strand</label>
              </div>
              <div class="input-field col m6 s12">
                <input id="parents_contact_number" name="parents_contact_number" type="text" class="validate" required>
                <label for="parents_contact_number">Parent's Contact Number</label>
              </div>
              <div class="input-field col m6 s12">
                <input id="preferred_school" name="preferred_school" type="text" class="validate" required>
                <label for="preferred_school">Preferred School in College</label>
              </div>
              <div class="input-field col m6 s12">
                <input id="preferred_program" name="preferred_program" type="text" class="validate" required>
                <label for="preferred_program">Preferred Program/Course</label>
              </div>
              <div class="input-field col m12 s12">
                <input id="email_address" name="email_address" type="email" class="validate" required>
                <label for="email_address">Email Address</label>
              </div>
            </div>
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
<script>
  swal("Privacy Notice", `"This system is a pre-registration for the Pasiklaban 2019. The organizers are collecting information/picture from you as participants for the purposes of registration and overall event management. By providing your information/picture, you are giving your consent to us to use your information/picture for the aforementioned purposes. After conclusion of the event and completion of all necessary reports, your personal data will be saved in secure files for future reference and networking activities. If you do not wish to be contacted further after this event, kindly inform the organizers."`,'info')
</script>
