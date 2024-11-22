<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>" />
    <link rel="stylesheet" href="<?= base_url() . 'assets/css/login.css' ?>" />

    <script src="<?= base_url() . 'assets/js/lib/jquery-3.7.0.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/js/lib/sweetalert2.all.min.js?version=1.0' ?>"></script>
</head>

<body>
    <div class="d-flex flex-lg-row flex-column-reverse">
        <!-- left column -->
        <main class="d-flex flex-column" id="aside-container">
            <div class="d-flex flex-column bg-align-items-center justify-content-lg-center h-100">
                <div id="form-container" class="px-xxl-5 px-lg-2">
                    <header class="text-center pb-3 pb-lg-1 mb-lg-4">
                        <p class="my-auto mb-1 login-text-header">Login</p>
                        <p class="text-muted login-sub-text">
                            Masukkan email dan password
                        </p>
                    </header>

                    <form action="<?= base_url() . 'login/verify' ?>" method="POST" class="mx-4">
                        <?php if ($this->session->flashdata('message')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $this->session->flashdata('message') ?>
                        </div>
                        <?php endif ?>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="username" class="form-control" id="username"
                                value="<?= $this->session->flashdata('username') ?>" name="username"
                                placeholder="Masukkan username anda" aria-describedby="usernameHelp" required />
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Masukkan password anda" required />
                                <button class="btn btn-outline" type="button" id="togglePassword">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#dee2e6"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M53.92,34.62A8,8,0,1,0,42.08,45.38L61.32,66.55C25,88.84,9.38,123.2,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208a127.11,127.11,0,0,0,52.07-10.83l22,24.21a8,8,0,1,0,11.84-10.76Zm47.33,75.84,41.67,45.85a32,32,0,0,1-41.67-45.85ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.16,133.16,0,0,1,25,128c4.69-8.79,19.66-33.39,47.35-49.38l18,19.75a48,48,0,0,0,63.66,70l14.73,16.2A112,112,0,0,1,128,192Zm6-95.43a8,8,0,0,1,3-15.72,48.16,48.16,0,0,1,38.77,42.64,8,8,0,0,1-7.22,8.71,6.39,6.39,0,0,1-.75,0,8,8,0,0,1-8-7.26A32.09,32.09,0,0,0,134,96.57Zm113.28,34.69c-.42.94-10.55,23.37-33.36,43.8a8,8,0,1,1-10.67-11.92A132.77,132.77,0,0,0,231.05,128a133.15,133.15,0,0,0-23.12-30.77C185.67,75.19,158.78,64,128,64a118.37,118.37,0,0,0-19.36,1.57A8,8,0,1,1,106,49.79,134,134,0,0,1,128,48c34.88,0,66.57,13.26,91.66,38.35,18.83,18.83,27.3,37.62,27.65,38.41A8,8,0,0,1,247.31,131.26Z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary fw-semibold" id="login-button">
                            Login
                        </button>
                    </form>
                </div>
            </div>
            <div class="text-left" id="trademark">
                <p class="text-muted mx-4 px-lg-1 pb-2 pb-lg-4">
                    © 2023 PT.Sawarga Digital Indonesia
                </p>
            </div>
        </main>

        <!-- right column -->
        <div class="d-flex flex-grow-1" id="banner-container">
            <div class="mx-4 py-1 py-lg-0 mx-lg-auto my-auto">
                <p class="mb-lg-3 text-white login-app-text"></p>
                <p class="my-0 text-white login-app-slogan">

                </p>
            </div>
        </div>
    </div>
    <script src="<?= base_url() . 'assets/js/login.js' ?>"></script>
</body>

</html>
