<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_user	= $_GET["id_user"];

if($delete = mysqli_query($konek, "DELETE FROM user WHERE id_user='$id_user'")){
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
                                window.location.replace('user.php');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>