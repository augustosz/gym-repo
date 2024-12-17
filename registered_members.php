<?php include('db_connect.php'); ?>
<script src="datatables-config.js"></script>

<div class="container-fluid">
    <style>
        input[type=checkbox] {
            /* Double-sized Checkboxes */
            -ms-transform: scale(1.5); /* IE */
            -moz-transform: scale(1.5); /* FF */
            -webkit-transform: scale(1.5); /* Safari and Chrome */
            -o-transform: scale(1.5); /* Opera */
            transform: scale(1.5);
            padding: 10px;
        }

        td {
            vertical-align: middle !important;
        }

        td p {
            margin: unset;
        }

        img {
            max-width: 100px;
            max-height: 150px;
        }

        /* Estilos adicionales para mejorar la estética */
        .card-header {
            font-weight: bold;
            font-size: 1.2rem;
        }

        .btn-block {
            width: auto;
        }

        .table {
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .table th, .table td {
            text-align: center;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-danger {
            background-color: #dc3545;
        }
    </style>

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <!-- Título opcional aquí si es necesario -->
            </div>
        </div>

        <div class="row">
            <!-- Panel de la tabla -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Membresías Activas
                        <button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_member">
                            <i class="fa fa-plus"></i> Nueva
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-condensed table-hover">
                            <colgroup>
                                <col width="5%">
                                <col width="15%">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID de membresía</th>
                                    <th>Nombre</th>
                                    <th>Plan</th>
                                    <th>Paquete</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1;
                                    $member =  $conn->query("SELECT r.*, p.plan, pp.package, CONCAT(m.lastname, ', ', m.firstname, ' ', m.middlename) AS name, m.member_id 
                                                            FROM registration_info r 
                                                            INNER JOIN members m ON m.id = r.member_id 
                                                            INNER JOIN plans p ON p.id = r.plan_id 
                                                            INNER JOIN packages pp ON pp.id = r.package_id 
                                                            WHERE r.status = 1 
                                                            ORDER BY r.id ASC");
                                    while($row = $member->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><b><?php echo $row['member_id'] ?></b></td>
                                    <td><b><?php echo ucwords($row['name']) ?></b></td>
                                    <td><b><?php echo $row['plan'] . ' Mes/es' ?></b></td>
                                    <td><b><?php echo $row['package'] ?></b></td>
                                    <td>
                                        <?php if(strtotime(date('Y-m-d')) <= strtotime($row['end_date'])): ?>
                                            <span class="badge badge-success">Activo</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Expiró</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary view_member" type="button" data-id="<?php echo $row['id'] ?>">Ver</button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Fin del panel de la tabla -->
        </div>
    </div>  

</div>

<script>
    $(document).ready(function(){
        $('table').dataTable();
    });

    $('#new_member').click(function(){
        uni_modal("<i class='fa fa-plus'></i> Nuevo Plan", "manage_membership.php", '');
    });

    $('.view_member').click(function(){
        uni_modal("<i class='fa fa-address-card'></i> Detalles de membresía", "view_pdetails.php?id=" + $(this).attr('data-id'), '');
    });

    $('.edit_member').click(function(){
        uni_modal("<i class='fa fa-edit'></i> Editar", "manage_member.php?id=" + $(this).attr('data-id'), 'mid-large');
    });

    $('.delete_member').click(function(){
        _conf("¿Estás seguro de eliminar esta membresía?", "delete_member", [$(this).attr('data-id')], 'mid-large');
    });
</script>
