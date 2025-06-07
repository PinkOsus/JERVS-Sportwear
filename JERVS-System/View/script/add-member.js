document.addEventListener('DOMContentLoaded', function() {
    const openBtn = document.getElementById('openAddMemberBtn');
    const modal = document.getElementById('addMemberPanel');
    const form = document.getElementById('addUserForm');
    const messageBox = document.getElementById('addUserMessage');
    const passwordInput = form.querySelector('input[name="password"]');
    const togglePassword = form.querySelector('.toggle-password');
    const passwordStrength = form.querySelector('.password-strength');
    
    // Open modal
    openBtn.addEventListener('click', function() {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    });
    
    // Close modal
    window.closeModal = function() {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
        form.reset();
        messageBox.style.display = 'none';
    }
    
    // Toggle password visibility
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    });
    
    // Password strength indicator
    passwordInput.addEventListener('input', function() {
        const strength = calculatePasswordStrength(this.value);
        passwordStrength.style.width = strength + '%';
        passwordStrength.style.backgroundColor = getStrengthColor(strength);
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Simulate form submission (replace with actual AJAX call)
        setTimeout(() => {
            messageBox.textContent = 'Member added successfully!';
            messageBox.className = 'message-box success';
            messageBox.style.display = 'block';
            
            // Reset form after 2 seconds
            setTimeout(() => {
                form.reset();
                closeModal();
            }, 2000);
        }, 1000);
    });
    
    // Click outside modal to close
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
    
    // Helper functions
    function calculatePasswordStrength(password) {
        let strength = 0;
        if (password.length > 0) strength += 20;
        if (password.length >= 8) strength += 20;
        if (/[A-Z]/.test(password)) strength += 20;
        if (/[0-9]/.test(password)) strength += 20;
        if (/[^A-Za-z0-9]/.test(password)) strength += 20;
        return Math.min(strength, 100);
    }
    
    function getStrengthColor(strength) {
        if (strength < 40) return '#f44336';
        if (strength < 70) return '#ff9800';
        return '#4caf50';
    }
});