<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>laporan - piutang</title>

  <!-- bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">

  <style>
    @media screen {
      .content {
        display: none;
      }
    }

    header h1 {
      font-size: 1.5rem;
    }

    header table,
    main {
      font-size: 0.6rem;
    }
  </style>
</head>

<body>
  <div class="container-fluid content">
    <header class="py-3">
      <h1 class="text-center mb-2">LAPORAN PIUTANG</h1>

      <table>
        <tr>
          <th>Customer &nbsp; </th>
          <th> : </th>
          <th> &nbsp;<?= $customer_text ?></th>
        </tr>
        <tr>
          <th>Periode &nbsp; </th>
          <th> : </th>
          <th> &nbsp;<?= $periode ?></th>
        </tr>
      </table>
    </header>

    <main>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th scope="col">Kode Invoice</th>
            <th scope="col">Tanggal Invoice</th>
            <th scope="col">Nama Customer</th>
            <th scope="col" class="text-center">Tanggal Jatuh Tempo</th>
            <th scope="col" class="text-center">Piutang</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($piutang)) : ?>
            <?php foreach ($piutang as $i => $item) : ?>
              <tr>
                <td class="text-center"><?= ++$i ?></td>
                <td><?= $item->kode_invoice ?></td>
                <td><?= $item->tanggal_invoice ?></td>
                <td><?= $item->nama_customer ?></td>
                <td class="text-center"><?= $item->jatuh_tempo ?></td>
                <td class="text-center"><?= $item->sisa_piutang ?></td>
              </tr>
            <?php endforeach ?>
          <?php else : ?>
            <tr>
              <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
          <?php endif ?>
        </tbody>
        <tr>
          <td colspan="5">Jumlah</td>
          <td class="text-center"><?= $summary ?></td>
        </tr>
      </table>
    </main>
  </div>
</body>

</html>