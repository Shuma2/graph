<?php
include $_SERVER['DOCUMENT_ROOT'] . '/inc/helpers.inc.php';

if(!isset($_COOKIE['statusUpdate']))
{
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    try
    {
        $result = $pdo->query('UPDATE work SET status = 0 WHERE status <> 1 AND workdate <> CURDATE()');
    }
    catch(PDOException $e)
    {
        errorText('Unable to update status: ', $e);
    }

    setcookie('statusUpdate', 1, strtotime('today 23:59'), '/');

    header('Location: .');
    exit();
}

$placeholderWork = 'What need to do';
$placeholderTime = 'Number of minutes';

function countNumberOfWork() { //подсчёт кол-ва записел в поле #
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    if(isset($_POST['control']) && $_POST['control'] == 'Edit'){ //подсчёт при реадктировании
        try{
            $result = $pdo->query('SELECT id FROM work WHERE workdate = CURDATE()');
        }
        catch(PDOException $e) {
            errorText('Unable to select number of work from table: ', $e);
        }

        $post = $_POST['id'];
        foreach($result as $row) {
            $nowID[] = array('id' => $row['id']);
        }

        foreach($nowID as $key => $id){
            if(in_array($post, $id)){
                echo $key + 1;
            }
        }
    }
    else{ //подсчёт при обычной форме
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

}

if(isset($_POST['action']) && $_POST['action'] == 'Add Work') { //нажатие кнопки "Add work"
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    $insert = 'INSERT INTO work SET ';
    $work = ' main = :main,';
    $time = ' worktime = :time,';
    $comment = '';
    $date = ' workdate = CURDATE(),';
    $status = ' status = 3;';

    $placeholders = array();

    if(($_POST['workToDo']) == '' || ($_POST['time']) == ''){
        session_start();
        $_SESSION['workToDo'] = $_POST['workToDo'];
        $_SESSION['time'] = $_POST['time'];

        header('Location: index.php?error');
        exit();
    }

    if ($_POST['workToDo'] != '') {
        $placeholders[':main'] = $_POST['workToDo'];
    }

    if ($_POST['time'] != '') {
        $placeholders[':time'] = $_POST['time'];
    }

    if ($_POST['comment'] != '') {
        $comment = ' comment = :comment,';
        $placeholders[':comment'] = $_POST['comment'];
    }

    if($_POST['comment'] == '') {
        $comment = '';
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

if(isset($_POST['action']) && $_POST['action'] == 'Update') { //разобраться с UPDATE и какие должны быть методы заголовков
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    try{
        $sql = 'UPDATE work SET main = :main, worktime = :worktime, comment = :comment WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':main', $_POST['workToDo']);
        $s->bindValue(':worktime', $_POST['time']);
        $s->bindValue(':comment', $_POST['comment']);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch(PDOException $e){
        errorText('Unable to update values: ', $e);
    }
    header('Location: .');
    exit();
}

if(isset($_POST['control']) && $_POST['control'] && $_POST['control'] == 'Delete') { //удаление поля
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

if(isset($_POST['control']) && $_POST['control'] && $_POST['control'] == 'Edit') { //нажатие кнопки "Edit" в таблице
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    $idHere = $_POST['id'];
    try{
        $sql = 'SELECT id, main, worktime, comment FROM work WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $idHere);
        $s->execute();
    }
    catch(PDOException $e) {
        errorText('Unable to select row for edit: ', $e);
    }

    $row = $s->fetch();

    $id = $row['id'];
    $action = 'editWork';
    $button = 'Update';
    $workToDo = $row['main'];
    $timeForWork = $row['worktime'];
    $commentForWork = $row['comment'];
}

if(isset($_POST['control']) && $_POST['control'] && $_POST['control'] == 'Done')
{
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    try{
        $sql = 'UPDATE work SET status = 1 WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    }
    catch(PDOException $e){
        errorText('Unable to update values: ', $e);
    }

    header('Location: .');
    exit();
}

if(isset($_POST['random']) == 'Add random'){
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    try{
        $result = $pdo->query('INSERT INTO work SET main = concat(\'Graph|\', floor((RAND() * 201) + 10)), worktime = 3, workdate = CURDATE(), status = 3, comment = \'TEST\'');
    }
    catch(PDOException $e) {
        errorText('Unable to insert random work: ', $e);
    }

    header('Location: .');
    exit();
}

if(isset($_GET['error'])){
    session_start();
    if($_SESSION['workToDo'] == '')
        $placeholderWork = 'Need to fill that field';
    else
        $workToDo = $_SESSION['workToDo'];

    if($_SESSION['time'] == '')
        $placeholderTime = 'Need to fill that field';
    else
        $timeForWork = $_SESSION['time'];

    $emptyWork = '<style>' . '#workToDo::-webkit-input-placeholder{color:#ff551b;} #workToDo::-moz-placeholder{color:#ff551b;} #workToDo:-ms-input-placeholder{color:#ff551b;}' . '</style>';
    $emptyTime = '<style>' . '#time::-webkit-input-placeholder{color:#ff551b;} #time::-moz-placeholder{color:#ff551b;} #time:-ms-input-placeholder{color:#ff551b;}' . '</style>';
    session_abort();
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



