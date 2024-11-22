<script>
  const save = ({
    url = null,
    form = '#form',
    withModal = true,
    submitBtn = '#submit-btn',
    submitBtnText = 'Simpan',
    cancelBtn = '#cancel-btn',
    dataToSubmit = function() {
      return new FormData( $(`${form}`)[0] )
    },
    onSuccess = response => {
      if (withModal) {
        const modalId = '#' + $(`${form}`).closest('.modal').attr('id')
        closeModal(modalId)
  
        Swal.fire({
          icon: 'success',
          text: response.message,
          showConfirmButton: true
        })
      } else {
        Swal.fire({
          icon: 'success',
          text: response.message,
          showConfirmButton: false,
          timer: 1300
        })
      }
    },
    onFailed = response => {
      if (response.hasOwnProperty('messages')) {
        displayTheErrors(response.messages, errorExceptions)
      } else {
        Swal.fire({
          icon: 'error',
          text: response.message,
          showConfirmButton: true
        })
      }
    },
    afterSuccess = null,
    afterFailed = null,
    errorExceptions = []
  } = {}) => {
    $(`${form}`).on('submit', e => {
      if (!e.isDefaultPrevented()) {
        const buttons = {
          submitBtn,
          submitBtnText,
          cancelBtn
        }

        freezeFormFunctionality(buttons)

        const data = dataToSubmit()

        $.ajax({
          url,
          data,
          method: 'POST',
          processData: false,
          contentType: false,
          cache: false,
          dataType: 'json',
          success: response => {
            hideLoading()
            
            if (response.status) {

              onSuccess(response)

              if (afterSuccess) {
                if (withModal) {
                  afterSuccess(response)
                } else {
                  setTimeout(() => {
                    afterSuccess(response)
                  }, 1500)
                }
              }
            } else {
              onFailed(response)

              if (afterFailed) {
                afterFailed(response)
              }
            }
          },
          error: () => {
            Swal.fire({
              icon: 'error',
              text: 'Terjadi kesalahan saat memuat data, coba lagi nanti!',
              showConfirmButton: true
            })
          }
        })
          .always(() => {
            enableSubmitBtn(buttons)
          })
      }

      return false
    })
  }

  const freezeFormFunctionality = buttons => {
		disableSubmitBtn(buttons)
		showLoading()
	}

	const disableSubmitBtn = buttons => {
    if (buttons.cancelBtn) {
      const cancelBtn = $(`${buttons.cancelBtn}`)

      cancelBtn.attr('disabled', true)
    }

    if (buttons.submitBtn) {
      const submitBtn = $(`${buttons.submitBtn}`)
      const spinner = `
        <span class="spinner-border me-1 spinner-border-sm" aria-hidden="true"></span>
        <span role="status">Memproses...</span>`
  
      submitBtn.attr('disabled', true)
      submitBtn.html(spinner)
    }
	}

	const enableSubmitBtn = buttons => {
		if (buttons.cancelBtn) {
      const cancelBtn = $(`${buttons.cancelBtn}`)

      cancelBtn.attr('disabled', false)
    }
    
    if (buttons.submitBtn) {
      const submitBtn = $(`${buttons.submitBtn}`)

      submitBtn.attr('disabled', false)

      if (buttons.submitBtnText) {
        submitBtn.html(buttons.submitBtnText)
      } else {
        submitBtn.html('Simpan')
      }
    }
	}
</script>