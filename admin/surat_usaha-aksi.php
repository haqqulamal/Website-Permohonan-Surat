<?php

include "../koneksi.php";
include "alert/loadalert.php";

$nomor_surat = $_POST["nomor_surat"];
$id_penduduk = $_POST["id_penduduk"];
$tempat_tanggal_lahir = $_POST["tempat_tanggal_lahir"];
$alamat_tempat_tinggal = $_POST["alamat_tempat_tinggal"];
$jenis_usaha = $_POST["jenis_usaha"]; 
$created_at = $_POST["created_at"];

if($add = mysqli_query($konek,"INSERT INTO surat_usaha (nomor_surat, id_penduduk, tempat_tanggal_lahir, alamat_tempat_tinggal, jenis_usaha, created_at) 
	VALUES ('$nomor_surat', '$id_penduduk', '$tempat_tanggal_lahir', '$alamat_tempat_tinggal', '$jenis_usaha', '$created_at')")){
        echo " 
        <script>
                                setTimeout(function () {  
                                swal({
                                title: 'Sukses',
                                text:  'Data Berhasil Di Simpan!!',
                                type: 'success',
                                timer: 1900,
                                showConfirmButton: true
                                });  
                                },90); 
                                window.setTimeout(function(){ 
                                window.location.replace('surat_usaha');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>