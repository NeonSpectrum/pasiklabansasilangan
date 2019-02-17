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
          text: 'Retrieving data...',
          timer: 3000,
          onOpen: () => {
            swal.showLoading()
          }
        })
        setTimeout(function() {
          swal({
            title: 'Welcome, ' + response.name,
            text: 'Start Taking Photos.',
            timer: 3000,
            onOpen: () => {
              swal.showLoading()
            }
          })
          setTimeout(function() {
            preparePhoto()
          }, 3000)
        }, 3000)
      } else {
        swal({
          title: response.error,
          html: '<span style="color:red">See registration committee</span>',
          timer: 3000,
          showConfirmButton: false
        })
        scanner.start()
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
function preparePhoto() {
  navigator.mediaDevices
    .getUserMedia({
      video: { width: 375, height: 375 }
    })
    .then(stream => {
      let player
      swal({
        html: `
          <video id="capturePhoto" style="transform:rotateY(180deg)"></video>
          <center>
            Capturing in<br>
            <h1 class="countdown" style="margin:0">5</h1>
          </center>
        `,
        timer: 5000,
        showConfirmButton: false,
        customClass: 'swal2-modal-lg',
        onOpen: () => {
          player = document.getElementById('capturePhoto')
          player.srcObject = stream
          player.play()
          window.timer = setInterval(function() {
            $('h1.countdown').text(Number($('h1.countdown').text()) - 1)
          }, 1000)
        },
        onClose: () => {
          clearInterval(timer)
        }
      }).then(result => {
        let picture = document.createElement('canvas')
        picture.height = 375
        picture.width = 375
        picture.getContext('2d').drawImage(player, 0, 0, 375, 375)

        showImage(picture.toDataURL())
      })
    })
}

function showImage(url) {
  swal({
    imageUrl: url,
    showCancelButton: true,
    cancelButtonText: 'Retake'
  }).then(result => {
    if (result.value) {
      $.ajax({
        type: 'POST',
        data: { type: 'picture', code: currentData.code, image: url }
      }).always(function() {
        location.reload()
      })
    } else {
      preparePhoto()
    }
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
