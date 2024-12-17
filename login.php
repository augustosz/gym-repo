<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
ob_start();
if (!isset($_SESSION['system'])) {
	// $system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	// foreach($system as $k => $v){
	// 	$_SESSION['system'][$k] = $v;
	// }
}
ob_end_flush();
?>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Gym Management System</title>


	<?php include('./header.php'); ?>
	<?php
	if (isset($_SESSION['login_id']))
		header("location:index.php?page=home");

	?>

</head>

<head>
	<style>
		body {
			width: 100%;
			height: calc(100%);
			/*background: #007bff;*/

		}

		main#main {
			width: 100%;
			height: calc(100%);
			background-image: url('assets/img/back.jpg');
			background-size: cover;
			/* Hace que la imagen cubra todo el contenedor */
			background-position: center;
			/* Centra la imagen en el contenedor */




		}

		#login-right {
			position: absolute;
			right: 0;
			width: 40%;
			height: calc(100%);
			background: white;
			display: flex;
			align-items: center;
		}

		#login-left {
			position: absolute;
			left: 0;
			width: 60%;
			height: calc(100%);
			background: #59b6ec61;
			display: flex;
			align-items: center;
			background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>);
			background-repeat: no-repeat;
			background-size: cover;
		}

		#login-right .card {
			margin: auto;
			z-index: 1
		}

		.logo {
			margin: auto;
			font-size: 8rem;
			background: white;
			padding: .5em 0.7em;
			border-radius: 50% 50%;
			color: #000000b3;
			z-index: 10;
		}

		div#login-right::before {
			content: "";
			position: absolute;
			top: 0;
			left: 0;
			width: calc(100%);
			height: calc(100%);
			background: #000000e0;
		}

		/* Nuevo estilo para hacer más grande el título */
		#titulo {
			font-size: 7rem;
			/* Ajusta este valor según lo grande que quieras el título */
			font-weight: bold;

		}
	</style>
</head>

<body>
	<main id="main" class="bg-dark d-flex justify-content-center align-items-center vh-100">

		<div class="text-left text-white py-5">
      
			<h1 class="py-4" id="titulo">GYM Software</h1>

			<div class="card col-lg-7 col-md-7 col-9 mx-auto py-3 shadow-lg">

				<div class="card-body">
					<p class="h5 text-info py-3">Ingrese sus credenciales</p>
					<form id="login-form">

						<div class="form-group">
							<input type="text" id="username" name="username" class="form-control" placeholder="Usuario">
						</div>
						<div class="form-group">
							<input type="password" id="password" name="password" class="form-control" placeholder="Contraseña">
						</div>

						<button class="btn btn-primary col-md-12 mx-auto py-3">Iniciar</button>
					</form>
				</div>
			</div>
		</div>
	</main>

	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
</body>

<script>
	$('#login-form').submit(function(e) {
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'ajax.php?action=login',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success: function(resp) {
				if (resp == 1) {
					location.href = 'index.php?page=home';
				} else {
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>

</html>