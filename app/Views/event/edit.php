<?php
helper('form');
helper('url');
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

echo "<h2>" . $title ."</h2>";
echo $this->include('lesson/form') ;