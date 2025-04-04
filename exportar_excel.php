<?php
require 'vendor/autoload.php'; 
require 'database.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Escribir cabeceras
$sheet->setCellValue('A1', 'ID oferta');
$sheet->setCellValue('B1', 'Creador oferta');
$sheet->setCellValue('C1', 'Objeto');
$sheet->setCellValue('D1', 'Actividad');
$sheet->setCellValue('E1', 'Descripción');
$sheet->setCellValue('F1', 'Moneda');
$sheet->setCellValue('G1', 'Presupuesto');
$sheet->setCellValue('H1', 'Fecha de inicio');
$sheet->setCellValue('I1', 'Hora de inicio');
$sheet->setCellValue('J1', 'Fecha de cierre');
$sheet->setCellValue('K1', 'Estado');

// Obtener el ID de la oferta desde la URL
$idOferta = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($idOferta > 0) {
    // Consulta solo la oferta específica
    $stmt = $pdo->prepare("SELECT * FROM ofertas WHERE id = ?");
    $stmt->execute([$idOferta]);
} else {
    // Si no se proporciona un ID válido, descargar todas
    $stmt = $pdo->query("SELECT * FROM ofertas");
}

$ofertas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$row = 2;
foreach ($ofertas as $oferta) {
    $sheet->setCellValue('A' . $row, $oferta['id']);
    $sheet->setCellValue('B' . $row, 'Creador'); 
    $sheet->setCellValue('C' . $row, $oferta['objeto']);
    $sheet->setCellValue('D' . $row, $oferta['actividad']);
    $sheet->setCellValue('E' . $row, $oferta['descripcion']);
    $sheet->setCellValue('F' . $row, $oferta['moneda']);
    $sheet->setCellValue('G' . $row, $oferta['presupuesto']);
    $sheet->setCellValue('H' . $row, $oferta['fecha_inicio']);
    
    // Extraer solo la hora de la fecha de inicio
    $hora_inicio = date('H:i:s', strtotime($oferta['fecha_inicio']));
    $sheet->setCellValue('I' . $row, $hora_inicio);
    
    $sheet->setCellValue('J' . $row, $oferta['fecha_cierre']);
    $sheet->setCellValue('K' . $row, $oferta['estado']);
    
    $row++;
}

// Crear el archivo en memoria y enviarlo al usuario
$writer = new Xlsx($spreadsheet);
$nombreArchivo = 'reporte_oferta_' . ($idOferta > 0 ? $idOferta : 'todas') . '.xlsx';

// **Evitar salida inesperada**
ob_end_clean();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>
