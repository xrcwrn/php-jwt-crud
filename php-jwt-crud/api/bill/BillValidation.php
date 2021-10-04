<?php

class BillValidation {

    function msg($success, $status, $message, $extra = []) {
        return array_merge([
            'success' => $success,
            'status' => $status,
            'message' => $message
                ], $extra);
    }

    function insertValidation($data) {
        if (!isset($data->invoice_no) || empty(trim($data->invoice_no))) {

            $fields = ['fields' => ['invoice_no']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->invoice_date) || empty(trim($data->invoice_date))) {

            $fields = ['fields' => ['invoice_date']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->supplier) || empty(trim($data->supplier))) {

            $fields = ['fields' => ['supplier']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->final_amount) || empty(trim($data->final_amount))) {

            $fields = ['fields' => ['final_amount']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!filter_var($data->final_amount, FILTER_VALIDATE_FLOAT)) {

            $fields = ['fields' => ['final_amount']];
            $returnData = msg(0, 422, 'Field value is not correct!', $fields);
        } else {
            $returnData = msg(1, 200, 'all are ok!');
        }
        return $returnData;
    }

    function updateValidation($data) {
        if (!isset($data->invoice_no) || empty(trim($data->invoice_no))) {

            $fields = ['fields' => ['invoice_no']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->invoice_date) || empty(trim($data->invoice_date))) {

            $fields = ['fields' => ['invoice_date']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->supplier) || empty(trim($data->supplier))) {

            $fields = ['fields' => ['supplier']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!isset($data->final_amount) || empty(trim($data->final_amount))) {

            $fields = ['fields' => ['final_amount']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        } elseif (!filter_var($data->final_amount, FILTER_VALIDATE_FLOAT)) {

            $fields = ['fields' => ['final_amount']];
            $returnData = msg(0, 422, 'Field value is not correct!', $fields);
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
