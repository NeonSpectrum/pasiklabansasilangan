@include('header')
<div class="container">
  <div class="row">
    <div class="col s12 m10 offset-m1" style="margin-top:30px">
      <div class="card">
        <form name="frmUpload">
          <input type="hidden" name="code" value="{{ $code }}">
          <div class="card-content">
            <span class="card-title black-text">Upload</span>
            <div class="row">
              @if(!$user->nickname)
                <div class="input-field col m8">
                  <input id="nickname" name="nickname" type="text" class="validate" required>
                  <label for="nickname">Nickname</label>
                </div>
              @endif
              @if($user->batch == 0)
                <div class="input-field col m4">
                  <select id="batch" name="batch">
                    @for($i = date("Y"); $i >= 1992; $i--)
                      <option>{{ $i }}</option>
                    @endfor
                  </select>
                  <label for="batch">Batch (Year)</label>
                </div>
              @endif
              @if(!$user->referrer)
                <div class="input-field col m12">
                  <input id="referrer" name="referrer" type="text" class="validate" required>
                  <label for="referrer">Referrer</label>
                </div>
              @endif
              <div class="file-field input-field col m12">
                <div class="btn">
                  <span>Browse</span>
                  <input type="file" name="image_reference" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Upload file">
                </div>
              </div>
            </div>
            <div class="image-container"></div>
          </div>
          <div class="card-action" style="overflow:hidden">
            <button type="submit" class="btn waves-light waves-effect right">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@include('footer')
