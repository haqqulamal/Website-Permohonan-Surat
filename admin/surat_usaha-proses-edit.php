<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_surat_usaha = $_POST["id_surat_usaha"];
$nomor_surat = $_POST["nomor_surat"];
$id_penduduk = $_POST["id_penduduk"];
$tempat_tanggal_lahir = $_POST["tempat_tanggal_lahir"];
$alamat_tempat_tinggal = $_POST["alamat_tempat_tinggal"];
$jenis_usaha = $_POST["jenis_usaha"]; 
$created_at = $_POST["created_at"];

if($edit = mysqli_query($konek, "UPDATE surat_usaha SET nomor_surat='$nomor_surat', id_penduduk='$id_penduduk', tempat_tanggal_lahir='$tempat_tanggal_lahir', alamat_tempat_tinggal='$alamat_tempat_tinggal', jenis_usaha='$jenis_usaha', created_at='$created_at'
                WHERE id_surat_usaha='$id_surat_usaha'")){
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
                                window.location.replace('surat_usaha');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>