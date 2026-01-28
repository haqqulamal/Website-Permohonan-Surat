<?php
include "koneksi.php";
session_start();

// Cek apakah pengguna sudah login dan memiliki role admin atau petugas
if (!isset($_SESSION['Login']) || $_SESSION['Login'] !== true || !in_array($_SESSION['role'], ['pejabat', 'penduduk'])) {
    header("Location: logout.php");
    exit();
} 

include "../vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4',]);

ob_start();
    ?>
    <?php 
echo " 
       <style type='text/css'>
       .main-wrapper a {
            text-decoration: none;
            color: #3586b7;
        }
        .main-wrapper a.text-link:hover {
            border-bottom: 1px dashed #CCCCCC;
        }
        .tutorial-link-wrapper {
            text-align: center;
        }
        header {
            padding: 10px 30px 7px 30px;
            border-bottom: 2px solid #636b71;
            background: #343d44;
        }
        footer {   
            background: #343d44;
            padding: 10px 0 7px 30px;
            color: #b9bfc3;
            font-size: 10px;
        }
        footer a {
            color: #b9bfc3;
            text-decoration: none;
            margin-left: 10px;
        }
        .link-header {
            margin-top: 10px;
        }
        .link-header a {
            font-size: 10px;
            color: #b9bfc3;
            text-decoration: none;
            margin: 0;
        }
        .link-header a.home:hover {
            color: #b9bfc3;
        }
        .main-wrapper {
            padding: 25px 0;
        }
        .link-header {
            float: right;
        }
        .clearfix {
            clear: both;
        }
        @media screen and (max-width: 450px) {
            header,
            footer {
                text-align: center;
            }
            .link-header {
                float: none;
                margin: 0;
            }
        }

        h1 {
            margin: 25px auto 0;
            text-align: center;
            text-transform: uppercase;
            font-size: 10px;
        }

        table td {
            transition: all .5s;
        }
        .table-wrapper {
            overflow: auto;
        }
        .main-wrapper {
            padding: 20px;
        }
        .main-wrapper a:hover {
            border-bottom: 1px dashed #CCCCCC;
        }
        
        /* Table */
        .demo-table {
            border-collapse: collapse;
            font-size: 10px;
            min-width: 537px;
        }

        .demo-table th, 
        .demo-table td {
            border: 1px solid #e1edff;
            padding: 7px 17px;
        }
        .demo-table caption {
            margin: 7px;
        }

        /* Table Header */
        .demo-table thead th {
            background-color: #508abb;
            color: #FFFFFF;
            border-color: #6ea1cc !important;
            text-transform: uppercase;
        }

        /* Table Body */
        .demo-table tbody td {
            color: #353535;
        }
        .demo-table tbody td:first-child,
        .demo-table tbody td:nth-child(4),
        .demo-table tbody td:last-child {
            text-align: right;
        }

        .demo-table tbody tr:nth-child(odd) td {
            background-color: #f4fbff;
        }
        .demo-table tbody tr:hover td {
            background-color: #ffffa2;
            border-color: #ffff0f;
        }

        /* Table Footer */
        .demo-table tfoot th {
            background-color: #e5f5ff;
            text-align: right;
        }
        .demo-table tfoot th:first-child {
            text-align: left;
        }
        .demo-table tbody td:empty
        {
            background-color: #ffcccc;
        }
        
        /* Table 2 */
        .demo-table2 {
            border-collapse: collapse;
            font-size: 10px;
            min-width: 536px;
        }

        .demo-table2 th, 
        .demo-table2 td {
            padding: 7px 17px;
        }
        .demo-table2 caption {
            margin: 7px;
        }

        .demo-table2 thead th:last-child,
        .demo-table2 tfoot th:last-child,
        .demo-table2 tbody td:last-child {
            border: 0;
        }

        /* Table Header */
        .demo-table2 thead th {
            border-right: 1px solid #c7ecc7;
            text-transform: uppercase;
        }

        /* Table Body */
        .demo-table2 tbody td {
            color: #353535;
            border-right: 1px solid #c7ecc7;
        }
        .demo-table2 tbody tr:nth-child(odd) td {
            background-color: #f4fff7;
        }
        .demo-table2 tbody tr:nth-child(even) td {
            background-color: #dbffe5;
        }
        .demo-table2 tbody td:nth-child(4),
        .demo-table2 tbody td:first-child,
        .demo-table2 tbody td:last-child {
            text-align: right;
        }
        .demo-table2 tbody tr:hover td {
            background-color: #ffffa2;
            border-color: #ffff0f;
        }

        /* Table Footer */
        .demo-table2 tfoot th {
            border-right: 1px solid #5675;
            text-align: right;
        }





            table {
                background: #fff;
                padding: 5px;
            }

            .table1 td,th {
                background: #fff;
                padding: 2px;
                border: 0;
                border: 0px  solid #444;
            }
             td,th {
                border: 0;
                border: 1px  solid #444;
            }
            th {
                font-weight: bold;
            }

            tr,td {tr,
                vertical-align: top!important;
            }
            #right {
                border-right: none !important;
            }
            #left {
                border-left: none !important;
            }
            .isi {
                height: 300px!important;
            }
            .disp {
                text-align: center;
                padding: 1.5rem 0;
                margin-bottom: .5rem;
            }
            .logodisp {
                float: left;
                position: relative;

                margin: 0 0 0 1rem;
            }
            #lead {
                width: auto;
                position: relative;
                margin: 25px 0 0 58%;
            }
            .lead {
                font-weight: bold;
                text-decoration: underline;
                margin-bottom: -10px;
            }
            .tgh {
                text-align: center;
            }
            #nama {
                font-size: 2.1rem;
                margin-bottom: -1rem;
            }
            #alamat {
                font-size: 16px;
            }
            .up {
                text-transform: uppercase;
                margin: 0;
                line-height: 2.2rem;
                font-size: 1.5rem;
            }
            .status {
                margin: 0;
                font-size: 1.3rem;
                margin-bottom: .5rem;
            }
            #lbr {
                font-size: 20px;
                font-weight: bold;
            }
            .separator {
                border-bottom: 2px solid #616161;
                margin: -1.3rem 0 1.5rem;
            }
            @media print{
                body {
                    font-size: 12px;
                    color: #212121;
                }
                
                
                tr,td {
                    vertical-align: top!important;
                }
                #lbr {
                    font-size: 20px;
                }
                .isi {
                    height: 200px!important;
                }
                .tgh {
                    text-align: center;
                }
                .disp {
                    text-align: center;
                    margin: -.5rem 0;
                }
                .logodisp {
                    float: left;
                    position: relative;
                    width: 100px;
                    height: 150px;
                    margin: .5rem 0 0 .5rem;
                }
                #lead {
                    width: auto;
                    position: relative;
                    margin: 15px 0 0 75%;
                }
                .lead {
                    font-weight: bold;
                    text-decoration: underline;
                    margin-bottom: -10px;
                }
                #nama {
                    font-size: 18px!important;
                    font-weight: bold;
                    text-transform: uppercase;
                    margin: -10px 0 -20px 0;
                }
                .up {
                    font-size: 17px!important;
                    font-weight: normal;
                }
                .status {
                    font-size: 17px!important;
                    font-weight: normal;
                    margin-bottom: -.1rem;
                }
                #alamat {
                    margin-top: -15px;
                    font-size: 13px;
                }
                #lbr {
                    font-size: 17px;
                    font-weight: bold;
                }
                .separator {
                    border-bottom: 2px solid #363636;
                    margin: -1rem 0 1rem;
                }

            .separator {
                border-bottom: 2px solid #363636;
                width: 20px;
                    height: 115px;
            }

             .separator1 {
                border-bottom: 5px solid #363636;
                width: 20px;
                    height: 5px;
            }
            body { font-family: Times New Roman; font-size: 12.7px }
