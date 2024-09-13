<?php
/* if ($_SESSION['empData']->role_id != 5) {
    Header("Location: 404");
} */

if ($_SESSION['empData']->role_id != 1) {
    Header("Location: noaccess");
}

// $arrFiles = array();
// $handle = glob('/it-equipment-system/*');
// if (!$handle) {
//     Header("Location: 404");
// }
// closedir($handle);

?>
