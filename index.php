<?php
require_once("yachts.php");

$yacht = Yachts::get()->findYacht($_GET["id"]);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400&family=Roboto:ital,wght@0,400;0,700;1,400&display=swap"
          rel="stylesheet">

    <title>Карточка яхты</title>
</head>
<body>
<header>
    <p class="logo">
        <img src="img/logo.svg" alt="Логотип яхт-клуба Yacht Club">
    </p>
</header>
<div id="cardContainer">
    <div class="card" style="cursor: default">
        <div class="card-content">
            <h3 class="card-name"><?= $yacht->title ?></h3>
            <p class="card-description"><?= $yacht->description ?></p>
            <ul class="card-features">
                <?php
                foreach ($yacht->features as $feature) {
                    ?>
                    <li><?= $feature ?></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <p class="card-price">
            <span class="card-price-name">Цена:</span>
            <span class="card-price-value"><?= $yacht->price ?> ₽/час</span>
        </p>
    </div>
    <div class="buttons-row">
        <a class="button" href="list.php">Все яхты</a>
        <a class="button" href="update.php?id=<?= $yacht->id ?>">Изменить</a>
        <a class="button" href="delete.php?id=<?= $yacht->id ?>">Удалить</a>
    </div>
</div>
</body>
</html>
