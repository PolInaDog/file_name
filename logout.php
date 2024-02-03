<?php

setcookie('login', $login, 0, '/');
setcookie('pass', $password, 0, '/');
header('Location: /index.php');
