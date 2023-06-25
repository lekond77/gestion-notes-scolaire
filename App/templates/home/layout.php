<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="public/style/style.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="/public/images/flag.jpeg">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https:unpkg.com/feather-icons"></script>
</head>

<body>

    <?php !empty($nav) ? include_once $nav : '' ?>

    <div id="container">

        <?= $content ?>

    </div>
    <?php !empty($footer) ? include_once $footer : '' ?>


    <script src="public/script/script.js" defer></script>