<?php
session_start();
echo 'in user controler';

require_once('../models/personnerModel.php');
require_once('../models/employeeModel.php');
require_once('../utils/utils.php');

if (isset($_GET['getUser'])) {
    echo '<br>in get user';
    $emp_id = $_SESSION["empData"]->emp_id;
    $person = new PersonerModel();
    $result = $person->getAllPersonel($emp_id);
    echo $result;
}

if (isset($_GET['gettyperole'])) {
    $type_role = new PersonerModel();
    $result = $type_role->getTypeRole();
    echo $result;
}
if (isset($_GET['getbranch'])) {
    $branch = new PersonerModel();
    $result = $branch->getBranch();
    echo $result;
}


if (isset($_POST['addUser'])) {
    echo 'in add useer';
    
    if (isset($_FILES['file']['name'])) {

        try {
// test
            $username = htmlentities($_POST['username']);
            $password = htmlentities($_POST['password']);
            $email = htmlentities($_POST['email']);
            $firstname = htmlentities($_POST['firstname']);
            $lastname = htmlentities($_POST['lastname']);
            $gender = htmlentities($_POST['gender']);
            $tel = htmlentities($_POST['tel']);
            $role = htmlentities($_POST['role']);

            if ($_POST['role'] != 1) {
                $branch = null;
            } else {
                $branch = htmlentities($_POST['branch']);
            }

            //$utils = new Utils();
            //$reponseUploadFile = $utils->uploadImage($_FILES['file']['name'], $_FILES['file']['size'], "employee_img");

            //if ($reponseUploadFile[0] == "upload success") {
                $array_user = array(
                    'username' => $username,
                    'password' => $password,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'gender' => $gender,
                    'email' => $email,
                    'tel' => $tel,
                    'role' => $role,
                    'emp_img' => $reponseUploadFile[1],
                    'branch' => $branch
                );


                $person = new PersonerModel();
                $result = $person->insertUser($array_user, $username);

                echo $result;
            //} else {
                ////echo $reponseUploadFile[0];
            //}
        } catch (\Throwable $th) {
            echo $th;
        }
    } else {
        try {

            $username = htmlentities($_POST['username']);
            $password = htmlentities($_POST['password']);
            $email = htmlentities($_POST['email']);
            $firstname = htmlentities($_POST['firstname']);
            $lastname = htmlentities($_POST['lastname']);
            $gender = htmlentities($_POST['gender']);
            $tel = htmlentities($_POST['tel']);
            $role = htmlentities($_POST['role']);

            if ($_POST['role'] != 1) {
                $branch = null;
            } else {
                $branch = htmlentities($_POST['branch']);
            }

            $array_user = array(
                'username' => $username,
                'password' => $password,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'gender' => $gender,
                'email' => $email,
                'tel' => $tel,
                'role' => $role,
                'emp_img' => null,
                'branch' => $branch
            );

            $person = new PersonerModel();
            $result = $person->insertUser($array_user, $username);

            echo $result;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}else{
    echo 'add user else';
}


if (isset($_POST['editUser'])) {

    try {
        $id_up = htmlentities($_POST['id_up']);
        $email_up = htmlentities($_POST['email_up']);
        $fname_up = htmlentities($_POST['fname_up']);
        $lname_up = htmlentities($_POST['lname_up']);
        $tel_up = htmlentities($_POST['tel_up']);
        $role_id_up = htmlentities($_POST['role_id_up']);

        if ($_POST['role_id_up'] != 1) {
            $branch_id_up = null;
        } else {
            $branch_id_up = htmlentities($_POST['branch_id_up']);
        }

        $array_user_up = array(
            'fname_up' => $fname_up,
            'lname_up' => $lname_up,
            'tel_up' => $tel_up,
            'email_up' => $email_up,
            'role_id_up' => $role_id_up,
            'branch_id_up' => $branch_id_up,
            'id_up' => $id_up,
        );

        $person = new PersonerModel();
        $result = $person->editUser($array_user_up);

        echo $result;
    } catch (\Throwable $th) {
        echo $th;
    }
}

if (isset($_GET['d_User'])) {
    $person = new PersonerModel();
    $id_emp = htmlentities($_GET['d_User']);
    $data = array('emp_id' => $id_emp);
    $result = $person->deleteUser($data);
    echo $result;
}

//emp_profile

class UserController {
    public function getProfile() {
        include("db.php");
        $emp_id = $_SESSION['emp_id'];
        $query = "SELECT * FROM users WHERE emp_id = '$emp_id'";
        $result = mysqli_query($conn, $query);
        $userData = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $userData[] = $row;
        }

        echo json_encode($userData);
    }

    public function editProfile() {
        include("db.php");
        
        $emp_id = $_POST['emp_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $img_profile_old = $_POST['img_profile_old'];
        $img_profile = $_FILES['img_profile']['name'];
        $target = "images/" . basename($img_profile);

        // If new image is uploaded
        if (!empty($img_profile)) {
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES['img_profile']['tmp_name']);
            $allowed = array('jpg', 'jpeg', 'png', 'gif');
            $ext = pathinfo($img_profile, PATHINFO_EXTENSION);

            if (in_array($ext, $allowed) && $check !== false) {
                if (move_uploaded_file($_FILES['img_profile']['tmp_name'], $target)) {
                    // Delete old image
                    if (file_exists("images/" . $img_profile_old)) {
                        unlink("images/" . $img_profile_old);
                    }
                    $img_profile = $_FILES['img_profile']['name'];
                } else {
                    echo json_encode(["success" => false, "message" => "Failed to upload image."]);
                    return;
                }
            } else {
                echo json_encode(["success" => false, "message" => "Invalid file type or file is not an image."]);
                return;
            }
        } else {
            $img_profile = $img_profile_old;
        }

        $query = "UPDATE users SET emp_firstname='$fname', emp_lastname='$lname', emp_email='$email', emp_tel='$tel', emp_img='$img_profile' WHERE emp_id='$emp_id'";
        if (mysqli_query($conn, $query)) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Error: " . mysqli_error($conn)]);
        }
    }
}


