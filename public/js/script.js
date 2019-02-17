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
  $('select')
    .not('[name="companion_batch[]"]')
    .formSelect()
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
    let isCompanions = $(this).data('type') == 'with-companions'

    if (!isCompanions) {
      let numberOfCompanions = $(this)
        .find('input[name=number_of_companions]')
        .val()

      if (
        !$(this)
          .find('input[name=terms]')
          .prop('checked')
      ) {
        alert('Please check the terms.')
        return
      }

      if (numberOfCompanions > 0) {
        $('.fields-content').html(null)
        for (var i = 1; i <= numberOfCompanions; i++) {
          $('.fields-content').append(
            "<div class='divider'></div>" +
              $('.template')
                .html()
                .replace(/\{id\}/g, i)
          )
        }
        $('.fields-content')
          .find('select')
          .formSelect()
        $('#companionsModal').modal('open')
        return
      }
    }

    $(this)
      .find('input')
      .prop('readonly', true)
    $(this)
      .find('button[type=submit]')
      .prop('disabled', true)

    let form_data = isCompanions
      ? {
          ...$(this).serializeJSON(),
          ...$('form[name=frmRegister]:not([data-type=with-companions])').serializeJSON()
        }
      : $(this).serializeJSON()

    swal({
      title: 'Please wait...',
      onOpen: () => {
        swal.showLoading()
      }
    })

    $.ajax({
      context: this,
      type: 'POST',
      data: form_data,
      dataType: 'json'
    })
      .done(function(response) {
        swal.close()
        if (response.success) {
          swal({
            title: 'Success',
            type: 'success',
            text:
              "You have successfully completed your registration. Kindly check your registered email for the next instructions. If you haven't received any email from us, kindly notify us by calling (02)735-6975."
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

  $('input[name=image_reference]').change(function() {
    var reader = new FileReader()
    reader.onload = e => {
      $('.image-container').html(`<img src="${e.target.result}" style="width:100%;height:100%">`)
    }
    reader.readAsDataURL(this.files[0])
  })

  $('form[name=frmUpload]').submit(function(e) {
    e.preventDefault()

    let form_data = new FormData()
    form_data.append(
      'code',
      $(this)
        .find('input[name=code]')
        .val()
    )
    form_data.append('file', $('input[name=image_reference]').prop('files')[0])
    form_data.append('data', $(this).serialize())

    $(this)
      .find('button[type=submit]')
      .prop('disabled', true)

    swal({
      title: 'Uploading...',
      onOpen: () => {
        swal.showLoading()
      }
    })

    $.ajax({
      context: this,
      type: 'POST',
      data: form_data,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(response) {
        swal.close()
        if (response.success == true) {
          location.href = main_url + '/upload/success'
        } else {
          swal('Error!', response.error, 'error')
        }
      }
    }).always(function() {
      $(this)
        .find('button[type=submit]')
        .prop('disabled', false)
    })
  })

  $('.btnSendTicket').click(function() {
    let code = $(this).data('code')
    $('#verifyPasswordModal')
      .find('input[name=code]')
      .val(code)
    $('#verifyPasswordModal')
      .find('input[name=type]')
      .val('ticket')
    $('#verifyPasswordModal')
      .find('button[type=submit]')
      .text('SEND')
    $('#verifyPasswordModal').modal('open')
    $('#verifyPasswordModal')
      .find('input[name=password]')
      .focus()
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

  $('.btnResendPayment').click(function() {
    let code = $(this).data('code')

    swal({
      title: 'Are you sure do you want to resend the payment instructions?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#26a69a',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    }).then(result => {
      if (result.value) {
        swal({
          title: 'Sending...',
          allowOutsideClick: false,
          allowEscapeKey: false,
          onOpen: () => {
            swal.showLoading()
          }
        })

        $.ajax({
          url: main_url + '/mailer/steps',
          data: { code },
          dataType: 'json',
          success: function(response) {
            swal.close()
            if (response.success == true) {
              swal('Email sent!', null, 'success')
            } else {
              swal('Error', response.error, 'error')
            }
          }
        })
      }
    })
  })

  $('.btnMarkAsPaid').click(function() {
    let code = $(this).data('code')

    swal({
      title: 'Are you sure do you want to mark it as paid?',
      type: 'warning',
      input: 'text',
      showCancelButton: true,
      confirmButtonColor: '#26a69a',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    }).then(result => {
      if (result.dismiss == 'cancel') return

      swal({
        title: 'Please wait...',
        onOpen: () => {
          swal.showLoading()
        }
      })

      $.ajax({
        context: this,
        type: 'POST',
        url: main_url + '/user/paid',
        data: { code, remarks: result.value },
        dataType: 'json'
      }).done(function(response) {
        swal.close()
        if (response.success == true) {
          swal('Marked as Paid!', null, 'success').then(() => {
            location.reload()
          })
        } else {
          alert(response.error)
        }
      })
    })
  })

  $('.btnUploadPicture').click(function() {
    window.selectedCode = $(this).data('code')
    $('input[name=image_upload]').click()
  })

  $('input[name=image_upload]').change(function() {
    if (!confirm('Uploading will replace the old one. Continue?')) return

    let form_data = new FormData()

    form_data.append('file', $(this).prop('files')[0])
    form_data.append('code', selectedCode)

    $(this).prop('disabled', true)

    swal({
      title: 'Uploading...',
      onOpen: () => {
        swal.showLoading()
      }
    })

    $.ajax({
      context: this,
      type: 'POST',
      url: main_url + '/upload',
      data: form_data,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(response) {
        swal.close()
        if (response.success == true) {
          swal('Uploaded', null, 'success').then(() => {
            location.reload()
          })
        } else {
          swal('Error!', response.error, 'error')
        }
      }
    }).always(function() {
      $(this).prop('disabled', false)
    })
  })

  $('form[name=frmVerifyPassword]').submit(function(e) {
    e.preventDefault()

    let type = $(this)
      .find('input[name=type]')
      .val()
    let button = $(this).find('button[type=submit]')
    let html = button.html()

    $(this)
      .find('button')
      .prop('disabled', true)
    button.html("<i class='material-icons left'>loop</i> " + (type == 'ticket' ? 'SENDING' : 'DELETING') + '...')

    swal({
      title: type == 'ticket' ? 'Sending...' : 'Deleting...',
      onOpen: () => {
        swal.showLoading()
      }
    })

    $.ajax({
      context: this,
      type: 'POST',
      url: main_url + (type == 'ticket' ? '/mailer/ticket' : '/user/delete'),
      data: $(this).serialize(),
      dataType: 'json',
      statusCode: {
        401: function(response) {
          swal.close()
          swal('Warning', 'Invalid Password.', 'warning')
          $(this)
            .find('input[name=password]')
            .focus()
        }
      }
    })
      .done(function(response) {
        swal.close()
        if (response.success == true) {
          swal(type == 'ticket' ? 'Ticket Sent!' : 'Deleted Successfully!', null, 'success').then(() => {
            if (type == 'ticket') {
              $(this).trigger('reset')
              $('#verifyPasswordModal').modal('close')
            } else {
              location.reload()
            }
          })
        } else {
          alert(response.error)
        }
      })
      .always(function() {
        $(this)
          .find('button')
          .prop('disabled', false)
        button.html(html)
      })
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

function showGuestInfo(id) {
  let modal = $('#viewGuestInfoModal')

  modal.modal('open')

  $.ajax({
    url: main_url + '/user/' + id,
    dataType: 'json'
  }).done(function(response) {
    modal.find('input[name=reference_number]').val(response.reference_number)
    modal.find('input[name=email_address]').val(response.email_address)
    modal.find('input[name=first_name]').val(response.first_name)
    modal.find('input[name=middle_initial]').val(response.middle_initial)
    modal.find('input[name=last_name]').val(response.last_name)
    modal.find('input[name=nickname]').val(response.nickname)
    modal.find('input[name=contact_number]').val(response.contact_number)
    modal.find('input[name=company]').val(response.company)
    modal.find('input[name=job_title]').val(response.job_title)
    modal.find('input[name=batch]').val(response.batch)

    M.updateTextFields()
  })

  $.ajax({
    url: main_url + '/user/' + id + '/companions',
    dataType: 'json'
  }).done(function(response) {
    response.forEach(function(companion, index) {
      modal.find('.modal-content').append(
        "<div class='divider'></div>" +
          $('.template')
            .html()
            .replace(/\{id\}/g, index)
      )
      modal.find('input#companion_reference_number_' + index).val(companion.reference_number)
      modal.find('input#companion_email_address_' + index).val(companion.email_address)
      modal.find('input#companion_first_name_' + index).val(companion.first_name)
      modal.find('input#companion_middle_initial_' + index).val(companion.middle_initial)
      modal.find('input#companion_last_name_' + index).val(companion.last_name)
      modal.find('input#companion_nickname_' + index).val(companion.nickname)
      modal.find('input#companion_company_' + index).val(companion.company)
      modal.find('input#companion_job_title_' + index).val(companion.job_title)
      modal.find('input#companion_batch_' + index).val(companion.batch)

      M.updateTextFields()
    })
  })
}
