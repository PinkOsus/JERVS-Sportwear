document.addEventListener('DOMContentLoaded', function () {
    const addProductForm = document.getElementById('addProductForm');
    const openBtn = document.getElementById('openAddProductBtn');
    const panel = document.getElementById('addProductPanel');

    // Initialize panel state
    panel.style.display = 'none';

    // Toggle product panel
    openBtn.addEventListener('click', () => {
        panel.style.display = panel.style.display === 'none' ? 'flex' : 'none';
    });

    // Form submission handling
    addProductForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('../../Controller/Product-Management/add_prod.php', {
            method: 'POST',
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                const feedback = document.getElementById("addProductMessage");

                if (data.success) {
                    feedback.innerText = "Item added Successfully";
                    feedback.style.color = "green";

                    setTimeout(() => {
                        this.reset();

                        window.location.reload();
                    }, 2000);
                } else {
                    feedback.innerText = "Item adding failed: " + data.message;
                    feedback.style.color = "red";
                }
            })
            .catch(error => {
                console.log("An error occured in ", error);
            });
    });
});