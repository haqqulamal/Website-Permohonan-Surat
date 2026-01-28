<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_surat_tanah = $_GET["id_surat_tanah"];

if($delete = mysqli_query($konek, "DELETE FROM surat_tanah WHERE id_surat_tanah='$id_surat_tanah'")){
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
                                window.location.replace('surat_tanah');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>