<?= $this->include('layouts/head') ?>

<body>
    <?= $this->include('layouts/header') ?>
    <main class="main">

<!--TODO: ADD DASHBOARD NAV-->
        <section id="user-info">

        <?php
            if (isset($user)){
                foreach ($user as $key => $value){
                    echo "<p>$key: $value</p>";
                }
            } else {
                echo "Error charging user info.";
            }

        //echo $this->include('');
        ?>
        </section>

    </main>
    <?= $this->include('layouts/footer') ?>
</body>

</html>