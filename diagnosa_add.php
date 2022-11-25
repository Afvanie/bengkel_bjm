<?php 
//include "librari/inc.koneksidb.php";
include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');
# Baca variabel Form (If Register Global ON)
$TxtNama 	= $_REQUEST['TxtNama'];
$RbKelamin 	= $_POST['cbojk'];
$TxtUmur	= $_REQUEST['TxtUmur'];
$TxtAlamat 	= $_REQUEST['TxtAlamat'];
$email=$_POST['textemail'];
$NOIP = date('dmHisa');
# Validasi Form
if (trim($TxtNama)=="") {
	include "PasienAddFm.php";
	echo "Nama belum diisi, ulangi kembali";
}
elseif (trim($TxtUmur)=="") {
	include "PasienAddFm.php";
	echo "Umur masih kosong, ulangi kembali";
}
elseif (trim($TxtAlamat)=="") {
	include "PasienAddFm.php";
	echo "Alamat masih kosong, ulangi kembali";
}
else {
    $NOIP = date('dmHisa');	
	$sql  = " INSERT INTO pasien (nama,kelamin,umur,alamat,tanggal,email) 
		 	  VALUES ('$TxtNama','$RbKelamin','$TxtUmur','$TxtAlamat',NOW(),'$email')";
	mysqli_query($koneksi, $sql) 
		  or die ("SQL Error 2".mysql_error());

	echo "<meta http-equiv='refresh' content='0; url=diagnosa_mulai.php'>";
}
?>
	