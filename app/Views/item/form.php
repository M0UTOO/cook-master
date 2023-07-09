<?php
helper('form');
helper('url');

    $hidden_input = [];
    $url = uri_string();
    $url = preg_replace('/[0-9]+/', '', $url);
    $action = "item/create";

    echo form_open_multipart($action, 'id="premise-create-form" class="premise-card"', $hidden_input);

                echo '<div class="form-group mb-3">';
                            echo form_label('Item name' , "label-premise-name");
                            echo form_input(['type'  => 'text', 'name'  => 'name', 'class' => 'form-control', 'placeholder' => "Name of item", 'required' => 'required']);
                echo '</div>'; 

                echo '<div class="form-group mb-3">';
                    echo form_submit('', 'Save', 'class="blue-btn btn mt-3 form-control"');
                echo '</div>';
    echo form_close();

    echo '</main>';
    echo $this->include('layouts/footer')
?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>
