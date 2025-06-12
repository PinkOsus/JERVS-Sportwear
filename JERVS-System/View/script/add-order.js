document.addEventListener('DOMContentLoaded', function() {
    // Toggle add order panel
    const openBtn = document.getElementById('openAddOrderBtn');
    const closeBtn = document.getElementById('closeAddOrderBtn');
    const addOrderPanel = document.getElementById('addOrderPanel');
    
    openBtn.addEventListener('click', function() {
        addOrderPanel.style.display = 'block';
    });
    
    closeBtn.addEventListener('click', function() {
        addOrderPanel.style.display = 'none';
        document.getElementById('addOrderMessage').innerHTML = '';
    });
    
    // Handle form submission with AJAX
    const orderForm = document.getElementById('addOrderForm');
    orderForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(orderForm);
        formData.append('action', 'add_order');
        
        fetch('../../Controller/add_order.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // Add new row to table
                addOrderToTable(data.order);
                // Reset form
                orderForm.reset();
                // Show success message
                document.getElementById('addOrderMessage').innerHTML = 
                    '<p style="color:green;">Order added successfully!</p>';
                // Hide panel after 2 seconds
                setTimeout(() => {
                    addOrderPanel.style.display = 'none';
                    document.getElementById('addOrderMessage').innerHTML = '';
                }, 2000);
            } else {
                document.getElementById('addOrderMessage').innerHTML = 
                    `<p style="color:red;">Error: ${data.message}</p>`;
            }
        })
        .catch(error => {
            document.getElementById('addOrderMessage').innerHTML = 
                '<p style="color:red;">Error submitting form. Please try again.</p>';
        });
    });
    
    // Function to add new order to table
    function addOrderToTable(order) {
        const table = document.getElementById('ordersTable').getElementsByTagName('tbody')[0];
        const balance = order.total_price - order.deposit;
        const lastUpdated = new Date(order.last_updated).toLocaleString();
        
        const newRow = table.insertRow(0);
        newRow.setAttribute('data-id', order.id);
        newRow.innerHTML = `
            <td>${order.item_name}</td>
            <td>${order.qty}</td>
            <td>${parseFloat(order.deposit).toFixed(2)}</td>
            <td>${parseFloat(order.total_price).toFixed(2)}</td>
            <td>${balance.toFixed(2)}</td>
            <td>${order.current_phase}</td>
            <td>${lastUpdated}</td>
            <td class="action-buttons">
                <button class="edit-btn" data-id="${order.id}">EDIT</button>
                <button class="view-btn" data-id="${order.id}">VIEW</button>
                <button class="delete-btn" data-id="${order.id}">DELETE</button>
                <button class="done-btn" data-id="${order.id}">DONE</button>
            </td>
        `;
        
        // Add event listeners to new buttons
        addButtonEventListeners(newRow);
    }
    
    // Add event listeners to all action buttons
    function addButtonEventListeners(row) {
        row.querySelector('.edit-btn').addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            window.location.href = `edit_order.php?id=${id}`;
        });
        
        row.querySelector('.view-btn').addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            window.location.href = `view_details.php?id=${id}`;
        });
        
        row.querySelector('.delete-btn').addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            if(confirm('Are you sure you want to delete this order?')) {
                deleteOrder(id);
            }
        });
        
        row.querySelector('.done-btn').addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            markAsDone(id);
        });
    }
    
    // Initialize event listeners for existing rows
    document.querySelectorAll('#ordersTable tbody tr').forEach(row => {
        addButtonEventListeners(row);
    });
    
    // Function to delete order
    function deleteOrder(id) {
        fetch(`../../Controller/Order-Management/delete.php?id=${id}`, {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                document.querySelector(`tr[data-id="${id}"]`).remove();
            } else {
                alert('Error deleting order: ' + data.message);
            }
        });
    }
    
    // Function to mark order as done
    function markAsDone(id) {
        fetch(`done.php?id=${id}`, {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                location.reload(); // Refresh to show updated status
            } else {
                alert('Error updating order: ' + data.message);
            }
        });
    }
});