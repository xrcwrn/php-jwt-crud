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
require '../../classes/Staff.php';
require '../../middlewares/Auth.php';
require './StaffValidation.php';

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
$validation = new StaffValidation();
$vdata = $validation->insertValidation($data);

if ($vdata["success"] == 1) {
    if ($auth->isAuth()) {
        $staff1 = new Staff($conn);
        $staff1->init(0, trim($data->name), trim($data->userid),
                trim($data->dept), trim($data->designation),
                trim($data->mobileNo));
        $status = $staff1->insert($staff1);
        if ($status == 1) {
            $returnData = msg(1, 200, "data inserted successfully");
        } else {
            $returnData = msg(0, 200, "Unable to inserted data");
        }
    } else {
        $returnData = msg(0, 401, "Unauthorized");
    }
} else {
    $returnData = $vdata;
}
echo json_encode($returnData);
