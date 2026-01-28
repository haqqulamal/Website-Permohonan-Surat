<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_penduduk = $_GET["id_penduduk"];

if($delete = mysqli_query($konek, "DELETE FROM penduduk WHERE id_penduduk='$id_penduduk'")){
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
                                window.location.replace('penduduk');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>