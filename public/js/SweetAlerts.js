document.addEventListener('DOMContentLoaded', function () {

    // prueba
    // console.log('El DOM ha sido cargado completamente');
    // Selecciona todos los elementos con la clase 'swal-confirm'
    const swalButtons = document.querySelectorAll('.swal-confirm');
    const swaledits = document.querySelectorAll('.swal-edit');

    // Asigna un evento de clic a cada botón con la clase 'swal-confirm'
    swalButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // Evita el comportamiento predeterminado del enlace

            const url = this.getAttribute('href'); // Obtiene la URL del atributo 'href'

            // Muestra un SweetAlert2 de confirmación
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Cambiaras de estado este registro en el aplicativo web',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar',
                confirmButtonColor:  'rgba(255, 102, 0)',
                cancelButtonColor: 'rgba(154, 0, 15)',
                width: '45%',
            }).then((result) => {
                // Si se hace clic en el botón 'Sí, eliminarlo', redirige a la URL
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Listo !",
                        text: "tu resgitro ha cambiado de estado",
                        icon: "success",
                        confirmButtonText: 'Listo',
                        confirmButtonColor: 'rgba(255, 102, 0)',
                        timer: 5000,
                        timerProgressBar: true,

                    });
                    window.location.href = url;
                }
            });
        });
    });
    
    // swal para los editar
    swaledits.forEach(button => {
        button.addEventListener('click', function(e){
            e.preventDefault();

            const url = this.getAttribute('href');

            Swal.fire({
                title: '¿Editar Registro?',
                text: 'ir al formulario de actualizar',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Editar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: 'rgba(255, 102, 0)',
                cancelButtonColor: 'rgba(154, 0, 15)'
            }).then((result) => {
                // si se hace click en guardar
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });

    // alert para los formularios
    const form = document.getElementById('form');
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Evita el envío del formulario por defecto

            // Muestra un SweetAlert2 de confirmación
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¡Estos registros se guardaran!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, enviar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor:  'rgba(255, 102, 0)',
                cancelButtonColor: 'rgba(154, 0, 15)',
            }).then((result) => {
                // Si se hace clic en el botón 'Sí, enviar', envía el formulario
                if (result.isConfirmed) {
                    form.submit(); // Envía el formulario
                }
            });
        });
          
});
        // funcion para ver contraseña
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var toggleButton = document.querySelector(".toggle-password");
            
            if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
            passwordField.type = "password";
            toggleButton.innerHTML = '<i class="fas fa-eye"></i>';
            }
        }
        