<script>
  // modal autofocus handler
  $(document).ready(() => {
		$('.modal').on('shown.bs.modal', function() {
			$(this).find('[autofocus]').focus();
		})
	})

	const openModal = ({
		modal = '#modal-form',
		modalType = 'form',
		modalTitle = '',
		modalContext = '',
		form = '#form',
		state = 'insert',
		onInsertOpen = null,
		onUpdateOpen = null,
		beforeModalShow = null
	} = {}) => {
		const _modal = $(`${modal}`)
		let title

		if (modalType === 'form') {
			prepareModal(form, state)

			if (state === 'insert') {
				if (onInsertOpen) {
					onInsertOpen()
				}
			} else if (state === 'update') {
				if (onUpdateOpen) {
					onUpdateOpen()
				}
			} else {
				console.error('state tidak valid')

				return
			}

			if (modalTitle) {
				title = modalTitle
			} else {
				switch (state) {
					case 'insert':
						title = `Tambah ${modalContext ? modalContext : 'Data'}`
						
						break
					case 'update':
						title = `Edit ${modalContext ? modalContext : 'Data'}`
						
						break
					default:
						console.error('state tidak valid')
	
						return
				}
			}
		} else if (modalType === 'standard') {
			title = modalTitle
		} else {
			console.error('modalType tidak valid!')

			return
		}

		if (beforeModalShow) {
			beforeModalShow()
		}

		_modal.find('.modal-title').text(title)
		_modal.modal('show')
	}

	const closeModal = (modal = '#modal-form') => {
		const _modal = $(`${modal}`) 
		_modal.modal('hide')
	}

	const prepareModal = (form, state) => {
		$(`${form}`)[0].reset()
		
		$('input, select, textarea').each(function () {
			removeErrorMessage(this)
		})

		$('input[type="radio"]').each(function () {
			const parent = $(this).closest('.radio-input-wrapper');
			removeErrorMessage(parent.find('.radio-error-indicator')[0])
		})

		if (state === 'insert') {
			$('.optional-on-update').each((i, el) => {
				$(el).show()
			})
		} else if (state === 'update') {
			$('.optional-on-update').each((i, el) => {
				$(el).hide()
			})
		} else {
			console.error('state tidak valid')
		}
	}
</script>