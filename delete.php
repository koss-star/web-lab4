<?php
require_once("yachts.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST["id"];
    Yachts::get()->deleteYacht($id);
    header("location:list.php");
    die();
} else {
    $yacht = Yachts::get()->findYacht($_GET["id"]);
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400&family=Roboto:ital,wght@0,400;0,700;1,400&display=swap"
          rel="stylesheet">

    <title>Удалить яхты</title>
</head>
<body>
<header>
    <p class="logo">
        <img src="img/logo.svg" alt="Логотип яхт-клуба Yacht Club">
    </p>
    <div class="buttons-row">
        <a class="button" href="list.php">Все яхты</a>
        <a class="button" href="index.php?id=<?= $yacht->id ?>">Назад к яхте</a>
    </div>
</header>
<div id="yachtFormContainer">
    <form id="yachtForm" method="POST" action="delete.php?id=<?= $yacht->id ?>">
        <p>Вы действительно хотите удалить яхту: <?= $yacht->title ?>?</p>
        <input id="id" type="hidden" name="id" value="<?= $yacht->id ?>"/>
        <div id="buttonsContainer">
            <button class="button" type="submit" value="delete">Удалить</button>
        </div>
    </form>
</div>
</body>
</html>
