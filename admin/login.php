<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['id_admin'])){
    header('location:index.php');
}else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "include/header.php"; ?>

			<div class="nav-collapse">
				<ul class="nav pull-right">

					<li class="">
						<a href="../index.php" class="">
							<i class="icon-chevron-left"></i>
							Kembali ke Halaman Depan
						</a>

					</li>
				</ul>

			</div><!--/.nav-collapse -->

		</div> <!-- /container -->

	</div> <!-- /navbar-inner -->

</div> <!-- /navbar -->


<?php
				  if (!file_exists('../include/koneksi.php')){
					echo "<br/><br/><br/><br/><br/>";
					echo "<div id=\"warning\" align=\"center\"></h5>WARNING ! <br/>File : koneksi.php tidak ditemukan, silahkan lakukan instalasi terlebih dahulu</h5><br/><img src=\"../images/progress.gif\"><br/>

					<span id=\"timer\"> Loading... </span></div>";
					echo "<meta http-equiv=\"refresh\" content=\"3;../install/\">";
					} else {
						?>
<div class="account-container">

	<div class="content clearfix">

		<form action="p_login.php" method="POST">

			<h1>Admin Login</h1>

			<div class="login-fields">

				<div class="field">
					<label for="username">Username</label>
					<input type="text" id="username" name="username" value="" placeholder="Username" class="login username-field" />
				</div> <!-- /field -->

				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field" />
				</div> <!-- /password -->

			</div> <!-- /login-fields -->

			<div class="login-actions">

				<input type="submit" name="submit" class="button btn btn-success btn-large" value="Login" />

			</div> <!-- .actions -->

		</form>

	</div> <!-- /content -->

</div> <!-- /account-container -->




<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>

<script src="js/signin.js"></script>
<?php
					}
?>
</body>

</html>
<?php
}
?>
