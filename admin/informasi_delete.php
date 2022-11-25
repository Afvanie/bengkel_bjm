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

if ((isset($_GET['id_info'])) && ($_GET['id_info'] != "")) {
  $deleteSQL = sprintf("DELETE FROM informasi WHERE id_info=%s",
                       GetSQLValueString($_GET['id_info'], "text"));

  
  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error());
unlink("foto_informasi/".$_GET['id_info'].".jpg");
  $deleteGoTo = "informasi_read.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}


$query_rsInfoDelete = "SELECT * FROM informasi ORDER BY id_info ASC";
$rsInfoDelete = mysqli_query($koneksi, $query_rsInfoDelete) or die(mysqli_error());
$row_rsInfoDelete = mysqli_fetch_assoc($rsInfoDelete);
$totalRows_rsInfoDelete = mysqli_num_rows($rsInfoDelete);
?>
<?php
mysqli_free_result($rsInfoDelete);
?>
