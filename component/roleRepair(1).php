<?php
/* if ($_SESSION['empData']->role_id != 3 && $_SESSION['empData']->role_id != 24 && $_SESSION['empData']->role_id != 25 && $_SESSION['empData']->role_id != 26) {
    Header("Location: 404");
}else {
    Header("https://sport.trueid.net/premier-league/clips/eQ2wjWDLVeKY");
} */

if ($_SESSION['empData']->role_id != 4) {
    Header("Location: noaccess");
} 
// else {
//     Header("https://sport.trueid.net/premier-league/clips/eQ2wjWDLVeKY");
// }
