<?php require_once('Connections/koneksi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_rsTampilInformasi = 100;
$pageNum_rsTampilInformasi = 0;
if (isset($_GET['pageNum_rsTampilInformasi'])) {
  $pageNum_rsTampilInformasi = $_GET['pageNum_rsTampilInformasi'];
}
$startRow_rsTampilInformasi = $pageNum_rsTampilInformasi * $maxRows_rsTampilInformasi;

$query_rsTampilInformasi = "SELECT * FROM informasi ORDER BY posting DESC";
$query_limit_rsTampilInformasi = sprintf("%s LIMIT %d, %d", $query_rsTampilInformasi, $startRow_rsTampilInformasi, $maxRows_rsTampilInformasi);
$rsTampilInformasi = mysqli_query($koneksi, $query_limit_rsTampilInformasi) or die(mysqli_error());
$row_rsTampilInformasi = mysqli_fetch_assoc($rsTampilInformasi);

if (isset($_GET['totalRows_rsTampilInformasi'])) {
  $totalRows_rsTampilInformasi = $_GET['totalRows_rsTampilInformasi'];
} else {
  $all_rsTampilInformasi = mysqli_query($koneksi, $query_rsTampilInformasi);
  $totalRows_rsTampilInformasi = mysqli_num_rows($all_rsTampilInformasi);
}
$totalPages_rsTampilInformasi = ceil($totalRows_rsTampilInformasi/$maxRows_rsTampilInformasi)-1;
?>
<!DOCTYPE html>
<html>
<head>
<title>KBTI2021</title>
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
                    	<div class="w3-xlarge">APLIKASI SISTEM PAKAR</div>
                        <div class="w3-large"><strong>DIAGNOSIS PENYAKIT GIGI</strong></div>
                        <div class="w3-small" style="margin-top:3px;">MENGGUNAKAN METODE <strong>FUZZY MAMDANI</strong></div>
                    </div>
                    
                </div>
                <hr>
            </div>
            
            <div class="w3-container">
            	<div class="w3-row">
                	<div class="w3-col l3">
                    	<div>
                        	<ul class="w3-ul w3-hoverable w3-border">
  <a href="index.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-home fa-fw"></i> Beranda</li></a>
  
  <a href="diagnosa_create.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-book fa-fw"></i> Diagnosa</li></a>
  
  <a href="penyakit_read.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-book fa-fw"></i> Daftar Penyakit</li></a>
  
  <a href="informasi_read.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-book fa-fw"></i> Seputar Gigi</li></a>
  
  
</ul>
                        </div>
                    </div>
                    <div class="w3-col l9" style="padding-left:8px;">
                    	<div class="w3-border w3-padding">
                        <div class="w3-border-bottom" style="padding-bottom:10px; margin-top:8px;"><strong><i class="fa fa-book"></i> INFORMASI SEPUTAR GIGI</strong></div>
                        
                         <?php do { ?>
                         <ul class="w3-ul w3-border" style="margin-top:8px;">
                         	<img class="w3-image" src="admin/foto_informasi/<?php echo $row_rsTampilInformasi['gambar']; ?>">
                            <li class="w3-center w3-large"><strong><?php echo $row_rsTampilInformasi['judul']; ?></strong></li>
                        <li class="w3-justify w3-small"><?php echo $row_rsTampilInformasi['isi']; ?></li>
                        </ul><br>
                        <?php } while ($row_rsTampilInformasi = mysqli_fetch_assoc($rsTampilInformasi)); ?>
                        
                        </div>
                    
                    </div>
                </div>
            </div><br>

        </div>
        <div class="w3-col l1">&nbsp;</div>
    </div>
</div><br>
<br>
<div class="w3-center w3-small">Copyright @ 2021 <strong>Sistem Pakar Penyakit Gigi</strong><br>
All Right Reserved</div>

<br>
	
</body>
</html>
<?php
mysqli_free_result($rsTampilInformasi);
?>
