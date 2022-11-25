 <?php
	date_default_timezone_set('Asia/Jakarta');
	include "koneksi.php";
	$NOIP = date('dmHisa');
	# Periksa apabila sudah ditemukan
	$sql_cekh = "SELECT * FROM tmp_penyakit 
			 WHERE noip='$NOIP' 
			 GROUP BY kd_penyakit";
	$qry_cekh = mysqli_query($koneksi, $sql_cekh);
	$hsl_cekh = mysqli_num_rows($qry_cekh);
	if ($hsl_cekh == 1) {
		$hsl_data = mysqli_fetch_array($qry_cekh);
		$sql_pasien = "SELECT * FROM tmp_pasien WHERE noip='$NOIP' order by id";
		$qry_pasien = mysqli_query($koneksi, $sql_pasien);
		$hsl_pasien = mysqli_fetch_array($qry_pasien);
		$sql_in = "INSERT INTO analisa_hasil SET
				  nama='$hsl_pasien[nama]',
				  kelamin='$hsl_pasien[kelamin]',
				  umur='$hsl_pasien[umur]',
				  alamat='$hsl_pasien[alamat]',
				  kd_penyakit='$hsl_data[kd_penyakit]',
				  noip	=	'$hsl_pasien[noip]',
				  tanggal='$hsl_pasien[tanggal]'";
		mysqli_query($sql_in, $koneksi);
		//echo "<meta http-equiv='refresh' content='0; url=?top=AnalisaHasil.php'>";
		exit;
	}
	$sqlcek = "SELECT * FROM tmp_analisa WHERE noip='$NOIP'";
	$qrycek = mysqli_query($koneksi, $sqlcek);
	$datacek = mysqli_num_rows($qrycek);
	if ($datacek >= 1) {
		// Seandainya tmp kosong
		$sqlg = "SELECT gejala.* FROM gejala,tmp_analisa 
			 WHERE gejala.kd_gejala=tmp_analisa.kd_gejala 
			 AND tmp_analisa.noip='$NOIP' 
			 AND NOT tmp_analisa.kd_gejala 
			 	 IN(SELECT kd_gejala 
				 FROM tmp_gejala WHERE noip='$NOIP')
			 ORDER BY gejala.kd_gejala LIMIT 1";
		$qryg = mysqli_query($sqlg, $koneksi) or die("Gagal $qryg : " . mysql_error());
		$datag = mysqli_fetch_array($qryg) or die("Gagal $datag : " . mysql_error());
		$kdgejala = $datag['kd_gejala'];
		$gejala   = $datag['gejala'];
		echo " Ditemukan ($sqlg)";
	} else {
		// Seandainya tmp kosong
		$sqlg = "SELECT * FROM gejala ORDER BY kd_gejala LIMIT 1";
		$qryg = mysqli_query($koneksi, $sqlg);
		$datag = mysqli_fetch_array($qryg);
		$kdgejala = $datag['kd_gejala'];
		$gejala   = $datag['gejala'];
	}
	?>
 <!DOCTYPE html>
 <html>

 <head>
     <title>BJM BENGKEL</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="assets/w3.css">
     <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
     <script src="assets/w3.js"></script>

 </head>

 <body class="w3-light-gray">


     <br>
     <div class="w3-container w3-light-gray">
         <div class="w3-row">
             <div class="w3-col l1">&nbsp;</div>
             <div class="w3-col l10 w3-white">
                 <div class="w3-container"><br>
                     <div class="w3-row">
                         <div class="w3-col l12 w3-center">
                             <div class="w3-xlarge">SISTEM PAKAR</div>
                             <div class="w3-large"><strong>DIAGNOSIS KERUSAKAN MOBIL</strong></div>
                             <div class="w3-small" style="margin-top:3px;">MENGGUNAKAN METODE <strong>FORDWARD
                                     CHAINING</strong></div>
                         </div>

                     </div>
                     <hr>
                 </div>

                 <div class="w3-container">
                     <div class="w3-row">
                         <div class="w3-col l3">
                             <div>
                                 <ul class="w3-ul w3-hoverable w3-border">
                                     <a href="index.php" style="text-decoration:none">
                                         <li style="border-bottom:1px solid #DDD;"><i class="fa fa-home fa-fw"></i>
                                             Beranda</li>
                                     </a>

                                     <a href="diagnosa_create.php" style="text-decoration:none">
                                         <li style="border-bottom:1px solid #DDD;"><i class="fa fa-book fa-fw"></i>
                                             Diagnosa</li>
                                     </a>

                                     <a href="penyakit_read.php" style="text-decoration:none">
                                         <li style="border-bottom:1px solid #DDD;"><i class="fa fa-book fa-fw"></i>
                                             Daftar Kerusakan</li>
                                     </a>

                                     <!-- <a href="informasi_read.php" style="text-decoration:none">
                                         <li style="border-bottom:1px solid #DDD;"><i class="fa fa-book fa-fw"></i>
                                             Seputar Gigi</li>
                                     </a> -->


                                 </ul>
                             </div>
                         </div>
                         <div class="w3-col l9" style="padding-left:8px;">
                             <div class="w3-border w3-padding">
                                 <div class="w3-border-bottom" style="padding-bottom:10px; margin-top:8px;"><strong><i
                                             class="fa fa-check"></i> PILIH GEJALA</strong></div>
                                 <div class="w3-padding w3-center w3-border w3-border-yellow w3-pale-yellow w3-small"
                                     style="margin-top:8px;">
                                     <div class="w3-medium">Pilih Gejala Yang Anda Rasakan</div>
                                 </div>



                                 <script type="text/javascript">
                                 $(document).ready(function() {
                                     $("form").submit(function() {
                                         if (!isCheckedById("gejala")) {
                                             alert(
                                                 "Anda Belum Memilih Gejala Apapun\nSilahkan Pilih Gejala..!");
                                             return false;
                                         } else {
                                             return true; //submit the form
                                         }
                                     });

                                     function isCheckedById(id) {
                                         var checked = $("input[@id=" + id + "]:checked").length;
                                         if (checked == 0) {
                                             return false;
                                         } else {
                                             return true;
                                         }
                                     }
                                     // pilih bobot
                                     function isCheckedById2(id) {
                                         var checked = $("option[@id=" + id + "]:checked").length;
                                         if (checked == "") {
                                             return false;
                                         } else {
                                             return true;
                                         }
                                     }
                                     //--
                                 });
                                 </script>



                                 <form method="post" name="form" target="_self" action="diagnosa_cek.php">
                                     <ul style="list-style:none; margin-top:8px;" class="w3-ul w3-border">
                                         <?php
											include "koneksi.php";
											$kosong_tmp_penyakit = mysqli_query($koneksi, "DELETE FROM tmp_penyakit");
											$query = mysqli_query($koneksi, "SELECT * FROM gejala ORDER BY gejala ASC") or die("Query Error..!" . mysql_error);
											while ($row = mysqli_fetch_array($query)) {
											?>
                                         <li class="w3-small w3-justify"><input style="cursor:pointer" type="checkbox"
                                                 class="w3-check" name="gejala[]" id="gejala"
                                                 value="<?php echo $row['kd_gejala']; ?>"><span
                                                 style="margin-left:10px;"><?php echo $row['gejala']; ?></span></li>
                                         <?php } ?>
                                     </ul>
                                     <hr>
                                     <div class="w3-center">
                                        <a href="diagnosa_create.php" style="cursor:pointer" class="w3-btn w3-small w3-red"><i class="fa fa-times-rectangle fa-fw"></i> Batal</a> 
                                        <button type="reset" class="w3-btn w3-small w3-orange"><i class="fa fa-recycle fa-fw"></i> Reset</button> 
                                        <button type="submit" class="w3-btn w3-small w3-green"><i class="fa fa-save fa-fw"></i> Proses Diagnosa</button>
                                     </div>

                                 </form>

                                 <br>
                             </div>

                         </div>
                     </div>
                 </div><br>

             </div>
             <div class="w3-col l1">&nbsp;</div>
         </div>
     </div>
     <br>
<div class="w3-center w3-small">Copyright @ 2022 <strong>BJM BENGKEL</strong><br>
All Right Reserved</div>
<br>

 </body>

 </html>