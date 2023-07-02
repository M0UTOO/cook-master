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
        $subscription = getSubscription();
        if ($subscription){
            echo "<p>Subscription: ". $subscription['name']."</p>";
            echo "<p>You can access : ". $subscription['maxlessonaccess']." lessons a day</p>";
        }
        echo '<a href='.base_url('/subscriptions').'>Change subscriptions</a>';
        ?>
        </section>

    </main>
    <?= $this->include('layouts/footer') ?>
</body>

</html>