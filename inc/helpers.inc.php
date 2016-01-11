<?php
function html($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function htmlout($text)
{
    echo html($text);
}

function errorText($erText, $e)
{
    $error = "$erText: " . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/error.html.php';
    exit();
}