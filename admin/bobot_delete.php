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

if ((isset($_GET['id_bobot'])) && ($_GET['id_bobot'] != "")) {
  $deleteSQL = sprintf("DELETE FROM bobot WHERE id_bobot=%s",
                       GetSQLValueString($_GET['id_bobot'], "int"));

  
  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysql_error());

  $deleteGoTo = "bobot_read.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}


$query_rsBobotDelete = "SELECT * FROM bobot ORDER BY id_bobot ASC";
$rsBobotDelete = mysqli_query($koneksi, $query_rsBobotDelete) or die(mysql_error());
$row_rsBobotDelete = mysqli_fetch_assoc($rsBobotDelete);
$totalRows_rsBobotDelete = mysqli_num_rows($rsBobotDelete);
?>
<?php
mysqli_free_result($rsBobotDelete);
?>
