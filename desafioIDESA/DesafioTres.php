<?php
require_once 'Database.php';

// Configurar cabeceras para el servicio REST
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['loteID'])) {
    $loteID = $_GET['loteID'];
    try {
        $lotes = getLotesById($loteID);
        echo json_encode($lotes, JSON_PRETTY_PRINT);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error al procesar la solicitud: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Método no permitido o parámetro faltante']);
}

/**
 * Obtener todos los lotes según el loteID
 */
function getLotesById(string $loteID): array {
    $lotes = [];
    $cnx = Database::getConnection();
    $stmt = $cnx->query("SELECT * FROM debts WHERE lote = '$loteID'");
    while ($rows = $stmt->fetchArray(SQLITE3_ASSOC)) {
        $lotes[] = $rows;
    }
    return $lotes;
}
?>
