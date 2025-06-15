// Bar Chart - Sales by Category
document.addEventListener('DOMContentLoaded', function () {
  //fetch total revenue
  fetch("../../Controller/Report/get_report_sales.php")
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        const total = parseFloat(data.total_revenue).toLocaleString();
        document.getElementById("totalRevenue").textContent = "₱" + total;
      } else {
        console.error("Server error:", data.message);
      }
    })
    .catch(err => console.error("Fetch error:", err));
  
  //fetch total orders
  fetch("../../Controller/Report/get_completed_orders.php")
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        document.getElementById("ordersCompleted").textContent = parseInt(data.total_orders).toLocaleString();
      } else {
        console.error("Server error:", data.message);
      }
    })
    .catch(err => console.error("Fetch error:", err));
  
  //fetch total ongoing orders
  fetch("../../Controller/Report/get_ongoing_orders.php")
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        document.getElementById("ongoingOrders").textContent = parseInt(data.total_ongoing).toLocaleString();
      } else {
        console.error("Server error:", data.message);
      }
    })
    .catch(err => console.error("Fetch error:", err));

  const barChart = new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
      labels: ['T-Shirts', 'Hoodies', 'Jeans', 'Jackets', 'Caps'],
      datasets: [{
        label: 'Items Sold',
        data: [120, 80, 60, 40, 17],
        backgroundColor: '#3498db',
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // Pie Chart - Stock Levels
  const pieChart = new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
      labels: ['T-Shirts', 'Hoodies', 'Jeans', 'Jackets', 'Caps'],
      datasets: [{
        label: 'Stock Level',
        data: [150, 90, 75, 50, 30],
        backgroundColor: ['#1abc9c', '#f39c12', '#9b59b6', '#e74c3c', '#2ecc71'],
      }]
    },
    options: {
      responsive: true
    }
  });
});
