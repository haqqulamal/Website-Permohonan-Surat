<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_persetujuan = $_POST["id_persetujuan"];
$id_surat = $_POST["id_surat"];
$id_user = $_POST["id_user"];
$tanggal_approval = $_POST["tanggal_approval"];
$status_persetujuan = $_POST["status_persetujuan"];
$catatan = $_POST["catatan"]; 
$created_at = $_POST["created_at"];

if($edit = mysqli_query($konek, "UPDATE persetujuan_permohonan SET id_surat='$id_surat', id_user='$id_user', tanggal_approval='$tanggal_approval', status_persetujuan='$status_persetujuan', catatan='$catatan', created_at='$created_at'
                WHERE id_persetujuan='$id_persetujuan'")){
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
                                window.location.replace('persetujuan_permohonan');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>