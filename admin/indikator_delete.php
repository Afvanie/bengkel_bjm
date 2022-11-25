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

if ((isset($_GET['id_indikator'])) && ($_GET['id_indikator'] != "")) {
  $deleteSQL = sprintf("DELETE FROM indikator WHERE id_indikator=%s",
                       GetSQLValueString($_GET['id_indikator'], "int"));

  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error());

  $deleteGoTo = "indikator_read.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$query_rsIndikatorDelete = "SELECT * FROM indikator ORDER BY id_indikator ASC";
$rsIndikatorDelete = mysqli_query($koneksi, $query_rsIndikatorDelete) or die(mysqli_error());
$row_rsIndikatorDelete = mysqli_fetch_assoc($rsIndikatorDelete);
$totalRows_rsIndikatorDelete = mysqli_num_rows($rsIndikatorDelete);
?>
<?php
mysqli_free_result($rsIndikatorDelete);
?>
