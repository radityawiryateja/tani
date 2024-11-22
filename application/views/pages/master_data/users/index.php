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
                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukan username">
                    </div>

                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-select" id="level" name="level">
                            <option value="" selected disabled>Pilih Level</option>
                            <?php
                            $level = $this->db->get('dat_level')->result();
                            foreach ($level as $level) { ?>
                                <option value="<?= $level->id ?>">
                                    <?= $level->level ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="status" class="form-label">Status Aktif</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password">
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
            <h1 class="fw-bold">Daftar users</h1>
            <p>Pengelolaan data users</p>
        </div>
        <?php if ($_SESSION['akses']->add_data_user == 1) : ?>
            <div class="col-md-4 text-md-end">
                <button onclick="createNewData()" class="btn btn-primary"><i class="ph ph-plus-circle fs-4 align-middle me-1"></i>
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
                    <option value="nama" selected>nama</option>
                    <option value="username" selected>username</option>
                </select>
            </div>

            <input type="text" class="form-control search-bar ms-auto" name="keyword" placeholder="Cari data..." />
        </div>

        <div class="table-responsive">
            <table class="table table-striped text-nowrap align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" style="min-width: 80px" class="text-center">No</th>
                        <th scope="col" style="min-width: 100px">Nama</th>
                        <th scope="col" style="min-width: 100px">Username</th>
                        <th scope="col" style="min-width: 100px">Level</th>
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
        baseURL: '<?= base_url() . 'master_data/users/' ?>',
        table: {
            name: 'tabelUsers',
            columnTotal: 6,
        },
        formConfig: {
            afterSuccess: response => {
                dataTableInitializer.reload.tabelUsers(0)
            }
        },
        sanitize: {
            numberOnly: true
        },
    }

    config.table.renderContent = (data, i) => {
        return data.map((val) => {
            i++

            let editButton = ''
            let deleteButton = ''

            let activeStatus = ''

            if (val.active == '0') {
                activeStatus = '<span class="badge text-bg-warning">Tidak Aktif</span>'
            } else {
                activeStatus = '<span class="badge text-bg-success">Aktif</span>'
            }

            <?php if ($_SESSION['akses']->update_data_user == 1) : ?>
                editButton += `
                    <button onclick="editData('${config.baseURL + 'edit'}', ${val.id})" type="button" class="btn btn-success">
                        <i class="ph ph-pencil fs-5 align-middle"></i>
                    </button>
                `
            <?php endif; ?>

            <?php if ($_SESSION['akses']->remove_data_user == 1) : ?>
                deleteButton +=
                    `<button onclick="deleteRow('${config.baseURL + 'delete'}', ${val.id})" type="" class="btn btn-danger">
                        <i class="ph ph-trash fs-5 align-middle"></i>
                    </button>
                `
            <?php endif; ?>

            return `
                <tr>
                    <th scope="row" class="text-center"s>${i}</th>
                    <td>${val.nama}</td>
                    <td>${val.username}</td>
                    <td>${val.level}</td>
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
        $.get(requestURL, {
                id
            }, response => {
                openModal({
                    state: 'update',
                    modalContext: 'users',
                    onUpdateOpen: () => {
                        $('input[name="id"]').val(response.id)
                        $('#nama').val(response.nama)
                        $('#username').val(response.username)
                        $('#level').val(response.level_id)
                        $('#active').val(response.active)

                        $('label[for="password"] span.text-danger').hide();
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

    const createNewData = () => {

        openModal({
            beforeModalShow: () => $('label[for="password"] span.text-danger').show()

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
                        dataTableInitializer.reload.tabelUsers(0)
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