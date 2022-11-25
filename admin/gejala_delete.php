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

if ((isset($_GET['kd_gejala'])) && ($_GET['kd_gejala'] != "")) {
  $deleteSQL = sprintf("DELETE FROM gejala WHERE kd_gejala=%s",
                       GetSQLValueString($_GET['kd_gejala'], "text"));

  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error());

  $deleteGoTo = "gejala_read.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$query_rsHapusGejala = "SELECT * FROM gejala ORDER BY kd_gejala ASC";
$rsHapusGejala = mysqli_query($koneksi, $query_rsHapusGejala) or die(mysqli_error());
$row_rsHapusGejala = mysqli_fetch_assoc($rsHapusGejala);
$totalRows_rsHapusGejala = mysqli_num_rows($rsHapusGejala);
?>
<?php
mysqli_free_result($rsHapusGejala);
?>
