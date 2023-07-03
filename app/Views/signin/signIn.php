<?= $this->include('layouts/head') ?>

<body >
    <div class="signInBody">
            <?= $this->include('layouts/header');

            echo "<section id='signIn-section' class='w-100 column-list'>";
            echo $this->include('signin/signInForm.php');

            echo "</section>";

            echo '<section id="signUp-section" class="w-100 column-list">';
            echo $this->include('users/signUpForm.php');

            echo "</section>";
            ?>
        </main>
    </div>
<?= $this->include('layouts/footer') ?>
</body>

<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>