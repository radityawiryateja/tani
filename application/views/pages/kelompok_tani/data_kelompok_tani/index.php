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
						<label for="id_kecamatan" class="form-label">Kecamatan <span class="text-danger">*</span></label>
						<select class="form-select" id="id_kecamatan" name="id_kecamatan">
							<option value="" selected disabled>Pilih Kecamatan</option>
							<?php
							$kecamatan = $this->db->get('kecamatan')->result();
							foreach ($kecamatan as $row) { ?>
								<option value="<?= $row->id ?>"><?= $row->nama ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="mb-3">
						<label for="id_desa" class="form-label">Desa <span class="text-danger">*</span></label>
						<select class="form-select" id="id_desa" name="id_desa">
							<option value="" selected disabled>Pilih Desa</option>
						</select>
					</div>

                    <div class="mb-3">
                        <label for="nama_kel_tani" class="form-label">Nama Kelompok Tani <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_kel_tani" name="nama_kel_tani" placeholder="Masukkan nama kelompok tani" autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor HP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan nomor hp">
                    </div>

					<div class="mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat">
                    </div>

					<div class="mb-3">
                        <label for="koordinat" class="form-label">Titik Koordinat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="koordinat" name="koordinat" placeholder="Masukkan koordinat">
                    </div>

					<div class="mb-3">
                        <label for="ketua" class="form-label">Nama Ketua <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="ketua" name="ketua" placeholder="Masukkan nama ketua kelompok tani">
                    </div>

					<div class="mb-3">
                        <label for="sekretaris" class="form-label">Nama Sekretaris <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sekretaris" name="sekretaris" placeholder="Masukkan nama sekretaris kelompok tani">
                    </div>

					<div class="mb-3">
                        <label for="bendahara" class="form-label">Nama Bendahara <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="bendahara" name="bendahara" placeholder="Masukkan nama bendahara kelompok tani">
                    </div>

					<div class="mb-3">
						<label for="pemasaran" class="form-label">Cara Pemasaran</label>
						<select class="select2 form-select" id="pemasaran" name="pemasaran[]" multiple="multiple">
							<option value="lokal">Lokal</option>
							<option value="ekspor">Ekspor</option>
						</select>
					</div>
					
					
					<div class="mb-3">
						<label for="no_sk_pengukuhan" class="form-label">Nomor SK Pengukuhan</label>
						<input type="text" class="form-control" id="no_sk_pengukuhan" name="no_sk_pengukuhan" placeholder="Masukkan nomor SK pengukuhan">
					</div>

					<div class="mb-3">
						<label for="exp_sk_pengukuhan" class="form-label">Tanggal Kadaluarsa SK Pengukuhan</label>
						<input type="date" class="form-control" id="exp_sk_pengukuhan" name="exp_sk_pengukuhan" placeholder="Masukkan tanggal kadaluarsa SK pengukuhan">
					</div>

					<div class="mb-3">
						<label for="sk_pengukuhan" class="form-label">File SK Pengukuhan</label>
						<input type="file" class="form-control" id="sk_pengukuhan" name="sk_pengukuhan" placeholder="Pilih file SK pengukuhan">
					</div>

					<div class="mb-3">
						<label for="no_sk_terdaftar" class="form-label">Nomor SK Terdaftar</label>
						<input type="text" class="form-control" id="no_sk_terdaftar" name="no_sk_terdaftar" placeholder="Masukkan nomor SK terdaftar">
					</div>

					<div class="mb-3">
						<label for="exp_sk_terdaftar" class="form-label">Tanggal Kadaluarsa SK Terdaftar</label>
						<input type="date" class="form-control" id="exp_sk_terdaftar" name="exp_sk_terdaftar" placeholder="Masukkan tanggal kadaluarsa SK terdaftar">
					</div>
					
					<div class="mb-3">
						<label for="sk_terdaftar" class="form-label">File SK Terdaftar</label>
						<input type="file" class="form-control" id="sk_terdaftar" name="sk_terdaftar" placeholder="Pilih file SK terdaftar">
					</div>

					<div class="mb-3">
						<label for="status" class="form-label">Status Aktif</label>
						<select class="form-select" id="status" name="status">
							<option value="1">Aktif</option>
							<option value="0">Tidak Aktif</option>
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
            <h1 class="fw-bold">Daftar Kelompok Tani</h1>
            <p>Pengelolaan data kelompok tani</p>
        </div>
        <?php if ($_SESSION['akses']->m_kel_tani == 1) : ?>
            <div class="col-md-4 text-md-end">
                <button onclick="createNewData()" class="btn btn-primary"><i class="ph ph-plus-circle fs-4 align-middle me-1"></i>
                    <span class="align-middle">Tambah kelompok tani</span>
				</button>
            </div>
        <?php endif; ?>
    </div>
</header>

<div class="custom-card shadow-sm">
    <div class="card-body">
        <!-- table -->
        <small class="text-secondary">Tabel</small>
        <hr class="text-secondary mt-2 mb-4" />

        <div class="filters d-flex flex-md-row flex-column mb-4">
            <div class="d-flex flex-grow-1 justify-content-md-between me-md-3 mb-md-0 mb-3">
                <select class="form-select per-page me-2" name="per-page">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>

                <select class="form-select search-filter" name="search-by">
					<option value="kecamatan.nama">Nama Kecamatan</option>
					<option value="desa.nama">Nama Desa</option>
                    <option value="kel_tani.nama">Nama Kelompok Tani</option>
					<option value="kel_tani.ketua">Nama Ketua</option>
					<option value="kel_tani.sekretaris">Nama Sekretaris</option>
					<option value="kel_tani.bendahara">Nama Bendahara</option>
					<option value="kel_tani.pemasaran">Cara Pemasaran</option>
                </select>
            </div>

            <input type="text" class="form-control search-bar ms-auto" name="keyword" placeholder="Cari data..." />
        </div>

        <div class="table-responsive">
            <table class="table table-striped text-nowrap align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" style="min-width: 60px" class="text-center">No</th>
						<!-- <th scope="col" style="min-width: 100px">Kecamatan</th>
						<th scope="col" style="min-width: 100px">Desa</th> -->
                        <th scope="col" style="min-width: 100px">Nama Kelompok Tani</th>
						<th scope="col" style="min-width: 100px">Nomor HP</th>
                        <th scope="col" style="min-width: 100px">Alamat</th>
                        <!-- <th scope="col" style="min-width: 100px">Koordinat</th> -->
						<th scope="col" style="min-width: 100px">Nama Ketua</th>
						<th scope="col" style="min-width: 100px">Nama Sekretaris</th>
						<th scope="col" style="min-width: 100px">Bendahara</th>
						<th scope="col" style="min-width: 100px">Cara Pemasaran</th>
						<th scope="col" style="min-width: 80px">Preview SK Pengukuhan</th>
                        <th scope="col" style="min-width: 80px">Kadaluarsa SK Pengukuhan</th>
						<th scope="col" style="min-width: 80px">Preview SK Terdaftar</th>
						<th scope="col" style="min-width: 80px">Kadaluarsa SK Terdaftar</th>
						<th scope="col" style="min-width: 80px">Status</th>
                        <th scope="col" class="text-center" style="min-width: 80px">
                            Aksi
                        </th>
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
        baseURL: '<?= base_url() . 'kelompok_tani/data_kelompok_tani/' ?>',
        table: {
            name: 'tabelKelompokTani',
            columnTotal: 14,
        },
        formConfig: {
            afterSuccess: response => {
                dataTableInitializer.reload.tabelKelompokTani(0)
            }
        },
        sanitize: {
            numberOnly: true
        },
    }

    config.table.renderContent = (data, i) => {
        return data.map((val) => {
            i++

			let previewSkPengukuhan = ''
			let previewSkTerdaftar = ''
            let activeStatus = ''
            let editButton = ''
            let deleteButton = ''

            if (val.status == '0') {
                activeStatus = '<span class="badge text-bg-warning">Tidak Aktif</span>'
            } else {
                activeStatus = '<span class="badge text-bg-success">Aktif</span>'
            }

            <?php if ($_SESSION['akses']->m_kel_tani == 1) : ?>
                editButton += `
                    <button onclick="editData('${config.baseURL + 'edit'}', ${val.id})" type="button" class="btn btn-success">
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
                    <th scope="row" class="text-center"s>${i}</th>
                    <!-- <td>${val.kecamatan}</td> -->
                    <!-- <td>${val.desa}</td> -->
                    <td>${val.nama}</td>
					<td>${val.no_hp}</td>
					<td>${val.alamat}</td>
					<!-- <td>${val.koordinat}</td> -->
					<td>${val.ketua}</td>
					<td>${val.sekretaris}</td>
					<td>${val.bendahara}</td>
					<td>${val.pemasaran}</td>
					<td>${previewSkPengukuhan}</td>
					<td>${val.exp_sk_pengukuhan}</td>
					<td>${previewSkTerdaftar}</td>
					<td>${val.exp_sk_terdaftar}</td>

                    <td>${activeStatus}</td>
                    <td class="text-center">${editButton + deleteButton}</td>
                </tr>
            `
        }).join('')
    }

    dataTableInitializer.init(config)
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
				modalContext: 'Kelompok Tani',
				onUpdateOpen: () => {
					$('#pemasaran').select2({
						placeholder: "Pilih cara pemasaran",
						theme: "bootstrap-5",
						allowClear: true
					});

					$('input[name="id"]').val(response.id);
					$('#id_kecamatan').val(response.id_kecamatan);
					$('#id_desa').val(response.id_desa);
					$('#nama_kel_tani').val(response.nama);
					$('#no_hp').val(response.no_hp);
					$('#alamat').val(response.alamat);
					$('#koordinat').val(response.koordinat);
					$('#ketua').val(response.ketua);
					$('#sekretaris').val(response.sekretaris);
					$('#bendahara').val(response.bendahara);

					$('#no_sk_pengukuhan').val(response.no_sk_pengukuhan);
					$('#exp_sk_pengukuhan').val(response.exp_sk_pengukuhan);
					$('#no_sk_terdaftar').val(response.no_sk_terdaftar);
					$('#exp_sk_terdaftar').val(response.exp_sk_terdaftar);

					$('#pemasaran').val(response.pemasaran.split(',')).trigger('change');

					$('#status').val(response.status);
					$('label[for="password"] span.text-danger').hide();

					daerahHandler(response.id_kecamatan, response.id_desa);
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
		let desaDropdown = $('#id_desa');
		desaDropdown.empty();
		desaDropdown.append('<option value="" selected disabled>Pilih Desa</option>');

        openModal({
			modalContext: 'Kelompok Tani',
            beforeModalShow: () => {
				$('#pemasaran').select2({
					placeholder: "Pilih cara pemasaran",
					theme: "bootstrap-5",
					allowClear: true
				});

				$('label[for="password"] span.text-danger').show()

				daerahHandler();
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
                        dataTableInitializer.reload.tabelKelompokTani(0)
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

<!-- daerah handler -->
<script>
	function daerahHandler(id_kecamatan = null, id_desa = null) {
		showLoading();

		const requests = [];

		if (id_kecamatan) {
			requests.push(
				$.ajax({
					url: `<?= base_url('desa/get_desa_by_kecamatan/') ?>${id_kecamatan}`,
					type: 'GET',
					dataType: 'json',
					success: function (data) {
						var desaDropdown = $('#id_desa');
						desaDropdown.empty();
						desaDropdown.append('<option value="" selected disabled>Pilih Desa</option>');
						$.each(data, function (index, desa) {
							desaDropdown.append('<option value="' + desa.id + '">' + desa.nama + '</option>');
						});

						if (id_desa) {
							desaDropdown.val(id_desa);
						}
					}
				})
			);
		}

		Promise.all(requests)
			.then(() => hideLoading())
			.catch(() => {
				hideLoading();
				Swal.fire({
					icon: 'error',
					text: 'Terjadi kesalahan saat memuat data, coba lagi nanti!',
					showConfirmButton: true
				});
			});
	}

	$('#id_kecamatan').off('change').change(function () {
		var id_kecamatan = $(this).val();
		daerahHandler(id_kecamatan);

		var desaDropdown = $('#id_desa');
		desaDropdown.empty();
		desaDropdown.append('<option value="" selected disabled>Pilih Desa</option>');
	});
</script>

<?php $this->load->view('js/utils/formSanitizeHandler') ?>
<?php $this->load->view('js/singlePageCRUD') ?>
