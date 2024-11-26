<?php


if (!isset($_SESSION['userId'])) {
    header("Location: app/views/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Reservas</title>
    <!-- FullCalendar CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.css" rel="stylesheet" />
    <style>
        .container {
            margin-top: 50px;
        }
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="calendar"></div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- FullCalendar JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                events: function(start, end, timezone, callback) {
                    // Llamada AJAX al controlador PHP
                    $.ajax({
                        url: 'app/controllers/getReservationsForCalendar.php', // Controlador para obtener las reservas
                        dataType: 'json',
                        success: function(data) {
                            var events = data.map(function(reservation) {
                                return {
                                    title: reservation.client_name + ' - ' + (reservation.paid ? 'Pagado' : 'Pendiente'),
                                    start: reservation.reservation_date, // Fecha de la reserva
                                    backgroundColor: reservation.paid ? 'green' : 'red', // Cambiar el color según el estado
                                    description: reservation.details, // Detalles adicionales
                                    id: reservation.reservation_id // ID de la reserva para usar en ediciones
                                };
                            });
                            callback(events);
                        }
                    });
                },
                editable: true,
                droppable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                eventClick: function(event, jsEvent, view) {
                    // Mostrar detalles al hacer clic en el evento
                    alert('Reserva ID: ' + event.id + '\n' + 'Detalles: ' + event.description);
                }
            });
        });
    </script>
</body>
</html>
