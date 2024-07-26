<?php
/* if ($_SESSION['empData']->role_id != 3 && $_SESSION['empData']->role_id != 24 && $_SESSION['empData']->role_id != 25 && $_SESSION['empData']->role_id != 26) {
    Header("Location: 404");
}else {
    Header("https://sport.trueid.net/premier-league/clips/eQ2wjWDLVeKY");
} */

/*if ($_SESSION['empData']->role_id != 4) {
    Header("Location: noaccess.php?repair");
} */
if ($_SESSION['empData']->role_id != 4) {
	if ($_SESSION['empData']->role_id != 1862) {
    		Header("Location: noaccess.php?".$_SESSION['empData']->role_id);
	}
}
// else {
//     Header("https://sport.trueid.net/premier-league/clips/eQ2wjWDLVeKY");
// }
