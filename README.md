# Sistema de Reservas de Canchas

¡Bienvenido al Sistema de Reservas de Canchas! Esta aplicación permite gestionar reservas de canchas de fútbol de forma sencilla, con opciones de login, registro, administración de usuarios y gestión completa de turnos.


## 📋 Tabla de Contenidos
- [Características](#características)
- [Instalación](#instalación)
- [Uso](#uso)
- [Contribuir](#contribuir)
- [Licencia](#licencia)
- [Autores](#autores)

## ✨ Características
- Gestión de reservas para canchas de fútbol 5 y fútbol 8.
- Posibilidad de añadir, modificar y eliminar canchas.
- Visualización de horarios disponibles y confirmación de reservas.
- Tema oscuro con estilos personalizados utilizando Bulma CSS.
- Integración de alertas con SweetAlert2 para una mejor experiencia de usuario.

## 🚀 Instalación

Sigue estos pasos para configurar el proyecto localmente:

1. Clona el repositorio:

git clone https://github.com/Hdauu/canchas.git
Dirígete al directorio del proyecto:
bash

cd canchas
Configura la base de datos:

Ve a DB/sistemacanchas y colocala en tu localhost


define('DB_SERVER', 'servidor');
define('DB_USERNAME', 'usuario');
define('DB_PASSWORD', 'contraseña');
define('DB_NAME', 'nombre_base_datos');
Instala las dependencias necesarias:

Asegúrate de tener composer instalado para manejar dependencias en PHP.
Inicia el servidor local:



💻 Uso
Reservas: Navega a la sección de reservas para ver las canchas disponibles, seleccionar un horario, y confirmar la reserva.
Administración: Si tienes permisos de administrador, accede a la sección de administración para gestionar usuarios y canchas.
🛠️ Contribuir
¡Las contribuciones son bienvenidas! Si deseas contribuir al proyecto, sigue estos pasos:

Haz un fork del repositorio.
Crea una nueva rama para tu funcionalidad (git checkout -b feature/nueva-funcionalidad).
Realiza tus cambios y haz commit (git commit -m 'Añadir nueva funcionalidad').
Sube la rama (git push origin feature/nueva-funcionalidad).
Abre un Pull Request en GitHub.
📝 Licencia
Este proyecto está bajo la licencia MIT. Consulta el archivo LICENSE para más detalles.

👥 Autores
Hdauu - Desarrollador principal del proyecto. Visita su GitHub.
🔗 Recursos Adicionales
Documentación de Bulma CSS
SweetAlert2 - Guía de Uso
