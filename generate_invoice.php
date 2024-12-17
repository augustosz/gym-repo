<?php
require("fpdf/fpdf.php");
include "db_connect.php";

if (isset($_GET['registration_id'])) {
    $registration_id = $_GET['registration_id'];

    // Recuperar datos
    $qry = $conn->query("SELECT r.*, m.firstname, m.lastname, pp.package
                        FROM registration_info r
                        INNER JOIN members m ON m.id = r.member_id
                        INNER JOIN packages pp ON pp.id = r.package_id
                        WHERE r.id = $registration_id")->fetch_assoc();
    $last_payment = $conn->query("SELECT amount FROM payments WHERE registration_id = $registration_id ORDER BY date_created DESC LIMIT 1")->fetch_assoc();
    $total = $last_payment['amount'];

    // Crear PDF
    $pdf = new FPDF('P', 'mm', array(90, 300)); // Ticket más grande
    $pdf->AddPage();
    $pdf->SetMargins(5, 5, 5);

    // Estilo del título
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, "PULSE GYM SOFTWARE", 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 7, "Fecha: " . date("d/m/Y H:i"), 0, 1, 'C');
    $pdf->Ln(2);

    // Separador
    $pdf->Cell(0, 0, str_repeat('-', 48), 0, 1, 'C');
    $pdf->Ln(3);

    // Encabezado de la tabla
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 8, "CANT", 0, 0, 'C');   
    $pdf->Cell(34, 8, "ARTICULO", 0, 0, 'C'); 
    $pdf->Cell(15, 8, "PRECIO", 0, 0, 'C');
    $pdf->Cell(20, 8, "TOTAL", 0, 1, 'C');
    $pdf->Ln(1);

    // Línea de datos
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(10, 8, "1", 0, 0, 'C'); // Cantidad
    $pdf->Cell(35, 8, utf8_decode("Explosión Corporal"), 0, 0, 'L'); // Artículo
    $pdf->Cell(15, 8, "$" . number_format($total, 2), 0, 0, 'C'); // Precio
    $pdf->Cell(22, 8, " $" . number_format($total, 2), 0, 1, 'C'); // Total

    // Separador
    $pdf->Ln(3);
    $pdf->Cell(0, 0, str_repeat('-', 48), 0, 1, 'C');
    $pdf->Ln(3);

    // Total a pagar
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 8, "TOTAL A PAGAR: $" . number_format($total, 2), 0, 1, 'C');

    // Mensaje final
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->MultiCell(0, 5, utf8_decode("Gracias por elegir nuestros servicios.\nPor favor, conserve este ticket para futuras referencias."), 0, 'C');

    // Salida del PDF
    $pdf->Output();
}
?>
