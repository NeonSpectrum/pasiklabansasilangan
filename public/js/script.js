$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  error: function() {
    swal.close()
  }
})

swal.setDefaults({
  allowOutsideClick: false,
  allowEscapeKey: false
})

$(document).ready(function() {
  $('.materialboxed').materialbox()
  $('.modal').modal({
    dismissible: false,
    endingTop: '5%'
  })
  $('select[name=strand]').formSelect()

  $('.dropdown-trigger').dropdown()

  $('form[name=frmLogin]').submit(function(e) {
    e.preventDefault()

    $(this)
      .find('input')
      .prop('readonly', true)
    $(this)
      .find('button[type=submit]')
      .prop('disabled', true)

    $.ajax({
      context: this,
      type: 'POST',
      url: main_url + '/login',
      data: $(this).serialize(),
      dataType: 'json'
    })
      .done(function(response) {
        if (response.success) {
          location.href = './dashboard'
        } else {
          alert(response.error)
        }
      })
      .always(function() {
        $(this)
          .find('input')
          .prop('readonly', false)
        $(this)
          .find('button[type=submit]')
          .prop('disabled', false)
      })
  })

  $('form[name=frmRegister]').submit(function(e) {
    e.preventDefault()

    $(this)
      .find('input')
      .prop('readonly', true)
    $(this)
      .find('button[type=submit]')
      .prop('disabled', true)

    swal({
      title: 'Please wait...',
      onOpen: () => {
        swal.showLoading()
      }
    })

    $.ajax({
      context: this,
      type: 'POST',
      data: $(this).serialize(),
      dataType: 'json'
    })
      .done(function(response) {
        swal.close()
        if (response.success) {
          swal({
            title: 'Success',
            type: 'success',
            text: 'Successful Registration! Kindly check your email for your Entrance QR Code.'
          }).then(function() {
            location.reload()
          })
        } else {
          if (response.error.errorInfo && response.error.errorInfo[1] == 1062) {
            swal('Warning', 'Already Exists!', 'warning')
          } else {
            swal('Error', 'There was an error.', 'error')
            console.log(response.error)
          }
        }
      })
      .always(function() {
        $(this)
          .find('input')
          .prop('readonly', false)
        $(this)
          .find('button[type=submit]')
          .prop('disabled', false)
      })
  })

  $('.btnDelete').click(function() {
    let code = $(this).data('code')
    $('#verifyPasswordModal')
      .find('input[name=code]')
      .val(code)
    $('#verifyPasswordModal')
      .find('input[name=type]')
      .val('delete')
    $('#verifyPasswordModal')
      .find('button[type=submit]')
      .text('DELETE')
    $('#verifyPasswordModal').modal('open')
    $('#verifyPasswordModal')
      .find('input[name=password]')
      .focus()
  })

  let dTable = $('.datatable').DataTable({
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
    order: [[0, $('.datatable').data('sort') == 'desc' ? 'desc' : 'asc']]
  })
})
