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
    $('.scanner h1').remove()
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
function fetchLogged() {
  if ($('table').length == 0) return
  $.get(
    'loggedlist',
    null,
    function(response) {
      // if (_.isEqual(prevResponse, response)) return
      // prevResponse = response
      dTable.clear()
      $.each(response, function(id, value) {
        dTable.row.add([
          id + 1,
          value.first_name + ' ' + value.last_name + ' (' + value.batch + ')',
          value.nickname,
          value.reference_number,
          `<img class="materialboxed" src="loggedusers/${value.reference_number}-qrcode.webp" height="100">`,
          `<img class="materialboxed" src="loggedusers/${value.reference_number}-picture.png" height="100">`,
          value.logged_at
        ])
      })
      dTable.draw()
      $('.materialboxed').materialbox()
    },
    'json'
  )
}

$(document).ready(function() {
  window.dTable = $('table').DataTable({
    oLanguage: {
      sStripClasses: '',
      sSearch: '',
      sSearchPlaceholder: 'Enter Keywords Here',
      sInfo: '_START_ -_END_ of _TOTAL_',
      sLengthMenu:
        '<span>Rows per page:</span><select class="browser-default">' +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        '</select></div>'
    },
    bAutoWidth: false,
    search: {
      smart: false
    },
    order: [[0, 'desc']]
  })
  fetchLogged()
  setInterval(function() {
    fetchLogged()
  }, 5000)
})
