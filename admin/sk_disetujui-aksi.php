<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_surat = $_POST["id_surat"];
$nomor_sk = $_POST["nomor_sk"];
$tanggal_sk = $_POST["tanggal_sk"];
$created_at_disetujui = $_POST["created_at_disetujui"]; 

if($add = mysqli_query($konek,"INSERT INTO sk_disetujui (id_surat, nomor_sk, tanggal_sk, created_at_disetujui ) 
	VALUES ('$id_surat', '$nomor_sk', '$tanggal_sk', '$created_at_disetujui' )")){
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
                                window.location.replace('sk_disetujui');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>