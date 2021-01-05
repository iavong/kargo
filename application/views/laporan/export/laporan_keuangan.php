<?php error_reporting(1); ?>

<!DOCTYPE html>
<?php echo '<html><head>'; ?>
<title><?= $title; ?></title>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .td-bold {
        font-weight: bold;
    }

    .center {
        text-align: center;
    }
</style>
<?php echo '</head><body>'; ?>
<?php if (!empty($bulan || $tahun)) : ?>
    <p style="text-align: center; font-weight: bold;text-transform: uppercase;">
        LAPORAN KEUANGAN <br>
        cv. KALBAR KARGO MANDIRI <br>
        BULAN <?= strftime('%B', mktime(0, 0, 0, $bulan)); ?> TAHUN <?= $tahun; ?>
    </p>
<?php else : ?>
    <p style="text-align: center; font-weight: bold;text-transform: uppercase;">
        LAPORAN KEUANGAN <br>
        cv. KALBAR KARGO MANDIRI <br>
        PERIODE <?= tgl_indo(date('Y-m-d', strtotime($tgl_awal))); ?> s/d <?= tgl_indo(date('Y-m-d', strtotime($tgl_akhir))); ?>
    </p>
<?php endif; ?>
<hr style="height: 2px; color: #000; margin: 10px 0 20px 0;">


<!-- |PENJUALAN / PEMASUKAN| -->
<div class="center">
    <strong>PEMASUKAN</strong>
</div>
<table cellpadding="1" cellspacing="0" style="width:100%; margin: 10px 0px 15px 0px;">
    <tr style="font-size:11px;">
        <th>NO.</th>
        <th>TANGGAL</th>
        <th>PENJUALAN</th>
    </tr>

    <?php
    $no = 0;
    foreach ($datapenjualan->result() as $row) : ?>
        <?php $deleted = $row->deleted == 0; ?>
        <tr style="text-transform: uppercase;font-size:11px;text-align: center;">
            <td style="text-align: center;"><?= ++$no; ?></td>
            <td><?= tgl_indo(date('Y-m-d', strtotime($row->created_at))); ?></td>
            <td><?= $deleted ? rupiah($row->total_operasional) : '-'; ?></td>
        </tr>
        <?php
            $totalOperasional += $deleted ? $row->total_operasional : null;
            ?>
    <?php endforeach; ?>

    <tr style="text-transform: uppercase;font-size:12px;">
        <td colspan="2" class="td-bold">TOTAL</td>
        <td class="td-bold center"><?= rupiah($totalOperasional); ?></td>
    </tr>
</table>


<!-- |PENGELUARAN| -->
<div class="center">
    <strong>PENGELUARAN</strong>
</div>
<table cellpadding="1" cellspacing="0" style="width:100%; margin: 10px 0px 15px 0px;">
    <tr style="font-size:11px;">
        <th>NO.</th>
        <th>TANGGAL</th>
        <th>PENGELUARAN</th>
    </tr>

    <?php
    $no = 0;
    foreach ($datapembelian->result() as $row) : ?>
        <tr style="text-transform: uppercase;font-size:11px;text-align: center;">
            <td style="text-align: center;"><?= ++$no; ?></td>
            <td><?= tgl_indo(date('Y-m-d', strtotime($row->created_at))); ?></td>
            <td><?= rupiah($row->harga); ?></td>
        </tr>
        <?php
            $totalPembelian += $row->harga;
            ?>
    <?php endforeach; ?>

    <tr style="text-transform: uppercase;font-size:12px;">
        <td colspan="2" class="td-bold">TOTAL</td>
        <td class="td-bold center"><?= rupiah($totalPembelian); ?></td>
    </tr>
</table>


<!-- |GAJI| -->
<div class="center">
    <strong>GAJI</strong>
</div>
<table cellpadding="1" cellspacing="0" style="width:100%; margin: 10px 0px 15px 0px;">
    <tr style="font-size:11px;">
        <th>NO.</th>
        <th>TANGGAL</th>
        <th>NAMA</th>
        <th>GAJI</th>
    </tr>

    <?php
    $no = 0;
    foreach ($datagaji->result() as $row) : ?>
        <tr style="text-transform: uppercase;font-size:11px;text-align: center;">
            <td style="text-align: center;"><?= ++$no; ?></td>
            <td><?= tgl_indo(date('Y-m-d', strtotime($row->created_at))); ?></td>
            <td><?= $row->nama ?></td>
            <td><?= rupiah($row->total_gaji); ?></td>
        </tr>
        <?php
            $totalGaji += $row->total_gaji;
            ?>
    <?php endforeach; ?>

    <tr style="text-transform: uppercase;font-size:12px;">
        <td colspan="3" class="td-bold">TOTAL</td>
        <td class="td-bold center"><?= rupiah($totalGaji); ?></td>
    </tr>
</table>


<!-- || LABA -->
<div class="center">
    <strong>LABA</strong>
</div>
<table cellpadding="1" cellspacing="0" style="width:100%; margin: 10px 0px 15px 0px;">
    <tr style="text-transform: uppercase;font-size:11px;text-align: center;">
        <th>PEMASUKAN</th>
        <th>PENGELUARAN</th>
        <th>GAJI</th>
        <th>LABA</th>
    </tr>
    <tr style="text-transform: uppercase;font-size:12px;">
        <td class="center"><?= rupiah($totalOperasional) ?></td>
        <td class="center"><?= rupiah($totalPembelian) ?></td>
        <td class="center"><?= rupiah($totalGaji) ?></td>
        <td class="center td-bold"><?= rupiah($totalOperasional - $totalPembelian - $totalGaji) ?></td>
    </tr>
</table>

<?php echo '</body></html>'; ?>