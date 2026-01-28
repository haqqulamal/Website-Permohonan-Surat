<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_pengesahan = $_POST["id_pengesahan"];
$tanggal_disahkan = $_POST["tanggal_disahkan"];
$created_at_disahkan = $_POST["created_at_disahkan"];

$ekstensi_diperbolehkan = array('pdf','doc','docx', '');
                        $upload_sk_disahkan = $_FILES['upload_sk_disahkan']['name'];
                        $x = explode('.', $upload_sk_disahkan);
                        $ekstensi = strtolower(end($x));
                        $ukuran = $_FILES['upload_sk_disahkan']['size'];
                        $file_tmp = $_FILES['upload_sk_disahkan']['tmp_name'];

                        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                                if($ukuran < 5000000){                   
                                        move_uploaded_file($file_tmp, 'uploads/'.$upload_sk_disahkan);
                                        $add = mysql_query("INSERT INTO sk_disahkan VALUES(NULL, '$upload_sk_disahkan')");
                                                
if($add = mysqli_query($konek,"INSERT INTO sk_disahkan (id_pengesahan, tanggal_disahkan, created_at_disahkan, upload_sk_disahkan) 
        VALUES ('$id_pengesahan', '$tanggal_disahkan', '$created_at_disahkan', '$upload_sk_disahkan')")){
        echo " 
        <script>
                                setTimeout(function () {  
                                swal({
                                title: 'Sukses',
                                text:  'Data Berhasil DiTambah',
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: true
                                });  
                                },90); 
                                window.setTimeout(function(){ 
                                window.location.replace('sk_disahkan');
                                } ,2000); 
                        </script>
        ";
        exit();
        echo 'FILE BERHASIL DI UPLOAD';
                                        }else{
                                                echo "
                                                <script>
            setTimeout(function () {  
                swal({
                    title: 'Error',
                    text: 'File gagal di upload!',
                    type: 'error',
                    timer: 2000,
                    showConfirmButton: true
                });  
            }, 90); 
            window.setTimeout(function(){ 
                window.location.replace('sk_disahkan');
            }, 2000); 
        </script>";
                                        }
                                }else{
                                        echo "
                                        <script>
            setTimeout(function () {  
                swal({
                    title: 'Error',
                    text: 'Extension tidak di perbolehkan!',
                    type: 'error',
                    timer: 2000,
                    showConfirmButton: true
                });  
            }, 90); 
            window.setTimeout(function(){ 
                window.location.replace('sk_disahkan');
            }, 2000); 
        </script>";
                                }
                        }else{
                                echo "
                                <script>
            setTimeout(function () {  
                swal({
                    title: 'Error',
                    text: 'Hanya file PDF, DOC, DOCX yang diizinkan!',
                    type: 'error',
                    timer: 2000,
                    showConfirmButton: true
                });  
            }, 90); 
            window.setTimeout(function(){ 
                window.location.replace('sk_disahkan');
            }, 2000); 
        </script>";
                        }
 

?>