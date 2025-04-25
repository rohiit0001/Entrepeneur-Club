// Form Validation
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            let isValid = true;
            
            // Get all required inputs
            const requiredInputs = form.querySelectorAll('[required]');
            
            // Check each required input
            requiredInputs.forEach(input => {
                if (!validateInput(input)) {
                    isValid = false;
                }
            });
            
            // If form is not valid, prevent submission
            if (!isValid) {
                event.preventDefault();
            }
        });
        
        // Add blur event listeners to all inputs for real-time validation
        const inputs = form.querySelectorAll('input, textarea, select');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateInput(this);
            });
            
            // For password confirmation
            if (input.id === 'confirm_password') {
                input.addEventListener('input', function() {
                    validatePasswordMatch();
                });
            }
            
            if (input.id === 'password' && form.querySelector('#confirm_password')) {
                input.addEventListener('input', function() {
                    validatePasswordMatch();
                });
            }
        });
    });
    
    // Validate individual input
    function validateInput(input) {
        const errorElement = input.nextElementSibling;
        let isValid = true;
        let errorMessage = '';
        
        // Clear previous error
        if (errorElement && errorElement.classList.contains('error-message')) {
            errorElement.textContent = '';
        }
        
        // Check if empty
        if (input.hasAttribute('required') && !input.value.trim()) {
            isValid = false;
            errorMessage = 'This field is required';
        } 
        // Email validation
        else if (input.type === 'email' && input.value.trim()) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(input.value)) {
                isValid = false;
                errorMessage = 'Please enter a valid email address';
            }
        }
        // Password validation
        else if (input.id === 'password' && input.value.trim()) {
            if (input.value.length < 8) {
                isValid = false;
                errorMessage = 'Password must be at least 8 characters long';
            }
        }
        
        // Display error message if not valid
        if (!isValid && errorElement && errorElement.classList.contains('error-message')) {
            errorElement.textContent = errorMessage;
        } else if (!isValid) {
            // Create error message element if it doesn't exist
            const errorSpan = document.createElement('span');
            errorSpan.className = 'error-message';
            errorSpan.textContent = errorMessage;
            errorSpan.style.color = 'red';
            errorSpan.style.fontSize = '0.8rem';
            errorSpan.style.display = 'block';
            errorSpan.style.marginTop = '5px';
            
            input.parentNode.insertBefore(errorSpan, input.nextSibling);
        }
        
        // Update input styling
        if (isValid) {
            input.classList.remove('invalid');
            input.classList.add('valid');
        } else {
            input.classList.remove('valid');
            input.classList.add('invalid');
        }
        
        return isValid;
    }
    
    // Validate password match
    function validatePasswordMatch() {
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        
        if (!password || !confirmPassword) return;
        
        const errorElement = confirmPassword.nextElementSibling;
        
        if (password.value !== confirmPassword.value) {
            confirmPassword.classList.remove('valid');
            confirmPassword.classList.add('invalid');
            
            if (errorElement && errorElement.classList.contains('error-message')) {
                errorElement.textContent = 'Passwords do not match';
            } else {
                const errorSpan = document.createElement('span');
                errorSpan.className = 'error-message';
                errorSpan.textContent = 'Passwords do not match';
                errorSpan.style.color = 'red';
                errorSpan.style.fontSize = '0.8rem';
                errorSpan.style.display = 'block';
                errorSpan.style.marginTop = '5px';
                
                confirmPassword.parentNode.insertBefore(errorSpan, confirmPassword.nextSibling);
            }
            
            return false;
        } else if (confirmPassword.value) {
            confirmPassword.classList.remove('invalid');
            confirmPassword.classList.add('valid');
            
            if (errorElement && errorElement.classList.contains('error-message')) {
                errorElement.textContent = '';
            }
            
            return true;
        }
    }
});