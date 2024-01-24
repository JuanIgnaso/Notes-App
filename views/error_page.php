<h1 class="tituloPagina">Ha ocurrido un error</h1>

<main id="main_container">
    <div id="container_inner">
        <h2 class="tituloPagina" style="margin-bottom:1em;">
            <?php echo "<span>Error " . $exception->getCode() . "</span> - " . $exception->getMessage(); ?>
        </h2>
        <div id="error">
            <div class="posterTape"></div>
            <div class="posterTape"></div>
            <div class="posterTape"></div>
            <div class="posterTape"></div>
        </div>
    </div>
</main>