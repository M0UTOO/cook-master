<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TEST</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

</head>
<body>
<?php

use function PHPUnit\Framework\isEmpty;

if (isset($foo)) {
    echo $foo;
} else {
    echo $error;
}
?>
</body>
</html>