<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_penduduk = $_POST["id_penduduk"];
$nik = $_POST["nik"];
$nama_lengkap = $_POST["nama_lengkap"];
$alamat = $_POST["alamat"];
$no_telp = $_POST["no_telp"];
$email = $_POST["email"];

if($edit = mysqli_query($konek, "UPDATE penduduk SET nik='$nik', nama_lengkap='$nama_lengkap', alamat='$alamat', no_telp='$no_telp', email='$email'
                WHERE id_penduduk='$id_penduduk'")){
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
                                window.location.replace('penduduk');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>