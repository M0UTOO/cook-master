<?php

echo $this->include('layouts/head') ;

echo '<body>';
echo $this->include('layouts/header') ;

echo "<h2>" . $title ."</h2>";

echo $this->include('ingredient/form') ;