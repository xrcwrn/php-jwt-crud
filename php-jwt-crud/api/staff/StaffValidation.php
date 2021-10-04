<?php

class StaffValidation {

    function msg($success, $status, $message, $extra = []) {
        return array_merge([
            'success' => $success,
            'status' => $status,
            'message' => $message
                ], $extra);
    }

    function insertValidation($data) {
        if (!isset($data->name) || empty(trim($data->name))) {
            $fields = ['fields' => ['name']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->userid) || empty(trim($data->userid))) {
            $fields = ['fields' => ['userid']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!filter_var($data->userid, FILTER_VALIDATE_INT)) {
            $fields = ['fields' => ['userid']];
            $returnData = msg(0, 422, 'Field value must be college id!', $fields);
        } elseif (!isset($data->dept) || empty(trim($data->dept))) {
            $fields = ['fields' => ['dept']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->designation) || empty(trim($data->designation))) {
            $fields = ['fields' => ['designation']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->mobileNo) || empty(trim($data->mobileNo))) {
            $fields = ['fields' => ['mobileNo']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } else {
            $returnData = msg(1, 200, 'all are ok!');
        }
        return $returnData;
    }

    function updateValidation($data) {
        if (!isset($data->name) || empty(trim($data->name))) {
            $fields = ['fields' => ['name']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->userid) || empty(trim($data->userid))) {
            $fields = ['fields' => ['userid']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!filter_var($data->userid, FILTER_VALIDATE_INT)) {
            $fields = ['fields' => ['userid']];
            $returnData = msg(0, 422, 'Field value must be college id!', $fields);
        } elseif (!isset($data->dept) || empty(trim($data->dept))) {
            $fields = ['fields' => ['dept']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->designation) || empty(trim($data->designation))) {
            $fields = ['fields' => ['designation']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->mobileNo) || empty(trim($data->mobileNo))) {
            $fields = ['fields' => ['mobileNo']];
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
        echo $returnData["success"];
        return $returnData;
    }

}
