<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_sk_disahkan = $_POST["id_sk_disahkan"];
$id_pengesahan = $_POST["id_pengesahan"];
$tanggal_disahkan = $_POST["tanggal_disahkan"];
$created_at_disahkan = $_POST["created_at_disahkan"];

// Konfigurasi upload
$ekstensi = array('pdf','doc','docx');
                                                $upload_sk_disahkan = $_FILES['upload_sk_disahkan']['name'];
                                                $x = explode('.', $upload_sk_disahkan);
                                                $eks = strtolower(end($x));
                                                $ukuran = $_FILES['upload_sk_disahkan']['size'];
                                                $target_dir = "uploads/";
//jika form file tidak kosong akan mengeksekusi script dibawah ini
                                            if($upload_sk_disahkan != ""){

                                                $rand = rand(1,10000);
                                                $nfile = $rand."-".$upload_sk_disahkan;

                                                //validasi file
                                                if(in_array($eks, $ekstensi) == true){
                                                    if($ukuran < 5000000){

                                                        $id_sk_disahkan = $_REQUEST['id_sk_disahkan'];
                                                        $query = mysqli_query($konek, "SELECT upload_sk_disahkan FROM sk_disahkan 
                                                                WHERE id_sk_disahkan='$id_sk_disahkan'");
                                                        list($upload_sk_disahkan) = mysqli_fetch_array($query);

                                                        //jika file tidak kosong akan mengeksekusi script dibawah ini
                                                        if(!empty($upload_sk_disahkan)){
                                                            unlink($target_dir.$upload_sk_disahkan);

                                                            move_uploaded_file($_FILES['upload_sk_disahkan']['tmp_name'], $target_dir.$nfile);

                                                            $query = mysqli_query($konek, "UPDATE sk_disahkan SET id_pengesahan='$id_pengesahan', tanggal_disahkan='$tanggal_disahkan', created_at_disahkan='$created_at_disahkan',upload_sk_disahkan='$nfile' WHERE id_sk_disahkan='$id_sk_disahkan'");

                                                            if($query == true){
                                                               echo " 
    <script>
                                setTimeout(function () {  
                                swal({
                                title: 'Sukses',
                                text:  'Data Berhasil Di Edit',
                                type: 'success',
                                timer: 1500,
                                showConfirmButton: true
                                });  
                                },50); 
                                window.setTimeout(function(){ 
                                window.location.replace('sk_disahkan');
                                } ,2000); 
                        </script>
    ";
                                                                die();
                                                            } else {
                                                                $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                                echo '<script language="javascript">window.history.back();</script>';
                                                            }
                                                        } else {

                                                            //jika file kosong akan mengeksekusi script dibawah ini
                                                            move_uploaded_file($_FILES['upload_sk_disahkan']['tmp_name'], $target_dir.$nfile);

                                                            $query = mysqli_query($konek, "UPDATE sk_disahkan SET id_pengesahan='$id_pengesahan', tanggal_disahkan='$tanggal_disahkan', created_at_disahkan='$created_at_disahkan',upload_sk_disahkan='$nfile' WHERE id_sk_disahkan='$id_sk_disahkan'");

                                                            if($query == true){
                                                                echo " 
    <script>
                                setTimeout(function () {  
                                swal({
                                title: 'Sukses',
                                text:  'Data Berhasil Di Edit',
                                type: 'success',
                                timer: 1500,
                                showConfirmButton: true
                                });  
                                },50); 
                                window.setTimeout(function(){ 
                                window.location.replace('sk_disahkan');
                                } ,2000); 
                        </script>
    ";
                                                                die();
                                                            } else {
                                                                $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                                echo '<script language="javascript">window.history.back();</script>';
                                                            }
                                                        }
                                                    } else {
                                                        $_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!';
                                                        echo '<script language="javascript">window.history.back();</script>';
                                                    }
                                                } else {
                                                    $_SESSION['errFormat'] = 'Format file yang diperbolehkan hanya *.JPG, *.PNG, *.DOC, *.DOCX atau *.PDF!';
                                                    echo '<script language="javascript">window.history.back();</script>';
                                                }
                                            } else {

                                                //jika form file kosong akan mengeksekusi script dibawah ini
                                                $id_sk_disahkan = $_REQUEST['id_sk_disahkan'];

                                                $query = mysqli_query($konek, "UPDATE sk_disahkan SET id_pengesahan='$id_pengesahan', tanggal_disahkan='$tanggal_disahkan', created_at_disahkan='$created_at_disahkan'
                                                    WHERE id_sk_disahkan='$id_sk_disahkan'");

                                   
                                                    echo " 
    <script>
                                setTimeout(function () {  
                                swal({
                                title: 'Sukses',
                                text:  'Data Berhasil Di Tambah',
                                type: 'success',
                                timer: 1500,
                                showConfirmButton: true
                                });  
                                },50); 
                                window.setTimeout(function(){ 
                                window.location.replace('sk_disahkan');
                                } ,2000); 
                        </script>
    "; 


        error_reporting (E_ALL ^ E_NOTICE);
        $id_sk_disahkan = mysqli_real_escape_string($konek, $_REQUEST['id_sk_disahkan']); 
        $query = mysqli_query($konek, "SELECT id_pengesahan, tanggal_disahkan, created_at_disahkan, upload_sk_disahkan
            FROM sk_disahkan WHERE id_sk_disahkan='$id_sk_disahkan'");
        list($id_sk_disahkan, $id_pengesahan, $tanggal_disahkan, $created_at_disahkan ,$upload_sk_disahkan) = mysqli_fetch_array($query);
    echo " 
    <script>
                                setTimeout(function () {  
                                swal({
                                title: 'Sukses',
                                text:  'Data Berhasil Di Edit',
                                type: 'success',
                                timer: 1500,
                                showConfirmButton: true
                                });  
                                },50); 
                                window.setTimeout(function(){ 
                                window.location.replace('sk_disahkan');
                                } ,2000); 
                        </script>
    ";
    exit();
}

die ("Terdapat Kesalahan : ". mysqli_error($konek));

?>