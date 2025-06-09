// Bar Chart - Sales by Category
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
  