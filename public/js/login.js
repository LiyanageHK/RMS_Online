document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.querySelector("form");

    loginForm.addEventListener("submit", function (event) {
        const email = document.getElementById("email");
        const password = document.getElementById("password");

        let errors = [];

        // Reset error classes
        email.classList.remove('error');
        password.classList.remove('error');

        // Validate fields
        if (!email.value.trim()) {
            errors.push("Email is required.");
            email.classList.add('error');
        }

        if (!password.value.trim()) {
            errors.push("Password is required.");
            password.classList.add('error');
        }

        // Show all errors in one alert
        if (errors.length > 0) {
            event.preventDefault();
            alert(errors.join("\n"));
        }
    });
});





    // Wait until the document is fully loaded
    document.addEventListener("DOMContentLoaded", function () {
        // Password toggle functionality
        let togglePassword = document.getElementById('togglePassword');
        let passwordInput = document.getElementById('password');

        // Toggle the password visibility when the icon is clicked
        togglePassword.addEventListener('click', function () {
            // Check the type of the input field and toggle it between 'password' and 'text'
            let type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the eye-slash icon when the password is visible
            this.classList.toggle('fa-eye-slash');
        });
    });