.pos { position: absolute; z-index: 0; left: 9px; top: 0px }
        </style>

        <html>
        <head>

        <body>
";

                
if(!empty($logo)){
                        echo '<img class="logodisp" src="../aset/foto/logopuskesmas.png'.$logo.'"/>';
                    } else {
                        echo '<div class="logodisp" id="_0:0" style="top:0">
<img name="_1301:851" src="sleman.png" height="100" width="100" border="0" usemap="#Map"></div>';
                    }
                    echo '
 

<div class="pos" id="_378:102" style="top:100;left:255">
<span id="_24.4" style="font-weight:bold; font-family:Times New Roman; font-size:14.0px; color:#000000">
PEMERINTAH KALURAHAN KALITIRTO</span>
</div>

<div class="separator"></div>
<div class="pos" id="_186:195" style="top:120;left:315">
<span id="_24.4" style="font-weight:bold; font-family:Times New Roman; font-size:18.0px; color:#000000">
BERBAH, SLEMAN</span>
</div>

<div class="pos" id="_389:214" style="top:140;left:170">
<span id="_16.3" style=" font-family:Times New Roman; font-size:12.5px; color:#000000">
Teguhan, Kalitirto, Kec. Berbah, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55573</span>
<br> 
</div>
</div></div>';

echo "
                </div>
                ";
                echo ' 
                <h5 class="tgh" id="nama">Laporan Data Permohonan SK Tanah<br></h5> 
                            
                           
