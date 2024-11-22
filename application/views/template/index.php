<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIKASEP UCIL</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>" />

    <!-- select2 css -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugin/select2/css/select2.min.css' ?>">
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugin/select2/css/select2-bootstrap-5-theme.min.css' ?>" />

    <!-- daterangepicker css -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/plugin/daterangepicker/daterangepicker.css' ?>">

    <!-- icons -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/icons/phosphor-icons/2.0.0/Fonts/regular/style.css' ?>" />

    <!-- main css -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/css/main.css?version=1.4' ?>" />

    <!-- themes layout css -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/css/layout/sidebar.css' ?>" />
    <link rel="stylesheet" href="<?= base_url() . 'assets/css/layout/header.css' ?>" />

    <!-- jquery and moment and jsBarcode -->
    <script src="<?= base_url() . 'assets/js/lib/jquery-3.7.0.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/js/lib/moment.min.js' ?>"></script>

    <!-- select2 js -->
    <script src="<?= base_url() . 'assets/plugin/select2/js/select2.min.js' ?>"></script>

    <!-- syncfusion chart js -->
    <?php if (isset($syncfusion_chart)) : ?>
        <script src="<?= base_url() . 'assets/plugin/chart/ej2-chart.min.js' ?>"></script>
    <?php endif ?>

    <!-- global select2 config -->
    <script>
        const select2Config = {
            width: 'resolve',
            theme: 'bootstrap-5',
            allowClear: true,
            placeholder: () => $(this).data('placeholder')
        }
    </script>
</head>

<body>
    <?php $this->load->view('template/components/sidebar') ?>

    <main>
        <?php $this->load->view('template/components/header') ?>

        <div class="content pe-sm-4 ps-sm-4 pb-3">
            <div class="container-fluid bg-light">
                <div class="main-content d-flex flex-column">
                    <div class="flex-grow-1 mb-4">
                        <?php $this->load->view($view) ?>
                    </div>

                    <footer class="d-flex align-items-center">
                        <small class="text-dark">©2023 PT. Sawarga Digital Indonesia</small>
                    </footer>
                </div>
            </div>
        </div>
    </main>

    <!-- bootstrap js -->
    <script src="<?= base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>

    <!-- sweetalert 2 -->
    <script src="<?= base_url() . 'assets/js/lib/sweetalert2.all.min.js?version=1.0' ?>"></script>

    <!-- themes layout js -->
    <script src="<?= base_url() . 'assets/js/layout/sidebar.js' ?>"></script>
    <script src="<?= base_url() . 'assets/js/layout/header.js' ?>"></script>

    <!-- select2 initialize handler -->
    <script>
        (() => {
            let isUseSelect2 = true

            if (typeof config !== 'undefined') {
                if (config.hasOwnProperty('select2') && !config.select2) {
                    isUseSelect2 = false
                }
            }

            if (isUseSelect2) {
                $(document).ready(() => {
                    $('.select2').select2(select2Config)
                })
            }
        })()
    </script>

    <!-- daterangepicker js -->
    <script src="<?= base_url() . 'assets/plugin/daterangepicker/daterangepicker.js' ?>"></script>
</body>

</html>
