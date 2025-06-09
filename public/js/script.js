document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            let errors = [];
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (name === '') {
                errors.push('Name is required.');
            }
            if (email === '') {
                errors.push('Email is required.');
            } else if (!/^\S+@\S+\.\S+$/.test(email)) { // Basic email regex
                errors.push('Invalid email format.');
            }
            if (password === '') {
                errors.push('Password is required.');
            } else if (password.length < 6) {
                errors.push('Password must be at least 6 characters long.');
            }
            if (password !== confirmPassword) {
                errors.push('Passwords do not match.');
            }

            if (errors.length > 0) {
                event.preventDefault(); // Stop form submission
                // Display errors in a dedicated error box
                const errorBox = document.querySelector('.error-message-box') || document.createElement('div');
                if (!document.querySelector('.error-message-box')) {
                    errorBox.className = 'error-message-box';
                    registerForm.prepend(errorBox);
                }
                errorBox.innerHTML = '';
                errors.forEach(err => {
                    const p = document.createElement('p');
                    p.className = 'error-message';
                    p.textContent = err;
                    errorBox.appendChild(p);
                });
            }
        });
    }
});