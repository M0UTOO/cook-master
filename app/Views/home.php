<?= $this->include('layouts/head') ?>
<body>
<?= $this->include('layouts/header') ?>
<main class="main">

    <?php

    use function PHPUnit\Framework\isEmpty;
    echo "<p id='api-message' class='.d-none'>";
    if (isset($message)) {
        echo $message;
    }
    echo "</p>"
    ?>

    <section id="incoming-events">
        <h2 id="incoming-events-title">Evènements à venir</h2>
        <?php

//        foreach ($data['events'] as $event){
//            echo "<div class='card'>";
//            echo "<div class='card-header'>";
//            echo $event['name'];
//            echo "</div>";
//            echo "<div class='card-body'>";
//            echo "<h5 class='card-title'></h5>";
//            echo "<p class='card-text'>With supporting text below as a natural lead-in to additional content.</p>";
//            echo "<a href='#' class='btn btn-primary'>Go somewhere</a>";
//            echo "</div>";
//            echo "</div>";
//        }
        ?>
    </section>

</main>
<?= $this->include('layouts/footer') ?>
</body>



</html>