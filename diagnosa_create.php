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

                                    <!-- <a href="informasi_read.php" style="text-decoration:none"><li style="border-bottom:1px solid #DDD;"><i class="fa fa-book fa-fw"></i> Seputar Kerusakan Mobil</li></a> -->


                                </ul>
                            </div>
                        </div>
                        <div class="w3-col l9" style="padding-left:8px;">
                            <div class="w3-border w3-padding">
                                <div class="w3-border-bottom" style="padding-bottom:10px; margin-top:8px;"><strong><i
                                            class="fa fa-book"></i> DIAGNOSA</strong></div>
                                <!-- DISINI -->
                                <div class="w3-padding w3-border w3-border-yellow w3-pale-yellow w3-small"
                                    style="margin-top:8px;">
                                    <div><strong><i class="fa fa-info-circle"></i> PERHATIAN</strong></div>
                                    <div>Silahkan Isi Identitas Anda Terlebih Dahulu Sebelum Memulai Diagnosa. Mohon Isi
                                        Dengan Benar.</div>
                                </div>

                                <form method="post" name="form1" target="_self" action="diagnosa_add.php">
                                    <div style="margin-top:8px;">
                                        <label>Nama</label>
                                        <input autofocus name="TxtNama" class="w3-input w3-border w3-small" required
                                            id="TxtNama" type="text" size="35" maxlength="30">

                                    </div>


                                    <div style="margin-top:8px;">
                                        <label>Umur</label>
                                        <input class="w3-input w3-border w3-small" required name="TxtUmur" id="TxtUmur"
                                            type="number" size="3" maxlength="3">
                                    </div>

                                    <div style="margin-top:8px;">
                                        <label>Jenis Kelamin</label>
                                        <select name="cbojk" id="cbojk" class="w3-input w3-border w3-small" required>

                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>

                                    </div>



                                    <div style="margin-top:8px;">
                                        <label>Alamat</label>
                                        <input name="TxtAlamat" class="w3-input w3-border w3-small" required
                                            id="TxtAlamat" type="text" size="50" maxlength="100">
                                    </div>





                                    <div style="margin-top:8px;">
                                        <label>Email</label>
                                        <input class="w3-input w3-border w3-small" required type="text" name="textemail"
                                            id="textemail" size="25" maxlength="50">
                                    </div>









                                    <hr>
                                    <div class="w3-center">
                                        <a href="index.php" style="cursor:pointer" class="w3-btn w3-small w3-red"><i class="fa fa-times-rectangle fa-fw"></i> Batal</a> 
                                        <button type="submit" class="w3-btn w3-small w3-green"><i class="fa fa-save fa-fw"></i>Simpan</button>
                                    </div>
                                </form>

                                <br>
                                <!-- AKHIR DISINI -->


                            </div>

                        </div>
                    </div>
                </div><br>

            </div>
            <div class="w3-col l1">&nbsp;</div>
        </div>
    </div><br>
    <div class="w3-center w3-small">Copyright @ 2022 <strong>BJM BENGKEL</strong><br>
        All Right Reserved</div>
    <br>

</body>

</html>