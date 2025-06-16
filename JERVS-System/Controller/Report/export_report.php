<?php
include('../../config/database.php');
include('../../Controller/sessioncheck.php');

// Get request data
$data = json_decode(file_get_contents('php://input'), true);
$format = $data['format'] ?? 'excel';
$timePeriod = $data['timePeriod'] ?? 'last_30_days';

// Query database based on filters
$query = "SELECT * FROM orders_tbl WHERE order_date >= DATE_SUB(NOW(), INTERVAL ";
$query .= ($timePeriod === 'last_90_days') ? "90 DAY" : "30 DAY";
$result = $conn->query($query);

// Generate report data
$reportData = [];
while ($row = $result->fetch_assoc()) {
    $reportData[] = [
        'Order ID' => $row['id'],
        'Item Name' => $row['item_name'],
        'Quantity' => $row['qty'],
        'Total Price' => $row['total_price'],
        'Status' => ucfirst($row['current_phase']),
        'Order Date' => $row['order_date']
    ];
}

// Export based on format
switch ($format) {
    case 'pdf':
        exportPDF($reportData);
        break;
    case 'csv':
        exportCSV($reportData);
        break;
    default:
        exportExcel($reportData);
}

function exportExcel($data) {
    require_once '../../vendor/autoload.php';
    
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // Add headers
    $headers = array_keys($data[0]);
    $sheet->fromArray($headers, NULL, 'A1');
    
    // Add data
    $sheet->fromArray($data, NULL, 'A2');
    
    // Set headers
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="business_report.xlsx"');
    
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit;
}

function exportCSV($data) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="business_report.csv"');
    
    $output = fopen('php://output', 'w');
    
    // Add headers
    fputcsv($output, array_keys($data[0]));
    
    // Add data
    foreach ($data as $row) {
        fputcsv($output, $row);
    }
    
    fclose($output);
    exit;
}

function exportPDF($data) {
    require_once '../../vendor/autoload.php';
    
    $mpdf = new \Mpdf\Mpdf();
    $html = '<h1>Business Report</h1><table border="1"><tr>';
    
    // Add headers
    foreach (array_keys($data[0]) as $header) {
        $html .= '<th>'.$header.'</th>';
    }
    $html .= '</tr>';
    
    // Add data
    foreach ($data as $row) {
        $html .= '<tr>';
        foreach ($row as $value) {
            $html .= '<td>'.$value.'</td>';
        }
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    $mpdf->WriteHTML($html);
    
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment;filename="business_report.pdf"');
    
    $mpdf->Output('php://output', 'D');
    exit;
}