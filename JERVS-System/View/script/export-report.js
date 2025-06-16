document.getElementById('exportReportBtn').addEventListener('click', function() {
    // Get current filter values
    const timePeriod = document.querySelector('.header-actions select').value;
    
    // Send request to export script
    fetch('../../Controller/Report/export_report.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            format: 'excel', // or 'pdf', 'csv'
            timePeriod: timePeriod
        })
    })
    .then(response => {
        if (!response.ok) throw new Error('Export failed');
        return response.blob();
    })
    .then(blob => {
        // Create download link
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `business-report-${new Date().toISOString().slice(0,10)}.xlsx`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Export failed: ' + error.message);
    });
});