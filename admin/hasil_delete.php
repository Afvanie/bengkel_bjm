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

if ((isset($_GET['id_pasien'])) && ($_GET['id_pasien'] != "")) {
  $deleteSQL = sprintf("DELETE FROM hasil WHERE id_pasien=%s",
                       GetSQLValueString($_GET['id_pasien'], "int"));

  
  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error());
  
  $deleteSQL2 = sprintf("DELETE FROM pasien WHERE id_pasien=%s",
                       GetSQLValueString($_GET['id_pasien'], "int"));

  
  $Result1 = mysqli_query($koneksi, $deleteSQL2) or die(mysqli_error());

  $deleteGoTo = "hasil_read.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}


$query_rsHasilDelete = "SELECT * FROM hasil ORDER BY id_hasil ASC";
$rsHasilDelete = mysqli_query($koneksi, $query_rsHasilDelete) or die(mysqli_error());
$row_rsHasilDelete = mysqli_fetch_assoc($rsHasilDelete);
$totalRows_rsHasilDelete = mysqli_num_rows($rsHasilDelete);
?>
<?php
mysqli_free_result($rsHasilDelete);
?>
