<?php

session_start();
include "../koneksi.php";
include "auth_user.php";
?>

<style type="text/css">
    .sc-date{text-align: center;}
    .sc-number{text-align: right;}
</style>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <title>Paperless - STMIK Indonesia Banjarmasin</title>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

    <style type='text/css'>
      .logodisp {
                    float: left;
                    position: relative;
                    width: 180px;
                    height: 170px;
                    margin: .5rem 0 0 .5rem;
                }
                .logodisp {
                float: left;
                position: relative;

                margin: 0 0 0 1rem;
            }

            .border {
              border-color: black;
        border-width: 3px;
        border-top-style: solid;


    }
    </style>
	<!-- Library CSS -->
	<?php
		include "bundle_css.php";
	?>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <?php
        include 'content_header.php';
       ?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
              <li class="header"> <b>Menu </b></li>
              <li><a href="index.php"><i class="fa fa-home"></i><span>Dashboard</span></a></li>

          <li><a href="#"><i class="fa fa-send"></i> <span>Transaksi Surat</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
             <li><a href="suratmasuk.php"><i class="fa fa-envelope-o"></i><span>Surat Masuk</span></a></li>
             <li><a href="suratkeluar.php"><i class="fa fa-envelope-open-o"></i><span>Surat Keluar</span></a></li>
            </ul>
            </li> 

              <li class="active"><a href="#"><i class="fa fa-bars"></i> <span>Master Surat</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="index.php?view=sms"><i class="fa fa-circle-o"></i>Surat Perihal</a></li>
                <li><a href="suratkeputusan.php"><i class="fa fa-circle-o"></i>Surat Keputusan</a></li>
                <li class="active"><a href="suratdinas.php"><i class="fa fa-circle-o"></i>Surat Dinas</a></li>
              </ul>
            </li>  

            <li><a href="#"><i class="fa fa-users"></i> <span>Data Master</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <li><a href="user.php"><i class="fa fa-user-circle-o"></i><span>User</span></a></li>
              <li><a href="pegawai.php"><i class="fa fa-user-circle-o"></i><span>Data Pegawai</span></a></li>   
              </ul>
            </li>  

              <li><a href="#"><i class="fa fa-print"></i> <span>Agenda Surat</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="agenda_surat_masuk.php"><i class="fa fa-circle-o"></i>Surat Masuk</a></li>
                <li><a href="agenda_surat_keluar.php"><i class="fa fa-circle-o"></i>Surat Keluar</a></li>
              </ul>
            </li> 

          <li class="header"> <b>Pengaturan </b></li>
              <li><a href="about.php"><i class="fa fa-info-circle"></i><span>Tentang Aplikasi</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tambah Surat Dinas
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-book"></i> Tambah Surat Dinas</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">

					<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Surat Dinas</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='suratdinas_add.php' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered' border="1">

                    <body>

<div class="logodisp">
<img class="logodisp" src="../aset/foto/logostmik.png" height="1701" width="851" border="0" usemap="#Map"></div>
<center>
<div class="pos" id="_349:80" style="top:80;left:349">
<span id="_16.3" style="font-family:Times New Roman; font-size:16.3px; color:#000000">
YAYASAN PENDIDIKAN BINA ILMU</span>
</div>
<div class="pos" id="_378:102" style="top:102;left:378">
<span id="_24.4" style="font-weight:bold; font-family:Times New Roman; font-size:24.4px; color:#000000">
STMIK INDONESIA </span>
</div>
<div class="pos" id="_243:129" style="top:129;left:243">
<span id="_19.0" style="font-weight:bold; font-family:Times New Roman; font-size:19.0px; color:#000000">
SEKOLAH TINGGI MANAJEMEN INFORMATIKA & </span>
</div>
<div class="pos" id="_350:152" style="top:152;left:350">
<span id="_19.0" style="font-weight:bold; font-family:Times New Roman; font-size:19.0px; color:#000000">
KOMPUTER BANJARMASIN</span>
</div>
<div class="pos" id="_360:174" style="top:174;left:360">
<span id="_19.0" style="font-weight:bold; font-family:Times New Roman; font-size:19.0px; color:#000000">
STATUS TERAKREDITASI</span>
</div>
<div class="pos" id="_186:195" style="top:195;left:186">
<span id="_16.3" style=" font-family:Times New Roman; font-size:16.3px; color:#000000">
Sekretariat : Jl. Pangeran Hidayatullah (Samping Jembatan Banua Anyar) Banjarmasin</span>
</div>
<div class="pos" id="_389:214" style="top:214;left:389">
<span id="_16.3" style=" font-family:Times New Roman; font-size:16.3px; color:#000000">
Telp. (0511) 4315530-4315531 </span>
</div><div class="border"><br><br>
</center>

