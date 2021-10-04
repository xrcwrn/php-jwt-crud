<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function msg($success, $status, $message, $extra = []) {
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
            ], $extra);
}

require '../../classes/Database.php';
require '../../classes/Bill.php';
require '../../middlewares/Auth.php';
require './BillValidation.php';

$allHeaders = getallheaders();
$db_connection = new Database();
$conn = $db_connection->dbConnection();
$auth = new Auth($conn, $allHeaders);

$data = json_decode(file_get_contents("php://input"));
$returnData = [];

// IF REQUEST METHOD IS NOT EQUAL TO POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $returnData = msg(0, 404, 'Page Not Found!');
}
// CHECKING EMPTY FIELDS
$validation = new BillValidation();
$vdata = $validation->updateValidation($data);
// IF THERE ARE NO EMPTY FIELDS THEN-
echo $vdata["success"];
if ($vdata["success"] == 1) {
    if ($auth->isAuth()) {
        $bill = new Bill($conn);
        $bill->init(trim($data->id), trim($data->invoice_no), trim($data->invoice_date),
                trim($data->supplier), trim($data->final_amount));
        $status = $bill->update($bill);
        if ($status == 1) {
            $returnData = msg(1, 200, "data updated successfully");
        } else {
            $returnData = msg(0, 200, "Unable to update data");
        }
    } else {
        $returnData = msg(0, 401, "Unauthorized");
    }
} else {
    $returnData = $vdata;
}
echo json_encode($returnData);
