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

    <?php echo $emptyWork;
    echo $emptyTime; ?>

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
                <div class="panel-heading">List for <?php htmlOut(date('d.m.Y')); ?></div>
                <div class="panel-body">
                    <?php if(isset($resultTable)): ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th><th>Work</th><th>Time</th><th>Remaining time</th><th>Comment</th><th>Status</th><th>Timer</th><th>Edit</th><th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                                <?php foreach($resultTable as $key => $table): ?>
                                    <tr id="trId<?php htmlOut($key + 1); ?>">
                                        <td><?php htmlOut($key + 1); //выводит отсчёт с 1 каждый день ?></td>
                                        <td><?php htmlOut($table['work']); ?></td>
                                        <td><?php htmlOut($table['workTime']); ?></td>
                                        <td id="countdownTimer<?php htmlOut($key + 1); ?>">
                                            <script>var num = <?php htmlOut($key + 1); ?>;
                                                var timeValue<?php htmlOut($key + 1); ?> = <?php htmlOut($table['workTime']); ?>;
                                            </script></td>
                                        <td><?php htmlOut(substr($table['comment'], 0, 175)); ?></td>
                                        <td><?php statusCheck($table['status']); ?></td>
                                        <td>
                                            <div class="player">
                                                <button type="button" id="button_play<?php htmlOut($key + 1); ?>" class="btn-xs btn" onclick='buttonPlayPress(<?php htmlOut($key + 1); ?>)' >
                                                    <i class="fa fa-play"></i>
                                                </button>
                                                <button type="button" id="button_pause<?php htmlOut($key + 1); ?>" class="btn-xs btn" onclick='buttonPausePress(<?php htmlOut($key + 1); ?>)'>
                                                    <i class="fa fa-pause"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <form action="?" method="post">
                                            <div>
                                                <td id="hiddenIdRow"><input type="hidden" name="id" value="<?php echo $table['id']; ?>"></td>
                                                <td><input type="submit" id="editButton<?php htmlOut($key + 1); ?>" name="control" class="btn btn-info btn-xs" value="Edit"></td>
                                                <td><input type="submit" name="control" class="btn btn-danger btn-xs" value="Delete"></td>
                                            </div>
                                        </form>
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

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/js/bootstrap.min.js"></script>

<script src='http://cdnjs.cloudflare.com/ajax/libs/d3/3.4.11/d3.min.js'></script> <!--for timer-->
<script src="/js/player.js"></script> <!--for timer-->
<!--<script>-->
<!--    document.write(num);-->
<!--        var timer = new Timer();-->
<!---->
<!--        $('.table-striped #button_play'+num).click(function () {-->
<!--            timer.start({countdown: true, startValues: {seconds: timeValue1}});-->
<!--            $('#trId'+num).removeClass('warning');-->
<!--            $('#trId'+num).addClass('info');-->
<!--        });-->
<!--        $('.table-striped #button_pause'+num).click(function () {-->
<!--            timer.pause();-->
<!--            $('#trId'+num).removeClass('info');-->
<!--            $('#trId'+num).addClass('warning');-->
<!--        });-->
<!--        timer.addEventListener('secondsUpdated', function () {-->
<!--            $('.table-striped #countdownTimer'+num).html(timer.getTimeValues().toString());-->
<!--        });-->
<!--        timer.addEventListener('started', function () {-->
<!--            $('.table-striped #countdownTimer'+num).html(timer.getTimeValues().toString());-->
<!--        });-->
<!--        timer.addEventListener('targetAchieved', function (e) {-->
<!--            $('#countdownTimer'+num).html('Finished');-->
<!--            document.getElementById("button_play"+num).disabled = true;-->
<!--            document.getElementById("button_pause"+num).disabled = true;-->
<!--            document.getElementById("editButton"+num).disabled = true;-->
<!--            $('#button_play'+num).removeClass('btn-success');-->
<!--            $('#trId'+num).removeClass('info');-->
<!--            $('#trId'+num).addClass('success');-->
<!--        });-->
<!--</script>-->
<script>
    var timer = new Timer();

    $('.table-striped #button_play1').click(function () {
        timer.start({countdown: true, startValues: {seconds: timeValue1}});
        $('#trId1').removeClass('warning');
        $('#trId1').addClass('info');
    });
    $('.table-striped #button_pause1').click(function () {
        timer.pause();
        $('#trId1').removeClass('info');
        $('#trId1').addClass('warning');
    });
    timer.addEventListener('secondsUpdated', function () {
        $('.table-striped #countdownTimer1').html(timer.getTimeValues().toString());
    });
    timer.addEventListener('started', function () {
        $('.table-striped #countdownTimer1').html(timer.getTimeValues().toString());
    });
    timer.addEventListener('targetAchieved', function (e) {
        $('#countdownTimer1').html('Finished');
        document.getElementById("button_play1").disabled = true;
        document.getElementById("button_pause1").disabled = true;
        document.getElementById("editButton1").disabled = true;
        $('#button_play1').removeClass('btn-success');
        $('#trId1').removeClass('info');
        $('#trId1').addClass('success');
    });
</script>
</body>
</html>