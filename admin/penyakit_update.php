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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE penyakit SET nama_penyakit=%s, definisi=%s, solusi=%s WHERE kd_penyakit=%s",
                       GetSQLValueString($_POST['nama_penyakit'], "text"),
                       GetSQLValueString($_POST['definisi'], "text"),
                       GetSQLValueString($_POST['solusi'], "text"),
                       GetSQLValueString($_POST['kd_penyakit'], "text"));

  
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error());

  $updateGoTo = "penyakit_read.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsPenyakitUpdate = "-1";
if (isset($_GET['kd_penyakit'])) {
  $colname_rsPenyakitUpdate = $_GET['kd_penyakit'];
}

$query_rsPenyakitUpdate = sprintf("SELECT * FROM penyakit WHERE kd_penyakit = %s", GetSQLValueString($colname_rsPenyakitUpdate, "text"));
$rsPenyakitUpdate = mysqli_query($koneksi, $query_rsPenyakitUpdate) or die(mysqli_error());
$row_rsPenyakitUpdate = mysqli_fetch_assoc($rsPenyakitUpdate);
$totalRows_rsPenyakitUpdate = mysqli_num_rows($rsPenyakitUpdate);
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
                    	<div class="w3-border w3-padding"><!-- InstanceBeginEditable name="EditRegion2" --><div class="w3-border-bottom" style="padding-bottom:10px; margin-top:8px;"><strong><i class="fa fa-edit"></i> UBAH DATA KERUSAKAN</strong></div>
                            <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<ul class="w3-ul w3-border" style="margin-top:8px;">
	<li>Kode Kerusakan<span class="w3-right"><strong><?php echo $row_rsPenyakitUpdate['kd_penyakit']; ?></strong></span></li>
</ul>
<div style="margin-top:8px;">
	<label>Nama Kerusakan</label>
    <input class="w3-input w3-border w3-small" required type="text" name="nama_penyakit" value="<?php echo htmlentities($row_rsPenyakitUpdate['nama_penyakit'], ENT_COMPAT, ''); ?>" size="32">
</div>

<div style="margin-top:8px;">
	<label>Definisi Kerusakan</label>
    <textarea class="w3-input w3-border w3-small" required name="definisi" cols="50" rows="5"><?php echo htmlentities($row_rsPenyakitUpdate['definisi'], ENT_COMPAT, ''); ?></textarea>
</div>

<div style="margin-top:8px;">
	<label>Solusi Penanganan</label>
    <textarea class="w3-input w3-border w3-small" required name="solusi" cols="50" rows="5"><?php echo htmlentities($row_rsPenyakitUpdate['solusi'], ENT_COMPAT, ''); ?></textarea>
</div>
                              
                              <hr>
  <div class="w3-center">
  <a onClick="window.history.back()" style="cursor:pointer" class="w3-btn w3-small w3-red"><i class="fa fa-times-rectangle fa-fw"></i> Batal</a> <button type="submit" class="w3-btn w3-small w3-green"><i class="fa fa-save fa-fw"></i> Simpan Perubahan</button>
  </div>
                              <input type="hidden" name="MM_update" value="form1">
                              <input type="hidden" name="kd_penyakit" value="<?php echo $row_rsPenyakitUpdate['kd_penyakit']; ?>">
                            </form>
                            <br>

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
<?php
mysqli_free_result($rsPenyakitUpdate);
?>
