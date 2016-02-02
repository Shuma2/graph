<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/inc/helpers.inc.php';

if(isset($_GET['action']) && ($_GET['action']) == 'search')
{
    include $_SERVER['DOCUMENT_ROOT'] . '/inc/db.inc.php';

    $select = 'SELECT main, worktime, workdate, status, comment FROM work WHERE ';
    $work = '';
    $comment = '';
    $date = '';

    $placeholders = array();

    if($_GET['workSearch'] == '' && $_GET['commentSearch'] == '' && $_GET['dateSearch'] == '' && $_GET['dateSearch2'] == '')
    {
        $error = 'Need to fill one or more field';
        include $_SERVER['DOCUMENT_ROOT'] . '/inc/error.html.php';
        exit();
    }

    if(($_GET['dateSearch'] != '' && $_GET['dateSearch2'] == '') || ($_GET['dateSearch'] == '' && $_GET['dateSearch2'] != ''))
    {
        $date .= ' workdate = :workdate';
        $placeholders[':workdate'] = reformatDateToDB($_GET['dateSearch']);
        $placeholders[':workdate'] = reformatDateToDB($_GET['dateSearch2']);
    }

    if($_GET['dateSearch'] != '' && $_GET['dateSearch2'] != '')
    {
        $date = '';
        $date = ' workdate BETWEEN :workdate AND :workdate2';
        $placeholders[':workdate'] = reformatDateToDB($_GET['dateSearch']);
        $placeholders[':workdate2'] = reformatDateToDB($_GET['dateSearch2']);
    }

    if($_GET['workSearch'] != '')
    {
        $work .= ' main LIKE :main ';
        $placeholders[':main'] = '%' . $_GET['workSearch'] . '%';
    }

    if($_GET['workSearch'] == '' && $_GET['commentSearch'] != '')
    {
        $comment .= ' comment LIKE :comment ';
        $placeholders[':comment'] = '%' . $_GET['commentSearch'] . '%';
    }

    if($_GET['workSearch'] != '' && $_GET['dateSearch'] != '')
    {
        $work = '';
        $work .= ' main LIKE :main ';
        $date = '';
        $date .= ' AND workdate = :workdate';
        $placeholders[':main'] = '%' . $_GET['workSearch'] . '%';
        $placeholders[':workdate'] = reformatDateToDB($_GET['dateSearch']);
    }

    if($_GET['workSearch'] != '' && $_GET['dateSearch2'] != '')
    {
        $work = '';
        $work .= ' main LIKE :main ';
        $date = '';
        $date .= ' AND workdate = :workdate';
        $placeholders[':main'] = '%' . $_GET['workSearch'] . '%';
        $placeholders[':workdate'] = reformatDateToDB($_GET['dateSearch2']);
    }

    if($_GET['commentSearch'] != '' && $_GET['dateSearch'] != '')
    {
        $comment = '';
        $comment .= ' comment LIKE :comment ';
        $date = '';
        $date .= ' AND workdate = :workdate';
        $placeholders[':comment'] = '%' . $_GET['commentSearch'] . '%';
        $placeholders[':workdate'] = reformatDateToDB($_GET['dateSearch']);
    }

    if($_GET['commentSearch'] != '' && $_GET['dateSearch2'] != '')
    {
        $comment = '';
        $comment .= ' comment LIKE :comment ';
        $date = '';
        $date .= ' AND workdate = :workdate';
        $placeholders[':comment'] = '%' . $_GET['commentSearch'] . '%';
        $placeholders[':workdate'] = reformatDateToDB($_GET['dateSearch2']);
    }

    if($_GET['workSearch'] != '' && $_GET['commentSearch'] != '' && $_GET['dateSearch'] != '')
    {
        $work = '';
        $work .= ' main LIKE :main ';
        $comment = '';
        $comment .= ' AND comment LIKE :comment ';
        $date = '';
        $date .= ' AND workdate = :workdate';
        $placeholders[':main'] =  '%' . $_GET['workSearch'] . '%';
        $placeholders[':comment'] = '%' . $_GET['commentSearch'] . '%';
        $placeholders[':workdate'] = reformatDateToDB($_GET['dateSearch']);
    }

    if($_GET['workSearch'] != '' && $_GET['commentSearch'] != '' && $_GET['dateSearch2'] != '')
    {
        $work = '';
        $work .= ' main LIKE :main ';
        $comment = '';
        $comment .= ' AND comment LIKE :comment ';
        $date = '';
        $date .= ' AND workdate = :workdate';
        $placeholders[':main'] =  '%' . $_GET['workSearch'] . '%';
        $placeholders[':comment'] = '%' . $_GET['commentSearch'] . '%';
        $placeholders[':workdate'] = reformatDateToDB($_GET['dateSearch2']);
    }

    if($_GET['workSearch'] != '' && $_GET['commentSearch'] != '' && ($_GET['dateSearch']) != '' && ($_GET['dateSearch2']) != '')
    {
        $work = '';
        $work .= ' main LIKE :main ';
        $comment = '';
        $comment .= ' AND comment LIKE :comment ';
        $date = '';
        $date .= ' AND workdate BETWEEN :workdate AND :workdate2';
        $placeholders[':main'] =  '%' . $_GET['workSearch'] . '%';
        $placeholders[':comment'] = '%' . $_GET['commentSearch'] . '%';
        $placeholders[':workdate'] = reformatDateToDB($_GET['dateSearch']);
        $placeholders[':workdate2'] = reformatDateToDB($_GET['dateSearch2']);
    }

    try{
        $sql = $select . $work . $comment . $date . ' ORDER BY workdate DESC';
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