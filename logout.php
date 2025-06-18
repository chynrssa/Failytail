<?php
session_start();
session_destroy();
header("Location: /FAILYTAIL/login.php"); // Redirect ke halaman utama setelah logout
exit();
?>
