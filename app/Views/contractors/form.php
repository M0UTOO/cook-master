<?php

//TODO : disable picture and presentation input if manager is creating account or do not put it.
use App\Controllers\ContractorType;

echo '<div class="form-group">';
echo form_label('Your presentation' , "label-presentation");
echo form_input(['type'  => 'textarea', 'name'  => 'presentation', 'class' => 'form-control', 'placeholder' => "Your presentation (can use MD format)"]);
echo '</div>';

echo '<div class="form-group">';
echo form_label('Contract start date' , "label-start-date");
echo form_input(['type'  => 'date', 'name'  => 'contractstart', 'class' => 'form-control', 'placeholder' => "Contract start date", 'required' => 'required']);
echo '</div>';

echo '<div class="form-group">';
echo form_label('Contract end date' , "label-end-date");
echo form_input(['type'  => 'date', 'name'  => 'contractend', 'class' => 'form-control', 'placeholder' => "Contract end date", 'required' => 'required']);
echo '</div>';

/*//TODO: GET THIS FROM THE DATABASE ONCE IT'S DONE IN THE API
$typeOfContractors = [
    'cook'  => 'Cook',
    'deliverer'    => 'Deliverer',
    'seller'  => 'Seller',
    'other' => 'Other contractor type',
];*/

$typeOfContractors = new ContractorType();
//var_dump($typeOfContractors);


echo '<div class="form-group">';
echo form_label('Type of contractors' , "label-type-contractor");
//echo form_dropdown('idcontractortype', $typeOfContractors, '1', 'class="form-control"');
echo '</div>';