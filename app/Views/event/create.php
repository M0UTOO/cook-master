<?php
helper('form');
helper('url');
echo $this->include('layouts/head') ;

echo '<body>';
echo $this->include('layouts/header') ;

echo "<h2>" . $title ."</h2>";
echo $this->include('event/form') ;