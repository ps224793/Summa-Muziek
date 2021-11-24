<?php 
setcookie("userId", "", time() - 3600);
setcookie("userName", "", time() - 3600);
header("Location: http://summamusic/login");
exit();
?>