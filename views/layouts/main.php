<!DOCTYPE html>
<html lang="en">
<?php
use app\core\Application;

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/styles.css">
    <link rel="stylesheet" href="resources/icons/fontawesome/css/all.css">
    <title>
        <?php echo $this->title;
        ?>
    </title>
</head>

<body>
    <?php
    if (!Application::isGuest()) {
        ?>
        <div id="menuUsuario">
            <i class="fa-solid fa-circle-user"></i>
            <span>
                <?php echo Application::$app->user->getUserName(); ?>
                <a href="/logout"><i class="fa-solid fa-right-from-bracket"></i></a>
            </span>
        </div>

        <?php
    }
    ?>

    <div class="container">
        <?php
        if (Application::$app->session->getFlash('success')) {
            ; ?>
            <div class="alert">
                <div class="background">
                    <p>
                        <?php echo Application::$app->session->getFlash('success'); ?>
                    </p>
                </div>
            </div>
            <?php
        }
        ?>


        {{content}}
    </div>

    <!-- FOOTER -->
    <?php
    include 'webFooter.php';
    ?>