if (isset($_GET['getProfile'])) {

    $emp_id = $_SESSION["empData"]->emp_id;
    $profile_u = new EmployeeModel();
    $result = $profile_u->getUserProfile($emp_id);
    echo $result;
}

if (isset($_POST['editProfile'])) {

    if (!empty($_FILES['file']['name'])) {
        try {
            $emp_id = htmlentities($_POST['emp_id']);
            $fname = htmlentities($_POST['fname']);
            $lname = htmlentities($_POST['lname']);
            $email = htmlentities($_POST['email']);
            $tel = htmlentities($_POST['tel']);

            $u = new Utils();
            $reponseUploadFile = $u->uploadImage($_FILES['file']['name'], $_FILES['file']['size'], "employee_img");

            if ($reponseUploadFile[0] == "upload success") {

                unset($_SESSION['empData']->emp_img);
                $_SESSION['empData']->emp_img = $reponseUploadFile[1];

                $array_profile = array(
                    'fname' => $fname,
                    'lname' => $lname,
                    'email' => $email,
                    'tel' => $tel,
                    'emp_img_profile' => $reponseUploadFile[1],
                    'emp_id' => $emp_id,
                );

                $emp_profile = new EmployeeModel();
                $result = $emp_profile->editProfile($array_profile);
                echo $result;
            } else {
                echo $reponseUploadFile[0];
            }
        } catch (exception $e) {
            echo $e;
        }
    } else {

        try {
            $emp_id = htmlentities($_POST['emp_id']);
            $fname = htmlentities($_POST['fname']);
            $lname = htmlentities($_POST['lname']);
            $email = htmlentities($_POST['email']);
            $tel = htmlentities($_POST['tel']);
            $img_old = htmlentities($_POST['file_old']);

            $array_profile = array(
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
                'tel' => $tel,
                'emp_img_profile' => $img_old,
                'emp_id' => $emp_id,
            );

            $emp_profile = new EmployeeModel();
            $result = $emp_profile->editProfile($array_profile);
            echo $result;
        } catch (exception $e) {
            echo $e;
        }
    }
}

if (isset($_POST['changePass'])) {

    try {
        $emp_id = htmlentities($_POST['emp_id']);
        $newPass = htmlentities($_POST['newPass']);

        $emp = new EmployeeModel();

        $data = array(
            'newPass' => $newPass,
            'emp_id' => $emp_id
        );
        $result = $emp->changePass($data);
        echo $result;
    } catch (\Throwable $th) {
        echo $th;
    }
}

if (isset($_GET['getEmpRole'])) {
    $emp_role = new PersonerModel();
    $result = $emp_role->getEmpRole();
    echo $result;
}

