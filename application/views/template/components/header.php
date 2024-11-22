<div class="modal fade" id="change-password-modal-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5"></h1>
            </div>

            <div class="modal-body">
                <form id="change-password-form">
                    <div class="mb-3">
                        <label for="password_lama" class="form-label" id="form-label-password">Password lama <span class="text-danger">*</span></label>
                        <input autofocus type="password" name="password_lama" class="form-control form-control-solid" id="password_lama" placeholder="Masukkan password lama anda" autocomplete required />
                    </div>
                    <div class="mb-3">
                        <label for="password_baru" class="form-label">Password baru<span class="text-danger">*</span></label>
                        <input type="password" name="password_baru" class="form-control form-control-solid" id="password_baru" placeholder="Masukkan password baru" autocomplete required />
                    </div>
                    <div class="mb-3">
                        <input type="password" name="verifikasi_password" class="form-control form-control-solid" id="verifikasi_password" placeholder="Masukkan kembali password" autocomplete required />
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="change-password-cancel-btn" type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    Close
                </button>
                <button id="change-password-submit-btn" type="button" onclick="makeChangePasswordRequest()" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<header class="head-wrapper px-4 position-relative d-flex justify-content-lg-end justify-content-between align-items-center">
    <i style="font-size: 32px" class="d-lg-none hamburger-menu text-white ph ph-text-align-justify"></i>

    <h1 class="logo fw-bold text-break mb-0 d-lg-none">SIKASEP UCIL</h1>

    <button id="profile-btn" class="d-lg-flex d-none align-items-center btn btn-primary-light rounded-pill">
        <div class="img-wrapper rounded-circle overflow-hidden">
            <img src="<?= base_url() . 'assets/images/no-profile.png' ?>" alt="" class="img-fluid" />
        </div>
        <span class="fw-semibold text-break" style="font-size: 16px"><?= $this->session->userdata('nama') ?></span>
    </button>

    <span class="profile-icon d-lg-none d-block">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
            <path d="M26.749 24.93C28.1851 23.2021 29.184 21.1537 29.661 18.9582C30.1381 16.7626 30.0793 14.4845 29.4897 12.3164C28.9001 10.1484 27.797 8.15423 26.2737 6.50268C24.7504 4.85112 22.8517 3.59075 20.7383 2.82818C18.6248 2.06561 16.3589 1.82328 14.132 2.12168C11.9051 2.42008 9.78282 3.25043 7.94472 4.5425C6.10662 5.83457 4.60675 7.55034 3.57199 9.54467C2.53724 11.539 1.99804 13.7532 2.00001 16C2.00076 19.2662 3.15175 22.4278 5.25101 24.93L5.23101 24.947C5.30101 25.031 5.38101 25.103 5.45301 25.186C5.54301 25.289 5.64001 25.386 5.73301 25.486C6.01301 25.79 6.30101 26.082 6.60301 26.356C6.69501 26.44 6.79001 26.518 6.88301 26.598C7.20301 26.874 7.53201 27.136 7.87301 27.38C7.91701 27.41 7.95701 27.449 8.00101 27.48V27.468C10.3431 29.1162 13.1371 30.0007 16.001 30.0007C18.8649 30.0007 21.6589 29.1162 24.001 27.468V27.48C24.045 27.449 24.084 27.41 24.129 27.38C24.469 27.135 24.799 26.874 25.119 26.598C25.212 26.518 25.307 26.439 25.399 26.356C25.701 26.081 25.989 25.79 26.269 25.486C26.362 25.386 26.458 25.289 26.549 25.186C26.62 25.103 26.701 25.031 26.771 24.946L26.749 24.93ZM16 8C16.89 8 17.7601 8.26392 18.5001 8.75838C19.2401 9.25285 19.8169 9.95566 20.1575 10.7779C20.4981 11.6002 20.5872 12.505 20.4135 13.3779C20.2399 14.2508 19.8113 15.0526 19.182 15.682C18.5527 16.3113 17.7508 16.7399 16.8779 16.9135C16.005 17.0872 15.1002 16.998 14.2779 16.6575C13.4557 16.3169 12.7529 15.7401 12.2584 15.0001C11.7639 14.26 11.5 13.39 11.5 12.5C11.5 11.3065 11.9741 10.1619 12.818 9.31802C13.6619 8.4741 14.8065 8 16 8ZM8.00701 24.93C8.02435 23.617 8.55795 22.3636 9.49236 21.4409C10.4268 20.5183 11.6869 20.0007 13 20H19C20.3132 20.0007 21.5732 20.5183 22.5076 21.4409C23.4421 22.3636 23.9757 23.617 23.993 24.93C21.7998 26.9063 18.9523 28.0001 16 28.0001C13.0477 28.0001 10.2002 26.9063 8.00701 24.93Z" fill="white" />
        </svg>
    </span>

    <div class="profile-wrapper position-absolute bg-white border p-4 top-100" style="z-index: 99999 !important;">
        <div class="profile-content d-flex align-items-center">
            <div class="profile-img">
                <div class="img-wrapper rounded-circle overflow-hidden me-3">
                    <img src="<?= base_url() . 'assets/images/no-profile.png' ?>" alt="" class="img-fluid" />
                </div>
            </div>

            <div class="profile-detail d-flex flex-column">
                <span class="fw-semibold text-break" style="font-size: 16px"><?= $this->session->userdata('nama') ?></span>
                <small class="text-secondary text-break" style="font-size: 12px"><?= $this->session->userdata('nama_role') ?></small>
            </div>
        </div>

        <hr />

        <ul class="list-unstyled mb-0">
            <li class="mb-3">
                <a class="text-dark text-decoration-none" href="#" onclick="openChangePasswordModal()">
                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000000" viewBox="0 0 256 256">
                        <path d="M48,56V200a12,12,0,0,1-24,0V56a12,12,0,0,1,24,0Zm82.73,50.7L116,111.48V96a12,12,0,0,0-24,0v15.48L77.27,106.7a12,12,0,1,0-7.41,22.82l14.72,4.79-9.1,12.52A12,12,0,1,0,94.9,160.94l9.1-12.52,9.1,12.52a12,12,0,1,0,19.42-14.11l-9.1-12.52,14.72-4.79a12,12,0,1,0-7.41-22.82Zm111.12,7.7a12,12,0,0,0-15.12-7.7L212,111.48V96a12,12,0,0,0-24,0v15.48l-14.73-4.78a12,12,0,1,0-7.41,22.82l14.72,4.79-9.1,12.52a12,12,0,1,0,19.42,14.11l9.1-12.52,9.1,12.52a12,12,0,1,0,19.42-14.11l-9.1-12.52,14.72-4.79A12,12,0,0,0,241.85,114.4Z">
                        </path>
                    </svg>
                    <span class="fs-6 align-middle">Ganti Password</span>
                </a>
            </li>
            <li>
                <a class="text-danger fs-6 text-decoration-none" href="<?= base_url('login/out') ?>">
                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#dc3545" viewBox="0 0 256 256">
                        <path d="M112,216a8,8,0,0,1-8,8H48a16,16,0,0,1-16-16V48A16,16,0,0,1,48,32h56a8,8,0,0,1,0,16H48V208h56A8,8,0,0,1,112,216Zm109.66-93.66-40-40A8,8,0,0,0,168,88v32H104a8,8,0,0,0,0,16h64v32a8,8,0,0,0,13.66,5.66l40-40A8,8,0,0,0,221.66,122.34Z">
                        </path>
                    </svg>
                    <span class="fs-6 align-middle">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</header>

