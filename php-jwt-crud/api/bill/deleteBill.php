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

$allHeaders = getallheaders();
$db_connection = new Database();
$conn = $db_connection->dbConnection();
$auth = new Auth($conn, $allHeaders);

$returnData = [];
$uid = $_GET["id"];
//json_encode($uid);
// CHECKING EMPTY FIELDS
if (!isset($uid)) {

    $fields = ['fields' => ['id']];
    $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
}
// IF THERE ARE NO EMPTY FIELDS THEN-
else {
    $id = trim($uid);
    if ($id <= 0) {
        $returnData = msg(0, 422, 'Please enter correct id');

        // THE USER IS ABLE TO PERFORM THE LOGIN ACTION
    } else {
        if ($auth->isAuth()) {
            $bill = new Bill($conn);
            $i = $bill->del($id);

            if ($i == 1) {
                $returnData = msg(1, 200, "data deleted successfully");
            } else {
                $returnData = msg(0, 200, "Unable to delete");
            }
        } else {
            $returnData = msg(0, 401, "Unauthorized");
        }
    }
}
echo json_encode($returnData);
