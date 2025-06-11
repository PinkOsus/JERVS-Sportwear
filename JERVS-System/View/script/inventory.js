document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const productSearch = document.getElementById('productSearch');
    const categoryFilter = document.getElementById('categoryFilter');
    const inventoryTable = document.querySelector('.inventory-table tbody');
    const rows = inventoryTable.querySelectorAll('tr');
    
    // Filter products based on search and category
    function filterProducts() {
        const searchTerm = productSearch.value.toLowerCase();
        const selectedCategory = categoryFilter.value.toLowerCase();
        
        rows.forEach(row => {
            const productName = row.querySelector('.product-details strong').textContent.toLowerCase();
            const productCategory = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            
            const nameMatch = productName.includes(searchTerm);
            const categoryMatch = selectedCategory === '' || productCategory === selectedCategory;
            
            if(nameMatch && categoryMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    productSearch.addEventListener('input', filterProducts);
    categoryFilter.addEventListener('change', filterProducts);
    
    // Delete product confirmation
    const deleteButtons = document.querySelectorAll('.btn-action.delete');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-id');
            
            if(confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
                // Send AJAX request to delete product
                fetch(`delete_product.php?id=${productId}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        this.closest('tr').remove();
                        alert('Product deleted successfully');
                    } else {
                        alert('Error deleting product: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the product');
                });
            }
        });
    });
    
    // Export functionality
    const exportBtn = document.getElementById('exportBtn');
    
    exportBtn.addEventListener('click', function() {
        // In a real implementation, this would generate a CSV or Excel file
        alert('Export functionality will be implemented here');
    });
});