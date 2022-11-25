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

$maxRows_rsAdminread = 100;
$pageNum_rsAdminread = 0;
if (isset($_GET['pageNum_rsAdminread'])) {
  $pageNum_rsAdminread = $_GET['pageNum_rsAdminread'];
}
$startRow_rsAdminread = $pageNum_rsAdminread * $maxRows_rsAdminread;


$query_rsAdminread = "SELECT * FROM login ORDER BY id_login DESC";
$query_limit_rsAdminread = sprintf("%s LIMIT %d, %d", $query_rsAdminread, $startRow_rsAdminread, $maxRows_rsAdminread);
$rsAdminread = mysqli_query($koneksi, $query_limit_rsAdminread) or die(mysqli_error());
$row_rsAdminread = mysqli_fetch_assoc($rsAdminread);

if (isset($_GET['totalRows_rsAdminread'])) {
  $totalRows_rsAdminread = $_GET['totalRows_rsAdminread'];
} else {
  $all_rsAdminread = mysqli_query($koneksi, $query_rsAdminread);
  $totalRows_rsAdminread = mysqli_num_rows($all_rsAdminread);
}
$totalPages_rsAdminread = ceil($totalRows_rsAdminread/$maxRows_rsAdminread)-1;
$nomor = 1;
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
                        <div class="w3-large"><strong>DIAGNOSIS KERUSAKAN</strong></div>
                        <div class="w3-small" style="margin-top:3px;">MENGGUNAKAN METODE <strong>FORWARD CHAINING</strong>
                      </div>
                  </div>
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
  
  <a href="bobot_read.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-history fa-fw"></i> Rule & FORWARD CHAINING</li></a>
  
  <a href="hasil_read.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-check-square-o fa-fw"></i> Hasil Diagnosa</li></a>
  
  <a href="informasi_read.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-info fa-fw"></i> Informasi Kerusakan</li></a>
  
  <!-- InstanceBeginEditable name="EditRegion1" --><a onClick="return confirm('Anda Yakin Ingin Keluar?')" href="<?php echo $logoutAction ?>" style="text-decoration:none">
  <li style="border-bottom:1px solid #DDD;"><i class="fa fa-times fa-fw"></i> Keluar</li>
  </a><!-- InstanceEndEditable -->
                       	  </ul>
                        </div>
                    </div>
                    <div class="w3-col l9" style="padding-left:8px;">
                    	<div class="w3-border w3-padding"><!-- InstanceBeginEditable name="EditRegion2" --><div class="w3-border-bottom" style="padding-bottom:10px; margin-top:8px;"><strong><i class="fa fa-lock"></i> DATA LOGIN</strong><span class="w3-right"><a href="admin_create.php" class="w3-tag w3-black w3-small" style="text-decoration:none"><i class="fa fa-plus fa-fw"></i> Tambah Data</a></span></div>
                        
                        
<?php if ($totalRows_rsAdminread > 0) { // Show if recordset not empty ?>
<input oninput="w3.filterHTML('#admin', '.admin', this.value)" placeholder="Pencarian Data" class="w3-input w3-border w3-small" style="outline:none; margin-top:8px;" autofocus>
  <table class="w3-table w3-striped w3-small w3-hoverable w3-bordered w3-border" id="admin" style="margin-top:8px;">
    <tr style="font-weight:bold">
    <td>No</td>
    <td>Username</td>
    <td>Password</td>
    <td>Opsi</td>
  </tr>
  <?php do { ?>
    <tr class="admin">
      <td><?php echo $nomor++; ?></td>
      <td><?php echo $row_rsAdminread['username']; ?></td>
      <td><?php echo $row_rsAdminread['password']; ?></td>
      <td><a class="w3-tag w3-small w3-blue" style="text-decoration:none" href="admin_update.php?id_login=<?php echo $row_rsAdminread['id_login']; ?>">Ubah</a> <a class="w3-tag w3-small w3-red" style="text-decoration:none" onClick="return confirm('Anda Yakin Ingin Menghapus?')" href="admin_delete.php?id_login=<?php echo $row_rsAdminread['id_login']; ?>">Hapus</a></td>
    </tr>
    <?php } while ($row_rsAdminread = mysqli_fetch_assoc($rsAdminread)); ?>
</table>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($rsAdminread);
?>

  <?php if ($totalRows_rsAdminread == 0) { // Show if recordset empty ?>
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
<div class="w3-center w3-small">Copyright @ 2020 <strong>BJM BENGKEL</strong><br>
All Right Reserved</div>
<br>

	
</body>
<!-- InstanceEnd --></html>


