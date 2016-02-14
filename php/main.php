<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Graph</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <!--  My  -->
    <link href="/css/menu.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.png" type="image/png">
    <?php echo $emptyWork; echo $emptyTime; ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="http://d3js.org/d3.v3.min.js"></script>
    <![endif]-->
</head>
<body>
<script src="/js/easytimer.min.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/nav.html.php'; ?>
<div class="main">
    <div class="container">
        <div class="panel-group">
            <form action="" method="post">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <?php if(isset($_POST['control']) && $_POST['control'] == 'Edit'): ?>
                        <input type="submit" name="action" class="btn btn-info" value="Update">
                        <?php else: ?>
                        <input type="submit" name="action" class="btn btn-primary" value="Add Work">
                            <input type="submit" name="random" class="btn btn-default" value="Add random"> <!-- button "Add random" only for developing -->
                        <?php endif; ?>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="id">#:</label>
                                    <input type="number" class="form-control" id="idWork" name="idWork" disabled value="<?php countNumberOfWork(); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="workToDo">Work:</label>
                                    <input type="text" class="form-control" id="workToDo" name="workToDo" placeholder="<?php echo $placeholderWork; ?>" value="<?php htmlOut($workToDo); ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="time">Time:</label>
                                    <input type="text" class="form-control" id="time" name="time" placeholder="<?php echo $placeholderTime; ?>" value="<?php htmlOut($timeForWork) ; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="comment">Comment:</label>
                                    <textarea class="form-control" rows="3" id="comment" name="comment" placeholder="Comment will be displayed, when you will hover the cursor in the list (future feature)"><?php htmlOut($commentForWork);?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="panel panel-info">
                <div class="panel-heading">List for <?php htmlOut(date('d.m.Y')); ?> (in developing)</div>
                <div class="panel-body">
                    <?php if(isset($resultTable)): ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th><th>Work</th><th>Time</th><th>Remaining time</th><th>Comment</th><th>Status</th><th>Timer</th><th>Controls</th>
                        </tr>
                        </thead>
                        <tbody>
                                <?php foreach($resultTable as $key => $table): ?>
                                <!--Начало строки таблицы-->
                                    <tr class="" id="trId<?php htmlOut($table['id']); ?>">
                                        <td><?php htmlOut($key + 1); //выводит отсчёт с 1 каждый день ?></td>
                                        <td><?php htmlOut($table['work']); ?></td>
                                        <td><?php htmlOut($table['workTime']); ?></td>
                                <!--Объявление таймера и JS переменных для таймера-->
                                        <td id="countdownTimer<?php htmlOut($table['id']); ?>">
                                            <script>
                                                var timeValue<?php htmlOut($table['id']); ?> = <?php htmlOut($table['workTime']); ?>;
                                            </script>
                                        </td>
                                        <td><?php htmlOut(substr($table['comment'], 0, 175)); ?></td>
                                        <td id="status<?php htmlOut($table['id']); ?>"><?php statusCheck($table['status']); ?></td>
                                <!--Кнопки таймера-->
                                        <td>
                                            <div class="player">
                                                <button type="button" id="button_play<?php htmlOut($table['id']); ?>" class="btn-xs btn" onclick='buttonPlayPress(<?php htmlOut($table['id']); ?>)' >
                                                    <i class="fa fa-play"></i>
                                                </button>
                                                <button type="button" id="button_pause<?php htmlOut($table['id']); ?>" class="btn-xs btn" onclick='buttonPausePress(<?php htmlOut($table['id']); ?>)'>
                                                    <i class="fa fa-pause"></i>
                                                </button>
                                            </div>
                                        </td>
                                <!--Кнопки edit/delete/done-->
                                        <form action="?" method="post">
                                            <div>
                                                <td id="hiddenIdRow"><input type="hidden" name="id" value="<?php echo $table['id']; ?>"></td>
                                                <td><input type="submit" id="editButton<?php htmlOut($table['id']); ?>" name="control" class="btn btn-info btn-xs" value="Edit">
                                                <input type="submit" id="deleteButton<?php htmlOut($table['id']); ?>" name="control" class="btn btn-danger btn-xs" value="Delete">
                                                <input type="submit" id="doneButton<?php htmlOut($table['id']); ?>" name="control" class="btn btn-success btn-xs" value="Done"></td>
                                            </div>
                                        </form>
                                <!--Просто вафли какая кривая реализация таймера-->
                                        <script>
                                            var timer<?php htmlOut($table['id']); ?> = new Timer();

                                            $('.table-striped #button_play<?php htmlOut($table['id']); ?>').click(function () {
                                                timer<?php htmlOut($table['id']); ?>.start({countdown: true, startValues: {seconds: timeValue<?php htmlOut($table['id']); ?>}});
                                                $('#trId<?php htmlOut($table['id']); ?>').removeClass('warning');
                                                $('#trId<?php htmlOut($table['id']); ?>').addClass('info');
                                                $('#status<?php htmlOut($table['id']); ?>').html('In progress');
                                            });
                                            $('.table-striped #button_pause<?php htmlOut($table['id']); ?>').click(function () {
                                                timer<?php htmlOut($table['id']); ?>.pause();
                                                $('#trId<?php htmlOut($table['id']); ?>').removeClass('info');
                                                $('#trId<?php htmlOut($table['id']); ?>').addClass('warning');
                                            });
                                            timer<?php htmlOut($table['id']); ?>.addEventListener('secondsUpdated', function () {
                                                $('.table-striped #countdownTimer<?php htmlOut($table['id']); ?>').html(timer<?php htmlOut($table['id']); ?>.getTimeValues().toString());
                                            });
                                            timer<?php htmlOut($table['id']); ?>.addEventListener('started', function () {
                                                $('.table-striped #countdownTimer<?php htmlOut($table['id']); ?>').html(timer<?php htmlOut($table['id']); ?>.getTimeValues().toString());
                                            });
                                            timer<?php htmlOut($table['id']); ?>.addEventListener('targetAchieved', function (e) {
                                                $('#countdownTimer<?php htmlOut($table['id']); ?>').html('Finished');
                                                $('#button_play<?php htmlOut($table['id']); ?>').removeClass('btn-success');
                                                $('#trId<?php htmlOut($table['id']); ?>').removeClass('info');
                                                $('#doneButton<?php htmlOut($table['id']); ?>').click();
                                            })
                                        </script>
                                <!--Мега-кривой disable выбраной строки-->
                                        <?php if($table['status'] == 1): ?>
                                            <script>
                                                document.getElementById("button_play<?php htmlOut($table['id']); ?>").disabled = true;
                                                document.getElementById("button_pause<?php htmlOut($table['id']); ?>").disabled = true;
                                                document.getElementById("editButton<?php htmlOut($table['id']); ?>").disabled = true;
                                                document.getElementById("deleteButton<?php htmlOut($table['id']); ?>").disabled = true;
                                                document.getElementById("doneButton<?php htmlOut($table['id']); ?>").disabled = true;
                                                document.getElementById("trId<?php htmlOut($table['id']); ?>").setAttribute("class","success text-muted");
                                            </script>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                        <?php elseif(!isset($resultTable)): ?>
                                <h3 id="notificationNoNotes">Sorry, no notes today</h3>
                            </tbody>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/footer.html.php'; ?>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/js/bootstrap.min.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/d3/3.4.11/d3.min.js'></script> <!--for timer-->
<script src="/js/player.js"></script> <!--for timer-->
<!-- monitors if the tab is active -->
</body>
</html>