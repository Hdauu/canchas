<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header("Location: index.php?view=login");
    exit;
}

require_once __DIR__ . '/../helpers/getters.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

$reservation = getReservation($id); // Asegúrate de que esta función siempre retorne un array.

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Reserva</title>
    <link rel="stylesheet" href="../../node_modules/bulma/css/versions/bulma-no-dark-mode.css">
</head>

<body>
    <?php include __DIR__ . '/../components/nav.php'; ?>

    <main class="container is-max-desktop columns" style="margin-top: 50px;">
        <form id="reservation_form" class="column">
            <h2 class="title is-4">Ingrese los datos de la reserva</h2>
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            <div class="field is-grouped">
                <div class="control">
                    <label class="label">Fecha</label>
                    <input class="input" value="<?= htmlspecialchars($reservation['reservation_for_date'] ?? '') ?>" type="date" name="reservation_date" id="reservation_date">
                </div>

                <div class="control">
                    <label class="label">Horario</label>
                    <input class="input" value="<?= htmlspecialchars($reservation['reservation_time'] ?? '') ?>" type="time" name="reservation_time">
                </div>
                <div class="control" style="max-width: 150px;">
                    <label class="label">Cantidad de horas</label>
                    <input class="input" value="<?= htmlspecialchars($reservation['reservation_duration'] ?? '') ?>" type="number" name="reservation_duration">
                </div>
            </div>
            <div class="field">
                <label class="label">Cancha</label>
                <div class="control">
                    <div class="select">
                        <select name="field_id" required>
                            <option value="" <?= (isset($reservation['field_id']) && $reservation['field_id'] == '') ? 'selected' : '' ?> disabled> Seleccionar Cancha</option>
                            <?php
                            include __DIR__ . '/../controllers/listFieldsSelect.php';
                            foreach ($fieldsList as $field) {
                                $isSelected = (isset($reservation['field_id']) && $field['field_id'] == $reservation['field_id']) ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($field['field_id']) . '"' . $isSelected . '>' . htmlspecialchars($field['FieldType_id']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field columns is-grouped">
                <div class="control column is-two-fifths">
                    <label class="label">Cliente</label>
                    <input class="input" id="customer-input" type="text" list="suggestions" placeholder="Nombre / Número de teléfono" value="<?= htmlspecialchars($reservation['customer_name'] ?? '') ?>" name="customer_name">
                    <datalist id="suggestions">
                        <?php
                        include __DIR__ . '/../controllers/listCustomersSuggestions.php';
                        foreach ($customersSuggestions as $customer) {
                            echo '<option data-id="' . htmlspecialchars($customer['customer_id']) . '" value="' . htmlspecialchars($customer['customer_name']) . '"></option>';
                        }
                        ?>
                    </datalist>
                    <input type="hidden" id="customer_id" name="customer_id" value="<?= htmlspecialchars($reservation['customer_id'] ?? '') ?>">
                </div>
            </div>

            <div class="field">
                <label class="label">Pagado</label>
                <div class="control">
                    <label class="radio">
                        <input type="radio" name="reservation_paid" value="1"
                            <?php if (isset($reservation['reservation_paid']) && $reservation['reservation_paid'] == 1) echo 'checked'; ?>>
                        Si
                    </label>
                    <label class="radio">
                        <input type="radio" name="reservation_paid" value="0"
                            <?php if (isset($reservation['reservation_paid']) && $reservation['reservation_paid'] == 0) echo 'checked'; ?>>
                        No
                    </label>
                </div>
            </div>

            <article class="message is-danger" style="display: none;">
                <div class="message-body">
                </div>
            </article>

            <div class="field is-flex" style="width: 300px; max-width: 100%; margin: auto; gap: 1rem">
                <div class="control is-flex-grow-2">
                    <input type="submit" value="Guardar" class="button is-link is-fullwidth">
                </div>
                <div class="control is-flex-grow-1">
                    <a href="../../index.php" class="button is-link is-danger is-fullwidth">Cancelar</a>
                </div>
            </div>
        </form>
        <div class="column">
            <h2 class="is-2">Turnos disponibles</h2>
            <table class="table">
                <thead>
                    <tr>
                        <td>Cancha</td>
                        <td>Hora</td>
                        <td colspan="2"></td>
                    </tr>
                </thead>
                <tbody id="availableSlotsTableBody">
                </tbody>
            </table>
        </div>
    </main>
    <script src="../../public/js/add-edit-reservation.js"></script>
</body>

</html>

<script>
    document.getElementById('customer-input').addEventListener('input', function() {
        var customerOptions = document.querySelectorAll('#suggestions option');
        var inputValue = this.value;

        customerOptions.forEach(function(option) {
            if (option.value === inputValue) {
                document.getElementById('customer_id').value = option.getAttribute('data-id');
            }
        });
    });
</script>
