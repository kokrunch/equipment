<?php
session_start();
if (!isset($_SESSION["empData"])) {
    Header("Location: login-page");
}
