<?php
require('fpdf/fpdf.php'); 
include 'db_connect.php';  // Incluyendo conexión a la base de datos

class PDF extends FPDF {
    function Header() {
        // Logo en la esquina superior derecha, ajustado a una nueva posición
        $this->Image('fpdf/logo.png', 110, 20, 30, 30, 'PNG'); // Ajusté la posición del logo hacia abajo
        
        // Título centrado y en negrita con tamaño 24
        $this->SetFont('Arial', 'B', 24);
        $this->SetTextColor(32, 100, 210);
        $this->Cell(0, 15, iconv("UTF-8", "ISO-8859-1", strtoupper("GYM SOFTWARE")), 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        // Asegurando la codificación correcta para el texto
        $this->Cell(0, 10, iconv("UTF-8", "ISO-8859-1", 'Página ' . $this->PageNo()), 0, 0, 'C');
    }
}

// Cambia el tamaño de la página a A5 (148 x 210 mm)
$pdf = new PDF('P', 'mm', array(148, 210)); 
$pdf->SetMargins(10, 10, 10); // Margen adaptado
$pdf->AddPage();

// Establecer la codificación de caracteres a utf8mb4
$conn->set_charset("utf8mb4");

if (isset($_GET['registration_id'])) {
    $registration_id = $_GET['registration_id'];

    // Obtener la información del cliente, el pago, el entrenador y el plan
    $qry = $conn->query("SELECT r.*, m.firstname, m.lastname, m.email, m.contact, m.address, e.name AS trainer_name, p.plan AS plan_months, pp.package 
      FROM registration_info r 
      INNER JOIN members m ON m.id = r.member_id 
      INNER JOIN trainers e ON e.id = r.trainer_id
      INNER JOIN plans p ON p.id = r.plan_id 
      INNER JOIN packages pp ON pp.id = r.package_id
      WHERE r.id = $registration_id")->fetch_assoc();

    // Obtener el pago más reciente
    $last_payment = $conn->query("SELECT * FROM payments WHERE registration_id = $registration_id ORDER BY date_created DESC LIMIT 1")->fetch_assoc();

    # Información de contacto #
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetTextColor(39, 39, 51);
    $pdf->Cell(0, 10, iconv("UTF-8", "ISO-8859-1", $qry['address']), 0, 1, 'L');
    $pdf->Cell(0, 10, iconv("UTF-8", "ISO-8859-1", "Teléfono: " . $qry['contact']), 0, 1, 'L');
    $pdf->Cell(0, 10, iconv("UTF-8", "ISO-8859-1", "Email: " . $qry['email']), 0, 1, 'L');
    $pdf->Ln(10);

    # Datos de la factura #
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(39, 39, 51);
    $pdf->Cell(30, 7, iconv("UTF-8", "ISO-8859-1", " Fecha de emisión :"), 0, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(97, 97, 97);
    $pdf->Cell(0, 7, iconv("UTF-8", "ISO-8859-1", date(" d/m/Y ") . " " . date(" ")), 0, 1);

    // Generar número de factura único
    $invoice_number = 1;
    $last_invoice = $conn->query("SELECT MAX(invoice_number) as last_invoice FROM invoices WHERE registration_id = $registration_id");
    if ($last_invoice->num_rows > 0) {
        $invoice_number = $last_invoice->fetch_assoc()['last_invoice'] + 1;
    }

    # Ajustar la posición del número de factura #
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 7, iconv("UTF-8", "ISO-8859-1", strtoupper("Factura Nro. " . $invoice_number)), 0, 1, 'C');
    $pdf->Ln(7); // Espacio adicional después del número de factura

    # Zona de descripción #
    $pdf->SetTextColor(39, 39, 51);
    $pdf->Cell(0, 7, iconv("UTF-8", "ISO-8859-1", "Plan: " . $qry['plan_months'] . " Meses"), 0, 1, 'L');
    $pdf->Ln(5);

    # Tabla de productos #
    $pdf->SetFont('Arial', 'B', 10);  // Letra más gruesa para los encabezados
    $pdf->SetFillColor(23, 83, 201);
    $pdf->SetDrawColor(23, 83, 201);
    $pdf->SetTextColor(255, 255, 255);
    
    // Definimos el ancho total de la tabla
    $table_width = 128; // Ancho total de la tabla (148 mm - márgenes laterales de 10 mm cada uno)

    // Definimos el ancho de cada columna
    $column1_width = 80; // Ancho de la columna Descripción
    $column2_width = 25; // Ancho de la columna Precio
    $column3_width = 23; // Ancho de la columna Subtotal

    $pdf->Cell($column1_width, 8, iconv("UTF-8", "ISO-8859-1", "Descripción"), 1, 0, 'C', true);
    $pdf->Cell($column2_width, 8, iconv("UTF-8", "ISO-8859-1", "Precio"), 1, 0, 'C', true);
    $pdf->Cell($column3_width, 8, iconv("UTF-8", "ISO-8859-1", "Subtotal"), 1, 1, 'C', true);

    # Detalles de la tabla #
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(39, 39, 51);
    $pdf->Cell($column1_width, 7, iconv("UTF-8", "ISO-8859-1", $qry['package']), 1, 0, 'C'); // Paquete
    $pdf->Cell($column2_width, 7, iconv("UTF-8", "ISO-8859-1", "$" . number_format($last_payment['amount'], 2) . " "), 1, 0, 'C'); // Precio
    $pdf->Cell($column3_width, 7, iconv("UTF-8", "ISO-8859-1", "$" . number_format($last_payment['amount'], 2) . " "), 1, 1, 'C'); // Subtotal

    # Totales #
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell($column1_width, 7, '', 0, 0);  // Celda vacía para ajustar el Total a la derecha
    $pdf->Cell($column2_width, 7, iconv("UTF-8", "ISO-8859-1", 'Total'), 1, 0, 'C');
    $pdf->Cell($column3_width, 7, iconv("UTF-8", "ISO-8859-1", "$" . number_format($last_payment['amount'], 2) . " "), 1, 1, 'C');

    // Guardar en la base de datos sin el campo 'amount'
    $sql = "INSERT INTO invoices (registration_id, invoice_number, date_created) VALUES ($registration_id, $invoice_number, NOW())";
    $conn->query($sql);

    // Output the PDF
    $pdf->Output();
}
?>
