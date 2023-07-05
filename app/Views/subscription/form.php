<?php
helper('form');
helper('url');

    $hidden_input = [];
    $url = uri_string();
    $url = preg_replace('/[0-9]+/', '', $url);
    if ($url == "subscription/edit/") {
        $action = "subscription/edit/".$subscription['idsubscription'];
    } else {
        $action = "subscription/create";
    }

    echo form_open_multipart($action, 'id="subscription-create-form" class="subscription-card"', $hidden_input);

                $value = (isset($subscription) ? $subscription['picture'] :'');
                if ($value)
                {
                    echo '<img class="mb-3 img-fluid img-thumbnail"  alt="can\'t load picture" src="' . base_url("assets/images/subscriptions/" . $value) . '" />';
                }

                echo '<div class="form-group mb-3">';
                            echo form_label('Subscription name' , "label-subscription-name");
                            $value = (isset($subscription) ? $subscription['name'] :'');
                            echo form_input(['type'  => 'text', 'name'  => 'name', 'class' => 'form-control', 'value' => $value, 'placeholder' => "Name of subscription", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label( lang('Common.name') , "label-subscription-description");
                $value = (isset($subscription) ? $subscription['description'] :'');
                echo form_input(['type'  => 'textarea', 'name'  => 'description', 'class' => 'form-control', 'value' => $value, 'placeholder' => "Description of subscription", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_label( lang('Common.subscriptionPrice') , "label-subscription-price");
                    $value = (isset($subscription) ? $subscription['price'] :'');
                    echo form_input(['type'  => 'numeric', 'name'  => 'price', 'class' => 'form-control', 'value' => $value,'placeholder' => "Price of subscription (€/month)", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_label( lang('Common.maxLessonsPerDay') , "label-subscription-maxlessonaccess");
                    $value = (isset($subscription) ? $subscription['maxlessonaccess'] :'');
                    echo form_input(['type'  => 'numeric', 'name'  => 'maxlessonaccess', 'class' => 'form-control', 'value' => $value, 'placeholder' => "Maximum lesson viewable a day", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_label( lang('Common.picture') , "label-subscription-picture");
                    echo form_input(['type'  => 'file', 'name'  => 'picture', 'class' => 'form-control']);
                echo '</div>';

                $booleans = [
                    'allowroombooking' => lang('Common.allowRoomBooking'),
                    'allowshopreduction' => lang('Common.allowShopReduction'),
                    'allowchat' => lang('Common.allowChat'),
                ];
                $isChecked = true;


                echo "<div class='form-group'>";
                echo "<label>".lang('Common.subscriptionAutorization')."</label>";
                foreach ($booleans as $key => $value){
                    echo '<div class="form-check">';
                    if (isset($subscription) && $subscription[$key] == 1){
                        echo '<input class="form-check-input" checked="checked" type="checkbox" id="check-'.$key.'" name='. $key .' value="'. $isChecked.'" >';
                        echo '<label class="form-check-label">'. $value .'</label>';
                    } else {
                        echo '<input class="form-check-input" type="checkbox" id="check-'.$key.'" name='. $key .' value="'. $isChecked.'" >';
                        echo '<label class="form-check-label">'. $value .'</label>';
                    }
                    echo "</div>";
                }
                echo "</div>";

                echo '<div class="form-group mb-3">';
                    echo form_submit('', lang('Common.save'), 'class="btn blue-btn form-control mt-3"');
                echo '</div>';
    echo form_close();

    echo '</main>';
    echo $this->include('layouts/footer')
?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>
