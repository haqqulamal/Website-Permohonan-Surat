<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_penduduk = $_POST["id_penduduk"];
$umur = $_POST["umur"];
$tempat_lahir = $_POST["tempat_lahir"];
$tanggal_lahir = $_POST["tanggal_lahir"];
$alamat = $_POST["alamat"]; 
$model_tanah = $_POST["model_tanah"];

$nomor_buku = $_POST["nomor_buku"];
$nomor_letter_c = $_POST["nomor_letter_c"];
$nomor_model_d = $_POST["nomor_model_d"];
$nomor_model_e = $_POST["nomor_model_e"];
$nomor_situasi = $_POST["nomor_situasi"];
$nomor_hak_milik = $_POST["nomor_hak_milik"];
$nomor_ukur = $_POST["nomor_ukur"];
$nomor_persil = $_POST["nomor_persil"];
$luas_tanah = $_POST["luas_tanah"];
$batas_utara = $_POST["batas_utara"];
$batas_timur = $_POST["batas_timur"];
$batas_selatan = $_POST["batas_selatan"];
$batas_barat = $_POST["batas_barat"];
$penggunaan_tanah = $_POST["penggunaan_tanah"];
$tanggal_surat = $_POST["tanggal_surat"];
$created_at = $_POST["created_at"];

if($add = mysqli_query($konek,"INSERT INTO surat_tanah (id_penduduk, umur, tempat_lahir, tanggal_lahir, alamat, model_tanah, nomor_buku, nomor_letter_c, nomor_model_d, nomor_model_e, nomor_situasi, nomor_hak_milik, nomor_ukur, nomor_persil, luas_tanah, batas_utara, batas_timur, batas_selatan, batas_barat, penggunaan_tanah, tanggal_surat, created_at) 
	VALUES ('$id_penduduk', '$umur', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$model_tanah', '$nomor_buku', '$nomor_letter_c', '$nomor_model_d', '$nomor_model_e', '$nomor_situasi', '$nomor_hak_milik', '$nomor_ukur', '$nomor_persil', '$luas_tanah', '$batas_utara', '$batas_timur', '$batas_selatan', '$batas_barat', '$penggunaan_tanah', '$tanggal_surat', '$created_at')")){
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
                                window.location.replace('surat_tanah');
                                } ,1900); 
                        </script>
        ";
        exit();
        }
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>