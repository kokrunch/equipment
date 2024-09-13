<?php
if ($_SESSION['empData']->role_id != 3) {
	if ($_SESSION['empData']->role_id != 3) {
    		Header("Location: noaccess.php?".$_SESSION['empData']->role_id);
	}
}
