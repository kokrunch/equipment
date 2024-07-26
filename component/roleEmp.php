<?php
if ($_SESSION['empData']->role_id != 2) {
	if ($_SESSION['empData']->role_id != 2) {
    		Header("Location: noaccess.php?".$_SESSION['empData']->role_id);
	}
}
