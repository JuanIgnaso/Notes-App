<!DOCTYPE html>
<html lang="en">
<?php
use juanignaso\phpmvc\framework\Application;

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/styles.css">
    <link rel="stylesheet" href="/resources/css/common.css">
    <link rel="stylesheet" href="resources/css/form.css">
    <link rel="stylesheet" href="resources/icons/fontawesome/css/all.css">
    <title>
        <?php echo $this->title;
        ?>
    </title>
</head>

<body>

    <div class="container">
        {{content}}
    </div>

    <!-- FOOTER -->
    <?php
    include 'webFooter.php';
    ?>