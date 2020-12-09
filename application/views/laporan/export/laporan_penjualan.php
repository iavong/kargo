<?php error_reporting(0); ?>
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
        LAPORAN PENJUALAN <br>
        cv. KALBAR KARGO MANDIRI <br>
        BULAN <?= strftime('%B', mktime(0, 0, 0, $bulan)); ?> TAHUN <?= $tahun; ?>
    </p>
<?php else : ?>
    <p style="text-align: center; font-weight: bold;text-transform: uppercase;">
        LAPORAN PENJUALAN <br>
        cv. KALBAR KARGO MANDIRI <br>
        PERIODE <?= tgl_indo(date('Y-m-d', strtotime($tgl_awal))); ?> s/d <?= tgl_indo(date('Y-m-d', strtotime($tgl_akhir))); ?>
    </p>
<?php endif; ?>
<hr style="height: 2px; color: #000; margin: 10px 0 20px 0;">
<table cellpadding="1" cellspacing="0" style="width:100%;">
    <tr style="font-size:11px;">
        <td class="center td-bold">NO.</td>
        <td class="center td-bold">NO. KWT.</td>
        <td class="center td-bold">TANGGAL</td>
        <td class="center td-bold">NO. SMU</td>
        <td class="center td-bold">NO. FLIGHT</td>
        <td class="center td-bold">PENGIRIM</td>
        <td class="center td-bold">PENERIMA</td>
        <td class="center td-bold">RUTE</td>
        <td class="center td-bold">BERAT</td>
        <td class="center td-bold">KOLI</td>
        <td class="center td-bold">TOTAL SMU</td>
        <td class="center td-bold">TOTAL JSG</td>
        <td class="center td-bold">HANDLING</td>
        <td class="center td-bold">TOTAL</td>
    </tr>

    <?php
    $no = 0;
    foreach ($datapenjualan->result() as $row) : ?>
        <?php $deleted = $row->deleted == 0; ?>
        <tr style="text-transform: uppercase;font-size:11px;text-align: center;">
            <td style="text-align: center;"><?= ++$no; ?></td>
            <td><?= $row->no_kwitansi; ?></td>
            <td><?= tgl_indo(date('Y-m-d', strtotime($row->created_at))); ?></td>
            <td><?= $deleted ? $row->no_smu : '-'; ?></td>
            <td><?= $deleted ? $row->no_penerbangan : '-'; ?></td>
            <td><?= $deleted ? $row->pengirim : '-'; ?></td>
            <td><?= $deleted ? $row->penerima : '-'; ?></td>
            <td><?= $deleted ? $row->kota_tujuan : '-'; ?></td>
            <td><?= $deleted ? $row->berat . ' Kg' : '-'; ?></td>
            <td><?= $deleted ? $row->koli : '-'; ?></td>
            <td><?= $deleted ? rupiah($row->biaya_smu) : '-'; ?></td>
            <td><?= $deleted ? rupiah($row->total_biaya_gudang) : '-'; ?></td>
            <td><?= $deleted ? rupiah($row->total_operasional) : '-'; ?></td>
            <td><?= $deleted ? rupiah($row->biaya_total) : '-'; ?></td>
        </tr>
        <?php
            $total += $deleted ? $row->biaya_total : null;
            $totalOperasional += $deleted ? $row->total_operasional : null;
            ?>
    <?php endforeach; ?>
    <tr style="text-transform: uppercase;font-size:12px;">
        <td colspan="12" class="td-bold">TOTAL</td>
        <td class="td-bold center"><?= rupiah($totalOperasional); ?></td>
        <td class="td-bold center"><?= rupiah($total); ?></td>
    </tr>
</table>

<?php echo '</body></html>'; ?>