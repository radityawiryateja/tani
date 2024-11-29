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

					<input type="hidden" class="d-none" name="id_pelaku_ubi_olahan" value="<?= $id_pelaku_ubi_olahan ?>">

                    <div class="mb-3">
						<label for="nama_anggota" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" placeholder="Masukkan nama anggota kelompok ubi olahan" autofocus>
                    </div>

					<div class="mb-3">
                        <label for="no_ktp" class="form-label">Nomor KTP / NIK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="Masukkan nomor KTP / NIK">
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor HP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan nomor hp">
                    </div>

					<div class="mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat">
                    </div>

					<!-- <div class="mb-3">
						<label for="id_kecamatan" class="form-label">Kecamatan <span class="text-danger">*</span></label>
						<select class="form-select" id="id_kecamatan" name="id_kecamatan" disabled>
							<option value="" selected disabled>Pilih Kecamatan</option>
							<?php
							$kecamatan = $this->db->get('kecamatan')->result();
							foreach ($kecamatan as $row) { ?>
								<option value="<?= $row->id ?>"><?= $row->nama ?></option>
							<?php } ?>
						</select>
					</div> -->

					<input type="hidden" class="d-none" name="id_kecamatan" id="id_kecamatan_hidden" value="<?= $pelaku_ubi_olahan->id_kecamatan ?>">
<!-- 
					<div class="mb-3">
						<label for="id_desa" class="form-label">Desa <span class="text-danger">*</span></label>
						<select class="form-select" id="id_desa" name="id_desa" disabled>
							<option value="" selected disabled>Pilih Desa</option>
						</select>
					</div> -->

					<input type="hidden" class="d-none" name="id_desa" id="id_desa_hidden" value="<?= $pelaku_ubi_olahan->id_desa ?>">

					<div>
						<div class="mb-3">
							<label for="koordinat" class="form-label">Titik Koordinat <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="koordinat" name="koordinat" placeholder="Pilih koordinat di peta" readonly>
						</div>

						<div class="mb-3">
							<div id="map" style="height: 200px;"></div>
						</div>
					</div>
					
					<div class="mb-3">
						<label for="sumber_bahan_baku" class="form-label">Sumber Bahan Baku</label>
						<select class="select2 form-select" id="sumber_bahan_baku" name="sumber_bahan_baku[]" multiple="multiple">
							<option value="petani">Petani</option>
							<option value="bandar">Bandar</option>
						</select>
					</div>

					<div class="mb-3">
						<label for="pemasaran" class="form-label">Cara Pemasaran</label>
						<select class="select2 form-select" id="pemasaran" name="pemasaran[]" multiple="multiple">
							<option value="lokal">Lokal</option>
							<option value="ekspor">Ekspor</option>
						</select>
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
            <h1 class="fw-bold">Daftar Anggota Kelompok <?= $pelaku_ubi_olahan->nama ?></h1>
            <p>Pengelolaan data anggota kelompok ubi olahan</p>

			<!-- breadcrum -->
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb p-0">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
					<li class="breadcrumb-item"><a href="<?= base_url('pelaku_usaha_ubi/ubi_olahan') ?>">Daftar Kelompok Ubi Olahan</a></li>
					<li class="breadcrumb-item active" aria-current="page">Anggota Kelompok Ubi Olahan <?= $pelaku_ubi_olahan->nama ?></li>
				</ol>
			</nav>
        </div>
        <?php if ($_SESSION['akses']->m_pelaku_ubi_olahan == 1) : ?>
            <div class="col-md-4 text-md-end">
                <button onclick="createNewData()" class="btn btn-primary"><i class="ph ph-plus-circle fs-4 align-middle me-1"></i>
                    <span class="align-middle">Tambah Anggota</span>
				</button>
            </div>
        <?php endif; ?>
    </div>
</header>