<tr>
<th><div class="pos" id="_118:289" style="top:289;left:118">
<span id="_16.3" style=" font-family:Times New Roman; font-size:14.3px; color:#000000">
No Surat <td>:</td> </span>
</th>
<td><input type='text' class='form-control' placeholder='No Surat' name='no_surat' required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"></td>


<div class="form-group">
                    <div class="row">
                        <div class="col-sm-5">
                            <label>Pejabat yang memberi perintah</label>
                            <input type="text" name="nip_pejabat" id="nip_pejabat" 
                            class="form-control sc-input-required sc-select" 
                            placeholder="Pejabat yang memberi perintah" data-sf="LoadNip">
                            <input type="hidden" name="cPageSource" id="cPageSource" 
                            value="<?=$cPageSource?>">
                            <input type="hidden" name="code" id="code" >
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                            <label>Pegawai yang diperintah</label>
                            <input type="text" name="nip_leader" id="nip_leader" 
                            class="form-control sc-input-required sc-select" 
                            placeholder="Pegawai yang diperintah" data-sf="LoadNip">
                        </div>

                  <div class="col-sm-6">
                    <label>Pengikut &nbsp;&nbsp;<small style="opacity:.7"><i>(optional)</i></small></label>
                    <input type="text" name="nip" id="nip" 
                    class="form-control sc-select-multi" 
                    placeholder="Pengikut" data-sf="LoadNip">
                </div>


<tr>
<th><div class="pos" id="_118:289" style="top:289;left:118">
<span id="_16.3" style=" font-family:Times New Roman; font-size:14.3px; color:#000000">
Maksud Perjalanan Dinas <td>:</td> </span>
</th>
<td><textarea type='text' class='form-control' placeholder='Maksud Perjalanan Dinas' name='maksud' required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"></textarea> </td>




<tr>
<th><div class="pos" id="_118:289" style="top:289;left:118">
<span id="_16.3" style=" font-family:Times New Roman; font-size:14.3px; color:#000000">
Alat Angkut yang dipergunakan <td>:</td> </span>
</th>
<td>
  <select name="alat_angkutan" class="form-control" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                      <option selected>Pilih Jenis Angkutan</option>
                      <option value="Darat">Darat</option>
                      <option value="Udara">Udara</option>
                      <option value="Udara">Laut</option>
                    </select></td>


  <tr>
<th><div class="pos" id="_118:289" style="top:289;left:118">
<span id="_16.3" style=" font-family:Times New Roman; font-size:14.3px; color:#000000">
Tempat Berangkat <td>:</td> </span>
</th>
<td><input type='text' class='form-control' placeholder='Tempat Berangkat' name='tempat_berangkat' required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"> </td>


  <tr>
<th><div class="pos" id="_118:289" style="top:289;left:118">
<span id="_16.3" style=" font-family:Times New Roman; font-size:14.3px; color:#000000">
Tempat Tujuan <td>:</td> </span>
</th>
<td><input type='text' class='form-control' placeholder='Tempat Tujuan' name='tempat_tujuan' required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"> </td>

  <tr>
<th><div class="pos" id="_118:289" style="top:289;left:118">
<span id="_16.3" style=" font-family:Times New Roman; font-size:14.3px; color:#000000">
Lama Perjalanan (Hari) <td>:</td> </span>
</th>
<td><input type='text' class='form-control' placeholder='Lama Perjalanan (Hari)' name='lama_perjalanan' required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"> </td>

  <tr>
