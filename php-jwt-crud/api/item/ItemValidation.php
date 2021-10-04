<?php

class BillValidation {

    function msg($success, $status, $message, $extra = []) {
        return array_merge([
            'success' => $success,
            'status' => $status,
            'message' => $message
                ], $extra);
    }

    function issueValidation($data) {
        if (!isset($data->itemId) || empty(trim($data->itemId))) {
            $fields = ['fields' => ['itemId']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->locationId) || empty(trim($data->locationId))) {
            $fields = ['fields' => ['locationId']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->issueDate) || empty(trim($data->issueDate))) {
            $fields = ['fields' => ['issueDate']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->issueStatus) || empty(trim($data->issueStatus))) {
            $fields = ['fields' => ['issueStatus']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } else {
            $returnData = msg(1, 200, 'all are ok!');
        }
        return $returnData;
    }

    function returnValidation($data) {
        if (!isset($data->returnDate) || empty(trim($data->returnDate))) {
            $fields = ['fields' => ['returnDate']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->returnStatus) || empty(trim($data->returnStatus))) {
            $fields = ['fields' => ['returnStatus']];
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

    function updateIssueValidation($data) {
        if (!isset($data->itemId) || empty(trim($data->itemId))) {
            $fields = ['fields' => ['itemId']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->locationId) || empty(trim($data->locationId))) {
            $fields = ['fields' => ['locationId']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->issueDate) || empty(trim($data->issueDate))) {
            $fields = ['fields' => ['issueDate']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->issueStatus) || empty(trim($data->issueStatus))) {
            $fields = ['fields' => ['issueStatus']];
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
