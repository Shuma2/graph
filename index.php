<?php
include $_SERVER['DOCUMENT_ROOT'] . '/inc/helpers.inc.php';

function countNumberOfWork() { //подсчёт кол-ва записел в поле #
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    try{
        $result = 'SELECT COUNT(*) AS num FROM work WHERE workdate = CURDATE()';
        $s = $pdo->prepare($result);
        $s->execute();
    }
    catch(PDOException $e) {
        errorText('Unable to count numbers of works: ', $e);
    }

    $row = $s->fetch();
    htmlOut($row[0] + 1);
}

if(isset($_POST['action']) && $_POST['action'] == 'addWork') { //нажатие кнопки "Add work"
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    $insert = 'INSERT INTO work SET ';
    $work = ' main = :main,';
    $time = ' worktime = :time,';
    $comment = ' comment = :comment,';
    $date = ' workdate = CURDATE(),';
    $status = ' status = 3;';

    $placeholders = array();

    if(($_POST['workToDo']) == '' || ($_POST['time']) == ''){
        $error = 'Need to fill both fields';
        include $_SERVER['DOCUMENT_ROOT'] . '/inc/error.html.php';
        exit();
    }

    if ($_POST['workToDo'] != '') {
        $placeholders[':main'] = $_POST['workToDo'];
    }

    if ($_POST['time'] != '') {
        $placeholders[':time'] = $_POST['time'];
    }

    if ($_POST['comment'] != '') {
        $placeholders[':comment'] = $_POST['comment'];
    }

    try{
        $sql = $insert . $work . $time . $comment . $date . $status;
        $s = $pdo->prepare($sql);
        $s->execute($placeholders);
    }
    catch(PDOException $e) {
        errorText('Unable to insert query: ', $e);
    }
    header('Location: .');
    exit();
}

if(isset($_POST['control']) && $_POST['control'] == 'Delete') { //удаление поля
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    try{
        $sql = 'DELETE FROM work WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch(PDOException $e) {
        errorText('Unable to delete row: ', $e);
    }
    header('Location: .');
    exit();
}

if(isset($_POST['control']) && $_POST['control'] == 'Edit') { //нажатие кнопки "Edit" в таблице
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    try{
        $sql = 'SELECT id, main, worktime, comment FROM work WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch(PDOException $e) {
        errorText('Unable to select row for edit: ', $e);
    }

    $row = $s->fetch();

    $button = 'Update';
    $workToDo = $row['main'];
    $timeForWork = $row['worktime'];
    $commentForWork = $row['comment'];
}

if(isset($_GET['editWork'])) { //разобраться с UPDATE
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    try{
        $sql = 'UPDATE work SET main = :main, worktime = :worktime, comment = :comment WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':main', $_POST['workToDo']);
        $s->bindValue(':worktime', $timeForWork);
        $s->bindValue(':comment', $commentForWork);
        $s->bindValue(':id', $table['id']);
        $s->execute();
    }
    catch(PDOException $e){
        errorText('Unable to update values: ', $e);
    }
    header('Location: .');
    exit();
}

//SELECT в главную таблицу
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
        'work' => $row['main'],
        'workTime' => $row['worktime'],
        'status' => $row['status'],
        'comment' => $row['comment']
    );
}

include $_SERVER['DOCUMENT_ROOT'] . '/php/main.php';



