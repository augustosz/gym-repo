
<style>
	.collapse a{
		text-indent:10px;
	}
</style>

<nav id="sidebar" class='mx-lt-5 bg' style="background-color: #606470" >
		
		<div class="sidebar-list bg-white"">
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Inicio</a>
				<a href="index.php?page=members" class="nav-item nav-members"><span class='icon-field'><i class="fa fa-user-friends"></i></span> Miembros</a>
				<a href="index.php?page=registered_members" class="nav-item nav-registered_members"><span class='icon-field'><i class="fa fa-credit-card"></i></span> Pagos</a>

				<?php if($_SESSION['login_type'] == 1): ?>

				<a href="index.php?page=plans" class="nav-item nav-plans"><span class='icon-field'><i class="fa fa-th-list"></i></span> Tipos de planes</a>
				<a href="index.php?page=packages" class="nav-item nav-packages"><span class='icon-field'><i class="fa fa-list"></i></span> Paquetes</a>
				<a href="index.php?page=trainer" class="nav-item nav-trainer"><span class='icon-field'><i class="fa fa-user"></i></span> Entrenadores</a>
        <a href="index.php?page=statistics" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-chart-bar"></i></span> Estadísticas</a>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Usuarios</a>
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
