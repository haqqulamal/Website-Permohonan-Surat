<?php
require_once __DIR__ . '/vendor/autoload.php';
include "koneksi.php";
include "auth_middleware.php";
check_login();

$id_surat = mysqli_real_escape_string($konek, $_GET['id']);

// Fetch permohonan and penduduk details
$sql = "SELECT p.*, d.*, j.nama_surat FROM permohonan_sk p 
        JOIN penduduk d ON p.id_penduduk = d.id_penduduk 
        LEFT JOIN jenis_surat j ON p.id_jenis_surat = j.id -- Assuming table exists, adjust if needed
        WHERE p.id_surat = '$id_surat'";
// Fallback if jenis_surat table doesn't follow expectations
$sql = "SELECT p.*, d.* FROM permohonan_sk p 
        JOIN penduduk d ON p.id_penduduk = d.id_penduduk 
        WHERE p.id_surat = '$id_surat'";

$res = mysqli_query($konek, $sql);
$data = mysqli_fetch_assoc($res);

if (!$data || $data['status'] !== 'disahkan_lurah') {
    die("Surat belum disahkan atau tidak ditemukan.");
}

// Check authorization (Penduduk can only download their own, Staff/Lurah can download any)
if ($_SESSION['role_name'] == 'penduduk' && $data['id_penduduk'] != $_SESSION['id_penduduk']) {
    die("Unauthorized access.");
}

$mpdf = new \Mpdf\Mpdf();

// Simple HTML Template for the letter
$html = '
<div style="text-align: center; border-bottom: 2px solid black; padding-bottom: 10px;">
    <h3>PEMERINTAH KABUPATEN SLEMAN</h3>
    <h4>KAPANEWON DEPOK</h4>
    <h2>KALURAHAN .................</h2>
</div>

<div style="text-align: center; margin-top: 20px;">
    <u><h3>SURAT KETERANGAN</h3></u>
    <p>Nomor: ' . ($id_surat . '/SK/2026') . '</p>
</div>

<div style="margin-top: 30px;">
    <p>Yang bertanda tangan di bawah ini Lurah ............., menerangkan bahwa:</p>
    <table style="width: 100%; margin-left: 50px;">
        <tr><td style="width: 150px;">Nama Lengkap</td><td>: ' . $data['nama_lengkap'] . '</td></tr>
        <tr><td>NIK</td><td>: ' . $data['nik'] . '</td></tr>
        <tr><td>Alamat</td><td>: ' . $data['alamat'] . '</td></tr>
        <tr><td>Jenis Permohonan</td><td>: ' . $data['jenis_permohonan'] . '</td></tr>
        <tr><td>Keterangan</td><td>: ' . $data['keterangan'] . '</td></tr>
    </table>
    
    <p style="margin-top: 20px;">Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
</div>

<div style="margin-top: 50px; float: right; text-align: center; width: 300px;">
    <p>' . date('d F Y') . '</p>
    <p>Lurah .............</p>
    <br><br><br>
    <p><b>( ____________________ )</b></p>
</div>
';

$mpdf->WriteHTML($html);
$mpdf->Output($data['jenis_permohonan'] . "_" . $data['nama_lengkap'] . ".pdf", 'D');
?>