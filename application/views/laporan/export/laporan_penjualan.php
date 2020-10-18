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
<table cellpadding="8" cellspacing="0" style="width:100%;">
    <tr style="font-size:11px;">
        <td class="center td-bold">NO.</td>
        <td class="center td-bold">NO. KWT.</td>
        <td class="center td-bold">TGL</td>
        <td class="center td-bold">PENGIRIM</td>
        <td class="center td-bold">PENERIMA</td>
        <td class="center td-bold">RUTE</td>
        <td class="center td-bold">BERAT</td>
        <td class="center td-bold">KOLI</td>
        <td class="center td-bold">BIAYA SMU</td>
        <td class="center td-bold">ADMIN SMU</td>
        <td class="center td-bold">JS. GDG.</td>
        <td class="center td-bold">ADM. JS. GDG.</td>
        <td class="center td-bold">TOTAL</td>
    </tr>

    <?php
    $no = 0;
    foreach ($datapenjualan->result() as $row) : ?>
        <tr style="text-transform: uppercase;font-size:11px;">
            <td style="text-align: center;"><?= ++$no; ?></td>
            <td><?= $row->no_kwitansi; ?></td>
            <td><?= tgl_indo(date('Y-m-d', strtotime($row->created_at))); ?></td>
            <td><?= $row->pengirim; ?></td>
            <td><?= $row->penerima; ?></td>
            <td><?= $row->kota_tujuan; ?></td>
            <td><?= $row->berat . ' Kg'; ?></td>
            <td><?= $row->koli; ?></td>
            <td><?= rupiah($row->harga_smu); ?></td>
            <td><?= rupiah($row->biaya_admin_smu); ?></td>
            <td><?= rupiah($row->harga_gudang); ?></td>
            <td><?= rupiah($row->harga_admin_gudang); ?></td>
            <td><?= rupiah($row->biaya_total); ?></td>
        </tr>
        <?php
        $total += $row->biaya_total;
        ?>
    <?php endforeach; ?>
    <tr>
        <td colspan="12" class="td-bold">TOTAL</td>
        <td class="td-bold"><?= rupiah($total); ?></td>
    </tr>
</table>

<?php echo '</body></html>'; ?>