<br><br>
                            
                    <div class="">
            <div class="">
                <table class="demo-table2" width="100%" cellspacing="0" >
                    <thead class="">
                            
                                <tr>
                                    <th>No</th>
                                    <th>id_surat</th>
                                    <th>username</th>
                                    <th>nama_lengkap</th>
                                    <th>jenis_permohonan</th>
                                    <th>keterangan</th> 
                                    <th>tanggal_permohonan</th> 
                                    <th>status</th> 
                                </tr>                            
</thead>
                    <tbody>
                           
                                ';
include "../koneksi.php";
                            $querydosen = mysqli_query ($konek, "SELECT * FROM permohonan_sk 
                                                  INNER JOIN penduduk ON penduduk.id_penduduk = permohonan_sk.id_penduduk
                                                  INNER JOIN user ON user.id_user = permohonan_sk.id_user 
                                                  WHERE jenis_permohonan='Kepemilikan Tanah'");
                        if($querydosen == false){
                            die ("Terjadi Kesalahan : ". mysqli_error($konek));
                        }
                        $no = 0;
                                while($dosen = mysqli_fetch_array($querydosen)){
                                    $no++;
                            
                    
                                
                                 echo '
                                 <tr>
                                        <td>'.$no.'</td> 
                                        <td>'.$dosen['id_surat'].'</td>
                                        <td>'.$dosen['username'].'</td>
                                        <td>'.$dosen['nama_lengkap'].'</td>
                                        <td>'.$dosen['jenis_permohonan'].'</td>
                                        <td>'.$dosen['keterangan'].'</td> 
                                        <td>'.$dosen['tanggal_permohonan'].'</td>  
                                        <td>'.$dosen['status'].'</td>   
                                </tr>
                            ';
                                }
                            echo '
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 

<br>
<br>
<table border="0" class="table1" align="right" style=" font-family:Times New Roman; font-size:11px; color:#000000">
    <tbody>
'; echo "";
function TanggalIndonesia($date) {
    $date = date('Y-m-d',strtotime($date));
    if($date == '0000-00-00')
        return 'Tanggal Kosong';
 
    $tgl = substr($date, 8, 2);
    $bln = substr($date, 5, 2);
    $thn = substr($date, 0, 4);
 
    switch ($bln) {
        case 1 : {
                $bln = 'Januari';
            }break;
        case 2 : {
                $bln = 'Februari';
            }break;
        case 3 : {
                $bln = 'Maret';
            }break;
        case 4 : {
                $bln = 'April';
            }break;
        case 5 : {
                $bln = 'Mei';
            }break;
        case 6 : {
                $bln = 'Juni';
            }break;
        case 7 : {
                $bln = 'Juli';
            }break;
        case 8 : {
                $bln = 'Agustus';
            }break;
        case 9 : {
                $bln = 'September';
            }break;
        case 10 : {
                $bln = 'Oktober';
            }break;
        case 11 : {
                $bln = 'November';
            }break;
        case 12 : {
                $bln = 'Desember';
            }break;
        default: {
                $bln = 'UnKnown';
            }break;
    }
 
    $hari = date('N', strtotime($date));
    switch ($hari) {
        case 0 : {
                $hari = 'Minggu';
            }break;
        case 1 : {
                $hari = 'Senin';
            }break;
        case 2 : {
                $hari = 'Selasa';
            }break;
        case 3 : {
                $hari = 'Rabu';
            }break;
        case 4 : {
                $hari = 'Kamis';
            }break;
        case 5 : {
                $hari = "Jum'at";
            }break;
        case 6 : {
                $hari = 'Sabtu';
            }break;
        default: {
                $hari = 'UnKnown';
            }break;
    }
 
    $tanggalIndonesia = "".$tgl . " " . $bln . " " . $thn;
    return $tanggalIndonesia;
}
                                        echo '
        <tr>
            <td><b>Mengetahui,</b></td>
        </tr>
        <tr>
            <td>Sleman, '.TanggalIndonesia(date('Y-m-d')).'</td>
        </tr>

        <tr>
            <td><b>Kepala Desa</b></td>
        </tr> 
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>

        <tr>
            <td><b>Muhammad Nashir, S.Stp</b></td>
        </tr>
        <tr>
            <td><b>NIP. 19861226 200602 1 002</b></td>
        </tr>


    </tbody>
</table>

';
     
                             

                                

    

?>
<?php 

//penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
$mpdf->WriteHTML($html);
$mpdf->Output('sktanah' ,'I');
?>
