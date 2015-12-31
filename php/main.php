<?php
$id = null;
$workToDo = null;
$time = null;
$comment = null;

if(isset($_POST['id']))
    $id = $_POST['id'];
else
    echo "No ID";

if(isset($_POST['workToDo']))
    $workToDo = $_POST['workToDo'];
else
    echo "Enter work";

if(isset($_POST['time']))
    $time = $_POST['time'];
else
    echo "Enter time";

if(isset($_POST['comment']))
    $comment = $_POST['comment'];
else
    echo "Enter comment";

//echo $id;
//echo $workToDo;
//echo $time;
//echo $comment;
