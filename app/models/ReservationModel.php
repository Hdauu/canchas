<?php
class ReservationModel {
    
    public function getReservationsForCalendar() {
        // Conexión a la base de datos (ajusta según tu configuración)
        $conn = Connection::newConnection();
        
        // Consulta SQL para obtener las reservas
        $stmt = $conn->prepare("SELECT r.reservation_id, r.reservation_date, r.paid, c.client_name
                               FROM reservations r
                               JOIN clients c ON r.client_id = c.client_id");
        $stmt->execute();
        
        // Devolver los resultados como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
