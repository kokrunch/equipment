<?php
class DisburseCartModel
{
    private $conn;
    public function __construct()
    {
        include '../config/connectDatabase.php';
        $this->conn = $conn;
    }

    public function getDisburseCart($emp_id)
    {
        try {
            $sql = "SELECT\n" .
                "	*, \n" .
                " IFNULL( ( SELECT SUM( mbl.mat_quantity ) FROM tb_material_budget_year_log mbl WHERE mbl.mat_bud_id = mb.mat_bud_id ), 0 ) dis_bud_log_quantity\n" .
                "FROM\n" .
                "	tb_disburse_cart cart\n" .
                "	LEFT JOIN tb_material_budget_year mb ON cart.mat_bud_id = mb.mat_bud_id \n" .
                "	LEFT JOIN tb_material m ON mb.mat_id = m.mat_id\n" .
                "WHERE\n" .
                "	emp_id = :emp_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["emp_id" => $emp_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function checkMatInCart($mat_bud_id, $emp_id)
    {
        try {
            $sql = "SELECT * FROM\n" .
                "	tb_disburse_cart cart \n" .
                "WHERE mat_bud_id = :mat_bud_id AND emp_id = :emp_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["mat_bud_id" => $mat_bud_id, "emp_id" => $emp_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }


    public function updateQuanttyCart($mat_cart_id, $quantity)
    {
        try {
            $sql = "UPDATE tb_disburse_cart SET quantity = quantity + :quantityNew WHERE mat_cart_id = :mat_cart_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["quantityNew" => $quantity, "mat_cart_id" => $mat_cart_id]);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error Update QuantityCart.';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function countDisburseCart($emp_id)
    {
        try {
            $sql = "SELECT COUNT(*) count \n" .
                "FROM tb_disburse_cart\n" .
                "WHERE emp_id = :emp_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["emp_id" => $emp_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function deleteCart($mat_cart_id)
    {
        try {
            $sql = "DELETE FROM tb_disburse_cart WHERE mat_cart_id = :mat_cart_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["mat_cart_id" => $mat_cart_id]);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error Delete Cart Disburse.';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function insertDisburse($dataArray)
    {
        try {
            $sql = "INSERT INTO tb_disburse_cart(mat_bud_id,quantity,emp_id) VALUES(:mat_bud_id,:quantity,:emp_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dataArray);
            if ($stmt->rowCount() >= 1) {
                return '1';
            } else {
                return 'There was an error Insert Disburse Cart.';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getDisburseCartWhereDisId($disburse_id)
    {
        try {
            $sql = "SELECT * FROM tb_disburse_cart WHERE emp_id = :emp_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["emp_id" => $disburse_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }
}
