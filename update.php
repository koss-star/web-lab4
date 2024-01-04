<?php
require_once("yachts.php");

$yachts = Yachts::get();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $yacht = $yachts->findYacht($id);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $yacht = Yacht::parseFromPost();
    $yachts->updateYacht($yacht);
    header('location:index.php?id=' . $id);
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

    <title>Обновить яхту</title>
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
    <form id="yachtForm" method="POST" action="update.php?<?= $yacht->id ?>">
        <input id="id" type="hidden" name="id" value="<?= $yacht->id ?>"/>
        <div class="form-element">
            <label for="title">
                Название
            </label>
            <input id="title" type="text" name="title" required placeholder="Катер Meridian 401"
                   value="<?= htmlspecialchars($yacht->title) ?>"/>
        </div>
        <div class="form-element">
            <label for="description">
                Описание
            </label>
            <input id="description" type="text" name="description" required placeholder=""
                   value="<?= htmlspecialchars($yacht->description) ?>"/>
        </div>
        <div class="form-element">
            <label for="price">
                Цена (₽/час)
            </label>
            <input type="number" min="0" id="price" name="price" required placeholder="10000" value="<?= $yacht->price ?>"/>
        </div>
        <div class="form-element">
            <label for="features">
                Особенности (через точку с запятой)
            </label>
            <input type="text" id="features" name="features" required placeholder="2 каюты; 4 спальных места"
                   value="<?= htmlspecialchars(implode("; ", $yacht->features)) ?>"/>
        </div>
        <div id="buttonsContainer">
            <button class="button" type="submit" value="create">Обновить</button>
        </div>
    </form>
</div>
</body>
</html>