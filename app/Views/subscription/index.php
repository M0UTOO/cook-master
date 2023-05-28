<?php
echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;

    if (isset($message)) {
        try {
            echo $message ;
        } catch (\Exception $e) {
            echo "Something went wrong. Please try again later.";
        }
    }

    if (session()->getFlashdata('message')){
        echo '<div class="alert alert-warning" role="alert">';
        echo session()->getFlashdata('message');
        echo '</div>';
    }
        echo "<section id='all-subscriptions'>";

            if (isset($subscriptions)){
                foreach ($subscriptions as $subscription){
                    echo "<a href='".base_url('subscription/'.$subscription->idsubscription)."' class='card'>";
                        echo "<div class='card-header'>";
                            echo "Check this out !";
                        echo "</div>";
                        echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>".$subscription->name."</h5>";
                            echo "<p class='card-text'> Price : ". $subscription->price." €</p>";
                        echo "</div>";
                    echo "</a>";
                }
            }
        echo "</section>";
    echo '</main>';
    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>