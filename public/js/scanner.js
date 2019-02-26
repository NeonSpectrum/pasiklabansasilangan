var prevResponse = []

$(document).ready(function() {
  $('.dropdown-trigger').dropdown()
})

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
})

if ($('#preview').length > 0) {
  let scanner = new Instascan.Scanner({
    video: document.getElementById('preview'),
    refractoryPeriod: 3000,
    captureImage: true
  })

  scanner.addListener('scan', function(content, image) {
    window.currentData = { code: content }
    scanner.stop()
    $.ajax({
      type: 'POST',
      data: {
        image,
        type: 'qrcode',
        ...currentData
      }
    }).done(function(response) {
      if (response.success) {
        currentData.name = response.name
        swal({
          title: 'Valid QR Code',
          text: 'Welcome to pasiklaban sa silangan.',
          timer: 3000,
          showConfirmButton: false
        }).then(() => scanner.start())
      } else {
        swal({
          title: response.error,
          html: '<span style="color:red">See registration committee</span>',
          timer: 3000,
          showConfirmButton: false
        }).then(() => scanner.start())
      }
    })
  })
  Instascan.Camera.getCameras()
    .then(function(cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0])
      } else {
        console.error('No cameras found.')
      }
    })
    .catch(function(e) {
      console.error(e)
    })
}
