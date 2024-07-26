<?php
/* if ($_SESSION['empData']->role_id != 1 && $_SESSION['empData']->role_id != 2) {
    Header("Location: 404");
} */

if ($_SESSION['empData']->role_id != 2) {
    Header("Location: noaccess");
}
