<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item has-background-grey-darker has-text-white" href="/canchas/index.php" style="text-shadow: none;">
            <h1 class="title is-6 has-text-white has-text-weight-normal" style="text-shadow: none;">Sistema de Reservas</h1>
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <div class="navbar-item has-dropdown is-hoverable">
                <a href="/canchas/index.php" class="navbar-link">Reservas</a>

                <div class="navbar-dropdown">
                    <a href="/canchas/app/views/add-edit-reservation.php" class="navbar-item">Nueva</a>
                </div>
            </div>
            <a href="/canchas/?view=clients" class="navbar-item">Clientes</a>
            <a href="/canchas/?view=fields" class="navbar-item">Canchas</a>
            <a href="/canchas/?view=estadisticas" class="navbar-item">Estadísticas</a>
            <!-- <a href="/canchas/?view=calendar" class="navbar-item">Calendario</a> -->
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a href="/canchas/app/controllers/logout.php" class="button has-background-grey-darker has-text-white" style="text-shadow: none;">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const burger = document.querySelector('.navbar-burger');
        const menu = document.getElementById(burger.dataset.target);

        burger.addEventListener('click', () => {
            burger.classList.toggle('is-active');
            menu.classList.toggle('is-active');
            burger.setAttribute('aria-expanded', burger.classList.contains('is-active'));
        });
    });
</script>
