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
                        <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama" autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="nomor_hp" class="form-label">Nomor Hp <span class="text-danger">*</span></label>
                        <input type="text" class="form-control number-only" id="nomor_hp" name="nomor_hp" maxlength="15" placeholder="Masukan nomor hp">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="npwp" class="form-label">NPWP</label>
                        <input type="text" class="form-control" id="npwp" name="npwp" placeholder="Masukan NPWP">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukan email">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1">Safety</option>
                            <option value="2">Warning</option>
                            <option value="3">Blacklist</option>
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
            <h1 class="fw-bold">Daftar Customer</h1>
            <p>Pengelolaan data customer</p>
        </div>

        <?php if ($_SESSION['akses']->add_data_customer == 1) : ?>
            <div class="col-md-4 text-md-end">
                <button onclick="openModal()" class="btn btn-primary"><i class="ph ph-plus-circle fs-4 align-middle me-1"></i>
                    <span class="align-middle">Tambah data</span></button>
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
                    <option value="nama" selected>Nama customer</option>
                </select>
            </div>

            <input type="text" class="form-control search-bar ms-auto" name="keyword" placeholder="Cari data..." />
        </div>

        <div class="table-responsive">
            <table class="table table-striped text-nowrap align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" style="min-width: 80px" class="text-center">No</th>
                        <th scope="col" style="min-width: 80px">Kode</th>
                        <th scope="col" style="min-width: 100px">Nama</th>
                        <th scope="col" style="min-width: 100px">Nomor HP</th>
                        <th scope="col" style="min-width: 180px">Alamat</th>
                        <th scope="col" style="min-width: 100px">Email</th>
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
        baseURL: '<?= base_url() . 'customer/' ?>',
        table: {
            name: 'tabelCustomer',
            columnTotal: 8,
        },
        formConfig: {
            afterSuccess: response => {
                dataTableInitializer.reload.tabelCustomer(0)
            }
        },
        sanitize: {
            numberOnly: true
        }
    }

    config.table.renderContent = (data, i) => {
        return data.map((val) => {
            i++

            let editButton = ''
            let deleteButton = ''

            <?php if ($_SESSION['akses']->update_data_customer == 1) : ?>
                editButton += `
                <button onclick="editData('${config.baseURL + 'edit'}', ${val.id})" type="button" class="btn btn-success">
                    <i class="ph ph-pencil fs-5 align-middle"></i>
                </button>
            `
            <?php endif; ?>

            <?php if ($_SESSION['akses']->remove_data_customer == 1) : ?>
                deleteButton +=
                    `<button onclick="deleteRow('${config.baseURL + 'delete'}', ${val.id})" type="" class="btn btn-danger">
                    <i class="ph ph-trash fs-5 align-middle"></i>
                </button>
            `
            <?php endif; ?>

            if (val.status == 1) {
                status = '<span class="badge text-bg-success">Safety</span>';
            } else if (val.status == 2) {
                status = '<span class="badge text-bg-warning">Warning</span>';
            } else if (val.status == 3) {
                status = '<span class="badge text-bg-dark">Blacklist</span>';
            }
            return `
                <tr>
                    <th scope="row" class="text-center"s>${i}</th>
                    <td>${val.kode}</td>
                    <td>${val.nama}</td>
                    <td>${val.nomor_hp}</td>
                    <td>${val.alamat}</td>
                    <td>${val.email}</td>
                    <td>${status}</td>
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
        $.get(requestURL, {
                id
            }, response => {
                openModal({
                    state: 'update',
                    modalContext: 'Customer',
                    onUpdateOpen: () => {
                        $('input[name="id"]').val(response.id)
                        $('#kode').val(response.kode)
                        $('#nama').val(response.nama)
                        $('#nomor_hp').val(response.nomor_hp)
                        $('#alamat').val(response.alamat)
                        $('#npwp').val(response.npwp)
                        $('#email').val(response.email)
                        $('#status').val(response.status)
                    }
                })
            }, 'json')
            .fail(() => {
                Swal.fire({
                    icon: 'error',
                    text: 'Terjadi kesalahan saat memuat data, coba lagi nanti!',
                    showConfirmButton: true
                })
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
                        dataTableInitializer.reload.tabelCustomer(0)
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