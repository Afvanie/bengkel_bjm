<?php require_once('../Connections/koneksi.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
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

$maxRows_rsInfoRead = 100;
$pageNum_rsInfoRead = 0;
if (isset($_GET['pageNum_rsInfoRead'])) {
  $pageNum_rsInfoRead = $_GET['pageNum_rsInfoRead'];
}
$startRow_rsInfoRead = $pageNum_rsInfoRead * $maxRows_rsInfoRead;


$query_rsInfoRead = "SELECT * FROM informasi ORDER BY posting DESC";
$query_limit_rsInfoRead = sprintf("%s LIMIT %d, %d", $query_rsInfoRead, $startRow_rsInfoRead, $maxRows_rsInfoRead);
$rsInfoRead = mysqli_query($koneksi, $query_limit_rsInfoRead) or die(mysqli_error());
$row_rsInfoRead = mysqli_fetch_assoc($rsInfoRead);

if (isset($_GET['totalRows_rsInfoRead'])) {
  $totalRows_rsInfoRead = $_GET['totalRows_rsInfoRead'];
} else {
  $all_rsInfoRead = mysqli_query($koneksi, $query_rsInfoRead);
  $totalRows_rsInfoRead = mysqli_num_rows($all_rsInfoRead);
}
$totalPages_rsInfoRead = ceil($totalRows_rsInfoRead/$maxRows_rsInfoRead)-1;
?>

<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/template_admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>BJM BENGKEL</title>
<!-- InstanceEndEditable -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../assets/w3.css">
<link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<script src="../assets/w3.js"></script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
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
                        <div class="w3-small" style="margin-top:3px;">MENGGUNAKAN METODE <strong>FORWARD CHAINING</strong></div>
                    </div>
                    
                </div>
                <hr>
            </div>
            
            <div class="w3-container">
            	<div class="w3-row">
                	<div class="w3-col l3">
                    	<div>
                        	<ul class="w3-ul w3-hoverable w3-border">
  <a href="home.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-home fa-fw"></i> Beranda</li></a>
  
  <a href="admin_read.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-lock fa-fw"></i> Data Login</li></a>
  
  <a href="penyakit_read.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-bug fa-fw"></i> Data Penyakit</li></a>
  
  <a href="gejala_read.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-file fa-fw"></i> Data Gejala</li></a>
  
  <a href="indikator_read.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-list-ul fa-fw"></i> Indikator Bobot</li></a>
  
  <a href="bobot_read.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-history fa-fw"></i> Rule & Forward Chaining</li></a>
  
  <a href="hasil_read.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-check-square-o fa-fw"></i> Hasil Diagnosa</li></a>
  
  <a href="informasi_read.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-info fa-fw"></i> Informasi Kerusakan</li></a>
  
  <!-- InstanceBeginEditable name="EditRegion1" --><a onClick="return confirm('Anda Yakin Ingin Keluar?')" href="<?php echo $logoutAction ?>" style="text-decoration:none">
  <li style="border-bottom:1px solid #DDD;"><i class="fa fa-times fa-fw"></i> Keluar</li>
  </a><!-- InstanceEndEditable -->
                       	  </ul>
                        </div>
                    </div>
                    <div class="w3-col l9" style="padding-left:8px;">
                    	<div class="w3-border w3-padding"><!-- InstanceBeginEditable name="EditRegion2" --><div class="w3-border-bottom" style="padding-bottom:10px; margin-top:8px;"><strong><i class="fa fa-info"></i> INFORMASI BENGKEL MOBIL</strong> <span class="w3-right"><a href="informasi_create.php" class="w3-tag w3-black w3-small" style="text-decoration:none"><i class="fa fa-plus fa-fw"></i> Tambah Data</a></span></div>
                        
                        
<?php if ($totalRows_rsInfoRead > 0) { // Show if recordset not empty ?>
  <input oninput="w3.filterHTML('#informasi', '.informasi', this.value)" placeholder="Pencarian Data" class="w3-input w3-border w3-small" style="outline:none; margin-top:8px;" autofocus>
  <div style="margin-top:8px;" class="w3-text-red w3-small">*Klik Untuk Melihat Secara Detail</div>
  <table class="w3-table w3-striped w3-small w3-hoverable w3-bordered w3-border" id="informasi" style="margin-top:8px;">
    <tr style="font-weight:bold">
      
      <td>Judul</td>
      
      <td>Opsi</td>
    </tr>
    <?php do { ?>
      <tr class="informasi">
        
        <td onclick="document.getElementById('<?php echo $row_rsInfoRead['id_info']; ?>').style.display='block'"><?php echo $row_rsInfoRead['judul']; ?></td>
        
        <td><a class="w3-tag w3-small w3-blue" style="text-decoration:none" href="informasi_update.php?id_info=<?php echo $row_rsInfoRead['id_info']; ?>">Ubah</a> <a class="w3-tag w3-small w3-red" style="text-decoration:none" onClick="return confirm('Anda Yakin Ingin Menghapus?')" href="informasi_delete.php?id_info=<?php echo $row_rsInfoRead['id_info']; ?>">Hapus</a></td>
      </tr>
      
      
      
      <div id="<?php echo $row_rsInfoRead['id_info']; ?>" class="w3-modal">
  <div class="w3-modal-content" style="margin-top:-30px;">
    <div class="w3-container">
      <span onclick="document.getElementById('<?php echo $row_rsInfoRead['id_info']; ?>').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <p><i class="fa fa-search fa-fw"></i> Detail Informasi</p>
      <p>
	  <ul class="w3-ul w3-small w3-border">
  <li><div class="w3-center"><strong><?php echo $row_rsInfoRead['judul']; ?></strong></div></li>
  <li>
  <div class="w3-center"><img class="w3-center w3-image" height="200" width="400" src="foto_informasi/<?php echo $row_rsInfoRead['gambar']; ?>"></div>
  <div class="w3-justify" style="margin-top:8px;"><?php echo $row_rsInfoRead['isi']; ?></div></li>
  <li>Posting<span class="w3-right"><?php echo $row_rsInfoRead['posting']; ?></span></li>
  
</ul>
	  </p>
      
    </div>
  </div>
</div>
      
      <?php } while ($row_rsInfoRead = mysqli_fetch_assoc($rsInfoRead)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($rsInfoRead);
?>

<?php if ($totalRows_rsInfoRead == 0) { // Show if recordset empty ?>
 <table class="w3-table w3-border" style="margin-top:8px;">
    <tr>
      <td class="w3-center">Data Masih Kosong</td>
    </tr>
  </table>
  <?php } // Show if recordset empty ?>

                        <!-- InstanceEndEditable -->
                        
                        
                        
                        
                        
                      </div>
                    
                    </div>
                </div>
            </div><br>

        </div>
        <div class="w3-col l1">&nbsp;</div>
    </div>
</div><br>
<br>
<div class="w3-center w3-small">Copyright @ 2022 <strong>BJM BENGKEL</strong><br>
All Right Reserved</div>
<br>

	
</body>
<!-- InstanceEnd --></html>


