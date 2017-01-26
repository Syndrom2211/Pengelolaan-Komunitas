<!DOCTYPE HTML>
<html>
<head>
    <?php include "include/header.php"; ?>
</head>
<body id="pageBody">

<?php include "include/navigation.php"; ?>

<div id="contentOuterSeparator"></div>

<div class="container">

    <div class="divPanel page-content">

        <div class="row-fluid">
                  <!--
                  Untuk Pencarian
                  <div class="well">
                  <div class="input-append">
                    <input class="span9" placeholder="Cari kata kunci komunitas..." id="appendedInputButton" size="16" type="text">
                    <button class="btn" type="button">Cari</button>
                  </div>
                </div>
              -->

                  <div class="media">
                      <div class="media-body">
                        <div class="hero-unit">
                          <?php
                          include "include/koneksi.php";
                          $sql2 = mysql_query("SELECT * FROM tbl_bantuan_registrasi");
                          $num = mysql_fetch_array($sql2);
                          ?>
                    <h2>Bantuan Registrasi</h2>
                  <p align="justify" style="font-size:13px;">
                      <?php echo $num['penjelasan']; ?>
                  </p>
                </div>
                      </div>
                      <div class="page-header"></div>
                  </div>

				<!--/End Sidebar Content -->
                <div class="span4">
				<!--
                  <h3>Kategori Artikel</h3>
                  <p>
                  <ul>
                  <?php
                  //include "include/koneksi.php";
                  //$sql = mysql_query("SELECT * FROM tbl_kategori_artikel");
                  //while($hasil = mysql_fetch_array($sql)){
                  ?>
                      <li>
                        <a href="#"><?php //echo $hasil['nama_kategori']; ?></a>
                      </li>
                  <?php
                  //}
                  ?>
                  </ul>
                </p>
                <div class="page-header"></div>
                    <h3>Artikel Terbaru</h3>
                    <?php
                    //$sql = mysql_query("SELECT * FROM tbl_artikel");
                    //while($hasil = mysql_fetch_array($sql)){
                    ?>
                    <a class="pull-left" href="#">
                      <img style="margin:10px 10px 0px 10px;" src="<?php //echo $hasil['gambar']; ?>" class="img-rounded" />
                    </a>
	                  <a href="#"><?php //echo $hasil['judul']; ?></a>
                    <p align="justify">
                        <?php //echo $hasil['isi']; ?>
                    </p>
                    <?php
                    //}
                    ?>
					-->
                </div>
            </div>

        <div id="footerInnerSeparator"></div>
    </div>

</div>

<div id="footerOuterSeparator"></div>

<?php include "include/footer.php"; ?>
</body>
</html>
