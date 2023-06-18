<?= $this->include('layouts/head') ?>

<body>

    <?= $this->include('layouts/header') ?>

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


        echo '<a href='.base_url('/subscriptions').'>Change subscriptions</a>';
        ?>
        </section>

    </main>
    <?= $this->include('layouts/footer') ?>
</body>

</html>