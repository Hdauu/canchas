<div class="container has-background-grey-darker" style="margin-top: 50px; padding: 20px; border-radius: 8px;">
    <h1 class="title has-text-white has-text-centered">Estadísticas</h1>

    <div id="stats-content" class="columns is-multiline" style="display: none;">
        <div class="column is-one-third">
            <div class="box has-background-grey-lighter">
                <h2 class="subtitle has-text-black">Total de Canchas</h2>
                <p class="has-text-grey-dark" id="totalFields"></p>
            </div>
        </div>

        <div class="column is-one-third">
            <div class="box has-background-grey-lighter">
                <h2 class="subtitle has-text-black">Cancha Más Reservada</h2>
                <p class="has-text-grey-dark" id="mostBookedField"></p>
            </div>
        </div>

        <div class="column is-one-third">
            <div class="box has-background-grey-lighter">
                <h2 class="subtitle has-text-black">Promedio de Reservas</h2>
                <p class="has-text-grey-dark" id="avgReservations"></p>
            </div>
        </div>

        <div class="column is-one-third">
            <div class="box has-background-grey-lighter">
                <h2 class="subtitle has-text-black">Total de Horas Reservadas (Últimos 30 días)</h2>
                <p class="has-text-grey-dark" id="totalHours"></p>
            </div>
        </div>

        <div class="column is-one-third">
            <div class="box has-background-grey-lighter">
                <h2 class="subtitle has-text-black">Top 3 Clientes con Más Reservas</h2>
                <ul id="topCustomers" class="has-text-grey-dark"></ul>
            </div>
        </div>

        <div class="column is-one-third">
            <div class="box has-background-grey-lighter">
                <h2 class="subtitle has-text-black">Reservas semanales</h2>
                <ul id="reservationsPerWeek" class="has-text-grey-dark"></ul>
            </div>
        </div>
    </div>

    <!-- Spinner centrado -->
    <div id="spinner" class="has-text-centered">
        <div class="loader"></div>
    </div>
</div>

<script>
    window.onload = function() {
        document.getElementById("spinner").style.display = "block"; 
        fetch("app/controllers/statisticsController.php")
            .then(response => response.json())
            .then(data => {
                const totalFieldsText = `Hay ${data.totalFields || 0} canchas en total`;
                document.getElementById("totalFields").textContent = totalFieldsText;

                const mostBookedFieldText = data.mostBookedField ? `La cancha más reservada es la de ${data.mostBookedField}` : "No disponible";
                document.getElementById("mostBookedField").textContent = mostBookedFieldText;

                const avgReservationsText = `Hay un promedio de ${data.avgReservations || 0} en reservas`;
                document.getElementById("avgReservations").textContent = avgReservationsText;

                const totalHoursText = `Se han reservado un total de ${data.totalHours || 0} horas en los últimos 30 días`;
                document.getElementById("totalHours").textContent = totalHoursText;

                const topCustomersList = data.topCustomers.map(customer => `<li>${customer.customer_name}: ${customer.total_reservations} reservas</li>`).join('');
                document.getElementById("topCustomers").innerHTML = topCustomersList;

                const reservationsPerWeekList = data.totalReservationsPerWeek.map(week => `<li>En esta semana hay un total de ${week.total_reservations} reservas</li>`).join('');
                document.getElementById("reservationsPerWeek").innerHTML = reservationsPerWeekList;

                document.getElementById("stats-content").style.display = "flex";
            })
            .catch(error => console.error("Error:", error))
            .finally(() => {
                document.getElementById("spinner").style.display = "none"; 
            });
    };
</script>

<style>
    .loader {
        border: 8px solid #f3f3f3; 
        border-top: 8px solid #3498db; 
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
        margin: 20px auto; 
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    #spinner {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100px; 
    }
</style>
