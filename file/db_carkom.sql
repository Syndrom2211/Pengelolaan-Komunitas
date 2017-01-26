SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `tbl_admin` (
  `id_admin` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_admin VALUES("1","admin","21232f297a57a5a743894a0e4a801fc3","bangdam2211@gmail.com");



SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `tbl_anggota` (
  `no_ktp` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `alamat` text,
  `foto` varchar(500) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `link_facebook` text,
  `motivasi` text,
  `status_jabatan` varchar(30) NOT NULL,
  PRIMARY KEY (`no_ktp`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `tbl_bantuan_registrasi` (
  `id_bantuan` int(5) NOT NULL AUTO_INCREMENT,
  `penjelasan` text NOT NULL,
  PRIMARY KEY (`id_bantuan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_bantuan_registrasi VALUES("1","Selamat datang di halaman website Cari Komunitas (CarKom) yang dimana website ini bisa berfungsi\nbagi masyarakat sekitar untuk melakukan suatu kebutuhan baik personal maupun group/komunitas yang saling\nberhubungan dengan bantuan media yang memudahkan bagi seseorang untuk mencari komunitas yang diminatinya.\nWebsite ini menyediakan beberapa fitur yang bisa kalian kelola dan salah satunya adalah komunitas yang dimana\nkomunitas tersebut bisa kalian ikuti dengan proses tahapan yang disediakan. Ada hal yang harus kalian ketahui\nuntuk tahapan dalam pengelolaan media carkom disini, yaitu tentang Anggota dan Penangung Jawab.\nJika kalian ingin menjadi anggota pada suatu komunitas maka ada tahapannya, begitupun dengan penanggung jawab\nyang mengelola komunitasnya memiliki tahapannya pula.\n<br/><br/><br/>\n<b>Tahapan untuk mendaftarkan komunitasnya bagi penanggung jawab :</b><br/>\n1. Untuk mendaftarkan komunitas, anda harus mengunjungi kantor cabang terdekat carkom di daerah anda.<br/>\n2. Sebelum mendaftarkan komunitas, anda akan di daftarkan dahulu menjadi anggota dan dikenakan biaya pendaftaran komunitas sebesar <font color=\"green\">Rp20.000</font><br/>\n3. Setelah selesai melakukan transaksi, anda akan mendapatkan email yang berisi akun username dan password anda untuk login di websitenya<br/>\n4. Setelah login anda bisa mengelola data komunitas anda, anggota, artikel, dan laporan yang bersangkutannya.<br/>\n<br/><br/>\n<b>Tahapan untuk pendaftaran menjadi anggota disuatu komunitas :</b><br/>\n1. Mengisi Form <a href=\"relog.php\">biodata web</a> terlebih dahulu kemudian melakukan transaksi pembayaran sesuai profit komunitasnya<br/>\n2. Mengdownload dan mengisi Dokumen Biodata Media Carkom lalu di print dan diserahkan ke komunitasnya<br/>\n3. Sertakan bukti transfer ketika menyerahkan dokumen asli ke komunitasnya<br/>\n4. Admin akan menerima email dari penanggung jawab untuk verifikasi pembayaran nya dan mengaktifkan status anggotanya<br/>\n5. Jika sudah terverifikasi pembayarannya, anda bisa login ke websitenya juga<br/>\n6. Sebagai anggota, ada bisa membuat artikel dan mengisi feedback sebagai kesan, pesan, atau yang lainnya ketika anda sudah tergabung di komunitasnya.<br/>");



SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `tbl_biaya_rutinan_komunitas` (
  `id_rutinan` int(5) NOT NULL AUTO_INCREMENT,
  `jenis_biaya` varchar(30) NOT NULL,
  PRIMARY KEY (`id_rutinan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO tbl_biaya_rutinan_komunitas VALUES("1","Harian");
INSERT INTO tbl_biaya_rutinan_komunitas VALUES("2","Migguan");
INSERT INTO tbl_biaya_rutinan_komunitas VALUES("3","Bulanan");
INSERT INTO tbl_biaya_rutinan_komunitas VALUES("4","Tahunan");
INSERT INTO tbl_biaya_rutinan_komunitas VALUES("5","Tidak Ada");



SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `tbl_data_rekening` (
  `id_rekening` int(5) NOT NULL AUTO_INCREMENT,
  `nama_cabang` varchar(15) NOT NULL,
  `no_rekening` varchar(50) DEFAULT NULL,
  `atas_nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id_rekening`),
  UNIQUE KEY `nama_cabang` (`nama_cabang`),
  UNIQUE KEY `no_rekening` (`no_rekening`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO tbl_data_rekening VALUES("1","BCA","151 059 158 0","Carkom.com");
INSERT INTO tbl_data_rekening VALUES("2","BNI","0450 6728 29","Carkom.com");
INSERT INTO tbl_data_rekening VALUES("3","BRI","5761 0100 1578 506","Carkom.com");
INSERT INTO tbl_data_rekening VALUES("4","Mandiri","1130 0062 6194 1","Carkom.com");
INSERT INTO tbl_data_rekening VALUES("5","Bayar di tempat","","Cabang Carkom");



SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `tbl_detail_anggota` (
  `id_komunitas` int(5) DEFAULT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `status_anggota` varchar(15) DEFAULT NULL,
  `jenis_rutinan` varchar(50) DEFAULT NULL,
  `jumlah_bayar` varchar(30) DEFAULT NULL,
  `pembayaran_selanjutnya` date DEFAULT NULL,
  `status_bayar` varchar(50) DEFAULT NULL,
  KEY `tbl_detail_anggota_ibfk_3` (`id_komunitas`),
  KEY `tbl_detail_anggota_ibfk_4` (`no_ktp`),
  CONSTRAINT `tbl_detail_anggota_ibfk_3` FOREIGN KEY (`id_komunitas`) REFERENCES `tbl_komunitas` (`id_komunitas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_detail_anggota_ibfk_4` FOREIGN KEY (`no_ktp`) REFERENCES `tbl_anggota` (`no_ktp`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `tbl_feedback` (
  `no_ktp` varchar(20) NOT NULL,
  `id_komunitas` int(5) NOT NULL,
  `waktu` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `catatan` text,
  KEY `tbl_feedback_ibfk_4` (`id_komunitas`),
  KEY `tbl_feedback_ibfk_5` (`no_ktp`),
  CONSTRAINT `tbl_feedback_ibfk_4` FOREIGN KEY (`id_komunitas`) REFERENCES `tbl_komunitas` (`id_komunitas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_feedback_ibfk_5` FOREIGN KEY (`no_ktp`) REFERENCES `tbl_anggota` (`no_ktp`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `tbl_history_status` (
  `no_ktp` varchar(20) NOT NULL,
  `id_admin` int(5) NOT NULL,
  `waktu` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status_akhir` varchar(50) DEFAULT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `keterangan` text NOT NULL,
  KEY `tbl_history_status_ibfk_2` (`id_admin`),
  KEY `tbl_history_status_ibfk_3` (`no_ktp`),
  CONSTRAINT `tbl_history_status_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `tbl_admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_history_status_ibfk_3` FOREIGN KEY (`no_ktp`) REFERENCES `tbl_anggota` (`no_ktp`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `tbl_info` (
  `id_info` int(5) NOT NULL AUTO_INCREMENT,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `maps` text NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `tentang` text NOT NULL,
  PRIMARY KEY (`id_info`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_info VALUES("1","085798160154","bangdam2211@gmail.com","Jl. Gagak gg pasirhuni 1 No.48 b, RT.007/005 Sukaluyu Cibeunying Kaler Bandung, 40123","<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.957162329874!2d107.62364281424563!3d-6.895727495017259!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7b27d2d4227%3A0xec3e332aed243d0!2sJl.+Gagak%2C+Kota+Bandung%2C+Jawa+Barat!5e0!3m2!1sen!2sid!4v1475910660786\" width=\"250\" height=\"250\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>","http://facebook.com/Ravnui.Embassy.us","http://twitter.com/Syndrom2211","Carkom Indonesia adalah bentuk website yang berfungsi sebagai situs yang menyediakan infromasi layanan komunitas di seluruh indonesia. Tujuan sebenarnya dari adanya website ini adalah untuk memberikan informasi dengan harapan agar masyarakat bisa merubah pola pikirnya agar tumbuhnya kesadaran berorganisasi serta agar masyarakat bisa mengikuti salah satu organisasi yang diminati/disukainya.");



SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `tbl_jabatan` (
  `id_jabatan` int(5) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tbl_jabatan VALUES("1","Anggota Biasa");
INSERT INTO tbl_jabatan VALUES("3","Penanggung Jawab");



SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `tbl_jenjang` (
  `id_jenjang` int(5) NOT NULL AUTO_INCREMENT,
  `jenjang` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_jenjang`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO tbl_jenjang VALUES("2","SMP");
INSERT INTO tbl_jenjang VALUES("3","SMA");
INSERT INTO tbl_jenjang VALUES("4","SMA/SMK");
INSERT INTO tbl_jenjang VALUES("5","SD/SMP");
INSERT INTO tbl_jenjang VALUES("6","SD/SMP/SMA/SMK");
INSERT INTO tbl_jenjang VALUES("7","SD");



SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `tbl_kategori_komunitas` (
  `id_kategori_k` int(5) NOT NULL AUTO_INCREMENT,
  `jenis_kategori` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_kategori_k`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO tbl_kategori_komunitas VALUES("3","Jasmani");
INSERT INTO tbl_kategori_komunitas VALUES("4","Intelektual/Spiritual");
INSERT INTO tbl_kategori_komunitas VALUES("5","Intelektual/Jasmani");
INSERT INTO tbl_kategori_komunitas VALUES("6","Intelektual/Spiritual/Jasmani");
INSERT INTO tbl_kategori_komunitas VALUES("7","Spiritual/Jasmani");
INSERT INTO tbl_kategori_komunitas VALUES("8","Intelektual");
INSERT INTO tbl_kategori_komunitas VALUES("9","Spiritual");



SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `tbl_komunitas` (
  `id_tbl_komunitas` int(5) NOT NULL AUTO_INCREMENT,
  `id_komunitas` int(5) NOT NULL,
  `id_kategori_k` int(5) DEFAULT NULL,
  `id_jenjang` int(5) DEFAULT NULL,
  `id_rutinan` int(5) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `logo` varchar(500) DEFAULT NULL,
  `tentang` text,
  `visi` text,
  `misi` text,
  `profit` int(50) DEFAULT NULL,
  `bayar_rutinan` int(50) NOT NULL,
  `alamat` text,
  `provinsi` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kabupaten` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `rt` varchar(5) DEFAULT NULL,
  `rw` varchar(5) DEFAULT NULL,
  `no_rumah` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_komunitas`),
  UNIQUE KEY `id_tbl_komunitas` (`id_tbl_komunitas`),
  UNIQUE KEY `nama` (`nama`),
  KEY `tbl_komunitas_ibfk_1` (`id_kategori_k`),
  KEY `tbl_komunitas_ibfk_2` (`id_jenjang`),
  KEY `id_rutinan` (`id_rutinan`),
  CONSTRAINT `tbl_komunitas_ibfk_1` FOREIGN KEY (`id_kategori_k`) REFERENCES `tbl_kategori_komunitas` (`id_kategori_k`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_komunitas_ibfk_2` FOREIGN KEY (`id_jenjang`) REFERENCES `tbl_jenjang` (`id_jenjang`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_komunitas_ibfk_3` FOREIGN KEY (`id_rutinan`) REFERENCES `tbl_biaya_rutinan_komunitas` (`id_rutinan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;



SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `tbl_penanggung_jawab` (
  `id_komunitas` int(5) DEFAULT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `periode_mulai` date DEFAULT NULL,
  `periode_akhir` date DEFAULT NULL,
  KEY `tbl_penanggung_jawab_ibfk_3` (`id_komunitas`),
  KEY `tbl_penanggung_jawab_ibfk_4` (`no_ktp`),
  CONSTRAINT `tbl_penanggung_jawab_ibfk_3` FOREIGN KEY (`id_komunitas`) REFERENCES `tbl_komunitas` (`id_komunitas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_penanggung_jawab_ibfk_4` FOREIGN KEY (`no_ktp`) REFERENCES `tbl_anggota` (`no_ktp`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `tbl_transaksi_pembayaran` (
  `id_transaksi` int(5) NOT NULL AUTO_INCREMENT,
  `no_ktp` varchar(20) DEFAULT NULL,
  `tgl_daftar` date NOT NULL,
  `waktu_daftar` varchar(10) NOT NULL,
  `metode_pembayaran` varchar(200) NOT NULL,
  `atas_nama` varchar(100) NOT NULL,
  `jumlah_bayar` int(50) NOT NULL,
  `tujuan_pendaftaran` varchar(100) NOT NULL,
  `status_bayar` varchar(50) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `tbl_transaksi_pembayaran_ibfk_1` (`no_ktp`),
  CONSTRAINT `tbl_transaksi_pembayaran_ibfk_1` FOREIGN KEY (`no_ktp`) REFERENCES `tbl_anggota` (`no_ktp`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;



