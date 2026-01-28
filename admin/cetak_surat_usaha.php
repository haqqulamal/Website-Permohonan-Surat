<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "surat_perizinan";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id_surat_usaha = $_GET['id_surat_usaha'];

$sql = "SELECT * FROM surat_usaha INNER JOIN penduduk ON penduduk.id_penduduk = surat_usaha.id_penduduk WHERE id_surat_usaha=$id_surat_usaha";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Surat tidak ditemukan.";
    exit;
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Surat Keterangan Usaha</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }
        .container {
            width: 595px; /* sesuai ukuran A4 dalam piksel untuk 72 dpi */
            margin: auto;
            border: 1px solid #000;
            padding: 20px;
        }
        .header img {
            float: left;
            width: 110px;
            height: 110px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2, .header h3 {
            margin: 0;
        }
        .content {
            text-align: justify;
            margin-top: 40px;
        }
        .content table {
            width: 100%;
        }
        .signature {
            text-align: right;
            margin-top: 50px;
        }
        .signature img {
            width: 200px; /* Sesuaikan ukuran tanda tangan sesuai kebutuhan */
            height: auto;
        }
        .tanda img {
            width: 100px; /* Sesuaikan ukuran tanda tangan sesuai kebutuhan */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="sleman.png" alt="Logo Sleman">
            <h2>PEMERINTAH KABUPATEN SLEMAN</h2>
            <h3>KAPANEWON BERBAH</h3>
            <h3>PEMERINTAH KALURAHAN KALITIRTO</h3>
            Jalan Tanjungtirto, Kalitirto, Berbah, Sleman, 55573 <br>
            Email: kalitirto@slemankab.go.id Telp. 085602220001 
            <hr>
            <h3>SURAT KETERANGAN USAHA</h3>
            <p>Nomor: <?php echo $row['nomor_surat']; ?> </p>
        </div>
        <div class="content">
            <p>Yang bertanda tangan di bawah ini:</p>
            <table>
                <tr>
                    <td>Nama</td>
                    <td>: Arihadi</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>: Lurah</td>
                </tr>
            </table>
            <p>Dengan ini menerangkan bahwa:</p>
            <table>
                <tr>
                    <td>Nama</td>
                    <td>: <?php echo $row['nama_lengkap']; ?></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: <?php echo $row['nik']; ?></td>
                </tr>
                <tr>
                    <td>Tempat Tanggal Lahir</td>
                    <td>: <?php echo $row['tempat_tanggal_lahir']; ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: <?php echo $row['alamat']; ?></td>
                </tr>
                <tr>
                    <td>Jenis Usaha</td>
                    <td>: <?php echo $row['jenis_usaha']; ?></td>
                </tr>
            </table>
            <p>Nama yang tersebut di atas adalah benar penduduk yang berdomisili Kalurahan Kalitirto, Kapanewon Berbah, Kabupaten Sleman. Berdasarkan pengamatan bahwa nama tersebut di atas memiliki usaha berupa:</p>
            <b><p><?php echo $row['jenis_usaha']; ?></p></b>
            <p>Demikian Surat Keterangan ini dibuat agar dipergunakan sebagaimana mestinya.</p>
        </div>
        <div class="signature">
            <p>Kalitirto, <?php echo $row['created_at']; ?></p>
            <p>Lurah Kalitirto</p>
       
            <div class="tanda">
            <img src="tanda_tangan.png" alt="Tanda Tangan">
         
            <p>ARIHADI</p>
        </div>
    </div>
</body>
</html>
