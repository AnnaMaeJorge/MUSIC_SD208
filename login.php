<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
?>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Login | Music</title>


	<?php include('./header.php'); ?>
	<?php
	if (isset($_SESSION['login_id']))
		header("location:index.php?page=home");

	?>

</head>

<!-- style -->
<style>
	@import url('https://fonts.googleapis.com/css2?family=Anton&family=Fjalla+One&family=Lobster&display=swap');

	* {
		margin: 0;
		padding: 0;
		font-family: 'Lobster', cursive;
	}

	body {
		width: 100%;
		height: calc(100%);
		position: fixed;
		top: 0;
		left: 0;
		background: rgb(0, 0, 0);
		background-image: url(https://p0.pikist.com/photos/323/394/headphones-blue-pink-pastel-colors-bright-flat-lay-music-chill-wallpaper-for-girls.jpg);
		background-repeat: no-repeat;
		background-size: cover;
	}

	main#main {
		margin-top: 5%;
		margin-left: 12%;
		width: 70%;
		height: calc(80%) !important;
		display: flex;
	}

	.card .col-sm-7 {
		overflow: hidden;
		background-image: transparent;
		border-radius: 15px;
		box-shadow: 20px 15px 20px rgba(44, 172, 246, 0.667);
		width: 90%;
	}
</style>
<!-- style -->


<body class="bg-light">
	<main id="main">
		<div class="container">

			<div class="col-md-8 offset-md-2 d-flex justify-content-center">
				<div id="login-center" class="row justify-content-center align-self-center w-100">
					<div class="d-flex justify-content-center align-items-center w-100">
						<span class="m-4 p-2">
							<h2 style="color:black"><b> Music an escape towards your dream!</b></h2>
						</span>
					</div>
					<div class="card col-sm-7" style="background:transparent">
						<div class="card-body">
							<form id="login-form">
								<div class="form-group">
									<input type="text" id="email" name="email" class="form-control" placeholder="Email">
								</div>
								<div class="form-group">
									<input type="password" id="password" name="password" class="form-control" placeholder="Password">
								</div>
								<center><button class="btn btn-block btn-wave " style="color: #000;background-color: #159ec0">Login</button></center>
								<hr>

								<center><button class="btn btn-block btn-wave" style="color: #000;background-color: #fb6aae" type="button" id="new_account">Create New Account</button></center>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	</main>

	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

	<div class="modal fade" id="uni_modal" role='dialog'>
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"></h5>
					<button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><b>&times;</b></span>
					</button>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- PAGE assets/plugins -->
<!-- jQuery Mapael -->
<script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/dist/js/pages/dashboard2.js"></script>

<!-- DataTables  & Plugins -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jszip/jszip.min.js"></script>
<script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
	window.start_load = function() {
		$('body').prepend('<div id="preloader2"></div>')
	}
	window.end_load = function() {
		$('#preloader2').fadeOut('fast', function() {
			$(this).remove();
		})
	}
	window.viewer_modal = function($src = '') {
		start_load()
		var t = $src.split('.')
		t = t[1]
		if (t == 'mp4') {
			var view = $("<video src='" + $src + "' controls autoplay></video>")
		} else {
			var view = $("<img src='" + $src + "' />")
		}
		$('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
		$('#viewer_modal .modal-content').append(view)
		$('#viewer_modal').modal({
			show: true,
			backdrop: 'static',
			keyboard: false,
			focus: true
		})
		end_load()

	}
	window.uni_modal = function($title = '', $url = '', $size = "") {
		start_load()
		$.ajax({
			url: $url,
			error: err => {
				console.log()
				alert("An error occured")
			},
			success: function(resp) {
				if (resp) {
					$('#uni_modal .modal-title').html($title)
					$('#uni_modal .modal-body').html(resp)
					if ($size != '') {
						$('#uni_modal .modal-dialog').addClass($size)
					} else {
						$('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
					}
					$('#uni_modal').modal({
						show: true,
						backdrop: 'static',
						keyboard: false,
						focus: true
					})
					end_load()
				}
			}
		})
	}
	window._conf = function($msg = '', $func = '', $params = []) {
		$('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
		$('#confirm_modal .modal-body').html($msg)
		$('#confirm_modal').modal('show')
	}
	window.alert_toast = function($msg = 'TEST', $bg = 'success', $pos = '') {
		var Toast = Swal.mixin({
			toast: true,
			position: $pos || 'top-end',
			showConfirmButton: false,
			timer: 5000
		});
		Toast.fire({
			icon: $bg,
			title: $msg
		})
	}
	$('#new_account').click(function() {
		uni_modal("<h4>Sign Up</h4><span><h6 class='text-muted'>It’s quick and easy.</h6></span>", "signup.php", "large")
	})
	$('#login-form').submit(function(e) {
		e.preventDefault()
		start_load()
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'ajax.php?action=login',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				end_load()
			},
			success: function(resp) {
				if (resp == 1) {
					location.href = 'index.php?page=home';
				} else {
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					end_load()
				}
			}
		})
	})
	$('.number').on('input keyup keypress', function() {
		var val = $(this).val()
		val = val.replace(/[^0-9 \,]/, '');
		val = val.toLocaleString('en-US')
		$(this).val(val)
	})
</script>

</html>