<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_pengesahan = $_GET["id_pengesahan"];

if($delete = mysqli_query($konek, "DELETE FROM pengesahan_sk WHERE id_pengesahan='$id_pengesahan'")){
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
                                window.location.replace('pengesahan_sk');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>