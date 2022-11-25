<?php require_once('../Connections/koneksi.php'); ?>
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

if ((isset($_GET['kd_penyakit'])) && ($_GET['kd_penyakit'] != "")) {
  $deleteSQL = sprintf("DELETE FROM penyakit WHERE kd_penyakit=%s",
                       GetSQLValueString($_GET['kd_penyakit'], "text"));

  
  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error());

  $deleteGoTo = "penyakit_read.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}


$query_rsPenyakitDelete = "SELECT * FROM penyakit ORDER BY kd_penyakit ASC";
$rsPenyakitDelete = mysqli_query($koneksi, $query_rsPenyakitDelete) or die(mysqli_error());
$row_rsPenyakitDelete = mysqli_fetch_assoc($rsPenyakitDelete);
$totalRows_rsPenyakitDelete = mysqli_num_rows($rsPenyakitDelete);
?>
<?php
mysqli_free_result($rsPenyakitDelete);
?>
