<?php
class RoomModel
{

    private $conn;
    public function __construct()
    {
        include '../config/connectDatabase.php';
        $this->conn = $conn;
    }

    public function addRoom($data_arry)
    {

        try {
            $sql = "INSERT INTO tb_room (room_name,room_floor,room_detail) VALUE (:room_name,:room_floor,:room_detail)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_arry);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding room data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function getRoom()
    {
        try {
            $sql = "SELECT * FROM tb_room WHERE room_floor = 'g' ORDER BY room_name";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function getRoomByFloor($floor)
    {
        try {
            $sql = "SELECT * FROM tb_room WHERE room_floor = '$floor' ORDER BY room_name";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function getAllRoom()
    {
        try {
            $sql = "SELECT * FROM tb_room ORDER BY room_name";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function getRoomId($room_id)
    {
        try {
            $sql = "SELECT * FROM tb_room WHERE room_id = '$room_id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function getDetailEquipment($room_id)
    {
        try {
            $sql = "SELECT\n" .
                "	equ_name,\n" .
                "	COUNT(quantity) quantity,\n" .
                "	room_name \n" .
                "FROM\n" .
                "	tb_room_desc_equ\n" .
                "	LEFT JOIN tb_room ON tb_room.room_id = tb_room_desc_equ.room_id\n" .
                "	LEFT JOIN tb_equipment ON tb_equipment.equ_id = tb_room_desc_equ.equ_id \n" .
                "WHERE\n" .
                "	tb_room_desc_equ.room_id = :room_id AND tb_room_desc_equ.use_status = 1\n" .
                "GROUP BY tb_room_desc_equ.equ_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["room_id" => $room_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    function getDetailMaterial($room_id)
    {
        try {
            $sql = "SELECT mat_name,quantity,room_name FROM tb_room_desc_mat
        LEFT JOIN tb_room ON tb_room.room_id = tb_room_desc_mat.room_id
        LEFT JOIN tb_material ON tb_material.mat_id = tb_room_desc_mat.mat_id
         WHERE tb_room_desc_mat.room_id = '$room_id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function updateRoom($data_arry)
    {
        try {
            $sql = "UPDATE tb_room SET room_name = :room_name , room_floor = :room_floor , room_detail = :room_detail WHERE room_id = :room_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_arry);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error updating room data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function delRoom($data_arry)
    {
        try {
            $sql = "DELETE FROM tb_room WHERE room_id = :room_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_arry);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error deleting room data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function SearchRoom($data_arry)
    {

        try {
            //print_r($data_arry);
            $sql = "SELECT * FROM tb_room WHERE room_floor = :room_floor AND room_name = :room_name ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_arry);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