<th><div class="pos" id="_118:289" style="top:289;left:118">
<span id="_16.3" style=" font-family:Times New Roman; font-size:14.3px; color:#000000">
Tingkat Perjalanan <td>:</td> </span>
</th>
<td><input type='text' class='form-control' placeholder='Tingkat Perjalanan' name='tingkatan' required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"> </td>

  <tr>
<th><div class="pos" id="_118:289" style="top:289;left:118">
<span id="_16.3" style=" font-family:Times New Roman; font-size:14.3px; color:#000000">
Tgl Berangkat <td>:</td> </span>
</th>
<td><input type='date' class='form-control' placeholder='Perihal Surat' name='tanggal_berangkat' value="<?php echo date("Y-m-d") ?>" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"> </td>

  <tr>
<th><div class="pos" id="_118:289" style="top:289;left:118">
<span id="_16.3" style=" font-family:Times New Roman; font-size:14.3px; color:#000000">
Tgl Kembali <td>:</td> </span>
</th>
<td><input type='date' class='form-control' placeholder='Perihal Surat' name='tanggal_kembali' value="<?php echo date("Y-m-d") ?>" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"> </td>

  <tr>
<th><div class="pos" id="_118:289" style="top:289;left:118">
<span id="_16.3" style=" font-family:Times New Roman; font-size:14.3px; color:#000000">
Pegawai yang diperintah <td>:</td> </span>
</th>
<td><input type='text' class='form-control' sc-input-required sc-select placeholder='Pegawai yang diperintah' name='diperintah' required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"> </td>

  <tr>
<th><div class="pos" id="_118:289" style="top:289;left:118">
<span id="_16.3" style=" font-family:Times New Roman; font-size:14.3px; color:#000000">
Pengikut <td>:</td> </span>
</th>
<td><input type='text' class='form-control' placeholder='Pengikut' name='pengikut' required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"> </td>

  <tr>
<th><div class="pos" id="_118:289" style="top:289;left:118">
<span id="_16.3" style=" font-family:Times New Roman; font-size:14.3px; color:#000000">
Instansi (Pembebanan Anggaran) <td>:</td> </span>
</th>
<td><input type='text' class='form-control' placeholder='Instansi (Pembebanan Anggaran)' name='beban_anggaran' required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"> </td>

  <tr>
<th><div class="pos" id="_118:289" style="top:289;left:118">
<span id="_16.3" style=" font-family:Times New Roman; font-size:14.3px; color:#000000">
Mata Anggaran <td>:</td> </span>
</th>
<td><input type='text' class='form-control' placeholder='Mata Anggaran' name='mata_anggaran' required required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"> </td>

  <tr>
<th><div class="pos" id="_118:289" style="top:289;left:118">
<span id="_16.3" style=" font-family:Times New Roman; font-size:14.3px; color:#000000">
Keterangan Lain <td>:</td> </span>
</th>
<td><textarea type='text' class='form-control' placeholder='Keterangan Lainnya' name='keterangan' required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"></textarea> </td>

  <tr>
<th><div class="pos" id="_118:289" style="top:289;left:118">
<span id="_16.3" style=" font-family:Times New Roman; font-size:14.3px; color:#000000">
Tanggal Surat <td>:</td> </span>
</th>
<td><input type='date' class='form-control' placeholder='Tanggal Surat' name='tgl_surat' value="<?php echo date("Y-m-d") ?>" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')"></td>




    
                  </table>
                </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Simpan</button>
                    <button class='btn btn-default pull-right' value='Go Back' onclick='history.back(-1)'>Cancel</button>
                    
                  </div>
              </form>
            </div>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
	
		<!-- Modal Popup Dosen -->
		
    <?php
		include	"content_footer.php";
	?>
    </div><!-- ./wrapper -
	<!-- Library Scripts -->
	<?php
		include "bundle_script.php";
	?>
  </body>
</html>
<script type="text/javascript">
OBJFORM_NEW.trsppd          = {} 
OBJFORM_NEW.trsppd.ID       = "trsppd" ; 
OBJFORM_NEW.trsppd.Obj      = $("#trsppd") ; 
OBJFORM_NEW.trsppd.Url      = OBJFORM_NEW.trsppd.Obj.find("#cPageSource").val().replace("pages/","") ; 
OBJFORM_NEW.trsppd.Url_A    = OBJFORM_NEW.trsppd.Obj.find("#cPageSource").val() + ".ajax.php"; 
OBJFORM_NEW.trsppd.tTgl     = new Date(<?=$vaTgl[0]?>,<?=$vaTgl[1]?>,<?=$vaTgl[2]?>).getTime() ; 

