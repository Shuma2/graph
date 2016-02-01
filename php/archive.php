<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/inc/helpers.inc.php';

if(isset($_GET['Search']))
{
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    $select = 'SELECT main, worktime, workdate, status, comment FROM work ';
    $work = ' main = :main,';
    $time = ' worktime = :time,';
    $comment = ' comment = :comment,';
    $date = ' workdate = :workdate';
    $status = ' status = 3;';

    $placeholders = array();

//    if(($_GET['searchWork']) == '' && ($_GET['dateSearch']) == '' && ($_GET['commentSearch']) == '') {
//        header('Location: archive.php?error');
//        exit();
//    }

    if($_GET['searchWork'] != '')
    {
        $placeholders[':main'] = $_GET['searchWork'];
    }

    if($_GET['dateSearch'] != '')
    {
        $placeholders[':workdate'] = $_GET['dateSearch'];
    }

    if($_GET['commentSearch'] != '')
    {
        $placeholders[':comment'] = $_GET['commentSearch'];
    }

    try{
        $sql = $select . $work . $time . $comment . $date . $status;
        $s = $pdo->prepare($sql);
        $s->execute($placeholders);
    }
    catch(PDOException $e) {
        errorText('Unable to insert query: ', $e);
    }
    header('Location: .');
    exit();
}

//if(isset($_GET['error'])){
//    $placeholderWorkSearch = 'Need to fill that field';
//    $placeholderDateSearch = 'Need to fill that field';
//    $emptyWork = '<style>' . '#workToDo::-webkit-input-placeholder{color:#FF0000;} #workToDo::-moz-placeholder{color:#FF0000;} #workToDo:-ms-input-placeholder{color:#FF0000;}' . '</style>';
//    $emptyTime = '<style>' . '#time::-webkit-input-placeholder{color:#FF0000;} #time::-moz-placeholder{color:#FF0000;} #time:-ms-input-placeholder{color:#FF0000;}' . '</style>';
//}

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
    $dates[] = $row['workdate'];
}
$datesUnique = array_unique($dates); //удаление дубликатов из  $dates[] = $row['workdate'];

include 'archive.html.php';