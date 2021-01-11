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
        LAPORAN PEMBELIAN <br>
        cv. KALBAR KARGO MANDIRI <br>
        BULAN <?= strftime('%B', mktime(0, 0, 0, $bulan)); ?> TAHUN <?= $tahun; ?>
    </p>
<?php else : ?>
    <p style="text-align: center; font-weight: bold;text-transform: uppercase;">
        LAPORAN PEMBELIAN <br>
        cv. KALBAR KARGO MANDIRI <br>
        PERIODE <?= tgl_indo(date('Y-m-d', strtotime($tgl_awal))); ?> s/d <?= tgl_indo(date('Y-m-d', strtotime($tgl_akhir))); ?>
    </p>
<?php endif; ?>
<hr style="height: 2px; color: #000; margin: 10px 0 20px 0;">
<table cellpadding="2" cellspacing="0" style="width:100%;">
    <tr style="font-size:11px;">
        <td class="center td-bold">NO.</td>
        <td class="center td-bold">TANGGAL</td>
        <td class="center td-bold">KETERANGAN</td>
        <td class="center td-bold">HARGA</td>
    </tr>

    <?php
    $no = 0;
    foreach ($datapembelian->result() as $row) : ?>
        <tr style="text-transform: uppercase;font-size:11px;text-align: center;">
            <td><?= ++$no; ?></td>
            <td><?= tgl_indo(date('Y-m-d', strtotime($row->created_at))); ?></td>
            <td><?= (!empty($row->keterangan) ? $row->keterangan : '-'); ?></td>
            <td><?= rupiah($row->harga); ?></td>
        </tr>
        <?php
        $total += $row->harga;
        ?>
    <?php endforeach; ?>
    <tr style="font-size:11px;">
        <td colspan="3" class="td-bold">TOTAL</td>
        <td class="td-bold center"><?= rupiah($total); ?></td>
    </tr>
</table>

<?php echo '</body></html>'; ?>