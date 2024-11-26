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
						<select class="form-select" id="pemasaran" name="pemasaran[]" multiple="multiple">
							<option value="lokal">Lokal</option>
							<option value="ekspor">Ekspor</option>
						</select>
					</div>
					
					<div class="mb-3">
						<label for="sk_pengukuhan" class="form-label">File SK Pengukuhan</label>
						<input type="file" class="form-control" id="sk_pengukuhan" name="sk_pengukuhan" placeholder="Pilih file SK pengukuhan">
					</div>

					<div id="details-pengukuhan" style="display: none;">
						<div class="mb-3">
							<label for="no_sk_pengukuhan" class="form-label">Nomor SK Pengukuhan</label>
							<input type="text" class="form-control" id="no_sk_pengukuhan" name="no_sk_pengukuhan" placeholder="Masukkan nomor SK pengukuhan">
						</div>

						<div class="mb-3">
							<label for="exp_sk_pengukuhan" class="form-label">Tanggal Kadaluarsa SK Pengukuhan</label>
							<input type="date" class="form-control" id="exp_sk_pengukuhan" name="exp_sk_pengukuhan" placeholder="Masukkan tanggal kadaluarsa SK pengukuhan">
						</div>
					</div>

					<div class="mb-3">
						<label for="sk_terdaftar" class="form-label">File SK Terdaftar</label>
						<input type="file" class="form-control" id="sk_terdaftar" name="sk_terdaftar" placeholder="Pilih file SK terdaftar">
					</div>
					
					<div id="details-terdaftar" style="display: none;">
						<div class="mb-3">
							<label for="no_sk_terdaftar" class="form-label">Nomor SK Terdaftar</label>
							<input type="text" class="form-control" id="no_sk_terdaftar" name="no_sk_terdaftar" placeholder="Masukkan nomor SK terdaftar">
						</div>

						<div class="mb-3">
							<label for="exp_sk_terdaftar" class="form-label">Tanggal Kadaluarsa SK Terdaftar</label>
							<input type="date" class="form-control" id="exp_sk_terdaftar" name="exp_sk_terdaftar" placeholder="Masukkan tanggal kadaluarsa SK terdaftar">
						</div>
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

