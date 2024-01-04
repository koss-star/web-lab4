<?php
require_once("yachts.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $yacht = Yacht::parseFromPost();
    Yachts::get()->addYacht($yacht);
    header("location:list.php");
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400&family=Roboto:ital,wght@0,400;0,700;1,400&display=swap"
          rel="stylesheet">

    <title>Добавить яхту</title>
</head>
<body>
<header>
    <p class="logo">
        <img src="img/logo.svg" alt="Логотип яхт-клуба Yacht Club">
    </p>
    <a class="button" href="list.php">Все яхты</a>
</header>
<div id="yachtFormContainer">
    <form id="yachtForm" method="POST" action="create.php">
        <div class="form-element">
            <label for="title">
                Название
            </label>
            <input id="title" type="text" name="title" required placeholder="Катер Meridian 401"/>
        </div>
        <div class="form-element">
            <label for="description">
                Описание
            </label>
            <input id="description" type="text" name="description" required placeholder=""/>
        </div>
        <div class="form-element">
            <label for="price">
                Цена (₽/час)
            </label>
            <input type="number" min="0" id="price" name="price" required placeholder="10000"/>
        </div>
        <div class="form-element">
            <label for="features">
                Особенности (через точку с запятой)
            </label>
            <input type="text" id="features" name="features" required placeholder="2 каюты; 4 спальных места"/>
        </div>
        <div id="buttonsContainer">
            <button class="button" type="submit" value="create">Создать</button>
        </div>
    </form>
</div>
</body>
</html>
