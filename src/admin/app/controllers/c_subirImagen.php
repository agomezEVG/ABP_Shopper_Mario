<?php
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/shopperMario/src/admin/img/'; 
$response = array();

// Comprobar si el archivo ha sido subido sin errores
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    // Obtener la información del archivo subido
    $fileName = $_FILES['file']['name'];
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];

    $uniqueFileName = basename($fileName);

    // Ruta completa donde se guardará el archivo
    $destination = $uploadDir . $uniqueFileName;

    // Comprobar si el directorio de destino existe
    if (!is_dir($uploadDir)) {
        $response['error'] = 'El directorio de destino no existe.';
        echo json_encode($response);
        exit;
    }

    // Comprobar si el directorio tiene permisos de escritura
    if (!is_writable($uploadDir)) {
        $response['error'] = 'El directorio no tiene permisos de escritura.';
        echo json_encode($response);
        exit;
    }

    // Intentar mover el archivo subido al directorio de destino
    if (move_uploaded_file($fileTmpPath, $destination)) {
        // Responder con el nombre del archivo si la subida fue exitosa
        $response['filename'] = $uniqueFileName;
    } else {
        // Si hubo un error al mover el archivo
        $response['error'] = 'Hubo un problema al guardar el archivo. Asegúrate de que el directorio sea accesible y tenga permisos adecuados.';
    }
} else {
    // Si no se recibe un archivo o hay un error
    $response['error'] = 'No se ha recibido un archivo o ha ocurrido un error en la subida. Error: ' . $_FILES['file']['error'];
}

// Devolver la respuesta como JSON
echo json_encode($response);
