<?php
function isValidImageFileName($fileName) {
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);

    // Check if the extension corresponds to a valid image format
    if (in_array($extension, array('jpg', 'jpeg', 'png', 'gif'))) {
        return true;
    }

    return false;
}
?>