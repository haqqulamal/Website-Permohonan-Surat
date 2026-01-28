<?php
include '../koneksi.php';  
 
$id_sk_disahkan = isset($_GET['id_sk_disahkan']) ? $_GET['id_sk_disahkan'] : null; 

$querymatakuliah = mysqli_query($konek, "SELECT * FROM sk_disahkan WHERE id_sk_disahkan='$id_sk_disahkan'");
if($querymatakuliah == false){
	die ("Terjadi Kesalahan : ". mysqli_error($konek));
}
while($matakuliah = mysqli_fetch_array($querymatakuliah)){

?>

<style type="text/css">

 
     .zoom embed{-webkit-transform:scale(0.8);-moz-transform:scale(0.8);-o-transform:scale(0.8);-webkit-transition-duration:0.5s;-moz-transition-duration:0.5s;-o-transition-duration:0.5s;opacity:0.7;margin:0 10px 5px 0}
    .zoom embed:hover{-webkit-transform:scale(1.1);-moz-transform:scale(1.1);-o-transform:scale(1.1);box-shadow:0px 0px 30px gray;-webkit-box-shadow:0px 0px 30px gray;-moz-box-shadow:0px 0px 30px gray;opacity:1}
	
</style>
<html>

<body>
<div class="wrapper">
		<div class="zoom-effect">
			<div class="zoom">
<center>


<embed width="600" height="750" src="uploads/<?php echo $matakuliah["upload_sk_disahkan"]; ?>".pdf type="application/pdf"></embed>
</div>
		</div>		
	</div>
</center>
</div>
</div>
</div>
</body>

<?php
			}

?>

