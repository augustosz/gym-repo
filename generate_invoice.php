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

    // Crear PDF con tamaño reducido (como un cuadradito)
    $pdf = new FPDF('P', 'mm', array(90, 120)); // Ancho 90mm, Alto 120mm (reducido)
    $pdf->AddPage();
    $pdf->SetMargins(5, 5, 5);

    // Estilo del título
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(0, 6, "PULSE GYM SOFTWARE", 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 6, "Fecha: " . date("d/m/Y H:i"), 0, 1, 'C');
    $pdf->Ln(2);

    // Separador
    $pdf->Cell(0, 0, str_repeat('-', 30), 0, 1, 'C');
    $pdf->Ln(2);

    // Encabezado de la tabla
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 6, "CANT", 0, 0, 'C');
    $pdf->Cell(34, 6, "ARTICULO", 0, 0, 'C');
    $pdf->Cell(15, 6, "PRECIO", 0, 0, 'C');
    $pdf->Cell(20, 6, "TOTAL", 0, 1, 'C');

    // Línea de datos
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(10, 6, "1", 0, 0, 'C'); 
    $pdf->Cell(34, 6, utf8_decode("Explosión Corporal"), 0, 0, 'L'); 
    $pdf->Cell(15, 6, "$" . number_format($total, 2), 0, 0, 'C');
    $pdf->Cell(20, 6, "$" . number_format($total, 2), 0, 1, 'C');

    // Separador
    $pdf->Ln(2);
    $pdf->Cell(0, 0, str_repeat('-', 30), 0, 1, 'C');
    $pdf->Ln(2);

    // Total a pagar
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 6, "TOTAL A PAGAR: $" . number_format($total, 2), 0, 1, 'C');

    // Mensaje final
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->MultiCell(0, 4, utf8_decode("Gracias por elegir nuestros servicios.\nPor favor, conserve este ticket para futuras referencias."), 0, 'C');
 
 
    // Agregar logo después del mensaje
    $logoPath = 'fpdf/logo_transparente.png'; // Reemplaza con la ruta de tu logo
    $posY = $pdf->GetY() + 5; // Posición justo debajo del texto
    $pdf->Image($logoPath, 20, $posY, 50); // Ajusta x, y, ancho (30) según el tamaño de tu logo

    // Salida del PDF
    $pdf->Output();
}
?>