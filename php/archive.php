<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/inc/helpers.inc.php';

include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

try
{
    $result = $pdo->query('SELECT id, main, workdate, worktime, status, comment FROM work ORDER BY workdate DESC');
}
catch(PDOException $e)
{
    errorText('Unable to select list of works: ', $e);
}

foreach($result as $row)
{
    $allDates[] = array(
        'id' => $row['id'],
        'main' => $row['main'],
        'workdate' => $row['workdate'],
        'worktime' => $row['worktime'],
        'status' => $row['status'],
        'comment' => $row['comment']);
}

include 'archive.html.php';