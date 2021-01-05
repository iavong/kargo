<?php
if (!function_exists('rupiah')) {
    // Fungsi menampilkan format rupiah
    function rupiah($angka)
    {
        $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }

    function test($angka)
    {
        $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
}
