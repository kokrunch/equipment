<?php
if ($_SESSION['empData']->role_id != 5) {
	if ($_SESSION['empData']->role_id != 5) {
    		Header("Location: noaccess.php?".$_SESSION['empData']->role_id);
	}
}
