<?php
function checkAuth($login, $password)
{
    require __DIR__ . '/usersDB.php';

    foreach ($arrayUsers as $user) {
        if ($user['login'] == $login && $user['pass'] == $password) {
            return true;
        }
    }

    return false;
}

function getUserLogin()
{
    $loginFromCoockie = $_COOKIE['login'] ?? '';
    $passFromCoockie = $_COOKIE['pass'] ?? '';

    if (checkAuth($loginFromCoockie, $passFromCoockie)) {
        return $loginFromCoockie;
    } else {
        return null;
    }
}
