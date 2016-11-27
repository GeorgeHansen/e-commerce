<?php
session_start();

session_unset();

session_destroy();
header("Location: /e-commerce/?controller=Login&action=home");

?>