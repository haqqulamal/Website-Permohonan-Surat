<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_sk = $_POST["id_sk"];
$id_surat = $_POST["id_surat"];
$nomor_sk = $_POST["nomor_sk"];
$tanggal_sk = $_POST["tanggal_sk"];
$created_at_disetujui = $_POST["created_at_disetujui"]; 

if($edit = mysqli_query($konek, "UPDATE sk_disetujui SET id_surat='$id_surat', nomor_sk='$nomor_sk', tanggal_sk='$tanggal_sk', created_at_disetujui='$created_at_disetujui' WHERE id_sk='$id_sk'")){
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
                                window.location.replace('sk_disetujui');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>