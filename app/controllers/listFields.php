<?php
require __DIR__ . '/../models/Connection.php';
require __DIR__ . '/../models/FieldsModel.php';
$fieldObj = new Fields();

$conn = Connection::newConnection();

$filterInfo = isset($_GET['filter_info']) && $_GET['filter_info'] != '' ? $_GET['filter_info'] : null;

$fieldsList = $fieldObj->getAllFields($conn, $filterInfo);

try {
    $rows = "";
    foreach ($fieldsList as $field) {
        $fieldType = $fieldObj->getFieldTypeName($conn, $field['field_id']);
        $field['FieldType_id'] = $fieldType['FieldType_name'];
        $rows .= "
                <tr id='row-{$field['field_id']}'>
                    <td>{$field['field_id']}</td>
                    <td>{$field['FieldType_id']}</td>
                    
                </tr>";
    }
    echo $rows;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
