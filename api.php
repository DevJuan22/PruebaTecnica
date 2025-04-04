<?php
require 'database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];

try {
    switch ($method) {
        case 'GET':
            $query = "SELECT * FROM ofertas WHERE 1=1";
            $params = [];

            if (!empty($_GET['id'])) {
                $query .= " AND id = ?";
                $params[] = $_GET['id'];
            }

            if (!empty($_GET['objeto'])) {
                $query .= " AND objeto LIKE ?";
                $params[] = "%" . $_GET['objeto'] . "%";
            }

            if (!empty($_GET['comprador'])) {
                $query .= " AND actividad LIKE ?";
                $params[] = "%" . $_GET['comprador'] . "%";
            }

            if (!empty($_GET['estado'])) {
                $query .= " AND estado = ?";
                $params[] = $_GET['estado'];
            }

            if (!empty($_GET['fecha_inicio'])) {
                $query .= " AND fecha_inicio >= ?";
                $params[] = $_GET['fecha_inicio'];
            }

            if (!empty($_GET['fecha_cierre'])) {
                $query .= " AND fecha_cierre <= ?";
                $params[] = $_GET['fecha_cierre'];
            }

            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            $ofertas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($ofertas as &$oferta) {
                $docStmt = $pdo->prepare("SELECT COUNT(*) as total FROM documentos WHERE oferta_id = ?");
                $docStmt->execute([$oferta['id']]);
                $oferta['cantidad_documentos'] = $docStmt->fetchColumn();
            }

            echo json_encode($ofertas);
            break;

        default:
            echo json_encode(["error" => "Método no permitido"]);
            break;
    }
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
