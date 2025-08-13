<?php
session_start();
session_unset();
session_destroy();
header("Location: dashboard1.php");
exit;
