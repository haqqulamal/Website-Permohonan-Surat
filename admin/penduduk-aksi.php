<?php

include "../koneksi.php";
include "alert/loadalert.php";

$nik = $_POST["nik"];
$nama_lengkap = $_POST["nama_lengkap"];
$alamat = $_POST["alamat"];
$no_telp = $_POST["no_telp"];
$email = $_POST["email"]; 

if($add = mysqli_query($konek,"INSERT INTO penduduk (nik, nama_lengkap, alamat, no_telp, email) 
	VALUES ('$nik', '$nama_lengkap', '$alamat', '$no_telp', '$email')")){
        echo " 
        <script>
                                setTimeout(function () {  
                                swal({
                                title: 'Sukses',
                                text:  'Data Berhasil Di Simpan!!',
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