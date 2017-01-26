<div class="nav-collapse">
  <ul class="nav pull-right">
    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                      class="icon-user"></i> <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="v_setting.php">Pengaturan</a></li>
        <li><a href="p_logout.php">Logout</a></li>
      </ul>
    </li>
  </ul>
</div>
<!--/.nav-collapse -->
</div>
<!-- /container -->
</div>
<!-- /navbar-inner -->
</div>
<!-- /navbar -->
<div class="subnavbar">
<div class="subnavbar-inner">
<div class="container">
<ul class="mainnav">
  <li><a href="index.php"><i class="icon-play"></i><span>Home</span> </a> </li>
  <li><a href="v_komunitas.php"><i class="icon-group"></i><span>List Komunitas</span> </a> </li>
  <li><a href="v_pj.php"><i class="icon-user-md"></i><span>List Penanggung Jawab</span> </a></li>
  <li><a href="v_anggota.php"><i class="icon-user"></i><span>List Anggota</span> </a> </li>
  <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-file"></i><span>Data Laporan</span> <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <li><a href="lap_gantijab.php">Penggantian Jabatan</a></li>
      <li><a href="lap_statusaktif.php">Status Keaktifan</a></li>
	  <li><a href="lap_biayarutinan.php">Status Biaya Rutinan</a></li>
      <li><a href="lap_feedback.php">Feedback Anggota</a></li>
      <li><a href="lap_transaksi.php">Transaksi Pembayaran</a></li>
      <!--<li><a href="v_history_pj.php">History Penanggung Jawab</a></li>-->
    </ul>
  </li>
  <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-asterisk"></i><span>Data Master</span> <b class="caret"></b></a>
    <ul class="dropdown-menu">
	  <li><a href="v_jabatan.php">Jabatan Anggota</a></li>
      <li><a href="v_jenjang.php">Jenjang Komunitas</a></li>
      <li><a href="v_k_komunitas.php">Kategori Komunitas</a></li>
	  <li><a href="v_rekening.php">Rekening Bank</a></li>
	  <li><a href="v_biaya_rutinan.php">Biaya Rutinan Komunitas</a></li>
      <!--<li><a href="v_history_pj.php">History Penanggung Jawab</a></li>-->
    </ul>
  </li>
  <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-cog"></i><span>Pengaturan Lainnya</span> <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <li><a href="v_info.php">Informasi Website</a></li>
      <li><a href="v_bantuan.php">Bantuan Registrasi</a></li>
	  <li><a href="v_backuprestore.php">Backup/Restore</a></li>
      <!--<li><a href="v_history_pj.php">History Penanggung Jawab</a></li>-->
    </ul>
  </li>
</ul>
</div>
<!-- /container -->
</div>
<!-- /subnavbar-inner -->
</div>
