(function () {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    
    forms.forEach(form => {
        form.addEventListener('submit', function (event) {
            let isValid = form.checkValidity();
            
            // Validasi konfirmasi password
            let password = form.querySelector('#password');
            let confirmPassword = form.querySelector('#konfirmasiPassword');
            
            if (password && confirmPassword && password.value !== confirmPassword.value) {
                confirmPassword.classList.add('is-invalid');
                confirmPassword.nextElementSibling.textContent = 'Konfirmasi kata sandi harus sama.';
                isValid = false;
            } else {
                confirmPassword.classList.remove('is-invalid');
            }

            if (!isValid) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });
})();
