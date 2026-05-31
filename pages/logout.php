<?php
include '../includes/db.php';
session_destroy();
session_write_close();
header('Location: ../index.php');
exit;

