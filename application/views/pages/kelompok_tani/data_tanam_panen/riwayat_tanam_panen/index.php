<!-- modal -->
<div class="modal fade" id="modal-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-label"></h1>
            </div>
            <form id="form">
                <div class="modal-body">
                    <input type="text" class="d-none" name="id">

					<div class="mb-3">
						<label for="id_anggota_kel_tani" class="form-label">Pilih Anggota Kelompok Tani <span class="text-danger">*</span></label>
						<select class="form_control" id="id_anggota_kel_tani" name="id_anggota_kel_tani">
						</select>

						<input type="hidden" name="id_anggota_kel_tani" id="id_anggota_kel_tani_hidden">
					</div>
					
                    <div class="mb-3">
						<label for="luas_tanam" class="form-label">Luas Tanam <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="luas_tanam" name="luas_tanam" placeholder="Masukkan jumlah luas tanam">
                    </div>

                    <div class="mb-3">
                        <label for="tgl_tanam" class="form-label">Tanggal Tanam <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tgl_tanam" name="tgl_tanam" placeholder="Masukkan tanggal tanam">
                    </div>

					<div class="mb-3">
                        <label for="estimasi_tgl_panen" class="form-label">Estimasi Tanggal Panen <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="estimasi_tgl_panen" name="estimasi_tgl_panen" placeholder="Masukkan estimasi tanggal panen">
                    </div>

					<div class="mb-3">
                        <label for="tgl_panen" class="form-label">Tanggal Panen <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tgl_panen" name="tgl_panen" placeholder="Masukkan tanggal panen">
                    </div>

					<div class="mb-3">
                        <label for="luas_panen" class="form-label">Luas Panen <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="luas_panen" name="luas_panen" placeholder="Masukkan luas panen">
                    </div>

					<div class="mb-3">
                        <label for="total_produksi" class="form-label">Total Produksi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="total_produksi" name="total_produksi" placeholder="Masukkan total produksi">
                    </div>

					<div class="mb-3">
                        <label for="harga_bersih" class="form-label">Harga Bersih <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="harga_bersih" name="harga_bersih" placeholder="Masukkan harga bersih">
                    </div>

					<div class="mb-3">
                        <label for="harga_kotor" class="form-label">Harga Kotor <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="harga_kotor" name="harga_kotor" placeholder="Masukkan harga kotor">
                    </div>

					<div class="mb-3">
                        <label for="harga_borongan" class="form-label">Harga Borongan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="harga_borongan" name="harga_borongan" placeholder="Masukkan harga borongan">
                    </div>

					<input type="hidden" name="status" id="status_hidden" value="Belum Panen">
					
					<div class="mb-3">
						<label for="status" class="form-label">Status <span class="text-danger">*</span></label>
						<select class="form-select" id="status" name="status">
							<option value="Belum Panen" disabled>Belum Panen</option>
							<option value="Sudah Panen">Sudah Panen</option>
							<option value="Gagal Panen">Gagal Panen</option>
						</select>
					</div>
                </div>

                <div class="modal-footer">
					<button id="cancel-btn" type="button" class="btn btn-danger" data-bs-dismiss="modal">
						Tutup
                    </button>
                    <button id="submit-btn" type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<header class="mb-3">
    <div class="row">
        <div class="col-md-8">
            <h1 class="fw-bold">Data Tanam Panen</h1>
            <p>Pengelolaan data tanam dan panen anggota kelompok tani</p>

			<!-- breadcrum -->
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb p-0">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
					<li class="breadcrumb-item active" aria-current="page">Data Tanam Panen</li>
				</ol>
			</nav>
        </div>
        <?php if ($_SESSION['akses']->m_kel_tani == 1) : ?>
            <div class="col-md-4 text-md-end">
                <button onclick="createNewData()" class="btn btn-primary"><i class="ph ph-plus-circle fs-4 align-middle me-1"></i>
                    <span class="align-middle">Tambah data tanam</span>
				</button>
            </div>
        <?php endif; ?>
    </div>
</header>

