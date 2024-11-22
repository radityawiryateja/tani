<?php $this->load->view('js/utils/bufferHandler') ?>

<script>
    $('input[name="image"]').on('change', e => {
		const src = URL.createObjectURL( e.target.files[0] )

		hideUpload(src)
	})

	const chooseImage = () => {
		$('#custom-image-selector').click()
	}

	const hideUpload = (imgSource) => {
		$('#img_preview').removeClass('d-none')
		$('#img_preview').addClass('d-flex')

		$( '#img_preview img' ).attr( 'src', imgSource )

		$('#img_selector_wrapper').addClass('d-none')
	}

	const showUpload = () => {
		$('#img_preview').removeClass('d-flex')
		$('#img_preview').addClass('d-none')

		$('input[name="image"]').val('')
		$( '#img_preview img' ).attr( 'src', '#' )

		$('#img_selector_wrapper').removeClass('d-none')
	}

	const deleteImage = ({path, image, table, field}) => {
		
		if (image != '#') {
			Swal.fire({
				title: 'Apa kamu yakin?',
				text: 'Gambar akan dihapus!',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Batal',
				confirmButtonText: 'Ya!'
			}).then((result) => {
				if (result.isConfirmed) {
					showLoading()
	
					$.post('<?= base_url() . 'utils/ImageHandler/delete_image' ?>', {
						path,
						image,
						table,
						field
					}, response => {
						if (response.status) {
							Swal.fire({
								icon: 'success',
								text: response.message,
								showConfirmButton: false,
								timer: 1300
							})
	
							showUpload()
						} else {
							Swal.fire({
								icon: 'error',
								text: response.message,
								showConfirmButton: true
							})
						}
					}, 'json')
						.fail(error => {
							Swal.fire({
								icon: 'error',
								text: 'Terjadi kesalahan saat memuat data, coba lagi nanti!',
								showConfirmButton: true
							})
						})
				}
			})
		} else {
			showUpload()
		}
	}
</script>