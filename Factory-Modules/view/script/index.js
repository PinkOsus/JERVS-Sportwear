document.addEventListener('DOMContentLoaded', function() {
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