if (isset($_POST['insertEmpRole'])) {
    try {
        $role_name = htmlentities($_POST['role_name']);
        $role_id = htmlentities($_POST['role_id']);
        $person = new PersonerModel();

        $data = array('role_name' => $role_name, 'role_id' => $role_id);
        $result = $person->insertEmpRole($data);
        echo $result;
    } catch (\Throwable $th) {
        echo $th;
    }
}

if (isset($_GET['deleteEmpRole'])) {
    $emp_role = new PersonerModel();
    $role_id = $_GET['deleteEmpRole'];
    $data = array('role_id' => $role_id);
    $result = $emp_role->deleteEmpRole($data);
    echo $result;
}

if (isset($_POST['updateEmpRole'])) {
    try {

        $update_role_name = htmlentities($_POST['update_role_name']);
        $role_id = htmlentities($_POST['role_id']);
        $sub_role_id = htmlentities($_POST['sub_role_id']);
        $PersonerModel = new PersonerModel();

        $data = array(
            'update_role_name' => $update_role_name,
            'role_id' => $role_id,
            'sub_role_id' => $sub_role_id
        );

        $result = $PersonerModel->updateEmpRole($data);
        echo $result;
    } catch (\Throwable $th) {
        echo $th;
    }
}

if (isset($_GET['getRoleid'])) {
    $emp_role = new PersonerModel();
    $role_id = $_GET['getRoleid'];
    $result = $emp_role->getRoleId($role_id);
    echo $result;
}

if (isset($_GET['getRoleData'])) {
    $type_role = new PersonerModel();
    $resultRole = $type_role->getTypeRole();
    echo $resultRole;
}

if (isset($_GET['getEmpToken'])) {
    try {
        $emp_model = new EmployeeModel();
        $resultToken = $emp_model->getEmpToken();
        echo $resultToken;
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_GET['getEmpWhereRole'])) {
    try {
        $role_id = $_GET['role_id'];
        $emp_model = new EmployeeModel();
        $resultEmp = $emp_model->getEmp($role_id);
        echo $resultEmp;
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_POST['addToken'])) {
    try {
        $group_name =  htmlentities($_POST['group_name']);
        $role_id = $_POST['role_id'];
        $token = htmlentities($_POST['token']);
        $emp_model = new EmployeeModel();

        $arr_data = [
            "group_name" => $group_name,
            "token" => $token,
            "role_id" => $role_id
        ];
        $result = $emp_model->InsertToken($arr_data);
        echo $result;
    } catch (Exception $e) {
        echo $e;
    }
}


if (isset($_POST['editToken'])) {
    try {
        $token_id = $_POST['token_id'];
        $token = htmlentities($_POST['token']);
        $emp_model = new EmployeeModel();

        $arr_data = [
            "token" => $token,
            "token_id" => $token_id
        ];

        $result = $emp_model->updateToken($arr_data);
        echo $result;
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_POST['deleteToken'])) {
    try {
        $tokenId = htmlentities($_POST['tokenId']);
        $emp_model = new EmployeeModel();
        $checkDelToken = $emp_model->checkDeleteToken($tokenId);
        if ($checkDelToken == 1) {
            $result = $emp_model->deleteToken($tokenId);
            echo $result;
        } else {
            echo $checkDelToken;
        }
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_GET['getNotiofication'])) {
    try {
        $emp_id = $_SESSION['empData']->emp_id;
        $limit = $_GET['limit'];
        $emp_model = new EmployeeModel();
        $result = $emp_model->getNotification($emp_id,  (int)$limit);
        echo $result;
    } catch (Exception $e) {
        echo $e;
    }
}


if (isset($_GET['updateNoti'])) {
    try {
        $token_id = $_GET['token_id'];
        $emp_model = new EmployeeModel();
        $emp_model->UpdateNotification($token_id);
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_POST['addEmpToken'])) {
    try {

        $emp_id = $_POST['emp_id'];
        $token_id = $_POST['token_id'];
        $emp_model = new EmployeeModel();
        $result =  $emp_model->insertEmpToken($token_id, $emp_id);
        echo $result;
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_POST['deleteEmpToken'])) {
    try {
        $emp_token_id = $_POST['emp_token_id'];
        $emp_model = new EmployeeModel();
        $result =  $emp_model->deleteEmpToken($emp_token_id);
        echo $result;
    } catch (Exception $e) {
        echo $e;
    }
}
?>