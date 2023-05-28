<?php
echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;

    echo "<h2>" . $title . "<img alt='logo' class='' src=" . base_url("assets/images/svg/moon-icon.svg") . " /></h2>";

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
        if (isManager()){
            echo '<a href="/contractorType/create"><img src=' . base_url("assets/images/svg/add-user-icon-blue.svg") . ' alt="plus-icon" class="icons" /></a>';
        }

    echo "<section id='all-contractorTypes'>";
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
        echo '<th scope="col">#</th>';
        echo '<th scope="col">Name</th>';
        echo '<th scope="col">Actions</th>';
    echo '</tr>';
    echo '</thead>';

    echo '<tbody class="table-group-divider">';

            if (isset($contractorTypes) && is_array($contractorTypes)){
                $count = 0;
                foreach ($contractorTypes as $contractorType){
                    $count +=1;
                    echo "<td>$count</td>";
                    echo "<td>$contractorType->name</td>";
                    echo '<td>';
                        echo '<a href="/contractorType/delete/' . $contractorType->idcontractortype . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                    echo '</td>';

                    echo "<a href='#' class='btn'>Save</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>There are no contractorTypes yet.</p>";
            }

        echo "</section>";
    echo '</main>';
    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>


<!--before-->
<!--echo "<a href='".base_url('contractorType/'.$subscription->idsubscription)."' class='card'>";-->
<!--echo "<div class='card-header'>";-->
<!--    echo "Check this out !";-->
<!--    echo "</div>";-->
<!--echo "<div class='card-body'>";-->
<!--    echo "<h5 class='card-title'>".$subscription->name."</h5>";-->
<!--    echo "<p class='card-text'> Price : ". $subscription->price." €</p>";-->
<!--    echo "</div>";-->
<!--echo "</a>";-->