<div class="card shadow-sm">
    <div class="card-body">
        <!-- table -->
		<ul class="nav nav-tabs mb-3">
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('kelompok_tani/input_tanam_panen') ?>">Input Tanam Panen</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="<?= base_url('kelompok_tani/riwayat_tanam_panen') ?>">Riwayat Tanam Panen</a>
			</li>
		</ul>

        <div class="filters d-flex flex-md-row flex-column mb-4">
            <div class="d-flex flex-grow-1 justify-content-md-between me-md-3 mb-md-0 mb-3">
                <select class="form-select per-page me-2" name="per-page">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>

                <select class="form-select search-filter" name="search-by">
                    <option value="kel_tani.nama">Nama Kelompok Tani</option>
					<option value="anggota_kel_tani.nama">Nama Anggota Kelompok</option>
					<option value="kecamatan.nama">Nama Kecamatan</option>
					<option value="desa.nama">Nama Desa</option>
					<option value="anggota_kel_tani.status">Status</option>
                </select>
            </div>

            <input type="text" class="form-control search-bar ms-auto" name="keyword" placeholder="Cari data..." />
        </div>

        <div class="table-responsive">
            <table class="table table-striped text-nowrap align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" style="min-width: 60px" class="text-center align-middle">No</th>
                        <th scope="col" class="text-center align-middle" style="min-width: 120px">Aksi</th>
                        <th scope="col" style="min-width: 100px" class="align-middle">Nama Kelompok</th>
						<th scope="col" style="min-width: 100px" class="align-middle">Nama Anggota</th>
						<th scope="col" style="min-width: 100px" class="align-middle">Luas Tanam</th>
                        <th scope="col" style="min-width: 100px" class="align-middle">Tanggal Tanam</th>
						<th scope="col" style="min-width: 100px" class="align-middle">Tanggal Panen</th>
						<th scope="col" style="min-width: 100px" class="align-middle">Harga Bersih</th>
						<th scope="col" style="min-width: 100px" class="align-middle">Harga Kotor</th>
						<th scope="col" style="min-width: 100px" class="align-middle">Harga Borongan</th>
						<th scope="col" style="min-width: 100px" class="align-middle">Total Produksi</th>
						<th scope="col" style="min-width: 80px" class="text-center align-middle">Status</th>
                    </tr>
                </thead>
                <tbody id="table-result"></tbody>
            </table>
        </div>

        <!-- pagination button -->
        <nav id="pagination-wrapper"></nav>
    </div>
</div>

<?php $this->load->view('js/dataTable') ?>

<script>
    const config = {
        baseURL: '<?= base_url() . 'kelompok_tani/riwayat_tanam_panen/' ?>',
        table: {
            name: 'tabelRiwayatTanamPanen',
            columnTotal: 12,
        },
        formConfig: {
            afterSuccess: response => {
                dataTableInitializer.reload.tabelRiwayatTanamPanen(0)
            }
        },
        sanitize: {
            numberOnly: true
        },
    }

    config.table.renderContent = (data, i) => {
        return data.map((val) => {
            i++

            let status = ''
            let editButton = ''
            let deleteButton = ''
			
			if (val.status == 'Belum Panen') {
				status = `<span class="badge text-bg-primary">${val.status}</span>`
			} else if (val.status == 'Sudah Panen') {
				status = `<span class="badge text-bg-success">${val.status}</span>`
			} else if (val.status == 'Gagal Panen') {
				status = `<span class="badge text-bg-danger">${val.status}</span>`
			}

            <?php if ($_SESSION['akses']->m_kel_tani == 1) : ?>
                editButton += `
                    <button onclick="editData('${config.baseURL + 'edit'}', ${val.id})" type="button" class="btn btn-warning">
                        <i class="ph ph-pencil fs-5 align-middle"></i>
                    </button>
                `
            <?php endif; ?>

            <?php if ($_SESSION['akses']->m_kel_tani == 1) : ?>
                deleteButton +=
                    `<button onclick="deleteRow('${config.baseURL + 'delete'}', ${val.id})" type="" class="btn btn-danger">
                        <i class="ph ph-trash fs-5 align-middle"></i>
                    </button>
                `
            <?php endif; ?>

            return `
                <tr>
                    <th scope="row" class="text-center">${i}</th>
                    <td class="text-center">${editButton + deleteButton}</td>
                    <td>${val.nama_kel_tani ? val.nama_kel_tani : '-'}</td>
					<td>${val.nama_anggota ? val.nama_anggota : '-'}</td>
					<td>${val.luas_tanam ? val.luas_tanam : '-'}</td>
					<td>${val.tgl_tanam ? val.tgl_tanam : '-'}</td>
					<td>${val.tgl_panen ? tgl_panen : '-'}</td>
					<td>${val.total_produksi ? val.total_produksi : '-'}</td>
					<td>${val.harga_bersih ? val.harga_bersih : '-'}</td>
					<td>${val.harga_kotor ? val.harga_kotor : '-'}</td>
					<td>${val.harga_borongan ? val.harga_borongan : '-'}</td>
					<td class="text-center">${status}</td>
                </tr>
            `
        }).join('')
    }

    dataTableInitializer.init(config)
</script>

