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

if ((isset($_GET['id_login'])) && ($_GET['id_login'] != "")) {
  $deleteSQL = sprintf("DELETE FROM login WHERE id_login=%s",
                       GetSQLValueString($_GET['id_login'], "int"));

  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysql_error());

  $deleteGoTo = "admin_read.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
 
$query_rsAdminDeete = "SELECT * FROM login ORDER BY id_login ASC";
$rsAdminDeete = mysqli_query($query_rsAdminDeete, $koneksi) or die(mysql_error());
$row_rsAdminDeete = mysqli_fetch_assoc($rsAdminDeete);
$totalRows_rsAdminDeete = mysqli_num_rows($rsAdminDeete);
?>
<?php
mysqli_free_result($rsAdminDeete);
?>
