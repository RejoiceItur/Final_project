<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'final_proj';

// Include PHPExcel library
require 'PHPExcel/Classes/PHPExcel.php';

// Create a new PHPExcel object
$objPHPExcel = new PHPExcel();

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch data from the table and add it to the Excel sheet
function addDataToSheet($conn, $tableName, $tableTitle) {
    global $objPHPExcel;

    // Retrieve data from the table
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    // Create a new sheet
    $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex($objPHPExcel->getSheetCount() - 1);
    $sheet = $objPHPExcel->getActiveSheet();
    $sheet->setTitle($tableTitle);

    // Set column headings
    $headings = array('ID', 'Product name', 'Seller name', 'Date Added');
    $colIndex = 0;
    foreach ($headings as $heading) {
        $sheet->setCellValueByColumnAndRow($colIndex, 1, $heading);
        $colIndex++;
    }

    // Check if there are any rows in the result
    if ($result->num_rows > 0) {
        // Output data of each row
        $rowIndex = 2; // Start from the second row after headings
        while($row = $result->fetch_assoc()) {
            $colIndex = 0;
            foreach ($row as $value) {
                $sheet->setCellValueByColumnAndRow($colIndex, $rowIndex, $value);
                $colIndex++;
            }
            $rowIndex++;
        }
    }
}

addDataToSheet($conn, "products_deleted", "Deleted Products Data");

// Close the database connection
$conn->close();

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="deleted_products.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

// Make sure no output has been sent before
if (ob_get_contents()) {
    ob_end_clean();
}

// Send Excel file to browser
$objWriter->save('php://output');

// Redirect to display_records.php after sending the Excel file
header('Location: display_records.php');
exit;
?>
