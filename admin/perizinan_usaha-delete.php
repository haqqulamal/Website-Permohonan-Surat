<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_surat = $_GET["id_surat"];

if($delete = mysqli_query($konek, "DELETE FROM permohonan_sk WHERE id_surat='$id_surat'")){
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
                                window.location.replace('perizinan_usaha');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>