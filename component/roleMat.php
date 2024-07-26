<?php
/* if ($_SESSION['empData']->role_id != 4) {
    Header("Location: 404");
} */

/*if ($_SESSION['empData']->role_id != 3) {
    Header("Location: noaccess");
}*/

if ($_SESSION['empData']->role_id != 3) {
	if ($_SESSION['empData']->role_id != 1862) {
    		Header("Location: noaccess.php?".$_SESSION['empData']->role_id);
	}
}
