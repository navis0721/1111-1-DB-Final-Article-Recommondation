<?php
session_start();
session_destroy();
echo "<script>alert('已登出'); location.href = 'Novel.php';</script>";
?>