$(function(){
    //init
    scForm.InitSelect({
        cClass : "#" + OBJFORM_NEW.trsppd.ID + " .sc-select",
        minimumInputLength : 2
    }) ; 
    scForm.InitSelect({
        cClass : "#" + OBJFORM_NEW.trsppd.ID + " .sc-select-multi",
        lMulti : true ,
        minimumInputLength : 2
    }) ;
    scForm.InitDate({
        cClass : "#" + OBJFORM_NEW.trsppd.ID + " .sc-date"
    }) ;
    scForm.InitNumber(0,"#" + OBJFORM_NEW.trsppd.ID + " .sc-number") ; 

    //event
    OBJFORM_NEW.trsppd.Obj
    .find("#date_go").on("change",function(){
        vaSplit = $(this).val().split("-") ; 
        tAcuan  = new Date(vaSplit[2],vaSplit[1],vaSplit[0]).getTime() ; 
        if(tAcuan < OBJFORM_NEW.trsppd.tTgl){
            $(this).val("<?=$dTgl?>") ; 
        }else{
            OBJFORM_NEW.trsppd.Obj.find("#date_back").val(vaSplit[0]+"-"+vaSplit[1]+"-"+vaSplit[2]) ;
        }
        $(this).blur() ;
    }) ; 
    OBJFORM_NEW.trsppd.Obj
    .find("#date_back").on("change",function(){
        vaSplit = $(this).val().split("-") ; 
        tAcuan  = new Date(vaSplit[2],vaSplit[1],vaSplit[0]).getTime() ; 
        vaSplit = OBJFORM_NEW.trsppd.Obj.find("#date_go").val().split("-") ; 
        tBrgkt  = new Date(vaSplit[2],vaSplit[1],vaSplit[0]).getTime() ; 
        if(tAcuan < tBrgkt){
            $(this).val(vaSplit[0]+"-"+vaSplit[1]+"-"+vaSplit[2]) ;
        }
        $(this).blur() ;
    }) ; 

    OBJFORM_NEW.trsppd.Obj
    .find("#nip_leader").on("select2-selecting",function(e){ 
        scAjax(OBJFORM_NEW.trsppd.Url_A,'CheckPegawai','nip=' + e.val + '&id=nip_leader' +
            '&date_go=' + OBJFORM_NEW.trsppd.Obj.find("#date_go").val() +
            '&date_back=' + OBJFORM_NEW.trsppd.Obj.find("#date_back").val() ) ;
    }) ; 

    OBJFORM_NEW.trsppd.Obj
    .find("#nip").on("select2-selecting",function(e){ 
        scAjax(OBJFORM_NEW.trsppd.Url_A,'CheckPegawaiPendamping','nip=' + e.val + '&id=nip' +
            '&val=' + JSON.stringify(OBJFORM_NEW.trsppd.Obj.find("#nip").select2("data")) +
            '&date_go=' + OBJFORM_NEW.trsppd.Obj.find("#date_go").val() +
            '&date_back=' + OBJFORM_NEW.trsppd.Obj.find("#date_back").val() ) ; 
    }) ; 

    OBJFORM_NEW.trsppd.Obj
    .find("#cmdSave").on("click",function(e){
        e.preventDefault() ;
        if(scValidationForm(this,true)){
            scAjax(OBJFORM_NEW.trsppd.Url_A,'Saving',scGetDataForm(this),this ) ; 
        }
    }) ; 
}) ; 
</script> 
<?php 
if(isset($_GET['code'])){ 
?>
<script type="text/javascript">
    scAjax(OBJFORM_NEW.trsppd.Url_A,'Editing', 'code=<?=$_GET['code']?>') ; 
</script>
<?php 
}else{
?>
<script type="text/javascript">
    $(function(){
        OBJFORM_NEW.trsppd.Obj.find("#nip_pejabat").select2("open") ;
    }) ; 
</script>
<?php
}
?>