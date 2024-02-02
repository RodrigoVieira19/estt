<?php
//encerrar a sessão do usuário


session_start();

session_unset();

session_destroy();

header("Location: adm.php");
exit();
?>



