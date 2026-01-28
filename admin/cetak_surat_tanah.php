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

$id_surat_tanah = $_GET['id_surat_tanah'];

$sql = "SELECT * FROM surat_tanah WHERE id_surat_tanah=$id_surat_tanah";
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
    <title>Cetak Surat Keterangan</title>
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
            <h3>SURAT KETERANGAN</h3>
            <p>Nomor: <strong><?php echo htmlspecialchars($row['nomor_buku']); ?></strong></p>
        </div>
        <div class="content">
            <p>Yang bertanda tangan di bawah ini :</p>
            <p><strong>ARIHADI</strong>, Lurah Kalitirto, Kapanewon Berbah, Kabupaten Sleman menerangkan dengan ini bahwa :</p>
            <ol>
                <li>Sebidang tanah bekas hak adat berupa Tanah <strong><?php echo htmlspecialchars($row['model_tanah']); ?></strong>, 
                Terdaftar dalam Buku Pepikiran Desa No. <strong><?php echo htmlspecialchars($row['nomor_buku']); ?></strong> / Buku Letter C Desa No. <strong><?php echo htmlspecialchars($row['nomor_letter_c']); ?></strong>, 
                Model D No. <strong><?php echo htmlspecialchars($row['nomor_model_d']); ?></strong>, Model E No. <strong><?php echo htmlspecialchars($row['nomor_model_e']); ?></strong>, Gambar Situasi No. <strong><?php echo htmlspecialchars($row['nomor_situasi']); ?></strong>, 
                Kutipan dari Buku Daftar Hak Milik No. <strong><?php echo htmlspecialchars($row['nomor_hak_milik']); ?></strong>, Surat Ukur No. <strong><?php echo htmlspecialchars($row['nomor_ukur']); ?></strong>, 
                Persil No. <strong><?php echo htmlspecialchars($row['nomor_persil']); ?></strong>, Kelas P.IV, Luas: <strong><?php echo htmlspecialchars($row['luas_tanah']); ?> m<sup>2</sup></strong> dengan segala sesuatu yang berdiri di atasnya 
                berupa Tanah Pekarangan dan terletak di Padukuhan <strong><?php echo htmlspecialchars($row['alamat']); ?></strong>, Kalurahan Kalitirto, 
                Kapanewon Berbah, tersebut setempat berbatasan dengan tanah-tanah kepunyaan:
                    <table>
                        <tr><td>Utara</td><td>: <strong><?php echo htmlspecialchars($row['batas_utara']); ?></strong></td></tr>
                        <tr><td>Timur</td><td>: <strong><?php echo htmlspecialchars($row['batas_timur']); ?></strong></td></tr>
                        <tr><td>Selatan</td><td>: <strong><?php echo htmlspecialchars($row['batas_selatan']); ?></strong></td></tr>
                        <tr><td>Barat</td><td>: <strong><?php echo htmlspecialchars($row['batas_barat']); ?></strong></td></tr>
                    </table>
                </li>
                <li>Pemilik tanah tersebut adalah Warga Negara Indonesia Umur <strong><?php echo htmlspecialchars($row['umur']); ?></strong>, 
                dan bertempat tinggal terakhir di Padukuhan <strong><?php echo htmlspecialchars($row['alamat']); ?></strong>, Kalurahan Kalitirto, Kapanewon Berbah, Kabupaten Sleman.</li>
                <li>Tanah tersebut sampai pada waktu keterangan ini dibuat masih tetap tertulis atas namanya 
                dan tidak menjadi perselisihan dengan pihak lain, baik mengenai haknya maupun batas-batasnya serta belum bersertifikat.</li>
                <li>Tanah tersebut dipergunakan untuk Tanah <strong><?php echo htmlspecialchars($row['penggunaan_tanah']); ?></strong>.</li>
                <li>Keterangan ini diberikan untuk memenuhi keterangan-keterangan dalam PP.24/1997 Pasal 24 ayat 1 dan 2.</li>
            </ol>
        </div>
        <div class="signature">
            <p>Kalitirto, <strong><?php echo htmlspecialchars($row['tanggal_surat']); ?></strong></p>
            <p>Lurah Kalitirto</p>
            <div class="tanda">
            <img src="tanda_tangan.png" alt="Tanda Tangan">
            <p><strong>ARIHADI</strong></p>
        </div>
    </div>
</body>
</html>