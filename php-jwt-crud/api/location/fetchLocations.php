<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function msg($success, $status, $message, $extra = [], $data = []) {
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
            ], $extra);
}

require '../../classes/Database.php';
require '../../classes/Location.php';
require '../../middlewares/Auth.php';
require './LocationValidation.php';

$allHeaders = getallheaders();
$db_connection = new Database();
$conn = $db_connection->dbConnection();
$auth = new Auth($conn, $allHeaders);

$returnData = [];

$pno = $_GET["p"];
$order_by = $_GET["orderby"];
$order = $_GET["order"];
// CHECKING EMPTY FIELDS
if (!isset($pno)) {

    $pno = 1;
}
if (!isset($order_by)) {

    $order_by = "b.id";
}if (!isset($order)) {

    $order = "DESC";
}

// IF THERE ARE NO EMPTY FIELDS THEN-
else {
    $p = trim($pno);
    if ($p <= 0) {
        $returnData = msg(0, 422, 'Please enter correct page number');

        // THE USER IS ABLE TO PERFORM THE LOGIN ACTION
    } else {
        if ($auth->isAuth()) {
            $location = new Location($conn);
            $pageSize = 10;
            $start = 0;
            if ($p > 1) {
                $start = (($p - 1) * $pageSize);
            }


            $data[] = $location->fetchAll($start, $pageSize, $order_by, $order);
            $returnData = msg(1, 200, "data fetched successfully", $data);
        } else {
            $returnData = msg(0, 401, "Unauthorized");
        }
    }
}
echo json_encode($returnData);
