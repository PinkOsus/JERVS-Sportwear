document.addEventListener('DOMContentLoaded', function() {
  // Load monthly sales data for chart
  fetch('../../Controller/Dashboard/get_monthly_sales.php')
    .then(res => res.json())
    .then(data => {
      const ctx = document.getElementById('salesChart').getContext('2d');
      const chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [{
            label: 'Monthly Sales (₱)',
            data: data,
            backgroundColor: '#284cff',
            borderColor: '#284cff',
            borderWidth: 1,
            borderRadius: 4,
            hoverBackgroundColor: '#1a3bd6'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              backgroundColor: 'rgba(40, 76, 255, 0.9)',
              titleFont: {
                size: 14,
                weight: '600'
              },
              bodyFont: {
                size: 13
              },
              padding: 10,
              usePointStyle: true,
              callbacks: {
                label: function(context) {
                  return '₱' + context.raw.toLocaleString();
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: function(value) {
                  return '₱' + value.toLocaleString();
                }
              },
              grid: {
                color: 'rgba(0, 0, 0, 0.05)'
              }
            },
            x: {
              grid: {
                display: false
              }
            }
          }
        }
      });
    })
    .catch(error => console.error('Error loading chart data:', error));

  // Load metrics data
  fetch('../../Controller/Dashboard/get_month_comparison.php')
    .then(res => res.json())
    .then(data => {
      const thisMonth = data.this_month || 0;
      const lastMonth = data.last_month || 0;
      
      // Update monthly sales card
      document.querySelectorAll('.metric-card .metric-value')[1].textContent = 
        '₱' + thisMonth.toLocaleString(undefined, {minimumFractionDigits: 2});
      
      // Update comparison card
      let changePercent = 0;
      if (lastMonth > 0) {
        changePercent = ((thisMonth - lastMonth) / lastMonth) * 100;
      }
      
      const changeElement = document.querySelectorAll('.metric-card .metric-change')[2];
      changeElement.textContent = Math.abs(changePercent).toFixed(1) + '% ' + 
        (changePercent >= 0 ? 'increase' : 'decrease');
      changeElement.className = changePercent >= 0 ? 'metric-change positive' : 'metric-change negative';
      
      // You would need to add a similar endpoint for today's sales
      // For now we'll simulate it
      const todaySales = thisMonth / 30; // Approximate daily average
      document.querySelectorAll('.metric-card .metric-value')[0].textContent = 
        '₱' + todaySales.toLocaleString(undefined, {minimumFractionDigits: 2});
      document.querySelectorAll('.metric-card .metric-change')[0].textContent = 'Updated just now';
      document.querySelectorAll('.metric-card .metric-change')[0].className = 'metric-change positive';
    })
    .catch(error => console.error('Error loading metrics:', error));
});