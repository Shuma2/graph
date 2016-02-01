<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/inc/helpers.inc.php';

if(isset($_GET['action']) && ($_GET['action']) == 'search')
{
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    $select = 'SELECT main, worktime, workdate, status, comment FROM work WHERE ';
    $work = ' main LIKE "%:main%"';
    $comment = ' AND comment LIKE "%:comment%"';
    //$date = ' workdate = :workdate';

    $placeholders = array();

//    if(($_GET['workSearch']) == '' && ($_GET['dateSearch']) == '' && ($_GET['commentSearch']) == '') {
//        header('Location: archive.php?error');
//        exit();
//    }

    if($_GET['workSearch'] != '')
    {
        $placeholders[':main'] = $_GET['workSearch'];
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
        $sql = $select . $work . $comment . $date;
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