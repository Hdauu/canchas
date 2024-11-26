<?php
require_once '../models/Connection.php'; // Incluye la conexión a la base de datos

// Función para obtener estadísticas
function getStatistics($conn) {
    // Total de canchas
    $totalFields = $conn->query("SELECT COUNT(*) AS totalFields FROM field")->fetch()['totalFields'];

    // Cancha más reservada
    $mostBookedField = $conn->query("
    SELECT ft.FieldType_name, COUNT(r.reservation_id) AS total_reservations
    FROM reservation r
    JOIN field f ON r.field_id = f.field_id
    JOIN fieldtype ft ON f.FieldType_id = ft.FieldType_id
    GROUP BY ft.FieldType_name
    ORDER BY total_reservations DESC
    LIMIT 1")->fetch()['FieldType_name'] ?? 'No disponible';

    // Promedio de reservas
    $avgReservations = $conn->query("
        SELECT AVG(total_reservations) AS avgReservations
        FROM (
            SELECT COUNT(r.reservation_id) AS total_reservations
            FROM reservation r
            GROUP BY r.field_id
        ) AS subquery")->fetch()['avgReservations'] ?? 0;

    // Total de horas reservadas en los últimos 30 días
    $totalHours = $conn->query("
        SELECT SUM(reservation_duration) AS total_hours
        FROM reservation
        WHERE reservation_for_date >= CURDATE() - INTERVAL 30 DAY
    ")->fetch()['total_hours'] ?? 0;

    // Top 3 clientes con más reservas
    $topCustomers = $conn->query("
        SELECT c.customer_name, COUNT(r.reservation_id) AS total_reservations
        FROM reservation r
        JOIN customers c ON r.customer_id = c.customer_id
        GROUP BY c.customer_name
        ORDER BY total_reservations DESC
        LIMIT 3
    ")->fetchAll(PDO::FETCH_ASSOC);

    // Total de reservas por los últimos 7 días agrupadas por semana
    $totalReservationsPerWeek = $conn->query("
        SELECT WEEK(reservation_for_date) AS week_number, COUNT(reservation_id) AS total_reservations
        FROM reservation
        WHERE reservation_for_date >= CURDATE() - INTERVAL 7 DAY
        GROUP BY week_number
        ORDER BY week_number DESC
    ")->fetchAll(PDO::FETCH_ASSOC);

    return [
        'totalFields' => $totalFields,
        'mostBookedField' => $mostBookedField,
        'avgReservations' => round($avgReservations, 2),
        'totalHours' => round($totalHours, 2),
        'topCustomers' => $topCustomers, // Incluye los 3 mejores clientes
        'totalReservationsPerWeek' => $totalReservationsPerWeek, // Incluye las reservas por semana
    ];
}

// Crear una nueva conexión
$conn = Connection::newConnection();

// Verificar que la conexión se haya realizado correctamente
if ($conn) {
    // Obtención de estadísticas
    $statistics = getStatistics($conn);

    // Retornar las estadísticas en formato JSON
    header('Content-Type: application/json');
    echo json_encode($statistics);
} else {
    echo json_encode(['error' => 'No se pudo establecer la conexión a la base de datos.']);
}
?>
