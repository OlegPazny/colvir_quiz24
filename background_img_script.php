<?php
    //подключение к БД
    require_once "db_connect.php";
    // Проверка, был ли файл успешно загружен
    if ($_FILES['imageFile']['error'] !== UPLOAD_ERR_OK) {
        // Обработка ошибок загрузки файла
        die('Upload failed with error code ' . $_FILES['imageFile']['error']);
    }

    // Получение содержимого загруженного файла и его кодирование в base64
    $imageData = file_get_contents($_FILES['imageFile']['tmp_name']);
    $base64Image = base64_encode($imageData);

    // Проверка формата изображения
    $imageInfo = getimagesize($_FILES['imageFile']['tmp_name']);
    if ($imageInfo === false) {
        // Обработка ошибок формата изображения
        die('Invalid image format.');
    }

    $insert_bg_img=mysqli_query($db, "UPDATE `quiz` SET `background`='".$base64Image."' WHERE `id`=1")
?>