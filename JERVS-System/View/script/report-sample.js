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
  
  //fetching
  let barChart;
  
  function updateChart(days){
    fetch("../../Controller/Report/get_sales_data.php?days=" + days)
      .then(function(res){
        return res.json();
      })
      .then(function(salesData) {
        var ctx = document.getElementById('barChart').getContext('2d');

            if (barChart) {
                barChart.destroy();
            }

            barChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: salesData.labels,
                    datasets: [{
                        label: 'Items Sold',
                        data: salesData.data,
                        backgroundColor: '#3498db'
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
      })
      .catch(err => console.error("Fetch error:", err));
  }
  //initial chart
  updateChart(30);

  //if it change
  document.getElementById('timeRange').addEventListener('change', function () {
    updateChart(this.value);
  });

  // Pie Chart - Stock Levels
  fetch("../../Controller/Report/get_stock_levels.php")
    .then(res => res.json())
    .then(data => {
      if(data.success){
        const labels = data.stock_data.map(item => item.name);
        const quantities = data.stock_data.map(item => item.quantity);

        // Dynamically generate background colors
        const bgColors = labels.map((_, i) => {
          const colors = ['#1abc9c', '#f39c12', '#9b59b6', '#e74c3c', '#2ecc71', '#34495e', '#fd79a8'];
          return colors[i % colors.length]; // loop if not enough colors
        });

        new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
            label: 'Stock Level',
            data: quantities,
            backgroundColor: bgColors
          }]
        },
        options: {
          responsive: true
        }
        });
      }else {
        console.error("Server error:", data.message);
      }
    })
    .catch(err => console.error("Fetch error:", err));
});
