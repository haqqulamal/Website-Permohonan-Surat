<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_persetujuan = $_GET["id_persetujuan"];

if($delete = mysqli_query($konek, "DELETE FROM persetujuan_permohonan WHERE id_persetujuan='$id_persetujuan'")){
        echo " 
        <script>
                                setTimeout(function () {  
                                swal({
                                title: 'Sukses',
                                text:  'Data Berhasil Didelete!!',
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