<?php
error_reporting(0);
$row = $penjualan->row();
?>
<!DOCTYPE html>
<?php echo '<html><head>'; ?>
<title>Cetak Nota Penjualan</title>
<style>
    * {
        font-size: 11px;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        border: none;
    }

    .td-bold {
        font-weight: bold;
    }

    .kapital {
        text-transform: uppercase;
    }

    .center {
        text-align: center;
    }

    /* img.center {
        display: block;
        margin: 0 auto;
    } */
</style>
<?php echo '</head><body>'; ?>
<p class="textalign: center">Terima Kasih</p>

<!-- <p>SEMOGA PUAS DENGAN LAYANAN KAMI. TERIMA KASIH</p> -->

<?php echo '</body></html>'; ?>