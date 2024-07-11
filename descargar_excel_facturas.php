<?php
// Incluir la biblioteca PHPExcel (asegúrate de haberla instalado o incluida en tu proyecto)
require 'PHPExcel/PHPExcel.php';

// Incluir la conexión a la base de datos
include 'includes/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el parámetro de búsqueda desde la URL
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// Consulta SQL para obtener las facturas filtradas por nombre de paciente
$sql = "SELECT 
            f.id_factura,
            CONCAT(p.nombre, ' ', p.apellido) AS nombre_paciente,
            f.fecha_emision,
            f.total,
            CASE 
                WHEN f.pagada = 1 THEN 'LIQUIDADA'
                WHEN f.pagada = 0 THEN 'ADEUDO'
                ELSE 'DESCONOCIDO'  -- Opcional: para manejar otros posibles valores
            END AS Estatus
        FROM 
            facturas f
        JOIN 
            pacientes p ON f.id_paciente = p.id_paciente
        WHERE (p.nombre LIKE '%$search%' OR p.apellido LIKE '%$search%');";

$resultado = $conn->query($sql);

// Crear un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Configurar las propiedades del documento Excel
$objPHPExcel->getProperties()->setCreator("Tu Nombre")
                             ->setLastModifiedBy("Tu Nombre")
                             ->setTitle("Facturas Médicas")
                             ->setSubject("Facturas Médicas")
                             ->setDescription("Facturas médicas exportadas en Excel.")
                             ->setKeywords("facturas médicas excel")
                             ->setCategory("Datos de facturas");

// Agregar datos al documento Excel
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID Factura');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Paciente');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Fecha de Emisión');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Total');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Estatus');

$row = 2; // Iniciar desde la fila 2 para los datos
if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $fila['id_factura']);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $fila['nombre_paciente']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $fila['fecha_emision']);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $fila['total']);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $fila['Estatus']);
        $row++;
    }
}

// Ajustar el ancho de las columnas automáticamente
foreach(range('A','E') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
}

// Nombre del archivo de descarga
$filename = 'facturas_medicas_' . date('YmdHis') . '.xlsx';

// Configurar encabezados para la descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Crear el escritor de Excel (Excel2007)
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

// Cerrar la conexión y terminar la ejecución del script
$conn->close();
exit;
?>
