<?php
$host="localhost";
$user="root";
$pass="";
$dbName="db_gigi";
$koneksi = mysqli_connect($host, $user, $pass, $dbName);
if(!$koneksi){
	echo"Koneksi Gagal";
	}else {}
?>