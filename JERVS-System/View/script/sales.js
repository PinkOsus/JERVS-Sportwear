document.addEventListener('DOMContentLoaded', function() {
    // Sample data - Replace this shit with the real ones inside your shitty database
    const monthlySalesData = {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [{
        label: 'Monthly Sales (₱)',
        data: [18500, 19200, 21000, 19800, 22400, 24100, 23500, 22800, 24200, 23800, 25500, 26800],
        backgroundColor: 'rgba(26, 26, 26, 0.7)',
        borderColor: 'rgba(26, 26, 26, 1)',
        borderWidth: 1,
        borderRadius: 4,
        hoverBackgroundColor: 'rgba(26, 26, 26, 1)'
      }]
    };
  
    // Chart configuration
    const config = {
      type: 'bar',
      data: monthlySalesData,
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'top',
            labels: {
              font: {
                family: "'Inter', sans-serif",
                size: 13
              },
              color: '#333'
            }
          },
          tooltip: {
            backgroundColor: 'rgba(26, 26, 26, 0.9)',
            titleFont: {
              family: "'Inter', sans-serif",
              size: 14
            },
            bodyFont: {
              family: "'Inter', sans-serif",
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
              },
              font: {
                family: "'Inter', sans-serif"
              }
            },
            grid: {
              color: 'rgba(0, 0, 0, 0.05)'
            }
          },
          x: {
            grid: {
              display: false
            },
            ticks: {
              font: {
                family: "'Inter', sans-serif"
              }
            }
          }
        }
      }
    };
  
    // Create the chart
    const salesChart = new Chart(
      document.getElementById('salesChart'),
      config
    );
  });