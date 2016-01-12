<?php
include $_SERVER['DOCUMENT_ROOT'] . '/inc/helpers.inc.php';
include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

try{
    $result = $pdo->query('SELECT id, work, worktime, status, comment FROM work WHERE workdate = CURDATE()');
}
catch(PDOException $e){
    errorText('Error of select list from DB', $e);
}

foreach($result as $row){
    $resultTable[] = array(
        'id' => $row['id'],
        'work' => $row['work'],
        'workTime' => $row['worktime'],
        'status' => $row['status'],
        'comment' => $row['comment']
    );
}

include $_SERVER['DOCUMENT_ROOT'] . '/php/main.php';



