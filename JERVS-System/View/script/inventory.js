document.addEventListener('DOMContentLoaded', function() {
    const openBtn = document.getElementById('openAddProductBtn');
    const panel = document.getElementById('addProductPanel');
    
    // Initialize panel state
    panel.style.display = 'none';
    
    // Toggle product panel
    openBtn.addEventListener('click', () => {
        panel.style.display = panel.style.display === 'none' ? 'flex' : 'none';
    });
    
    // Form submission handling
    const addProductForm = document.getElementById('addProductForm');
    if (addProductForm) {
        addProductForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const messageBox = document.getElementById('addProductMessage');
                messageBox.style.display = 'block';
                
                if (data.success) {
                    messageBox.textContent = 'Product added successfully';
                    messageBox.style.color = 'green';
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    messageBox.textContent = 'Error: ' + data.message;
                    messageBox.style.color = 'red';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const messageBox = document.getElementById('addProductMessage');
                messageBox.style.display = 'block';
                messageBox.textContent = 'An error occurred';
                messageBox.style.color = 'red';
            });
        });
    }
});