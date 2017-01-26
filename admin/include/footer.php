<!-- /main -->
<div class="extra">
  <div class="extra-inner">
    <div class="container">
      <div class="row">
                    <!-- /span3 -->
                </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /extra-inner -->
</div>
<!-- /extra -->
<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12" align="right">Copyright © 2016 Carkom Indonesia. All Rights Reserved. </div>
        <!-- /span12 -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /footer-inner -->
</div>
<!-- /footer -->
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
		<!-- CKEditor -->
        <script src="js/ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#periode_mulai').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                });
				$('#periode_akhir').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                });
            });
        </script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>
<script src="js/signin.js"></script>
<script src="js/base.js"></script>
<script type="text/javascript">
window.onload=function(){
var defaultDate = new Date();
hour = "" + defaultDate.getHours(); if (hour.length == 1) { hour = "0" + hour; }
minute = "" + defaultDate.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
second = "" + defaultDate.getSeconds(); if (second.length == 1) { second = "0" + second; }
document.forms[0]['waktu_daftar'].value = hour + ":" + minute + ":" + second;;
}
</script>

<script>
		$(function() {
		  $('#tujuandaftar').change(function(){
			$('.pilihan').hide();
			//if(document.getElementById('tujuandaftar').value == "ikut") {
			//	$('.pilihandua').show();
			//}else{
			//	$('.pilihandua').hide();
			//}
			$('#' + $(this).val()).show();
		  });
		});
		
        var lineChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
				{
				    fillColor: "rgba(220,220,220,0.5)",
				    strokeColor: "rgba(220,220,220,1)",
				    pointColor: "rgba(220,220,220,1)",
				    pointStrokeColor: "#fff",
				    data: [65, 59, 90, 81, 56, 55, 40]
				},
				{
				    fillColor: "rgba(151,187,205,0.5)",
				    strokeColor: "rgba(151,187,205,1)",
				    pointColor: "rgba(151,187,205,1)",
				    pointStrokeColor: "#fff",
				    data: [28, 48, 40, 19, 96, 27, 100]
				}
			]

        }

        var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData);


        var barChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
				{
				    fillColor: "rgba(220,220,220,0.5)",
				    strokeColor: "rgba(220,220,220,1)",
				    data: [65, 59, 90, 81, 56, 55, 40]
				},
				{
				    fillColor: "rgba(151,187,205,0.5)",
				    strokeColor: "rgba(151,187,205,1)",
				    data: [28, 48, 40, 19, 96, 27, 100]
				}
			]

        }
		
        $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var calendar = $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          selectable: true,
          selectHelper: true,
          select: function(start, end, allDay) {
            var title = prompt('Event Title:');
            if (title) {
              calendar.fullCalendar('renderEvent',
                {
                  title: title,
                  start: start,
                  end: end,
                  allDay: allDay
                },
                true // make the event "stick"
              );
            }
            calendar.fullCalendar('unselect');
          },
          editable: true,
          events: [
            {
              title: 'All Day Event',
              start: new Date(y, m, 1)
            },
            {
              title: 'Long Event',
              start: new Date(y, m, d+5),
              end: new Date(y, m, d+7)
            },
            {
              id: 999,
              title: 'Repeating Event',
              start: new Date(y, m, d-3, 16, 0),
              allDay: false
            },
            {
              id: 999,
              title: 'Repeating Event',
              start: new Date(y, m, d+4, 16, 0),
              allDay: false
            },
            {
              title: 'Meeting',
              start: new Date(y, m, d, 10, 30),
              allDay: false
            },
            {
              title: 'Lunch',
              start: new Date(y, m, d, 12, 0),
              end: new Date(y, m, d, 14, 0),
              allDay: false
            },
            {
              title: 'Birthday Party',
              start: new Date(y, m, d+1, 19, 0),
              end: new Date(y, m, d+1, 22, 30),
              allDay: false
            },
            {
              title: 'EGrappler.com',
              start: new Date(y, m, 28),
              end: new Date(y, m, 29),
              url: 'http://EGrappler.com/'
            }
          ]
        });
      });
    </script><!-- /Calendar -->
	<script language="javascript">
	function konfirmasiHapusTransaksi(id_transaksi,atas_nama){
		var id_transaksi = id_transaksi;
		var atas_nama = atas_nama;

		konfirmasi = confirm("Apakah Transaksi atas nama '"+atas_nama+"' akan di hapus?")
		if(konfirmasi){
			window.location = "lap_transaksi.php?id_transaksi="+id_transaksi;
			return false;
		}else{
			alert("Batal Menghapus Transaksi");
		}
	}
	function konfirmasiHapusStatus(no_ktp,nama_lengkap){
		var no_ktp = no_ktp;
		var nama_lengkap = nama_lengkap;

		konfirmasi = confirm("Apakah Status anggota dengan nama '"+nama_lengkap+"' akan di hapus?")
		if(konfirmasi){
			window.location = "lap_statusaktif.php?no_ktp="+no_ktp;
			return false;
		}else{
			alert("Batal Menghapus Status Anggota");
		}
	}
	function konfirmasiHapusJenjang(id_jenjang,jenjang){
		var id_jenjang = id_jenjang;
		var jenjang = jenjang;

		konfirmasi = confirm("Apakah Jenjang '"+jenjang+"' akan di hapus?")
		if(konfirmasi){
			window.location = "v_jenjang.php?id_jenjang="+id_jenjang;
			return false;
		}else{
			alert("Batal Menghapus Jenjang");
		}
	}
	function konfirmasiHapusKategoriKomunitas(id_kategori_k,jenis_kategori){
		var id_kategori_k = id_kategori_k;
		var jenis_kategori = jenis_kategori;

		konfirmasi = confirm("Apakah Kategori Komunitas '"+jenis_kategori+"' akan di hapus?")
		if(konfirmasi){
			window.location = "v_k_komunitas.php?id_kategori_k="+id_kategori_k;
			return false;
		}else{
			alert("Batal Menghapus Kategori Komunitas");
		}
	}
	function konfirmasiHapusJabatan(id_jabatan,jabatan){
		var id_jabatan = id_jabatan;
		var jabatan = jabatan;

		konfirmasi = confirm("Apakah Jabatan '"+jabatan+"' akan di hapus?")
		if(konfirmasi){
			window.location = "v_jabatan.php?id_jabatan="+id_jabatan;
			return false;
		}else{
			alert("Batal Menghapus Jabatan");
		}
	}
	function konfirmasiHapusAnggota(no_ktp,nama_lengkap){
		var no_ktp = no_ktp;
		var nama_lengkap = nama_lengkap;

		konfirmasi = confirm("Apakah Anggota '"+nama_lengkap+"' akan di hapus?")
		if(konfirmasi){
			window.location = "v_anggota.php?no_ktp="+no_ktp;
			return false;
		}else{
			alert("Batal Menghapus Anggota");
		}
	}
	function konfirmasiHapusPenanggungJawab(no_ktp,nama_lengkap){
		var no_ktp = no_ktp;
		var nama_lengkap = nama_lengkap;

		konfirmasi = confirm("Apakah Penanggung Jawab '"+nama_lengkap+"' akan di hapus?")
		if(konfirmasi){
			window.location = "v_pj.php?no_ktp="+no_ktp;
			return false;
		}else{
			alert("Batal Menghapus Penanggung Jawab");
		}
	}
	function konfirmasiHapusKomunitas(id_komunitas,nama){
		var id_komunitas = id_komunitas;
		var nama = nama;

		konfirmasi = confirm("Apakah Komunitas '"+nama+"' akan di hapus?")
		if(konfirmasi){
			window.location = "v_komunitas.php?id_komunitas="+id_komunitas;
			return false;
		}else{
			alert("Batal Menghapus Komunitas");
		}
	}
	function konfirmasiHapusRekening(id_rekening,atas_nama){
		var id_rekening = id_rekening;
		var atas_nama = atas_nama;

		konfirmasi = confirm("Apakah Rekening atas nama '"+atas_nama+"' akan di hapus?")
		if(konfirmasi){
			window.location = "v_rekening.php?id_rekening="+id_rekening;
			return false;
		}else{
			alert("Batal Menghapus No Rekening");
		}
	}
	function konfirmasiHapusBiayaRutinan(id_rutinan,jenis_biaya){
		var id_rutinan = id_rutinan;
		var jenis_biaya = jenis_biaya;

		konfirmasi = confirm("Apakah Jenis Biaya '"+jenis_biaya+"' akan di hapus?")
		if(konfirmasi){
			window.location = "v_biaya_rutinan.php?id_rutinan="+id_rutinan;
			return false;
		}else{
			alert("Batal Menghapus Jenis Biaya");
		}
	}
	function konfirmasiHapusRutinanAnggota(no_ktp,nama_lengkap){
		var no_ktp = no_ktp;
		var nama_lengkap = nama_lengkap;

		konfirmasi = confirm("Apakah Rutinan Anggota '"+nama_lengkap+"' akan di hapus?")
		if(konfirmasi){
			window.location = "lap_biayarutinan.php?no_ktp="+no_ktp;
			return false;
		}else{
			alert("Batal Menghapus Rutinan Anggota");
		}
	}
	</script>