<!-- user select function -->
<script>
	const selectUser = () => {
		$('#id_anggota_kel_tani').select2({
			theme: 'bootstrap-5',
			placeholder: 'Pilih Anggota Kelompok Tani',
			allowClear: true,
			ajax: {
				url: '<?= base_url("anggota_kelompok_tani/search") ?>',
				type: 'POST',
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return { search: params.term };
				},
				processResults: function(data) {
					return {
						results: data.map(item => ({
							id: item.id,
							nama: item.nama,
							kelompok_tani: item.kelompok_tani,
							desa: item.desa,
							kecamatan: item.kecamatan
						}))
					};
				}
			},
			escapeMarkup: function(markup) {
				return markup;
			},
			templateResult: function(data) {
				if (!data.nama) {
					return data.text;
				}
				return `
					<div class="d-flex align-items-center py-2">
						<i class="ph ph-user fs-1 me-3"></i>
						<div>
							<p class="mb-0 fw-bold">${data.nama}</p>
							<small>${data.kelompok_tani}, ${data.kecamatan}</small>
						</div>
					</div>
				`;
			},
			templateSelection: function(data) {
				if (!data.nama) {
					return data.text;
				}
				return data.nama;
			},
			dropdownParent: $("#modal-form")
		});
	}
</script>

<!-- action handler -->
<script>
    const editData = (requestURL, id) => {
		showLoading()
		$.get(requestURL, {
			id
		}, response => {
			hideLoading()
			openModal({
				state: 'update',
				modalContext: 'Data Tanam',
				onUpdateOpen: () => {
					selectUser()

					let selectedOption = new Option(
						response.nama_anggota, 
						response.id_anggota_kel_tani, 
						true, 
						true 
					);
					
					$('#id_anggota_kel_tani').append(selectedOption).trigger('change');

					$('input[name="id"]').val(response.id);
					$('#id_anggota_kel_tani, #id_anggota_kel_tani_hidden').val(response.id_anggota_kel_tani);
					$('#luas_tanam').val(response.luas_tanam);
					$('#tgl_tanam').val(response.tgl_tanam);
					$('#estimasi_tgl_panen').val(response.estimasi_tgl_panen);
					$('#tgl_panen').val(response.tgl_panen);
					$('#luas_panen').val(response.luas_panen);
					$('#total_produksi').val(response.total_produksi);
					$('#harga_bersih').val(response.harga_bersih);
					$('#harga_kotor').val(response.harga_kotor);
					$('#harga_borongan').val(response.harga_borongan);
					$('#status, #status_hidden').val(response.status);
					$('label[for="password"] span.text-danger').hide();

					$('#id_anggota_kel_tani').removeAttr('disabled');
					$('#id_anggota_kel_tani_hidden').attr('disabled', true);

					$('#luas_tanam, #tgl_tanam, #estimasi_tgl_panen, #status_hidden')
					.removeAttr('disabled').removeAttr('hidden')
					.prev('label').removeAttr('hidden');
				}
			})
		}, 'json')
		.fail(() => {
			Swal.fire({
				icon: 'error',
				text: 'Terjadi kesalahan saat memuat data, coba lagi nanti!',
				showConfirmButton: true
			})
		});

    }

    const createNewData = () => {
        openModal({
			modalContext: 'Data Tanam',
            beforeModalShow: () => {
				selectUser()
			
				$('label[for="password"] span.text-danger').show()

				$('#id_anggota_kel_tani').removeAttr('disabled');
				$('#id_anggota_kel_tani_hidden').attr('disabled', true);

				$('#luas_tanam, #tgl_tanam, #estimasi_tgl_panen, #status_hidden')
				.removeAttr('disabled').removeAttr('hidden')
				.prev('label').removeAttr('hidden');

				$('#tgl_panen, #luas_panen, #total_produksi, #harga_bersih, #harga_kotor, #harga_borongan, #status')
    			.attr({ disabled: true, hidden: true })
				.prev('label').attr('hidden', true);;
			}
        })
    }

    const deleteRow = (requestURL, id) => {
        Swal.fire({
            title: 'Apa kamu yakin?',
            text: 'Data akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading()

                $.post(requestURL, {
                        id
                    }, response => {
                        if (response.status) {
                            hideLoading()

                            Swal.fire({
                                icon: 'success',
                                text: response.message,
                                showConfirmButton: true,
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: response.message,
                                showConfirmButton: true,
                            })
                        }
                    }, 'json')
                    .always(() => {
                        dataTableInitializer.reload.tabelRiwayatTanamPanen(0)
                    })
                    .fail(() => {
                        Swal.fire({
                            icon: 'error',
                            text: 'Terjadi kesalahan saat memuat data, coba lagi nanti!',
                            showConfirmButton: true
                        })
                    })
            }
        })
    }
</script>

<?php $this->load->view('js/utils/formSanitizeHandler') ?>
<?php $this->load->view('js/singlePageCRUD') ?>