<div class="card shadow-sm">
    <div class="card-body">
        <!-- table -->
        <div class="filters d-flex flex-md-row flex-column mb-4">
            <div class="d-flex flex-grow-1 justify-content-md-between me-md-3 mb-md-0 mb-3">
                <select class="form-select per-page me-2" name="per-page">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>

                <select class="form-select search-filter" name="search-by">
                    <option value="pelaku_anggota_ubi_olahan.nama">Nama</option>
					<option value="pelaku_anggota_ubi_olahan.sumber_bahan_baku">Sumber Bahan Baku</option>
					<option value="pelaku_anggota_ubi_olahan.pemasaran">Cara Pemasaran</option>
					<option value="pelaku_anggota_ubi_olahan.alamat">Alamat</option>
                </select>
            </div>

            <input type="text" class="form-control search-bar ms-auto" name="keyword" placeholder="Cari data..." />
        </div>

        <div class="table-responsive">
            <table class="table table-striped text-nowrap align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" style="min-width: 60px" class="text-center align-middle">No</th>
                        <th scope="col" class="text-center align-middle" style="min-width: 80px" >Aksi</th>
                        <th scope="col" style="min-width: 100px" class="align-middle">Nama</th>
						<th scope="col" style="min-width: 100px" class="align-middle">Nomor KTP</th>
						<th scope="col" style="min-width: 100px" class="align-middle">Nomor HP</th>
                        <th scope="col" style="min-width: 100px" class="align-middle">Alamat</th>
						<th scope="col" style="min-width: 100px" class="text-center align-middle">Sumber Bahan Baku</th>
						<th scope="col" style="min-width: 100px" class="text-center align-middle">Cara Pemasaran</th>
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
        baseURL: '<?= base_url() . 'pelaku_usaha_ubi/data_anggota_kelompok_ubi_olahan/' ?>',
        table: {
            name: 'tabelAnggotaKelompokUbiOlahan',
            columnTotal: 9,
        },
        formConfig: {
            afterSuccess: response => {
                dataTableInitializer.reload.tabelAnggotaKelompokUbiOlahan(0)
            }
        },
        sanitize: {
            numberOnly: true
        },
    }

    config.table.renderContent = (data, i) => {
        return data.map((val) => {
            i++

            let activeStatus = ''
            let editButton = ''
            let deleteButton = ''
			let sumber_bahan_baku = val.sumber_bahan_baku ? val.sumber_bahan_baku.split(',') : []
			let pemasaran = val.pemasaran ? val.pemasaran.split(',') : []
			
			sumber_bahan_baku = sumber_bahan_baku.map((val) => {
				return `<span class="badge text-bg-primary">${val.charAt(0).toUpperCase() + val.slice(1)}</span>`
			}).join('&nbsp;')

			pemasaran = pemasaran.map((val) => {
				return `<span class="badge text-bg-primary">${val.charAt(0).toUpperCase() + val.slice(1)}</span>`
			}).join('&nbsp;')

            if (val.status == '0') {
                activeStatus = '<span class="badge text-bg-warning">Tidak Aktif</span>'
            } else {
                activeStatus = '<span class="badge text-bg-success">Aktif</span>'
            }

            <?php if ($_SESSION['akses']->m_pelaku_ubi_olahan == 1) : ?>
                editButton += `
                    <button onclick="editData('${config.baseURL + 'edit'}', ${val.id})" type="button" class="btn btn-warning">
                        <i class="ph ph-pencil fs-5 align-middle"></i>
                    </button>
                `
            <?php endif; ?>

            <?php if ($_SESSION['akses']->m_pelaku_ubi_olahan == 1) : ?>
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
                    <td>${val.nama ? val.nama : '-'}</td>
					<td>${val.no_ktp ? val.no_ktp : '-'}</td>
					<td>${val.no_hp ? val.no_hp : '-'}</td>
					<td>${val.alamat ? val.alamat : '-'}</td>
					<td class="text-center">${sumber_bahan_baku ? sumber_bahan_baku : '-'}</td>
					<td class="text-center">${pemasaran ? pemasaran : '-'}</td>

                    <td class="text-center">${activeStatus}</td>
                </tr>
            `
        }).join('')
    }

    dataTableInitializer.init(config)
</script>

<!-- map handler -->
<script>
	// Initialize the map with Jakarta as the default center
	let map = L.map('map').setView([-6.200000, 106.816666], 13);

	L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19
	}).addTo(map);

	let defaultIcon = L.icon({
		iconUrl: '<?= base_url("assets/plugin/leaflet/images/marker-icon.png"); ?>',
		shadowUrl: '<?= base_url("assets/plugin/leaflet/images/marker-shadow.png"); ?>',
		iconSize: [25, 41],
		iconAnchor: [12, 41],
		popupAnchor: [1, -34],
		shadowSize: [41, 41]
	});

	let marker = L.marker([-6.200000, 106.816666], {
		icon: defaultIcon,
		draggable: true
	}).addTo(map);

	marker.on('dragend', function (e) {
		let lat = e.target.getLatLng().lat.toFixed(6);
		let lng = e.target.getLatLng().lng.toFixed(6);
		document.getElementById('koordinat').value = `${lat}, ${lng}`;
	});

	map.on('click', function (e) {
		let lat = e.latlng.lat.toFixed(6); 
		let lng = e.latlng.lng.toFixed(6); 
		marker.setLatLng([lat, lng]);

		document.getElementById('koordinat').value = `${lat}, ${lng}`;
	});

	$('#modal-form').on('shown.bs.modal', function () {
		map.invalidateSize();

		let koordinatValue = document.getElementById('koordinat').value;
		if (koordinatValue) {
			let [lat, lng] = koordinatValue.split(',').map(coord => parseFloat(coord.trim()));
			marker.setLatLng([lat, lng]);
			map.setView([lat, lng], 13);
		}
	});
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
				modalContext: 'Anggota Kelompok Ubi Olahan',
				onUpdateOpen: () => {

					$('#sumber_bahan_baku').select2({
						placeholder: "Pilih cara sumber bahan baku",
						theme: "bootstrap-5",
						allowClear: true
					});

					$('#pemasaran').select2({
						placeholder: "Pilih cara pemasaran",
						theme: "bootstrap-5",
						allowClear: true
					});

					$('input[name="id"]').val(response.id);
					$('#id_pelaku_ubi_olahan').val(response.id_pelaku_ubi_olahan);
					$('#id_kecamatan_hidden').val(response.id_kecamatan);
					$('#id_desa_hidden').val(response.id_desa);
					$('#nama_anggota').val(response.nama);
					$('#no_ktp').val(response.no_ktp);
					$('#no_hp').val(response.no_hp);
					$('#alamat').val(response.alamat);
					$('#koordinat').val(response.koordinat);
					$('#sumber_bahan_baku').val(response.sumber_bahan_baku.split(',')).trigger('change');
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
			modalContext: 'Anggota Kelompok Ubi Olahan',
            beforeModalShow: () => {

				$('#sumber_bahan_baku').select2({
                    placeholder: "Pilih cara sumber bahan baku",
                    theme: "bootstrap-5",
                    allowClear: true
                });

				$('#pemasaran').select2({
					placeholder: "Pilih cara pemasaran",
					theme: "bootstrap-5",
					allowClear: true
				});

				$('label[for="password"] span.text-danger').show()

				let id_kecamatan = '<?= $pelaku_ubi_olahan->id_kecamatan ?>';
				let id_desa = '<?= $pelaku_ubi_olahan->id_desa ?>';

				$('#id_kecamatan_hidden').val(id_kecamatan);
				$('#id_desa_hidden').val(id_desa);

				daerahHandler(id_kecamatan, id_desa);

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
                        dataTableInitializer.reload.tabelAnggotaKelompokUbiOlahan(0)
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
