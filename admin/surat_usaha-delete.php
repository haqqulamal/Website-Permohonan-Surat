<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_surat_usaha = $_GET["id_surat_usaha"];

if($delete = mysqli_query($konek, "DELETE FROM surat_usaha WHERE id_surat_usaha='$id_surat_usaha'")){
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
                                window.location.replace('surat_usaha');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>