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
        LAPORAN DEPOSIT <br>
        cv. KALBAR KARGO MANDIRI <br>
        BULAN <?= strftime('%B', mktime(0, 0, 0, $bulan)); ?> TAHUN <?= $tahun; ?>
    </p>
<?php else : ?>
    <p style="text-align: center; font-weight: bold;text-transform: uppercase;">
        LAPORAN DEPOSIT <br>
        cv. KALBAR KARGO MANDIRI <br>
        PERIODE <?= tgl_indo(date('Y-m-d', strtotime($tgl_awal))); ?> s/d <?= tgl_indo(date('Y-m-d', strtotime($tgl_akhir))); ?>
    </p>
<?php endif; ?>
<p style="font-weight: bold;text-transform: uppercase;">Nama : <?= $pengirim->nama; ?></p>
<hr style="height: 2px; color: #000; margin: 10px 0 20px 0;">
<table cellpadding="2" cellspacing="0" style="width:100%;">
    <tr>
        <td class="center td-bold">NO.</td>
        <td class="center td-bold">TGL</td>
        <td class="center td-bold">DEPOSIT</td>
        <td class="center td-bold">HISTORY</td>
    </tr>

    <?php
    $no = 0;
    foreach ($datadeposit->result() as $row) : ?>
        <tr>
            <td style="text-align: center;"><?= ++$no; ?></td>
            <td style="text-align: center;"><?= tgl_indo(date('Y-m-d', strtotime($row->created_at))); ?></td>
            <td><?= $row->tipe == 1 ? rupiah($row->deposit) : '-'; ?></td>
            <td><?= $row->tipe == 0 ? rupiah($row->deposit) : '-'; ?></td>
        </tr>
        <?php
            $totalDeposit += $row->tipe == 1 ? $row->deposit : null;
            $totalHistory += $row->tipe == 0 ? $row->deposit : null;
            ?>
    <?php endforeach; ?>
    <tr>
        <td colspan="2" class="td-bold">TOTAL</td>
        <td class="td-bold"><?= rupiah($totalDeposit); ?></td>
        <td class="td-bold"><?= rupiah($totalHistory); ?></td>
    </tr>
</table>

<?php echo '</body></html>'; ?>