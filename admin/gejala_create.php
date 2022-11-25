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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO gejala (kd_gejala, gejala) VALUES (%s, %s)",
                       GetSQLValueString($_POST['kd_gejala'], "text"),
                       GetSQLValueString($_POST['gejala'], "text"));
  $Result1 = mysqli_query($koneksi, $insertSQL) or die(mysqli_error());

  $insertGoTo = "gejala_read.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_rsGejalaCreate = "-1";
if (isset($_GET['kd_gejala'])) {
  $colname_rsGejalaCreate = $_GET['kd_gejala'];
}

$query_rsGejalaCreate = sprintf("SELECT * FROM gejala WHERE kd_gejala = %s", GetSQLValueString($colname_rsGejalaCreate, "text"));
$rsGejalaCreate = mysqli_query($koneksi, $query_rsGejalaCreate) or die(mysqli_error());
$row_rsGejalaCreate = mysqli_fetch_assoc($rsGejalaCreate);
$totalRows_rsGejalaCreate = mysqli_num_rows($rsGejalaCreate);
?>

<!DOCTYPE html>
<html>
<!-- InstanceBegin template="/Templates/template_admin.dwt.php" codeOutsideHTMLIsLocked="false" -->

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
                            <div class="w3-xlarge">APLIKASI SISTEM PAKAR</div>
                            <div class="w3-large"><strong>DIAGNOSIS KERUSAKAN MOBIL</strong></div>
                            <div class="w3-small" style="margin-top:3px;">MENGGUNAKAN METODE <strong>FORWARD
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
                                    <a href="home.php" style="text-decoration:none">
                                        <li style="border-bottom:1px solid #DDD;"><i class="fa fa-home fa-fw"></i>
                                            Beranda</li>
                                    </a>

                                    <a href="admin_read.php" style="text-decoration:none">
                                        <li style="border-bottom:1px solid #DDD;"><i class="fa fa-lock fa-fw"></i> Data
                                            Login</li>
                                    </a>

                                    <a href="penyakit_read.php" style="text-decoration:none">
                                        <li style="border-bottom:1px solid #DDD;"><i class="fa fa-bug fa-fw"></i> Data
                                            Penyakit</li>
                                    </a>

                                    <a href="gejala_read.php" style="text-decoration:none">
                                        <li style="border-bottom:1px solid #DDD;"><i class="fa fa-file fa-fw"></i> Data
                                            Gejala</li>
                                    </a>

                                    <a href="indikator_read.php" style="text-decoration:none">
                                        <li style="border-bottom:1px solid #DDD;"><i class="fa fa-list-ul fa-fw"></i>
                                            Indikator Bobot</li>
                                    </a>

                                    <a href="bobot_read.php" style="text-decoration:none">
                                        <li style="border-bottom:1px solid #DDD;"><i class="fa fa-history fa-fw"></i>
                                            Rule & Forward Chaining</li>
                                    </a>

                                    <a href="hasil_read.php" style="text-decoration:none">
                                        <li style="border-bottom:1px solid #DDD;"><i
                                                class="fa fa-check-square-o fa-fw"></i> Hasil Diagnosa</li>
                                    </a>

                                    <a href="informasi_read.php" style="text-decoration:none">
                                        <li style="border-bottom:1px solid #DDD;"><i class="fa fa-info fa-fw"></i>
                                            Informasi Gigi</li>
                                    </a>

                                    <!-- InstanceBeginEditable name="EditRegion1" --><a
                                        onClick="return confirm('Anda Yakin Ingin Keluar?')"
                                        href="<?php echo $logoutAction ?>" style="text-decoration:none">
                                        <li style="border-bottom:1px solid #DDD;"><i class="fa fa-times fa-fw"></i>
                                            Keluar</li>
                                    </a><!-- InstanceEndEditable -->
                                </ul>
                            </div>
                        </div>
                        <div class="w3-col l9" style="padding-left:8px;">
                            <div class="w3-border w3-padding">
                                <!-- InstanceBeginEditable name="EditRegion2" -->
                                <div class="w3-border-bottom" style="padding-bottom:10px; margin-top:8px;"><strong><i
                                            class="fa fa-plus"></i> TAMBAH DATA GEJALA</strong></div>


                                <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                                    <div style="margin-top:8px;">
                                        <label>Kode Gejala</label>
                                        <input type="text" class="w3-input w3-border w3-small" required name="kd_gejala"
                                            value="" size="32">
                                    </div>

                                    <div style="margin-top:8px;">
                                        <label>Gejala</label>
                                        <input type="text" class="w3-input w3-border w3-small" required name="gejala"
                                            value="" size="32">
                                    </div>

                                    <hr>
                                    <div class="w3-center">
                                        <a onClick="window.history.back()" style="cursor:pointer"
                                            class="w3-btn w3-small w3-red"><i class="fa fa-times-rectangle fa-fw"></i>
                                            Batal</a> <button type="submit" class="w3-btn w3-small w3-green"><i
                                                class="fa fa-save fa-fw"></i> Simpan</button>
                                    </div>
                                    <input type="hidden" name="MM_insert" value="form1">
                                </form>
                                <br>
                                <?php
mysqli_free_result($rsGejalaCreate);
?>

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
<div class="w3-center w3-small">Copyright @ 2020 <strong>Sistem Pakar Penyakit Gigi</strong><br>
All Right Reserved</div>
<br>


</body>
<!-- InstanceEnd -->

</html>