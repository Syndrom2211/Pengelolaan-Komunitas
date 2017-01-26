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

					</li>
				</ul>

			</div><!--/.nav-collapse -->

		</div> <!-- /container -->

	</div> <!-- /navbar-inner -->

</div> <!-- /navbar -->

<div class="account-container">

	<div class="content clearfix">

		<form enctype="multipart/form-data" method="POST" action="install2.php">


			<div style="margin:50px;">

				<div class="field">
					<input type="text" id="username" name="host" value="" placeholder="Host"  />
				</div> <!-- /field -->

				<div class="field">
					<input type="text" name="user" value="" placeholder="User"  />
				</div> <!-- /password -->
				
				<div class="field">
					<input type="text" name="pass" value="" placeholder="Password"  />
				</div>
				
				<div class="field">
					<input type="text" name="db" value="" placeholder="Nama Database"  />
				</div>
				
				<div class="field">
					File SQL (file/data.sql): <input type="file" name="datafile" size="30" />
				</div>
				
				<div class="field">
					<input type="submit" name="submit" value="Install" />
				</div>

			</div> <!-- /login-fields -->


		</form>

	</div> <!-- /content -->

</div> <!-- /account-container -->




<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>

<script src="js/signin.js"></script>

</body>

</html>
<?php
}
?>
