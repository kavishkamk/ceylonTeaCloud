<?php

/**
 * This method creates a console log with the passed variables
 * @param $data
 */
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

function function_alert($message) {
    // Display the alert box
    echo "<script>alert('$message');</script>";
}