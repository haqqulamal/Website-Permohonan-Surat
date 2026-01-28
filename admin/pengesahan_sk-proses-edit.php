<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_pengesahan = $_POST["id_pengesahan"];
$id_sk = $_POST["id_sk"];
$tanggal_pengesahan = $_POST["tanggal_pengesahan"];
$created_at_pengesahan = $_POST["created_at_pengesahan"];

if($edit = mysqli_query($konek, "UPDATE pengesahan_sk SET id_sk='$id_sk', tanggal_pengesahan='$tanggal_pengesahan', created_at_pengesahan='$created_at_pengesahan' WHERE id_pengesahan='$id_pengesahan'")){
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
                                window.location.replace('pengesahan_sk');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>