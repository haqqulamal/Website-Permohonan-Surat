<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_sk_disahkan = $_GET["id_sk_disahkan"];

if($delete = mysqli_query($konek, "DELETE FROM sk_disahkan WHERE id_sk_disahkan='$id_sk_disahkan'")){
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
                                window.location.replace('sk_disahkan');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>