<?php
// Corrected path with proper directory traversal
require_once __DIR__ . '/../../vendor/autoload.php'; // Fixed path
include('../../config/database.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

try {
    // Create Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Business Report');

    // Header row with styling
    $headers = ['Order ID', 'Order Name', 'Quantity', 'Total Price', 'Date Completed'];
    $sheet->fromArray($headers, null, 'A1');
    
    // Style headers
    $headerStyle = [
        'font' => ['bold' => true],
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'E6E6E6']]
    ];
    $sheet->getStyle('A1:E1')->applyFromArray($headerStyle);

    // Query your database
    $query = "SELECT sales_id, order_name, qty, total_price, date_completed FROM sales_tbl";
    $result = $conn->query($query);

    if (!$result) {
        throw new Exception("Database query failed: " . $conn->error);
    }

    // Add data rows
    $rowData = [];
    while ($row = $result->fetch_assoc()) {
        $rowData[] = [
            $row['sales_id'],
            $row['order_name'],
            $row['qty'],
            $row['total_price'],
            $row['date_completed']
        ];
    }
    
    if (!empty($rowData)) {
        $sheet->fromArray($rowData, null, 'A2');
    }

    // Auto-size columns
    foreach (range('A', 'E') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Set headers
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="business_report_'.date('Y-m-d').'.xlsx"');
    header('Cache-Control: max-age=0');

    // Write and output
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    
} catch (Exception $e) {
    // Log error and display user-friendly message
    error_log("Export Error: " . $e->getMessage());
    die("An error occurred while generating the report. Please try again later.");
}
exit;
?>