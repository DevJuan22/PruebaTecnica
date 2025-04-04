<?php
require 'database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$where = [];
$params = [];

// Filtrado dinámico
if (!empty($data['id'])) {
    $where[] = "o.id = ?";
    $params[] = $data['id'];
}
if (!empty($data['objeto'])) {
    $where[] = "o.objeto LIKE ?";
    $params[] = "%" . $data['objeto'] . "%";
}
if (!empty($data['estado'])) {
    $where[] = "o.estado = ?";
    $params[] = $data['estado'];
}
if (!empty($data['fecha_inicio'])) {
    $where[] = "o.fecha_inicio >= ?";
    $params[] = $data['fecha_inicio'];
}
if (!empty($data['fecha_cierre'])) {
    $where[] = "o.fecha_cierre <= ?";
    $params[] = $data['fecha_cierre'];
}

$sql = "SELECT o.*, 
        (SELECT COUNT(*) FROM documentos d WHERE d.oferta_id = o.id) as cantidad_documentos 
        FROM ofertas o";

if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " ORDER BY o.id DESC";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($resultados);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
