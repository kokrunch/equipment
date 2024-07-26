<?php
/* if ($_SESSION['empData']->role_id != 1 && $_SESSION['empData']->role_id != 2) {
    Header("Location: 404");
} */

if ($_SESSION['empData']->role_id != 2) {
	if ($_SESSION['empData']->role_id != 1862) {
    		Header("Location: noaccess.php?".$_SESSION['empData']->role_id);
	}
}
