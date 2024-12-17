<?php
include('db_connect.php');

// primera estadística
$query = "SELECT t1.date_created, t1.amount 
          FROM payments t1
          INNER JOIN members t2 ON t1.id = t2.id";

$result = mysqli_query($conn, $query);

$dates = [];
$amounts = [];
while ($row = $result->fetch_assoc()) {
  $dates[] = $row['date_created'];
  $amounts[] = $row['amount'];
}

$dates_json = json_encode($dates);
$amounts_json = json_encode($amounts);

// segunda consulta para ingresos totales por fecha
$query = "SELECT DATE(date_created) AS payment_date, SUM(amount) AS total_amount 
          FROM payments 
          GROUP BY payment_date 
          ORDER BY payment_date ASC";

$result = $conn->query($query);

$dates_total = [];
$amounts_total = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $dates_total[] = $row['payment_date'];
    $amounts_total[] = $row['total_amount'];
  }
} else {
  echo "No se encontraron resultados.";
}

// nueva consulta para ingresos totales por mes
$query_month = "SELECT DATE_FORMAT(date_created, '%Y-%m') AS payment_month, SUM(amount) AS total_amount 
                FROM payments 
                GROUP BY payment_month 
                ORDER BY payment_month ASC";

$result_month = $conn->query($query_month);

$months_total = [];
$amounts_month_total = [];

if ($result_month->num_rows > 0) {
  while ($row = $result_month->fetch_assoc()) {
    $months_total[] = $row['payment_month'];
    $amounts_month_total[] = $row['total_amount'];
  }
} else {
  echo "No se encontraron resultados para los ingresos totales por mes.";
}

$months_total_json = json_encode($months_total);
$amounts_month_total_json = json_encode($amounts_month_total);

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingresos Totales por Fecha</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
</head>


<body>

<div class="container mt-4">
  <div class="row">
    <!-- Gráfico 1: Monto por Transacción -->
    <div class="col-md-12 mb-5"> <!-- Mayor espacio debajo del gráfico 1 -->
      <canvas id="myChart1"></canvas>
    </div>

    <!-- Gráfico 2: Ingresos Totales por Fecha -->
    <div class="col-md-12 mb-5"> <!-- Menor espacio debajo del gráfico 2 -->
      <canvas id="myChart2"></canvas>
    </div>

    <!-- Gráfico 3: Ingresos Totales por Mes -->
    <div class="col-md-12 mb-5"> <!-- Espacio estándar debajo del gráfico 3 -->
      <canvas id="myChart3"></canvas>
    </div>
  </div>
</div>



  <script>
    // Gráfico 1: Monto por transacción (primer gráfico)
    const dates = <?php echo $dates_json; ?>;
    const amounts = <?php echo $amounts_json; ?>;

    const ctx1 = document.getElementById('myChart1').getContext('2d');
    const myChart1 = new Chart(ctx1, {
      type: 'line',
      data: {
        labels: dates, // Las fechas como etiquetas
        datasets: [{
          label: 'Monto por Transacción',
          data: amounts, // Los montos como datos
          backgroundColor: 'rgba(190, 135, 52, 0.42)',
          borderColor: 'rgb(63, 60, 25)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        legend: {
          labels: {
            fontSize: 22
          }
        },
        scales: {
          x: {
            type: 'time', // Escala de tiempo para el eje X
            time: {
              unit: 'day'
            }
          },
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Gráfico 2: Ingresos Totales por Fecha (segundo gráfico)
    const dates_total = <?php echo json_encode($dates_total); ?>;
    const amounts_total = <?php echo json_encode($amounts_total); ?>;

    const ctx2 = document.getElementById('myChart2').getContext('2d');
    const myChart2 = new Chart(ctx2, {
      type: 'bar', // Mantener 'bar' para las barras
      data: {
        labels: dates_total, // Fechas de los pagos
        datasets: [{
          label: 'Ingresos Totales',
          data: amounts_total, // Montos de los pagos
          backgroundColor: 'rgba(52, 116, 190, 0.42)',
          borderColor: 'rgb(25, 63, 63)',
          borderWidth: 1,
          fill: true, // Rellenar bajo las barras
        }]
      },
      options: {
        responsive: true,
        legend: {
          labels: {
            fontSize: 22
          }
        },
        scales: {
          x: {
            title: {
              display: true,
              text: 'Fecha'
            },
            type: 'category', // Configurar como categorías para fechas
          },
          y: {
            title: {
              display: true,
              text: 'Monto Total'
            },
            beginAtZero: true,
            type: 'linear', // Escala continua para mostrar los valores de manera continua
          }
        }
      }
    });


    // Gráfico 3: Ingresos Totales por Mes (nuevo gráfico)
    const months_total = <?php echo $months_total_json; ?>;
    const amounts_month_total = <?php echo $amounts_month_total_json; ?>;

    const ctx3 = document.getElementById('myChart3').getContext('2d');
    const myChart3 = new Chart(ctx3, {
      type: 'bar', // Mantener 'bar' para las barras
      data: {
        labels: months_total, // Meses de los pagos
        datasets: [{
          label: 'Ingresos Totales por Mes',
          data: amounts_month_total, // Montos totales por mes
          backgroundColor: 'rgba(52, 190, 98, 0.42)',
          borderColor: 'rgb(25, 63, 63)',
          borderWidth: 1,
          fill: true, // Rellenar bajo las barras
        }]
      },
      options: {
        responsive: true,
        legend: {
          labels: {
            fontSize: 22
          }
        },
        scales: {
          x: {
            title: {
              display: true,
              text: 'Mes'
            },
            ticks: {
              callback: function(value) {
                return value.substr(0, 7); // Mostrar solo año-mes
              }
            }
          },
          y: {
            title: {
              display: true,
              text: 'Monto Total'
            },
            beginAtZero: true,
            type: 'linear', // Escala continua para representar el monto
          }
        }
      }
    });
  </script>


</body>

</html>