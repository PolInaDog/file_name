<?php
require __DIR__ . '/auth.php';

$login = getUserLogin();

if ($login !== null && !empty($_FILES['attachment'])) {
    $file = $_FILES['attachment'];
    // Собираем путь до нового файла в папке upload
    $srsFileName = $file['name'];
    $newFilePass = __DIR__ . '/upload' . $srsFileName;

    // массив доступных расширений
    $arrayExstension = ['jpg', 'png', 'gif'];

    // расширение нашего файла
    $exstension = pathinfo($srsFileName, PATHINFO_EXTENSION);
    echo $exstension . '<br>';

    // проверки при загрузке файла
    // move_uploaded_files() - перемещает загруженный файл в новое место    
    // функция вернёт true если всё ok, false - что-то пошло не так

    if ($_FILES['size']) {
        $msg = 'Загрузка такого рамера файла запрещена!';
    } elseif (!in_array($exstension, $arrayExstension)) {
        $msg = 'Загрузка файла с таким расширением запрещенна!';
    } elseif ($file['error'] !== UPLOAD_ERR_OK) {
        $msg = 'Ошибка при загружки файла';
    } elseif (file_exists($newFilePass)) {
        $msg = 'Файл с таким именем уже существует';
    } elseif (!move_uploaded_file($file['tmp_name'], $newFilePass)) {
        $msg = 'Ошибка при загружки файла';
    } else {
        $msg = 'Файл успешно загружен';
    }
}
if ($login == null) {
    header('Location: /index.php');
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузка файла</title>
</head>

<body>
    <?php
    if (!empty($msg)) {
        echo $msg;
    }
    ?>
    <form action="/upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="attachment">
        <input type="submit" value="отправить">
    </form>
</body>

</html>