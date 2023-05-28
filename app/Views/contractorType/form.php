<?php
helper('form');

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

    $hidden_input = [];
    $action = "contractorType/create";


    echo form_open($action, 'id="contractorType-create-form" class=""', $hidden_input);

                echo '<div class="form-group mb-3">';
                            echo form_label('Subscription name' , "label-subscription-name");
                            $value = (isset($subscription) ? $subscription['name'] :'');
                            echo form_input(['type'  => 'text', 'name'  => 'name', 'class' => 'form-control', 'placeholder' => "New contractor type name", 'required' => 'required']);
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
