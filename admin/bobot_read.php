<?php include "../koneksi.php" ?>
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
                    	<div class="w3-xlarge">SISTEM PAKAR</div>
                        <div class="w3-large"><strong>DIAGNOSIS KERUSAKAN</strong></div>
                        <div class="w3-small" style="margin-top:3px;">MENGGUNAKAN METODE <strong>FORWARD CHAINING</strong>
                      </div>
                  </div>
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
                                            Rule & FORWARD CHAINING</li>
                                    </a>

                                    <a href="hasil_read.php" style="text-decoration:none">
                                        <li style="border-bottom:1px solid #DDD;"><i
                                                class="fa fa-check-square-o fa-fw"></i> Hasil Diagnosa</li>
                                    </a>

                                    <a href="informasi_read.php" style="text-decoration:none">
                                        <li style="border-bottom:1px solid #DDD;"><i class="fa fa-info fa-fw"></i>
                                            Informasi Kerusakan</li>
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
                                            class="fa fa-history"></i> DATA RULE & FORWARD CHAINING</strong><span
                                        class="w3-right"><a href="bobot_create.php" class="w3-tag w3-black w3-small"
                                            style="text-decoration:none"><i class="fa fa-plus fa-fw"></i> Tambah
                                            Data</a></span></div>


                                <input oninput="w3.filterHTML('#bobot', '.bobot', this.value)"
                                    placeholder="Pencarian Data" class="w3-input w3-border w3-small"
                                    style="outline:none; margin-top:8px;" autofocus>
                                <table class="w3-table w3-small w3-bordered w3-border" id="bobot"
                                    style="margin-top:8px;">

                                    <?php
                                    $query=mysqli_query($koneksi, "SELECT bobot.kd_gejala,bobot.kd_penyakit,penyakit.kd_penyakit,penyakit.nama_penyakit AS penyakit FROM bobot,penyakit WHERE bobot.kd_penyakit=penyakit.kd_penyakit GROUP BY bobot.kd_penyakit")or die(mysql_error());
                                    $no=0;
                                    while($row=mysqli_fetch_array($query)){
                                        $idpenyakit=$row['kd_penyakit'];
                                        $no++;
                                        ?>

                                    <tr class="bobot">
                                        <td><?php echo $no;?></td>
                                        <td>Penyakit :
                                            <?php echo $row['kd_penyakit'];?>&nbsp;|&nbsp;<strong><?php echo $row['penyakit'];?></strong>
                                            <table style="margin-top:8px;" class="w3-table w3-border">
                                                <?php
                                                $query2=mysqli_query($koneksi, "SELECT bobot.id_bobot,bobot.kd_gejala,bobot.bobot,bobot.kd_penyakit,gejala.gejala AS namagejala FROM bobot,gejala WHERE bobot.kd_penyakit='$idpenyakit' AND gejala.kd_gejala=bobot.kd_gejala")or die(mysql_error());
                                                while ($row2=mysqli_fetch_array($query2)){
                                                    $kd_gej=$row2['kd_gejala'];
                                                    $kd_pen=$row2['kd_penyakit'];
                                                ?>

                                                <tr class="w3-small">
                                                    <td class="w3-border-right"><span class="w3-tag w3-small">Bobot :
                                                            <?php echo number_format($row2['bobot'],1) ?></span>
                                                        <?php echo $row2['kd_gejala']." | ".$row2['namagejala'] ?><span
                                                            class="w3-right"><a class="w3-tag w3-small w3-blue"
                                                                style="text-decoration:none"
                                                                href="bobot_update.php?id_bobot=<?php echo $row2['id_bobot'] ?>">Ubah</a>
                                                            <a onClick="return confirm('Anda Yakin Ingin Menghapus?')"
                                                                href="bobot_delete.php?id_bobot=<?php echo $row2['id_bobot'] ?>"
                                                                class="w3-tag w3-small w3-red"
                                                                style="text-decoration:none">Hapus</a></span></td>


                                    </tr>

                                                <?php
		
		}
	?>
                                            </table>
                                        </td>
                                    </tr><?php } ?>
                                </table>
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
<!-- InstanceEnd -->

</html>