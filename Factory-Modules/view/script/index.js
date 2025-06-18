// Toggle password visibility
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector('input[name="password"]');
    
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
        });
    }

    // Form submission
    document.getElementById("loginForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const messageBox = document.getElementById("message");

        fetch("../../Controller/login.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            messageBox.className = data.success ? 'success' : 'error';
            messageBox.textContent = data.message || (data.success ? "Login Successful" : "Login failed");
            
            if(data.success) {
                setTimeout(() => {
                    window.location.href = "../orders/order.php";
                }, 1000);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            messageBox.className = 'error';
            messageBox.textContent = "An error occurred. Please try again.";
        });
    });
});