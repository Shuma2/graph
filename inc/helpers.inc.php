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
    $line = date('[d.m.Y H:i:s]: ');
    $log = fopen("inc/ErrorLog.txt", 'a') or die("Unable to create file");
    fwrite($log, $line . $error . "\n") or die ('Unable to write data');
    fclose($log);
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/error.html.php';
    exit();
}

function reformatDateToDB($date)
{
    $dateFormat = date_create($date);
    return date_format($dateFormat, 'Y-m-d');
}

function reformatDateToList($date)
{
    $dateFormat = date_create($date);
    return date_format($dateFormat, 'd.m.Y');
}

function statusCheck($status)
{
    if($status == 0) {
        echo 'Failed';
    }
    elseif($status == 1){
        echo 'Success';
    }
    elseif($status == 2){
        echo 'In progress';
    }
    elseif($status == 3){
        echo 'Waiting';
    }
    else{
        echo 'Unknown status';
    }
}