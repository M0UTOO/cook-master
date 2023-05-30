<?php
helper('form');

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

    $hidden_input = [];
    $action = "lessonGroup/create";


    echo form_open($action, 'id="lessonGroup-create-form" class=""', $hidden_input);

                echo '<div class="form-group mb-3">';
                            echo form_label('Group name' , "label-subscription-name");
                            $value = (isset($lessonGroup) ? $lessonGroup['name'] :'');
                            echo form_input(['type'  => 'text', 'name'  => 'name', 'class' => 'form-control', 'placeholder' => "New lesson group name", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_submit('', 'Save', 'class="btn btn-primary mt-3"');
                echo '</div>';
    echo form_close();

    echo '</main>';
    echo $this->include('layouts/footer')
?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>
