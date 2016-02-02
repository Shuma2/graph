<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/inc/helpers.inc.php';

if(isset($_GET['action']) && ($_GET['action']) == 'search')
{
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    $select = 'SELECT main, worktime, workdate, status, comment FROM work WHERE ';
    $work = '';
    $comment = '';
//    $date = ' AND workdate = :workdate';

    $placeholders = array();

//    if(($_GET['workSearch']) == '' && ($_GET['dateSearch']) == '' && ($_GET['commentSearch']) == '') {
//        header('Location: archive.php?error');
//        exit();
//    }

    if($_GET['workSearch'] == '' && $_GET['commentSearch'] == '')
    {
        $error = 'Need to fill one or more field';
        include $_SERVER['DOCUMENT_ROOT'] . '/inc/error.html.php';
        exit();
    }

//    if(isset($_GET['dateSearch']))
//    {
//        $placeholders[':workdate'] = $_GET['dateSearch'];
//    }

    if($_GET['workSearch'] != '')
    {
        $work .= ' main LIKE :main ';
        $placeholders[':main'] = '%' . $_GET['workSearch'] . '%';
    }

    if($_GET['workSearch'] != '' && $_GET['commentSearch'] != '')
    {
        $work .= ' main LIKE :main ';
        $comment .= ' AND comment LIKE :comment ';
        $placeholders[':comment'] = '%' . $_GET['commentSearch'] . '%';
    }

    if($_GET['workSearch'] == '' && $_GET['commentSearch'] != '')
    {
        $comment .= ' comment LIKE :comment ';
        $placeholders[':comment'] = '%' . $_GET['commentSearch'] . '%';
    }

    try{
        $sql = $select . $work . $comment . ' ORDER BY workdate DESC';
        $s = $pdo->prepare($sql);
        $s->execute($placeholders);
    }
    catch(PDOException $e) {
        errorText('Unable to insert query: ', $e);
    }

    foreach($s as $row)
    {
        $searchResult[] = array(
            'main' => $row['main'],
            'worktime' => $row['worktime'],
            'workdate' => $row['workdate'],
            'status' => $row['status'],
            'comment' => $row['comment']
        );
    }
    include 'archive.html.php';
    exit();
}

include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

try
{
    $result = $pdo->query('SELECT id, main, workdate, worktime, status, comment FROM work WHERE workdate <>(SELECT max(workdate) FROM work) ORDER BY workdate DESC');
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