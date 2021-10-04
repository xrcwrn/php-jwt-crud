<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Location
 *
 * @author CSE_LAB10
 */
class Location {

    var $conn;
    var $list;
    var $id;
    var $roomNo;
    var $roomType;

    /**
     * Constructor
     * @param $conn PDO db connection
     */
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function init($id, $roomNo, $roomType) {
        $this->id = $id;
        $this->roomNo = $roomNo;
        $this->roomType = $roomType;
    }

    /**
     * Add a row in location.
     * @return int 0 or 1
     */
    function insert($locationObj) {

        $query = "  INSERT INTO location  ( room_no, room_type)
                    VALUES (
                    :roomNo,
                    :roomType
                    )";

        $q = $this->conn->prepare($query);
        $q->execute(array(':roomNo' => $locationObj->roomNo,
            ':roomType' => $locationObj->roomType
        ));
        if ($this->conn->lastInsertId() != 0) {
            return 1;
        } else {
            //var_dump($q->errorInfo());
            //$q->debugDumpParams();
            return(0);
        }
    }

    /**
     * Update a row in location.
     * @return int 0 or 1
     */
    function update($locationObj) {
        $query = "  UPDATE location SET
                    room_no = :roomNo,
                    room_type = :roomType
                    WHERE id = :id ";

        $q = $this->conn->prepare($query);
        $q->execute(
                array(':roomNo' => $locationObj->roomNo,
                    ':roomType' => $locationObj->roomType,
                    ':id' => $locationObj->id));
        if ($q->rowCount() == 1) {
            return (1);
        } else {
            //var_dump($q->errorInfo());
            //$q->debugDumpParams();
            return(0);
        }
    }

    /**
     * Delete a row in location.
     * @param Int id_user
     * @return int 0 or 1
     */
    function del($id) {
        $query = "DELETE FROM location WHERE id = :id";

        $q = $this->conn->prepare($query);
        $q->execute(array(':id' => $id));
        $st = $q->rowCount();
        if ($st == 1) {
            return (1);
        } else {
            //var_dump($q->errorInfo());
            //$q->debugDumpParams();
            return(0);
        }
    }

    /**
     * Get a row in location.
     * @param Int id_user
     * @return int 0 or 1
     */
    function fetch($id) {

        $query = "  SELECT id, room_no, room_type
                    FROM location  
                    WHERE id = :id";

        $q = $this->conn->prepare($query);
        if ($q->execute(array(':id' => $id))) {
            $this->list = array();
            $i = 0;
            while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                $this->list[$i]['id'] = $row['id'];
                $this->list[$i]['roomNo'] = $row['room_no'];
                $this->list[$i]['roomType'] = $row['room_type'];
                $i++;
            }
            return ($this->list);
        } else {
            //var_dump($q->errorInfo());
            //$q->debugDumpParams();
            return(0);
        }
    }

    /**
     * Get a list of row in location.
     * @param Int limitFrom
     * @param Int limitNumber
     * @param char orderBy
     * @param Int order
     * @return int 0 or Number of elements
     */
    function fetchAll($limitFrom = 0, $limitNumber = 30, $orderBy = 'id', $order = 'ASC') {

        $query = "SELECT id, room_no, room_type 
                    FROM location  order by :orderBy :order limit :limitFrom, :limitNumber";

        if ($order != 'ASC') {
            $order = 'DESC';
        }

        $q = $this->conn->prepare($query);

        $q->bindValue(':orderBy', intval($orderBy), PDO::PARAM_STR);
        $q->bindValue(':order', intval($order), PDO::PARAM_STR);
        $q->bindValue(':limitFrom', intval($limitFrom), PDO::PARAM_INT);
        $q->bindValue(':limitNumber', intval($limitNumber), PDO::PARAM_INT);

        if ($q->execute()) {
            $this->list = array();
            $i = 0;
            while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                $this->list[$i]['id'] = $row['id'];
                $this->list[$i]['room_no'] = $row['room_no'];
                $this->list[$i]['room_type'] = $row['room_type'];
                $i++;
            }
            return ($this->list);
        } else {
            // var_dump($q->errorInfo());
            // $q->debugDumpParams();
            return(0);
        }
    }

    /**
     * Count row in location    * @return int 0 or Number of elements
     */
    function count() {

        $query = "SELECT COUNT(*) AS nbRows
        FROM location";

        $q = $this->conn->prepare($query);

        if ($q->execute()) {
            if ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                return($row['nbRows']);
            }
        } else {
            //var_dump($q->errorInfo());
            //$q->debugDumpParams();
            return(0);
        }
    }

}

?>
    