<?php
require 'database.php';

// Cambiar ofertas de "Activo" a "Publicado"
$stmt = $pdo->prepare("UPDATE ofertas SET estado = 'Publicado' WHERE estado = 'Activo' AND fecha_inicio <= NOW()");
$stmt->execute();

// Cambiar ofertas de "Publicado" a "Evaluación"
$stmt = $pdo->prepare("UPDATE ofertas SET estado = 'Evaluación' WHERE estado = 'Publicado' AND fecha_cierre <= NOW()");
$stmt->execute();

echo json_encode(["message" => "Estados actualizados correctamente"]);
?>
