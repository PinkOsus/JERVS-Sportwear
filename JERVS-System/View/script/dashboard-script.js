document.addEventListener('DOMContentLoaded', function () {
  // Sample data - Replace this shit with the real ones inside your shitty database
  fetch('../../Controller/Dashboard/get_monthly_sales.php')
    .then(res => res.json())
    .then(data => {
      const monthlySalesData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
          label: 'Monthly Sales (₱)',
          data: data,
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
                label: function (context) {
                  return '₱' + context.raw.toLocaleString();
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: function (value) {
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
    })
    .catch(error => console.error('Error fetching monthly sales:', error));

  //For checking if sales go up or down
  fetch('../../Controller/Dashboard/get_month_comparison.php')
    .then(res => res.json())
    .then(data => {
      const thisMonthAmt = data['this_month'].total_sales || 0;
      const lastMonthAmt = data['last_month'].total_sales || 0;

      const thisMonthOrders = data['this_month'].transactions || 0;
      const lastMonthOrders = data['last_month'].transactions || 0;

      //Update amounts
      document.getElementById('thisMonthAmount').textContent = '₱' + thisMonthAmt.toLocaleString(undefined, { minimumFractionDigits: 2 });
      document.getElementById('lastMonthAmount').textContent = '₱' + lastMonthAmt.toLocaleString(undefined, { minimumFractionDigits: 2 });

      //update order count
      document.getElementById('ordersCompleted').textContent = `${thisMonthOrders} Orders`;
      const orderChangeDiv = document.getElementById('ordersChange');

      //Calculate percentage change
      const changeElement = document.getElementById('thisMonthChange');
      if (lastMonthAmt === 0 && thisMonthAmt === 0) {
        changeElement.textContent = 'No change';
        changeElement.className = 'change';
      } else if (lastMonthAmt === 0) {
        changeElement.textContent = '↑ 100% (New)';
        changeElement.className = 'change positive';
      } else {
        const percentChange = ((thisMonthAmt - lastMonthAmt) / lastMonthAmt) * 100;
        const rounded = percentChange.toFixed(1);
        if (percentChange >= 0) {
          changeElement.textContent = `↑ ${rounded}% from last month`;
          changeElement.className = 'change positive';
        } else {
          changeElement.textContent = `↓ ${Math.abs(rounded)}% from last month`;
          changeElement.className = 'change negative';
        }
      }

      if(lastMonthOrders === 0 && thisMonthOrders === 0){
        orderChangeDiv.textContent = 'No change';
        orderChangeDiv.className = 'metric-change';
      }else if(lastMonthOrders === 0){
        orderChangeDiv.textContent = '↑ 100% vs. last month';
        orderChangeDiv.className = 'metric-change positive';
      }else{
        const orderChange = ((thisMonthOrders - lastMonthOrders)/lastMonthOrders) * 100;
        const orderChangeRounded = orderChange.toFixed(1);

        if(orderChange >= 0){
          orderChangeDiv.textContent = `↑ ${orderChangeRounded}% vs. last month`;
          orderChangeDiv.className = 'metric-change positive';
        }else{
          orderChangeDiv.textContent = `↓ ${Math.abs(orderChangeRounded)}% vs. last month`;
          orderChangeDiv.className = 'metric-change negative';
        }
      }
    })
    .catch(error => console.error('Error fetching monthly sales:', error));
});