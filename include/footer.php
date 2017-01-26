<div id="divFooter" class="footerArea">

    <div class="container">

        <div class="divPanel">
          <?php
          include "include/koneksi.php";
          $sql = mysql_query("SELECT * FROM tbl_info");
          $num = mysql_fetch_array($sql);
          ?>
            <div class="row-fluid">
                <div class="span3" id="footerArea1">

                    <h3>Tentang Carkom</h3>
                    <p align="justify"><?php echo $num['tentang']; ?></p>


                </div>
                <div class="span3" id="footerArea2">

                    <h3>Pengunjung</h3>
                    <i class="icon-file-alt"></i><a href="bare.php">&nbsp;Bantuan Registrasi</a><br/>

                </div>
                <div class="span3" id="footerArea3">

                    <h3>Maps</h3>
                    <p><?php echo $num['maps']; ?></p>

                </div>
                <div class="span3" id="footerArea4">

                    <h3>Kontak Carkom</h3>

                    <ul id="contact-info">
                    <li>
                        <i class="general foundicon-phone icon"></i>
                        <span class="field">Telepon:</span>
                        <br />
                        <?php echo $num['no_hp']; ?>
                    </li>
                    <li>
                        <i class="general foundicon-mail icon"></i>
                        <span class="field">Email:</span>
                        <br />
                        <a href="mailto:<?php echo $num['email']; ?>" title="Email"><?php echo $num['email']; ?></a>
                    </li>
                    <li>
                        <i class="general foundicon-home icon" style="margin-bottom:50px"></i>
                        <span class="field">Alamat:</span>
                        <p align="justify"><?php echo $num['alamat']; ?></p>
                    </li>
                    <li>
                      <p class="social_bookmarks">
                          <a href="<?php echo $num['facebook']; ?>" target="_blank"><i class="social foundicon-facebook"></i> Facebook</a>
  			<a href="<?php echo $num['twitter']; ?>" target="_blank"><i class="social foundicon-twitter"></i> Twitter</a>
                      </p>
                    </li>
                    </ul>

                </div>
            </div>

            <br /><br />
            <div class="row-fluid">
                <div class="span12">
                    <p class="copyright" align="right">
                        Copyright © 2016 <a href="index.php">Carkom Indonesia</a>. All Rights Reserved.
                    </p>
                </div>
            </div>
            <br />

        </div>

    </div>

</div>

<script src="scripts/jquery.min.js" type="text/javascript"></script>
<script src="scripts/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="scripts/default.js" type="text/javascript"></script>
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
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 9000);
}
</script>

<script type="text/javascript">$('.ttip').tooltip();</script>
