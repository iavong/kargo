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

<!-- || Deposit -->
<div class="center">
    <strong>DEPOSIT</strong>
</div>
<table cellpadding="2" cellspacing="0" style="width:100%; margin: 10px 0px 15px 0px;">
    <tr style="font-size:11px;">
        <th>NO.</th>
        <th>TGL</th>
        <th>DEPOSIT</th>
    </tr>

    <?php
    $no = 0;
    foreach ($datadeposit->result() as $row) : ?>
        <?php $isDeposit = $row->tipe == 1;  ?>
        <?php if ($isDeposit) : ?>
            <tr style="text-transform: uppercase;font-size:11px;text-align: center;">
                <td style="text-align: center;"><?= $isDeposit ? ++$no : null; ?></td>
                <td style="text-align: center;"><?= $isDeposit ? tgl_indo(date('Y-m-d', strtotime($row->created_at))) : null; ?></td>
                <td><?= $isDeposit ? rupiah($row->deposit) : null; ?></td>
            </tr>
        <?php endif; ?>
        <?php
        $totalDeposit += $isDeposit ? $row->deposit : null;
        $totalDp = $totalDeposit;
        ?>
    <?php endforeach; ?>
    <tr style="font-size:11px;">
        <td colspan="2" class="td-bold">TOTAL</td>
        <td class="td-bold center"><?= rupiah($totalDp); ?></td>
    </tr>
</table>

<!-- || History -->
<div class="center">
    <strong>HISTORY ORDER</strong>
</div>
<table cellpadding="2" cellspacing="0" style="width:100%; margin: 10px 0px 15px 0px;">
    <tr style="font-size:11px;">
        <th>NO.</th>
        <th>TGL</th>
        <th>HISTORY</th>
    </tr>

    <?php
    $no = 0;
    foreach ($datadeposit->result() as $row) :
        $isHistory = $row->tipe == 0;
    ?>
        <?php if ($isHistory) : ?>
            <tr style="text-transform: uppercase;font-size:11px;text-align: center;">
                <td style="text-align: center;"><?= $isHistory ? ++$no : null; ?></td>
                <td style="text-align: center;"><?= $isHistory ? tgl_indo(date('Y-m-d', strtotime($row->created_at))) : null; ?></td>
                <td><?= $isHistory ? rupiah($row->deposit) : '-'; ?></td>
            </tr>
        <?php endif; ?>
        <?php
        $totalHistory += $isHistory ? $row->deposit : null;
        $totalHis = $totalHistory;
        ?>
    <?php endforeach; ?>
    <tr style="font-size:11px;">
        <td colspan="2" class="td-bold">TOTAL</td>
        <td class="td-bold center"><?= rupiah($totalHis); ?></td>
    </tr>
</table>


<!-- || DEPOSIT DAN HISTORY -->
<div class="center">
    <strong>DEPOSIT & HISTORY ORDER</strong>
</div>

<!-- <table cellpadding="2" cellspacing="0" style="width:100%; margin: 10px 0px 15px 0px;">
    <tr>
        <th>NO.</th>
        <th>TGL</th>
        <th>DEPOSIT</th>
        <th>HISTORY</th>
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
</table> -->
<table cellpadding="1" cellspacing="0" style="width:100%; margin: 10px 0px 15px 0px;">
    <tr style="text-transform: uppercase;font-size:11px;text-align: center;">
        <th>DEPOSIT</th>
        <th>HISTORY</th>
        <th>AKUMULASI DEPOSIT</th>
    </tr>
    <tr style="text-transform: uppercase;font-size:11px;text-align: center;">
        <td class="center"><?= rupiah($totalDp) ?></td>
        <td class="center"><?= rupiah($totalHis) ?></td>
        <td class="center td-bold"><?= rupiah($totalDp - $totalHis) ?></td>
    </tr>
</table>


<?php echo '</body></html>'; ?>