<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_surat = $_POST["id_surat"];
$id_user = $_POST["id_user"];
$id_penduduk = $_POST["id_penduduk"];
$jenis_permohonan = $_POST["jenis_permohonan"];
$keterangan = $_POST["keterangan"];
$tanggal_permohonan = $_POST["tanggal_permohonan"]; 
$status = $_POST["status"];

if($edit = mysqli_query($konek, "UPDATE permohonan_sk SET id_user='$id_user', id_penduduk='$id_penduduk', jenis_permohonan='$jenis_permohonan', keterangan='$keterangan', tanggal_permohonan='$tanggal_permohonan', status='$status'
                WHERE id_surat='$id_surat'")){
        echo " 
        <script>
                                setTimeout(function () {  
                                swal({
                                title: 'Sukses',
                                text:  'Data Berhasil Di Edit!!',
                                type: 'success',
                                timer: 1900,
                                showConfirmButton: true
                                });  
                                },90); 
                                window.setTimeout(function(){ 
                                window.location.replace('perizinan_usaha');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>