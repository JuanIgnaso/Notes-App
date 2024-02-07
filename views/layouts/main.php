<!DOCTYPE html>
<html lang="en">
<?php
use juanignaso\phpmvc\framework\Application;

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/styles.css">
    <link rel="stylesheet" href="/resources/icons/fontawesome/css/all.css">
    <link rel="stylesheet" href="/resources/css/common.css">

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>
        <?php echo $this->title;
        ?>
    </title>
</head>

<body>


    <div class="container">
        <?php
        if (Application::$app->session->getFlash('success')) {
            ; ?>
            <div class="alert">
                <div class="background success">
                    <p>
                        <?php echo Application::$app->session->getFlash('success'); ?>
                    </p>
                </div>
            </div>
            <?php
        }
        ?>
        <?php
        if (Application::$app->session->getFlash('error')) {
            ; ?>
            <div class="alert">
                <div class="background danger">
                    <p>
                        <?php echo Application::$app->session->getFlash('error'); ?>
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