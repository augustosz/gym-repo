<?php include('db_connect.php');



?>
<script src="datatables-config.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>


?>
<div class="container-fluid">
<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 10px;
}

</style>
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Eliga las estadísticas a visualizar</b>
						<span class="">

				</span>
					</div>
					<div class="card-body">
          <h1>Line Chart using PHP MySQL and Chart JS</h1>       
			<canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

			<script>
				var ctx = document.getElementById("chart").getContext('2d');
    			var myChart = new Chart(ctx, {
        		type: 'line',
		        data: {
		            labels: [<?php echo $buildingName; ?>],
		            datasets: 
		            [{
		                label: 'Consumption',
		                data: [<?php echo $data1; ?>],
		                bbackgroundColor: 'transparent',
		                borderColor:'rgba(255,99,132)',
		                borderWidth: 3
		            },

		            {
		            	label: 'Cost',
		                data: [<?php echo $data2; ?>],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(0,255,255)',
		                borderWidth: 3	
		            }]
		        },
		     
		        options: {
		            scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
		            tooltips:{mode: 'index'},
		            legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
		        }
		    });
			</script>
          </div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height:150px;
	}
  .view_member, .edit_member{
    margin-right: 5px;
    margin-bottom: 7px;
}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('#new_member').click(function(){
		uni_modal("<i class='fa fa-plus'></i> Nuevo miembro","manage_member.php",'mid-large')
	})
	$('.view_member').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> Detalles de miembros","view_member.php?id="+$(this).attr('data-id'),'large')
		
	})
	$('.edit_member').click(function(){
		uni_modal("<i class='fa fa-edit'></i>  Administrar los detalles de los miembros ","manage_member.php?id="+$(this).attr('data-id'),'mid-large')
	
	})
	$('.delete_member').click(function(){
		_conf("¿Seguro que quieres eliminar?","delete_member",[$(this).attr('data-id')],'mid-large')
	})

	function delete_member($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_member',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Datos eliminados con exito",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>