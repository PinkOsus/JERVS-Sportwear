document.addEventListener('DOMContentLoaded', function () {
    const openBtn = document.getElementById('openAddOrderBtn');
    const closeBtn = document.getElementById('closeAddOrderBtn');
    const panel = document.getElementById('addOrder');
    const addOrderForm = document.getElementById('addOrderForm');

    //adding order form
    addOrderForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch("../../Controller/add_order.php", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                const feedback = document.getElementById("addOrderMessage");

                if (data.success) {
                    feedback.innerText = "Order added Successfully";
                    feedback.style.color = "green";

                    window.location.reload();
                } else {
                    feedback.innerText = "Order adding failed: " + data.message;
                    feedback.style.color = "red";
                }
            })
            .catch(error => {
                console.log("An error occured in ", error);
            });
    });

    openBtn.addEventListener('click', () => {
        panel.style.display = 'flex';
    });

    closeBtn.addEventListener('click', () => {
        panel.style.display = 'none';
    });
});