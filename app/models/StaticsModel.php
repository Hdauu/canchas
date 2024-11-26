<?php
class StatisticsModel
{
    public function getTotalFields($conn)
    {
        $stmt = $conn->prepare("SELECT COUNT(*) as total FROM field");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function getMostBookedField($conn)
    {
        $stmt = $conn->prepare("
            SELECT f.field_id, COUNT(r.reservation_id) as total_reservations 
            FROM field f 
            LEFT JOIN reservation r ON f.field_id = r.field_id
            GROUP BY f.field_id
            ORDER BY total_reservations DESC
            LIMIT 1
        ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? "Cancha ID: " . $result['field_id'] . " con " . $result['total_reservations'] . " reservas" : "No disponible";
    }

    public function getAverageReservations($conn)
    {
        $stmt = $conn->prepare("
            SELECT AVG(total_reservations) as avg_reservations
            FROM (
                SELECT COUNT(*) as total_reservations 
                FROM reservation 
                GROUP BY field_id
            ) as reservations_count
        ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return round($result['avg_reservations'], 2) ?? 0;
    }
}
