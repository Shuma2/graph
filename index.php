<?php
include $_SERVER['DOCUMENT_ROOT'] . '/inc/helpers.inc.php';

if(isset($_POST['action']) == 'addWork') {
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    $insert = 'INSERT INTO "work" SET ';
    $work = ' main = :main,';
    $time = ' worktime = :time,';
    $comment = ' comment = :comment,';
    $date = ' workdate = CURDATE(),';
    $status = ' status = 3';

    $placeholders = array();

    if ($_POST['workToDo'] != '') {
        $placeholders[':main'] = $_POST['workToDo'];
    }

    if ($_POST['time'] != '') {
        $placeholders[':time'] = $_POST['time'];
    }

    if ($_POST['comment'] != '') {
        $placeholders[':comment'] = $_POST['comment'];
    }

    if(!isset($_POST['workToDo']) || !isset($_POST['time'])){
        $error = 'Need to fill both fields';
        include $_SERVER['DOCUMENT_ROOT'] . '/inc/error.html.php';
        exit();
    }

    try{
        $sql = $insert . $work . $time . $comment . $date . $status;
        $s = $pdo->prepare($sql);
        $s->execute($placeholders);
    }
    catch(PDOException $e) {
        errorText('Unable to insert query: ', $e);
    }
}

include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

try{
    $result = $pdo->query('SELECT id, main, worktime, status, comment FROM work WHERE workdate = CURDATE()');
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



