<?php
session_start();

session_unset();

session_destroy();
header("Location: ?controller=login&action=home");

?>