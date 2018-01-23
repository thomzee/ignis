<?php
if (array_key_exists('success', $_SESSION)){
    $echo = '<div class="alert alert-success alert-dismissable" id="alert-flash-notification">';
    $echo .= $_SESSION['success'];
    $echo .= '</div>';

    echo $echo;
}

if (array_key_exists('danger', $_SESSION)){
    $echo = '<div class="alert alert-danger alert-dismissable" id="alert-flash-notification">';
    $echo .= $_SESSION['danger'];
    $echo .= '</div>';

    echo $echo;
}

if (array_key_exists('warning', $_SESSION)){
    $echo = '<div class="alert alert-warning alert-dismissable" id="alert-flash-notification">';
    $echo .= $_SESSION['warning'];
    $echo .= '</div>';

    echo $echo;
}

if (array_key_exists('primary', $_SESSION)){
    $echo = '<div class="alert alert-primary alert-dismissable" id="alert-flash-notification">';
    $echo .= $_SESSION['primary'];
    $echo .= '</div>';

    echo $echo;
}
?>