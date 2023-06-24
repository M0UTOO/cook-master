<?php
function pagination($data) : array {
    $totalEvents = count($data);
    $totalPages = ceil($totalEvents / 25);
    $resp['totalPages'] = $totalPages;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calculate the start index for the desired range
    $startIndex = 25 + (($page - 2) * 25); // Calculate the start index for the desired range

    // Check if the start index is valid
    if ($startIndex < $totalEvents) {
        $endIndex = min($startIndex + 25 - 1, $totalEvents - 1);

        // Update the 'display' variable with the desired range of events
        $resp['display'] = array_slice($data, $startIndex, $endIndex - $startIndex + 1);
    } else {
        // If the start index is out of range, set 'display' to an empty array
        $resp['display'] = [];
    }
    return $resp;
}
?>