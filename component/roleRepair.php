<?php
if ($_SESSION['empData']->role_id != 4) {
	if ($_SESSION['empData']->role_id != 4) {
    		Header("Location: noaccess.php?".$_SESSION['empData']->role_id);
	}
}
