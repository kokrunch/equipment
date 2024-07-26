<?php
session_start();

require_once('../models/RoomModel.php');

if (isset($_GET['getRoom'])){
    try {
        $Room = new RoomModel();
        $result = $Room->getRoom();
        echo $result;
    } catch (\Throwable $th) {
        echo $th;
    }
}

if (isset($_GET['getRoomByFloor'])){
    try {
        $floor = $_GET['getRoomByFloor'];
        $Room = new RoomModel();
        $result = $Room->getRoomByFloor($floor);
        echo $result;
    } catch (\Throwable $th) {
        echo $th;
    }
}

if (isset($_GET['getRoomId'])) {
    try {
    $room_id = $_GET['getRoomId'];
    $room = new RoomModel();
    $result = $room->getRoomId($room_id);
    echo $result;
} catch (\Throwable $th) {
    echo $th;
}
}

if (isset($_GET['getEquDetail'])) {
    try {
    $room_id = $_GET['getEquDetail'];
    $euipment = new RoomModel();
    $result = $euipment->getDetailEquipment($room_id);
    echo $result;
} catch (\Throwable $th) {
    echo $th;
}
}

if (isset($_GET['getMatDetail'])) {
    try {
        $room_id = $_GET['getMatDetail'];
    $material = new RoomModel();
    $result = $material->getDetailMaterial($room_id);
    echo $result;
} catch (\Throwable $th) {
    echo $th;
}
}

if (isset($_POST['addRoom'])) {
    try {
        $room_name = htmlentities($_POST['room_name']);
        $room_floor = htmlentities($_POST['room_floor']);
        $room_detail = htmlentities($_POST['room_detail']);

        $data_arry = array(
            'room_name' => $room_name,
            'room_floor' => $room_floor,
            'room_detail' => $room_detail
        );

        $RoomModel = new RoomModel();
        $result = $RoomModel->addRoom($data_arry);

        echo $result ;

    } catch (\Throwable $th) {
        //throw $th;
        echo $th;
    }
}

if (isset($_POST['updateRoom'])) {
    try {
        $room_name = htmlentities($_POST['room_name']);
        $room_floor = htmlentities($_POST['room_floor']);
        $room_detail = htmlentities($_POST['room_detail']);
        $room_id = htmlentities($_POST['room_id']);

        $data_arry = array(
            'room_name' => $room_name,
            'room_floor' => $room_floor,
            'room_detail' => $room_detail ,
            'room_id' => $room_id
        );

        $RoomModel = new RoomModel();
        $result = $RoomModel->updateRoom($data_arry);

        echo $result ;

    } catch (\Throwable $th) {
        //throw $th;
        echo $th;
    }
}

if (isset($_GET['delRoom'])){
    try {
        $room_id = $_GET['delRoom'];
        $Room = new RoomModel();
        $data_arry = array(
            'room_id' => $room_id,
        );

        $result_check_detail_mat = $Room->getDetailMaterial($room_id);
        $res_check_detail_mat = json_decode($result_check_detail_mat);

        if (count($res_check_detail_mat) == 1) {
            // echo "can not delete this room because have material in room";
            echo "2" ;
        } else {

            $result_check_detail_equ = $Room->getDetailEquipment($room_id);
            $res_check_detail_equ = json_decode($result_check_detail_equ);

            if( count($res_check_detail_equ) == 0 ) {
                $result = $Room->delRoom($data_arry);
                echo $result;
            } else {
                // echo "can not delete this room because have equipment in room";
                echo "2" ;
            }
        }
        
    } catch (\Throwable $th) {
        echo $th;
    }
}

if(isset($_POST['searchRoom'])){
    try {
        $room_floor = htmlentities($_POST['room_floor']);
        $room_name = htmlentities($_POST['room_name']);

        $data_arry = array(
            'room_floor' => $room_floor,
            'room_name' => $room_name,
        );

        $RoomModel = new RoomModel();
        $result = $RoomModel->SearchRoom($data_arry);
        echo $result;
    } catch (\Throwable $th) {
        echo $th;
    }
}
?>