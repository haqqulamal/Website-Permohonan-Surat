<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_sk = $_GET["id_sk"];

if($delete = mysqli_query($konek, "DELETE FROM sk_disetujui WHERE id_sk='$id_sk'")){
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
                                window.location.replace('sk_disetujui');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>