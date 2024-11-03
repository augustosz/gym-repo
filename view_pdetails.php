<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT r.*,p.plan,p.amount as pamount,pp.package,pp.amount as ppamount,concat(m.lastname,', ',m.firstname,' ',m.middlename) as name,m.member_id as mid_no from registration_info r inner join members m on m.id = r.member_id inner join plans p on p.id = r.plan_id inner join packages pp on pp.id = r.package_id where r.id=".$_GET['id'])->fetch_array();
	foreach($qry as $k =>$v){
		$$k = $v;
	}
	$trainer = $conn->query("SELECT * FROM trainers where id= $trainer_id");
	$trainer_arr = $trainer->num_rows > 0 ? $trainer->fetch_array() :'';'';
	$tf = $trainer_id > 0 ? $trainer_arr['rate']:0;
}

?>
<div class="container-fluid">
	<p>ID de miembro: <b><?php echo $mid_no ?></b></p>
	<p>Nombre: <b><?php echo ucwords($name) ?></b></p>
	<p>Plan: </i> <b><?php echo $plan.' month/s' ?></b></p>
	<p>Paquete: </i> <b><?php echo $package ?></b></p>
	<p>Entrenador: </i> <b><?php echo !empty($trainer_arr) ?  $trainer_arr['name'] : '' ?></b></p>
	<hr class="divider">
	<p>cuota plan membresia: </i> <b><?php echo number_format($pamount,2).' (Monto único)' ?></b></p>
	<p>cantidad de paquete: </i> <b><?php echo number_format($ppamount,2) ?></b></p>
	<p>Tarifa Entrenador: </i> <b><?php echo number_format($tf) ?></b></p>
	<p>Pagar mensualmente: </i> <b><?php echo number_format(($ppamount + $tf),2) ?></b></p>
</div>
<div class="modal-footer display">
	<div class="row">
		<div class="col-md-12">
			<button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
			<button class="btn float-right btn-primary mr-2" type="button" id="payment">Pagos</button>
			<?php if(strtotime(date('Y-m-d')) > strtotime($end_date)): ?>
			<button class="btn float-right btn-primary mr-2" type="button" id="renew">Renovar</button>
			<?php endif; ?>
			<button class="btn float-right btn-primary mr-2" type="button" id="end">Finalizar plan</button>
		</div>
	</div>
</div>
<style>
	p{
		margin:unset;
	}
	#uni_modal .modal-footer{
		display: none;
	}
	#uni_modal .modal-footer.display {
		display: block;
	}
</style>
<script>
	$('#payment').click(function(){
		uni_modal('Pagos','payment.php?rid=<?php echo $id ?>','large')
	})
	$('#renew').click(function(){
		start_load()
		$.ajax({
			url:'ajax.php?action=renew_membership',
			method:'POST',
			data:{rid:'<?php echo $id ?>'},
			success:function(resp){
				if(resp > 0){
					alert_toast('Membresia renovada con éxito','success')
					end_load()
					uni_modal("<i class='fa fa-address-card'></i> Detalles de membresia","view_pdetails.php?id="+resp,'')
				}
			}
		})
	})
	$('#end').click(function(){
		start_load()
		$.ajax({
			url:'ajax.php?action=end_membership',
			method:'POST',
			data:{rid:'<?php echo $id ?>'},
			success:function(resp){
				if(resp == 1){
					alert_toast('Membresia eliminada con exito','success')
					setTimeout(function(){
						location.reload()
					},750)
				}
			}
		})
	})
</script>	