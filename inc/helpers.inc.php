<?php
function html($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function htmlOut($text)
{
    echo html($text);
}

function errorText($erText, $e)
{
    $error = "$erText: " . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/error.html.php';
    exit();
}

function reformatDateToDB($date)
{
    $dateFormat = date_create($date);
    return $dateComplete = date_format($dateFormat, 'Y-m-d');
}