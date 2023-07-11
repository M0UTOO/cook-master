<?php
helper('form');
helper('url');
echo $this->include('layouts/head') ;

echo '<body>';
echo $this->include('layouts/header') ;

echo "<h2>" . $title ."</h2>";
if (isClient()) {
    echo $this->include('users/form') ;
} else if (isManager()) {
    echo $this->include('users/managerform') ;
} else if (isContractor()) {
    echo $this->include('users/contractorform') ;
}