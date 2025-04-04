


<?php

file_put_contents("log.txt", print_r($_POST, true) . "\n", FILE_APPEND);
file_put_contents("log.txt", print_r($_FILES, true) . "\n", FILE_APPEND);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['archivo']['name'])) {
        $oferta_id = $_POST['oferta_id'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $archivo = $_FILES['archivo'];

        // Carpeta donde se guardarán los archivos
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Nombre único para el archivo
        $archivo_nombre = time() . "_" . basename($archivo['name']);
        $archivo_ruta = $upload_dir . $archivo_nombre;

        // Mover el archivo a la carpeta
        if (move_uploaded_file($archivo['tmp_name'], $archivo_ruta)) {
            // Guardar en la base de datos
            $stmt = $conn->prepare("INSERT INTO documentos (oferta_id, titulo, descripcion, ruta_archivo) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $oferta_id, $titulo, $descripcion, $archivo_ruta);

            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Documento guardado correctamente"]);
            } else {
                echo json_encode(["success" => false, "message" => "Error al guardar en la base de datos"]);
            }
            $stmt->close();
        } else {
            echo json_encode(["success" => false, "message" => "Error al subir el archivo"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "No se recibió ningún archivo"]);
    }
}

if (!$stmt->execute()) {
    die("Error en la consulta SQL: " . $stmt->error);
}
?>
