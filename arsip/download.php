<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';
require_once '../vendor/autoload.php';

check_role();

$id_surat = intval($_GET['id']);

// Get permohonan data with penduduk info
$query = "SELECT permohonan_sk.*, penduduk.* 
          FROM permohonan_sk 
          LEFT JOIN penduduk ON permohonan_sk.id_penduduk = penduduk.id_penduduk 
          WHERE permohonan_sk.id_surat = $id_surat AND permohonan_sk.status = 'disahkan_lurah'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die('Surat tidak ditemukan atau belum disahkan!');
}

// Get SK number from sk_disetujui
$query_sk = "SELECT nomor_sk FROM sk_disetujui WHERE id_surat = $id_surat";
$result_sk = mysqli_query($conn, $query_sk);
$sk_data = mysqli_fetch_assoc($result_sk);
$nomor_sk = $sk_data['nomor_sk'] ?? 'N/A';

// Create PDF
$mpdf = new \Mpdf\Mpdf([
    'format' => 'A4',
    'margin_left' => 20,
    'margin_right' => 20,
    'margin_top' => 20,
    'margin_bottom' => 20,
]);

// HTML Content
$html = '
<style>
    body { font-family: Arial, sans-serif; }
    .header { text-align: center; margin-bottom: 30px; }
    .header h2 { margin: 5px 0; }
    .content { margin-top: 20px; }
    .footer { margin-top: 50px; text-align: right; }
    table { width: 100%; }
    table td { padding: 5px; }
</style>

<div class="header">
    <h2>PEMERINTAH DESA</h2>
    <h3>SURAT KETERANGAN</h3>
    <p>Nomor: ' . $nomor_sk . '</p>
</div>

<div class="content">
    <p>Yang bertanda tangan di bawah ini, Lurah Desa, menerangkan bahwa:</p>
    
    <table>
        <tr>
            <td width="150">Nama</td>
            <td width="10">:</td>
            <td>' . $data['nama_lengkap'] . '</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>' . $data['nik'] . '</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>' . $data['alamat'] . '</td>
        </tr>
        <tr>
            <td>No. Telp</td>
            <td>:</td>
            <td>' . $data['no_telp'] . '</td>
        </tr>
    </table>
    
    <p style="margin-top: 20px;">
        <strong>Keterangan:</strong><br>
        ' . nl2br($data['keterangan']) . '
    </p>
    
    <p style="margin-top: 20px;">
        Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
    </p>
</div>

<div class="footer">
    <p>
        Desa, ' . date('d F Y') . '<br>
        Lurah Desa<br><br><br><br>
        <u>_________________</u><br>
        NIP. 
    </p>
</div>
';

$mpdf->WriteHTML($html);

// Output PDF
$filename = 'Surat_' . str_replace(' ', '_', $data['keterangan']) . '_' . $data['nama_lengkap'] . '.pdf';
$mpdf->Output($filename, 'D'); // D = Download
?>