<!DOCTYPE html>
<html>

<head>
    <title>BJM BENGKEL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/w3.css">
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script src="assets/w3.js"></script>
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
                                    <a href="index.php" style="text-decoration:none">
                                        <li style="border-bottom:1px solid #DDD;"><i class="fa fa-home fa-fw"></i>
                                            Beranda</li>
                                    </a>

                                    <a href="diagnosa_create.php" style="text-decoration:none">
                                        <li style="border-bottom:1px solid #DDD;"><i class="fa fa-book fa-fw"></i>
                                            Diagnosa</li>
                                    </a>

                                    <a href="penyakit_read.php" style="text-decoration:none">
                                        <li style="border-bottom:1px solid #DDD;"><i class="fa fa-book fa-fw"></i>
                                            Daftar Kerusakan</li>
                                    </a>

                                    <!-- <a href="informasi_read.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-book fa-fw"></i> Seputar Gigi</li></a> -->


                                </ul>
                            </div>
                        </div>
                        <div class="w3-col l9" style="padding-left:8px;">
                            <div class="w3-border w3-padding">
                                <div class="w3-border-bottom" style="padding-bottom:10px; margin-top:8px;"><strong><i
                                            class="fa fa-file-text"></i> HASIL DIAGNOSA</strong></div>

                                <?php
			include "koneksi.php";
			// kosongkan tabel tmp_penyakit
			$kosong_tmp_penyakit=mysqli_query($koneksi, "DELETE FROM tmp_penyakit");
			//echo "<h3>Hasil Diagnosa</h3><hr>";
			$sqlpenyakit="SELECT * FROM bobot GROUP BY kd_penyakit ";
			$querypenyakit=mysqli_query($koneksi, $sqlpenyakit);
			$Similarity=0;
			echo "<div style='display:block'>";
			echo"<center><h2>PERHITUNGAN</h2></center>";
			while($rowpenyakit=mysqli_fetch_array($querypenyakit)){
			// data penyakit di tabel bobot
			echo "Kode Penyakit : ".$rowpenyakit['kd_penyakit']. "<br>";
			$kd_pen=$rowpenyakit['kd_penyakit'];
				//mengambil gejala di tabel bobot
				$query_gejala=mysqli_query($koneksi, "SELECT * FROM bobot WHERE kd_penyakit='$kd_pen'");
				$var1=0; $var2=0;
				$querySUM=mysqli_query($koneksi, "select sum(bobot)AS jumlahbobot from bobot where kd_penyakit='$kd_pen'");
				$resSUM=mysqli_fetch_array($querySUM);
				echo "Jumlah Bobot Dari Semua Gejala : ".$resSUM['jumlahbobot'] ."<br>";
				$SUMbobot=$resSUM['jumlahbobot'];
				while($row_gejala=mysqli_fetch_array($query_gejala)){
					// kode gejala di tabel bobot
					$kode_gejala_bobot=$row_gejala['kd_gejala'];
					$bobotbobot=$row_gejala['bobot'];
					//echo "bobot bobot=". $bobotbobot. "<br>";
					echo"<p>";
					echo "<strong>Kode Gejala :</strong> ". $row_gejala['kd_gejala']. " <strong><br>Bobotnya</strong> : ". $bobotbobot."<br>";
					// mencari data di tabel tmp_gejala dan membandingkannya
					$query_tmp_gejala=mysqli_query($koneksi, "SELECT * FROM tmp_gejala WHERE kd_gejala='$kode_gejala_bobot'");
					$row_tmp_gejala=mysqli_fetch_array($query_tmp_gejala);
					//$bobot_TMP=$row_tmp_gejala['bobot'];
					// Mengecek apakah ada data di tabel tmp_gejala
					$adadata=mysqli_num_rows($query_tmp_gejala);
						if($adadata!==0){
							echo "<span class='w3-text-blue'><b>Ini Gejala Yang Dipilih</b></span><br>";
							//echo " Kode Gejala pada tabel tmp_gejala = ".$row_tmp_gejala['kd_gejala'] ."<br>";
							//$bobotNilai=$bobotbobot*1; echo "Nilai bobot hasil kali 1 = ".$bobotNilai;
							
							$bobotNilai=$bobotbobot*1;
							echo "Nilai Bobot Dikali 1 => ".$bobotbobot." x 1 = ".$bobotNilai."<br>";
							$HasilKaliSatu;
							$var1=$bobotNilai/$SUMbobot; echo "Nilai Bobot Dibagi Jumlah Seluruh Bobot => ".$bobotNilai." / ".$SUMbobot." = ".$var1;
							}else{
							echo "Gejala Ini Tidak Dipilih<br>";
							$bobotNilai=$bobotbobot*0; //echo "Nilai = ".$bobotNilai;
							$var2=$bobotNilai+$bobotNilai; //echo "Nilai Jika 0=". $var2;
							}
							$Nilai_tmp_gejala=$var1+$var2; //echo "Nilai akhir".$Nilai_tmp_gejala;
							$Nilai_bawah=@$Nilai_bawah + $bobotbobot;
							$Nilai_Pembilang=$Nilai_tmp_gejala;
							$Nilai_Penyebut=$Nilai_bawah;
							// menghasilkan nilai Similarity dengan membagikan $Nilai_Pembilang/$Nilai_Penyebut
							$Similarity=$Nilai_Pembilang/$Nilai_Penyebut;
							// input data ke tabel tmp_penyakit		
					echo "</p>";	
					}
			$query_tmp_penyakit=mysqli_query($koneksi, "INSERT INTO tmp_penyakit(kd_penyakit,nilai) VALUES ('$kd_pen','$var1')");
			
			$nilaiMin=mysqli_query($koneksi, "SELECT kd_penyakit,MAX(nilai)  AS NilaiAkhir FROM tmp_penyakit GROUP BY nilai  ORDER BY nilai DESC ");
			//$nilaiMin=mysql_query("SELECT kd_penyakit,MIN(nilai)  AS NilaiAkhir FROM tmp_penyakit");
			$rowMin=mysqli_fetch_array($nilaiMin);
			$rendah=$rowMin['NilaiAkhir']; //echo $rendah;
			echo "<hr><b>Nilai Gejala Yang Paling Dominan :<br>Sebesar ". $rowMin['NilaiAkhir']."</b><br><hr>";
			//echo "<h3>Hasil Diagnosa : </h3>";
			echo "Penyakit Akhir : ".$rowMin['kd_penyakit']. "<br>";
			$penyakitakhir=$rowMin['kd_penyakit'];
			echo "<input type='hidden' value='$rowMin[kd_penyakit]'>";
			$sql_pilih_penyakit=mysqli_query($koneksi, "SELECT * FROM penyakit WHERE kd_penyakit='$penyakitakhir'");
			$row_hasil=mysqli_fetch_array($sql_pilih_penyakit);
			//echo "<strong>Nama Penyakit :</strong> ". $row_hasil['nama_penyakit'] ."<br>";
			//echo "<strong>Keterangan Penyakit : </strong><p>".$row_hasil['definisi'] ."</p>";
			//echo "<strong>Solusi Penyakit : </strong><p>".$row_hasil['solusi'] ."</p>";
			$kd_penyakit=$row_hasil['kd_penyakit'];
			$penyakit=$row_hasil['nama_penyakit'];
			$keterangan_penyakit=$row_hasil['definisi'];
			$solusi=$row_hasil['solusi'];
			}
			
			echo "<hr>";	
			echo "</div>";
			?> 
			
			
			
			
			
			<?php
				include "koneksi.php";
				$query_pasien=mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY id_pasien DESC");
				$data_pasien=mysqli_fetch_array($query_pasien);
				//echo "Nama : ". $data_pasien['nama'] . "<br>";
				//echo "Jenis Kelamin : ". $data_pasien['kelamin']. "<br>";
				//echo "Umur Pasien : ". $data_pasien['umur']. "<br>";
				//echo "Alamat : ". $data_pasien['alamat']. "<br>";
				//echo "<label><strong>Gejala yang diinputkan :</strong> </label><br>";
				$query_gejala_input=mysqli_query($koneksi, "SELECT gejala.gejala AS namagejala,tmp_gejala.kd_gejala FROM gejala,tmp_gejala WHERE tmp_gejala.kd_gejala=gejala.kd_gejala");
				$nogejala=0;
				
				?>
			
			
			<ul class="w3-ul w3-border" style="margin-top:8px;">
				<li>Nama<span class="w3-right"><?php echo $data_pasien['nama'] ?></span></li>
				<li>Umur<span class="w3-right"><?php echo $data_pasien['umur'] ?> Tahun</span></li>
				<li>Jenis Kelamin<span class="w3-right"><?php echo $data_pasien['kelamin'] ?></span></li>
				<li>Alamat<span class="w3-right"><?php echo $data_pasien['alamat'] ?></span></li>
			</ul>
			
			<div style="margin-top:8px;" class="w3-padding w3-border">
			<strong>GEJALA YANG DIPILIH</strong>
			<div class="w3-small w3-justify">
			<?php
			while($row_gejala_input=mysqli_fetch_array($query_gejala_input)){
					$nogejala++;
					echo $nogejala. ". ". $row_gejala_input['namagejala']. "<br>";
					}
					?>
			</div>
			</div>
			
			<div style="margin-top:8px;" class="w3-padding w3-border w3-pale-yellow">
			
			<?php
			//mencari persen
			$query_nilai=mysqli_query($koneksi, "SELECT SUM(nilai) as nilaiSum FROM tmp_penyakit");
			$rowSUM=mysqli_fetch_array($query_nilai);
			$nilaiTotal=$rowSUM['nilaiSum'];
			echo "<center>Nilai Total (Nilai P1 + Nilai P2 + Nilai P3) : <b>". $rowSUM['nilaiSum']. "</b></center>";
			$query_sum_tmp=mysqli_query($koneksi, "SELECT * FROM tmp_penyakit WHERE NOT nilai='0' ORDER BY nilai DESC ");
			while($row_sumtmp=mysqli_fetch_array($query_sum_tmp)){
				$nilai=$row_sumtmp['nilai'];
				$nilai_persen=$nilai/$nilaiTotal*100;
				$data_persen=$nilai_persen;
				$persen=substr($data_persen,0,5);
				echo "<center>";
				echo "Nilai Gejala Yang Diambil : <b>".$nilai."</b><br>";
				echo "Nilai Persen (Nilai Gejala / Nilai Total x 100) : <b>".$persen. "%</b></center><br>";
				$kd_pen2=$row_sumtmp['kd_penyakit'];
				//echo $kd_pen2 ."<br>";
				//echo $kd_pen2. "<br>";
				$query_penyasol=mysqli_query($koneksi, "SELECT * FROM penyakit WHERE kd_penyakit='$kd_pen2'");
				while ($row_penyasol=mysqli_fetch_array($query_penyasol)){
					// jika hasil diagnosa 100% / PENYAKITNYA CUMA 1
					if($persen==100||$persen>=70){
						echo "<div class='w3-center'><strong>ANDA MENDERITA PENYAKIT</strong></div>";
						echo "<div class='w3-center w3-xlarge w3-text-green'><strong>".strtoupper($row_penyasol['nama_penyakit'])."</strong></div><hr>";
						echo "<div class='w3-justify w3-small'>Apa Itu <b>".strtoupper($row_penyasol['nama_penyakit'])."</b>?<br>
						".$row_penyasol['definisi']."
						</div>";
						echo "<br>";
						echo "<div class='w3-justify w3-small'><b>Solusi Pengobatan</b><br>
						".$row_penyasol['solusi']."</div>";
						echo "<br>";
						
						// simpan hasil
						$query_temp=mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY id_pasien DESC") or die(mysql_error());
						$row_pasien=mysqli_fetch_array($query_temp)or die(mysql_error());
						$id_pasien=$row_pasien['id_pasien'];
						$nama=$row_pasien['nama'];
						$kelamin=$row_pasien['kelamin'];
						$umur=$row_pasien['umur'];
						$alamat=$row_pasien['alamat'];
						$tanggal=$row_pasien['tanggal'];
						$email=$row_pasien['email'];
						//echo "INI ID PASIEN ".$id_pasien ."<br>";
						//$query_tmp_hasil=mysql_query("");
						$kode_penyakit=$row_sumtmp['kd_penyakit'];
						//echo $kode_penyakit ."100%";
						$query_hasil="INSERT INTO hasil(id_hasil,id_pasien,nama,kelamin,umur,alamat,email, kd_penyakit,tanggal) VALUES (NULL,'$id_pasien','$nama','$kelamin','$umur','$alamat','$email','$kd_penyakit','$tanggal')";
						
						$res_hasil=mysqli_query($koneksi, $query_hasil)or die(mysql_error());
						if($res_hasil){
							//echo "BERHASIL DISIMPAN";
							}else{
								echo "GAGAL DISIMPAN";
							}
						//#end simpan
				?>
				
			
			
			
			
			
			<?php
			
						}else{
							//KALAU LEBIH DARI 1 PENYAKIT NYA
							echo "<div class='w3-center'><strong>ANDA MENDERITA PENYAKIT</strong></div>";
							echo "<div class='w3-center w3-xlarge w3-text-green'><strong>".strtoupper($row_penyasol['nama_penyakit'])."</strong></div>";
							echo "<center><span class='w3-tag'>Sebesar ".$persen."%</span></center><hr>";
						echo "<div class='w3-justify w3-small'>Apa Itu <b>".strtoupper($row_penyasol['nama_penyakit'])."</b>?<br>
						".$row_penyasol['definisi']."
						</div>";
						echo "<br>";
						echo "<div class='w3-justify w3-small'><b>Solusi Pengobatan</b><br>
						".$row_penyasol['solusi']."</div>";
						echo "<hr>";
						
						
						
						
							
							// simpan data
							$query_temp=mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY id_pasien DESC") or die(mysql_error());
							$row_pasien=mysqli_fetch_array($query_temp)or die(mysql_error());
							$id_pasien=$row_pasien['id_pasien'];
							$nama=$row_pasien['nama'];
							$kelamin=$row_pasien['kelamin'];
							$umur=$row_pasien['umur'];
							$alamat=$row_pasien['alamat'];
							$tanggal=$row_pasien['tanggal'];
							$email=$row_pasien['email'];
							$query_hasil2="INSERT INTO hasil(id_hasil,id_pasien,nama,kelamin,umur,alamat,email, kd_penyakit,tanggal) VALUES (NULL,'$id_pasien','$nama','$kelamin','$umur','$alamat','$email','$kd_penyakit','$tanggal')";
							$res_hasil2=mysqli_query($koneksi, $query_hasil2)or die(mysql_error());
							if($res_hasil2){
								echo "";
								}else{
									echo "<font color='#FF0000'>Data tidak dapat disimpan..!</font><br>";
								}
							}
					}
				}	
				
			?>
			</div>


                                <a class="w3-btn w3-block w3-green" style="margin-top:8px;" href="diagnosa_mulai.php"><i
                                        class="fa fa-chevron-left fa-fw"></i> Ulangi Diagnosa</a><br />

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

</html>