<script>
    const openChangePasswordModal = () => {
        $('#change-password-form')[0].reset()

        $('#change-password-form input').each(function() {
            removeChangePasswordErrorMessage(this)
        })
        $('#change-password-modal-form .modal-title').text("Form ganti password")
        $('#change-password-modal-form').modal('show')
    }

    const makeChangePasswordRequest = () => {
        const data = new FormData($('#change-password-form')[0])

        Swal.fire({
            text: "Sedang memproses data",
            customClass: 'swal-wide'
        })
        Swal.showLoading()


        disableChangePasswordSubmitBtn();
        $.post("<?= base_url() . 'login/change_password' ?>", Object.fromEntries(data), response => {
            Swal.close()
            if (response.status) {

                const _modal = $('#change-password-modal-form')
                _modal.modal('hide')

                Swal.fire({
                    icon: 'success',
                    text: response.message,
                    showConfirmButton: true
                })
            } else {
                if (response.hasOwnProperty('messages')) {
                    displayPasswordChangeErrors(response.messages)
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: response.message,
                        showConfirmButton: true
                    })
                }
            }
        }, 'json').always(() => {
            enableChangePasswordSubmitBtn();
        })
    }


    const disableChangePasswordSubmitBtn = () => {
        const cancelBtn = $('#change-password-cancel-btn')
        const submitBtn = $('#change-password-submit-btn')
        const spinner = `
			<span class="spinner-border me-1 spinner-border-sm" aria-hidden="true"></span>
			<span role="status">Memproses...</span>`

        cancelBtn.attr('disabled', true)
        submitBtn.attr('disabled', true)
        submitBtn.html(spinner)
    }

    const enableChangePasswordSubmitBtn = () => {
        const cancelBtn = $('#change-password-cancel-btn')
        const submitBtn = $('#change-password-submit-btn')

        cancelBtn.attr('disabled', false)
        submitBtn.attr('disabled', false)
        submitBtn.html('Simpan')
    }


    $('#change-password-form input').on('click', function() {
        removeChangePasswordErrorMessage(this)
    })


    const displayPasswordChangeErrors = (errors, exceptions = []) => {
        $.each(errors, (key, message) => {

            const el = $(`#${key}`)
            const errorMessage = createChangePasswordErrorFeedback(message)

            if (key === 'password_lama' || key === 'verifikasi_password') {
                el.val('')
            }

            el.addClass('is-invalid')



            if (el.next().hasClass('invalid-feedback')) {
                el.next().remove()
            }

            $(errorMessage).insertAfter(el)
        })
    }

    const createChangePasswordErrorFeedback = errorMessage => {
        const message = `<div class="invalid-feedback">${errorMessage}</div>`
        return message
    }

    const removeChangePasswordErrorMessage = el => {
        $(el).removeClass('is-invalid')

        if ($(el).next().hasClass('invalid-feedback')) {
            $(el).next().remove()
        }
    }

    $('#change-password-modal-form').on('shown.bs.modal', function() {
        $(this).find('[autofocus]').focus();
    })
</script>
