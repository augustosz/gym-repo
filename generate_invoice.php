<?php
require("fpdf/fpdf.php");
include "db_connect.php"; // Conexión a la base de datos

if (isset($_GET['registration_id'])) {
    $registration_id = $_GET['registration_id'];

    // Consulta para recuperar datos del registro, cliente y pagos
    $qry = $conn->query("SELECT r.*, m.firstname, m.lastname, m.email, m.contact, pp.package, p.plan AS plan_months
                        FROM registration_info r
                        INNER JOIN members m ON m.id = r.member_id
                        INNER JOIN packages pp ON pp.id = r.package_id
                        INNER JOIN plans p ON p.id = r.plan_id
                        WHERE r.id = $registration_id")->fetch_assoc();

    // Consulta para obtener el último pago realizado
    $last_payment = $conn->query("SELECT * FROM payments WHERE registration_id = $registration_id ORDER BY date_created DESC LIMIT 1")->fetch_assoc();

    // Generar número de factura único
    $invoice_number = 1;
    $last_invoice = $conn->query("SELECT MAX(invoice_number) as last_invoice FROM invoices");
    if ($last_invoice->num_rows > 0) {
        $invoice_number = $last_invoice->fetch_assoc()['last_invoice'] + 1;
    }

    // Guardar el número de factura en la base de datos
    $conn->query("INSERT INTO invoices (registration_id, invoice_number, date_created) 
                  VALUES ($registration_id, $invoice_number, NOW())");

    // ======================== Generar el PDF ========================
    $pdf = new FPDF($orientation = 'P', $unit = 'mm', array(58, 100)); // Formato ticket
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 9);

    // Encabezado del ticket
    $textypos = 5;
    $pdf->setY(2);
    $pdf->setX(2);
    $pdf->Cell(0, $textypos, "PULSE GYM SOFTWARE", 0, 1, 'C');
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(0, $textypos, "Fecha: " . date("d/m/Y H:i"), 0, 1, 'C');
    $pdf->Ln(2);

    // Separador
    $pdf->Cell(0, 0, '--------------------------------------------------', 0, 1, 'C');
    $pdf->Ln(1);

    // Encabezados de la tabla
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->setX(2);
    $pdf->Cell(8, 6, "CANT", 0, 0, 'L');
    $pdf->Cell(22, 6, "ARTICULO", 0, 0, 'L');
    $pdf->Cell(12, 6, "PRECIO", 0, 0, 'R');
    $pdf->Cell(12, 6, "TOTAL", 0, 1, 'R');

    // Datos dinámicos desde la base de datos
    $pdf->SetFont('Arial', '', 7);
    $total = 0;

    // Detalle del paquete y plan
    $pdf->setX(2);
    $pdf->Cell(8, 6, "1", 0, 0, 'L'); // Cantidad
    $pdf->Cell(22, 6, substr($qry['package'], 0, 15), 0, 0, 'L'); // Paquete
    $pdf->Cell(12, 6, "$" . number_format($last_payment['amount'], 2), 0, 0, 'R'); // Precio
    $pdf->Cell(12, 6, "$" . number_format($last_payment['amount'], 2), 0, 1, 'R'); // Total
    $total += $last_payment['amount'];

    // Separador final
    $pdf->Ln(2);
    $pdf->Cell(0, 0, '--------------------------------------------------', 0, 1, 'C');

    // Total general
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Ln(2);
    $pdf->setX(2);
    $pdf->Cell(35, 6, "TOTAL A PAGAR:", 0, 0, 'R');
    $pdf->Cell(15, 6, "$" . number_format($total, 2), 0, 1, 'R');

    // Mensaje de despedida
    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'I', 7);
    $pdf->setX(2);
    $pdf->MultiCell(0, 3, "Gracias por elegir nuestros servicios.\nPor favor, conserve este ticket para futuras referencias.");

    $pdf->Output();
}
?>
