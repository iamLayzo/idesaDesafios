<?php
require_once 'Database.php';

class DesafioDos {
    public static function retriveLotes(string $loteID): void {
        Database::setDB();
        $lotes = self::getLotes($loteID);
        echo json_encode($lotes, JSON_PRETTY_PRINT);
    }

    private static function getLotes(string $loteID): array {
        $lotes = [];
        $cnx = Database::getConnection();
        $stmt = $cnx->query("SELECT * FROM debts WHERE lote = '$loteID'");
        while ($rows = $stmt->fetchArray(SQLITE3_ASSOC)) {
            $lotes[] = $rows;
        }
        return $lotes;
    }
}

DesafioDos::retriveLotes('00148');
