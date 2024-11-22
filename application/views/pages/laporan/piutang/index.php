<header class="mb-3">
  <div class="row">
    <div class="col-md-8">
      <h1 class="fw-bold">Laporan Piutang</h1>
      <p>Pengelolaan laporan Piutang</p>
    </div>
  </div>
</header>

<div class="card shadow-sm mb-3">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <span>
        Filter Laporan
      </span>

      <div>
        <button title="cetak pdf" class="btn btn-success" onclick="report('xls')">
          <i class="ph ph-file-xls fs-5 align-middle"></i>
        </button>
        <button title="cetak pdf" class="btn btn-danger" onclick="report('pdf')">
          <i class="ph ph-file-pdf fs-5 align-middle"></i>
        </button>
      </div>
    </div>
  </div>
  <div class="card-body">

    <form id="filters-form" class="d-flex flex-md-row flex-column gap-3">
      <div class="row flex-fill gy-3">

        <div class="col-md-6">
          <select class="form-select" name="customer">
            <option selected value="">Semua Customer</option>

            <?php foreach ($customers as $customer) : ?>
              <option value="<?= $customer->id ?>"><?= $customer->nama ?></option>
            <?php endforeach ?>

          </select>
        </div>

        <div class="col-md-6">
          <input class="form-control datepicker-filters" name="rentang-tanggal" placeholder="Jatuh Tempo" readonly />
        </div>

      </div>

      <div>
        <button type="submit" class="btn btn-primary"><i class="ph ph-funnel me-2"></i>Filter</button>
      </div>
    </form>

    <!-- filter description -->
    <div class="row">
      <div class="col-md-6">
        <p class="mb-0 mt-3" id="filter-description"></p>
      </div>
    </div>

  </div>
</div>

<div class="custom-card shadow-sm">
  <div class="card-body">

    <div class="table-responsive">
      <table class="table table-striped table-bordered text-nowrap align-middle mb-0">
        <thead>
          <tr>
            <th scope="col" style="min-width: 80px" class="text-center">No</th>
            <th scope="col" style="min-width: 150px">Kode Invoice</th>
            <th scope="col" style="min-width: 150px">Tanggal Invoice</th>
            <th scope="col" style="min-width: 150px">Nama Customer</th>
            <th scope="col" style="min-width: 180px" class="text-center">Tanggal Jatuh Tempo</th>
            <th scope="col" style="min-width: 130px" class="text-center">Piutang</th>
          </tr>
        </thead>
        <tbody id="table-result">
          <tr>
            <td colspan="6" class="text-center">Tidak ada data</td>
          </tr>
        </tbody>
        <tfoot id="piutang-summary">
          <tr>
            <td colspan="5">Jumlah</td>
            <td class="sum text-center">Rp. 0</td>
          </tr>
        </tfoot>
      </table>
    </div>

  </div>
</div>

<!-- daterange handler -->
<script>
  $(document).ready(() => {
    $(() => {
      $('.datepicker-filters').daterangepicker({
        autoUpdateInput: false,
        locale: {
          cancelLabel: 'Bersihkan',
          applyLabel: 'Terapkan'
        }
      })
    })
  })

  $('.datepicker-filters').each((i, el) => {
    $(el).on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'))
      $(this).data('range', `${picker.startDate.format('YYYY/MM/DD')} - ${picker.endDate.format('YYYY/MM/DD')}`)
    })

    $(el).on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('')
      $(this).data('range', '')
    })
  })
</script>

<!-- report handler -->
<script>
  const report = format => {
    const pathURL = '<?= base_url() . 'laporan/piutang/print_report' ?>'
    const range = $('.datepicker-filters').data('range')

    if (range) {
      const query = '?' + new URLSearchParams({
        format,
        customer: $('[name="customer"]').val(),
        customerText: $('[name="customer"] option:selected').text(),
        range
      })

      window.open(pathURL + query, '_blank')
    } else {
      alert('Rentang tanggal harus diisi')
    }
  }
</script>

<!-- filters handler -->
<script>
  const filterDescription = $('#filter-description')

  filterDescription.hide()

  $('#filters-form').on('submit', e => {
    e.preventDefault()

    const customer = $('[name="customer"]').val()
    const customerText = $('[name="customer"] option:selected').text()
    const rangeText = $('.datepicker-filters').val()
    const range = $('.datepicker-filters').data('range')

    if (range) {
      const tableResult = $('#table-result')

      tableResult.html(`
        <tr>
          <td colspan="6">
            <div class="d-flex justify-content-center align-items-center">
              <div class="spinner-border spinner-border-sm me-2" role="status">
              </div>
              <span>Memproses...</span>
            </div>
          </td>
        </tr>
      `)

      $.get('<?= base_url() . 'laporan/piutang/get_report' ?>', {
            customer,
            range
          },
          response => {
            let summary = 0

            if (response.length) {
              const resultHTML = response.map((val, i) => {
                i++
                summary += parseInt(numberOnly(val.sisa_piutang))

                return `
                  <tr>
                    <td class="text-center">${i}</td>
                    <td>${val.kode_invoice}</td>
                    <td>${val.tanggal_invoice}</td>
                    <td>${val.nama_customer}</td>
                    <td class="text-center">${val.jatuh_tempo}</td>
                    <td class="text-center">${val.sisa_piutang}</td>
                  </tr>
                `
              }).join("")

              tableResult.html(resultHTML)
            } else {
              tableResult.html('<tr><td colspan="6" class="text-center">Tidak ada data</td></tr>')
            }

            $('#piutang-summary .sum').text(formatRupiah(summary.toString(), 'Rp. '))
            filterDescription.html(`Menampilkan data laporan hasil pencarian <span class="text-primary">Kategori "${customerText}"</span> dengan <span class="text-primary">Rentang Tanggal "${rangeText}"</span>.`).show()
          }, 'json')
        .fail(() => {
          tableResult.html('<tr><td colspan="9" class="text-center">Terjadi kesalahan saat memuat data, coba lagi nanti!</td></tr>')
          filterDescription.hide()
        })
    } else {
      alert('Rentang tanggal harus diisi')
    }
  })
</script>

<!-- sanitize handler -->
<script>
  const config = {
    sanitize: {
      numberOnly: true,
      rupiah: true
    }
  }
</script>

<?php $this->load->view('js/utils/formSanitizeHandler') ?>