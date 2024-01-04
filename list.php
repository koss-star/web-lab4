<?php
require_once("yachts.php");

$yachts = Yachts::get()->getAll();
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

    <title>Все яхты</title>
</head>

<body>
<header>
    <p class="logo">
        <img src="img/logo.svg" alt="Логотип яхт-клуба Yacht Club">
    </p>
    <a id="button" class="button" href="create.php">Добавить яхту</a>
</header>
<div class="cards-container">
    <?php
    if (count($yachts) > 0) :
        ?>
        <ul class="cards">
            <?php
            foreach ($yachts as $yacht) {
                ?>
                <li class="card" onClick="document.location.href='index.php?id=<?= $yacht->id ?>'">
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
                </li>
                <?php
            }
            ?>
        </ul>
    <?php else : ?>
        <p>Нет ни одной яхты.</p>
    <?php endif; ?>
</div>
</body>
</html>