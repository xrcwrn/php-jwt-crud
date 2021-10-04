<?php

class LocationValidation {

    function msg($success, $status, $message, $extra = []) {
        return array_merge([
            'success' => $success,
            'status' => $status,
            'message' => $message
                ], $extra);
    }

    function insertValidation($data) {
        if (!isset($data->roomNo) || empty(trim($data->roomNo))) {
            $fields = ['fields' => ['roomNo']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->roomType) || empty(trim($data->roomType))) {

            $fields = ['fields' => ['roomType']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } else {
            $returnData = msg(1, 200, 'all are ok!');
        }
        return $returnData;
    }

    function updateValidation($data) {
        if (!isset($data->roomNo) || empty(trim($data->roomNo))) {
            $fields = ['fields' => ['roomNo']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->roomType) || empty(trim($data->roomType))) {

            $fields = ['fields' => ['roomType']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->id) || empty(trim($data->id))) {
            $fields = ['fields' => ['id']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!filter_var($data->id, FILTER_VALIDATE_INT)) {
            $fields = ['fields' => ['id']];
            $returnData = msg(0, 422, 'Id must be integer!', $fields);
        } elseif ($data->id < 1) {
            $fields = ['fields' => ['id']];
            $returnData = msg(0, 422, 'id must be greater than 0!', $fields);
        } else {
            $returnData = msg(1, 200, 'all are ok!');
        }
        return $returnData;
    }

}