<!-- modal pdf preview -->
<div class="modal fade" id="modal-pdf-preview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h1 class="modal-title fs-5" id="modal-label"></h1>
      		</div>
      		<form>
      			<div class="modal-body">
      			</div>
				<div class="modal-footer">
					<button id="cancel-btn-image" type="button" class="btn btn-secondary-red" data-bs-dismiss="modal">
						Tutup
					</button>
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

			<!-- breadcrum -->
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb p-0">
					<li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
					<li class="breadcrumb-item active" aria-current="page">Daftar Kelompok Tani</li>
				</ol>
			</nav>
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
                    <option value="kel_tani.nama">Nama Kelompok Tani</option>
					<option value="kecamatan.nama">Nama Kecamatan</option>
					<option value="desa.nama">Nama Desa</option>
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
                        <th scope="col" rowspan="2" style="min-width: 60px" class="text-center align-middle">No</th>
                        <th scope="col" rowspan="2" class="text-center align-middle" style="min-width: 120px" >Aksi</th>
                        <th scope="col" rowspan="2" style="min-width: 100px" class="align-middle">Nama Kelompok</th>
						<th scope="col" rowspan="2" style="min-width: 100px" class="align-middle">Nomor HP</th>
                        <th scope="col" rowspan="2" style="min-width: 100px" class="align-middle">Alamat</th>
						<th scope="col" rowspan="2" style="min-width: 100px" class="align-middle">Nama Ketua</th>
						<th scope="col" rowspan="2" style="min-width: 100px" class="text-center align-middle">Cara Pemasaran</th>
						<th scope="col" colspan="2" style="min-width: 100px" class="text-center align-middle">SK Pengukuhan</th>
						<th scope="col" colspan="2" style="min-width: 100px" class="text-center align-middle">SK Terdaftar</th>
						<th scope="col" rowspan="2" style="min-width: 80px" class="text-center align-middle">Status</th>
                    </tr>
					<tr>
						<th scope="col" style="min-width: 100px" class="text-center">Preview SK</th>
                        <th scope="col" style="min-width: 100px" class="text-center">Tanggal Kadaluarsa</th>
						<th scope="col" style="min-width: 100px" class="text-center">Preview SK</th>
						<th scope="col" style="min-width: 100px" class="text-center">Tanggal Kadaluarsa</th>
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
            columnTotal: 12,
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
			let memberButton = ''
            let editButton = ''
            let deleteButton = ''
			let pemasaran = val.pemasaran ? val.pemasaran.split(',') : []
			
			pemasaran = pemasaran.map((val) => {
				return `<span class="badge text-bg-primary">${val.charAt(0).toUpperCase() + val.slice(1)}</span>`
			}).join('&nbsp;')

			if (val.exp_sk_pengukuhan && val.exp_sk_pengukuhan != '0000-00-00') {
				// const date = new Date(val.exp_sk_pengukuhan);
				// const options = { year: 'numeric', month: 'long', day: 'numeric' };
				// val.exp_sk_pengukuhan = date.toLocaleDateString('id-ID', options);
			} else {
				val.exp_sk_pengukuhan = '-'
			}

			if (val.exp_sk_terdaftar && val.exp_sk_terdaftar != '0000-00-00') {
				// const date = new Date(val.exp_sk_terdaftar);
				// const options = { year: 'numeric', month: 'long', day: 'numeric' };
				// val.exp_sk_terdaftar = date.toLocaleDateString('id-ID', options);
			} else {
				val.exp_sk_terdaftar = '-'
			}

            if (val.status == '0') {
                activeStatus = '<span class="badge text-bg-warning">Tidak Aktif</span>'
            } else {
                activeStatus = '<span class="badge text-bg-success">Aktif</span>'
            }

			if (val.sk_pengukuhan) {
				previewSkPengukuhan = `
					<button onclick="prevSkPengukuhan('${val.sk_pengukuhan}')" type="button" class="btn btn-primary">
						<i class="ph ph-eye fs-5 align-middle"></i>
					</button>
				`
			}

			if (val.sk_terdaftar) {
				previewSkTerdaftar += `
					<button onclick="prevSkTerdaftar('${val.sk_terdaftar}')" type="button" class="btn btn-primary">
						<i class="ph ph-eye fs-5 align-middle"></i>
					</button>
				`
			}

			<?php if ($_SESSION['akses']->m_kel_tani == 1) : ?>
				memberButton += `
					<form action="<?= base_url('kelompok_tani/data_anggota_kelompok_tani') ?>" method="GET" style="display: inline;">
						<input type="hidden" name="id_kel_tani" value="${val.id}">
						<button type="submit" class="btn btn-primary">
							<i class="ph ph-users fs-5 align-middle"></i>
						</button>
					</form>
				`;
            <?php endif; ?>

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
                    <td class="text-center">${memberButton + editButton + deleteButton}</td>
                    <td>${val.nama ? val.nama : '-'}</td>
					<td>${val.no_hp ? val.no_hp : '-'}</td>
					<td>${val.alamat ? val.alamat : '-'}</td>
					<td>${val.ketua ? val.ketua : '-'}</td>
					<td class="text-center">${pemasaran ? pemasaran : '-'}</td>
					<td class="text-center">${val.sk_pengukuhan ? previewSkPengukuhan : '-'}</td>
					<td class="text-center">${val.exp_sk_pengukuhan ? val.exp_sk_pengukuhan : '-'}</td>
					<td class="text-center">${val.sk_terdaftar ? previewSkTerdaftar : '-'}</td>
					<td class="text-center">${val.exp_sk_terdaftar ? val.exp_sk_terdaftar : '-'}</td>

                    <td class="text-center">${activeStatus}</td>
                </tr>
            `
        }).join('')
    }

    dataTableInitializer.init(config)
</script>

<!-- preview pdf handler -->
<script>
	const prevSkPengukuhan = (fileName) => {
		const modal = $('#modal-pdf-preview');
		const modalTitle = modal.find('.modal-title');
		const modalBody = modal.find('.modal-body');

		if (fileName == '' || fileName == null) {
			Swal.fire({
				icon: 'error',
				text: 'Tidak ada file untuk data ini!',
				showConfirmButton: true
			});
			return;
		} else {
			showLoading();

			const viewerUrl = '<?= base_url('assets/plugin/pdfjs/web/viewer.html') ?>';

			const fileUrl = `<?= base_url('public/file/sk-pengukuhan/') ?>${fileName}`;

			const fileElement = $(`
				<iframe 
					src="${viewerUrl}?file=${encodeURIComponent(fileUrl)}"
					width="100%" 
					height="600px">
				</iframe>
			`);

			fileElement.on('load', () => {
				hideLoading();
				fileElement.show();
				console.log("PDF loaded successfully.");
			});

			fileElement.on('error', (e) => {
				console.error('Error loading the file:', e);
				Swal.fire({
					icon: 'error',
					text: 'Gagal memuat SK Pengukuhan!',
					showConfirmButton: true
				});
			});

			modalTitle.html('Preview SK Pengukuhan');
			modalBody.html(fileElement);
			modal.modal('show');
		}
	}

	const prevSkTerdaftar = (fileName) => {
		const modal = $('#modal-pdf-preview');
		const modalTitle = modal.find('.modal-title');
		const modalBody = modal.find('.modal-body');

		if (fileName == '' || fileName == null) {
			Swal.fire({
				icon: 'error',
				text: 'Tidak ada file untuk data ini!',
				showConfirmButton: true
			});
			return;
		} else {
			showLoading();

			const viewerUrl = '<?= base_url('assets/plugin/pdfjs/web/viewer.html') ?>';

			const fileUrl = `<?= base_url('public/file/sk-terdaftar/') ?>${fileName}`;

			const fileElement = $(`
				<iframe
					src="${viewerUrl}?file=${encodeURIComponent(fileUrl)}"
					width="100%"
					height="600px">
				</iframe>
			`);

			fileElement.on('load', () => {
				hideLoading();
				fileElement.show();
			});

			fileElement.on('error', () => {
				Swal.fire({
					icon: 'error',
					text: 'Gagal memuat SK Terdaftar!',
					showConfirmButton: true
				});
			});

			modalTitle.html('Preview SK Terdaftar');
			modalBody.html(fileElement);
			modal.modal('show');
		}
	}
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

					if (response.sk_pengukuhan != null && response.sk_pengukuhan != '') {
						$('#details-pengukuhan').removeAttr('style');
					} else {
						$('#details-pengukuhan').attr('style', 'display: none;');
					}

					if (response.sk_terdaftar != null && response.sk_terdaftar != '') {
						$('#details-terdaftar').removeAttr('style');
					} else {
						$('#details-terdaftar').attr('style', 'display: none;');
					}

					$('#sk_pengukuhan').on('change', function () {
						if (this.files && this.files.length > 0) {
							$('#details-pengukuhan').removeAttr('style');
						} else {
							$('#details-pengukuhan').attr('style', 'display: none;');
						}
					});

					$('#sk_terdaftar').on('change', function () {
						if (this.files && this.files.length > 0) {
							$('#details-terdaftar').removeAttr('style');
						} else {
							$('#details-terdaftar').attr('style', 'display: none;');
						}
					});

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

		$('#details-pengukuhan').attr('style', 'display: none;');
		$('#details-terdaftar').attr('style', 'display: none;');

		$('#sk_pengukuhan').on('change', function () {
			if (this.files && this.files.length > 0) {
				$('#details-pengukuhan').removeAttr('style');
			} else {
				$('#details-pengukuhan').attr('style', 'display: none;');
			}
		});

		$('#sk_terdaftar').on('change', function () {
			if (this.files && this.files.length > 0) {
				$('#details-terdaftar').removeAttr('style');
			} else {
				$('#details-terdaftar').attr('style', 'display: none;');
			}
		});

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
