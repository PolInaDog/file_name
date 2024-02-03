<?php
$files = scandir(__DIR__ . '/upload');
$links = [];
echo __DIR__ . '<br>';

foreach ($files as $file) {
    if ($file == '.' || $file == '..') {
        continue;
    }
    // echo ($file) . '<br>';
    $links[] =  'upload/' . $file;
}

require __DIR__ . '/auth.php';
$login = getUserLogin();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
</head>

<body>
    <!-- Превью картинок -->
    <div>
        <?php foreach ($links as $link) : ?>
            <a href="<?= $link ?>"><img src="<?= $link ?>" alt="Картинка" width="100px"></a>
        <?php endforeach; ?>
    </div>

    <?php if ($login === null) : ?>
        <a href="/login.php">Авторизуйтесь</a>
    <?php else : ?>
        Добро пожаловать <?= $login ?>! <br>
        <a href="/logout.php">Выйти</a>
    <?php endif; ?>
</body>

</html>