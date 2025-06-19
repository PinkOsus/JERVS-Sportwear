document.addEventListener('DOMContentLoaded', function () {
    const openBtn = document.getElementById('openAddOrderBtn');
    const panel = document.getElementById('addOrder');
    const addOrderForm = document.getElementById('addOrderForm');
    const today = new Date().toISOString().split('T')[0];

    //set to today and for future onyl
    document.getElementById("pickupDate").setAttribute("min", today);
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

    const prices = {
        material: {
            sublimation: 200,
            mesh: 150,
            none: 0
        },
        type: {
            tshirt: 150,
            jersey: 200,
            short: 170,
            hoodie: 250
        }
    };

    const qtyInput = document.getElementById('qtyInput');
    const materialSelect = document.getElementById('materialSelect');
    const typeSelect = document.getElementById('typeSelect');
    const ghostTotal = document.getElementById('ghostTotal');
    const tPriceInput = document.getElementById('tPriceInput');

    [materialSelect, typeSelect, qtyInput].forEach(el => {
        el.addEventListener('input', calculateGhostPrice);
    });

    function calculateGhostPrice() {
        const material = materialSelect.value;
        const type = typeSelect.value;
        const qty = parseInt(qtyInput.value) || 0;

        const basePrice = (prices.material[material] || 0) + (prices.type[type] || 0);
        const total = basePrice * qty;

        ghostTotal.value = '₱' + total.toFixed(2);
    }
});